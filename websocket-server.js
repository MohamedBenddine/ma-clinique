const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const mysql = require('mysql2/promise');
const cors = require('cors');
require('dotenv').config();

const app = express();
const server = http.createServer(app);
const io = socketIo(server, {
  cors: {
    origin: "http://localhost", // Adjust to your domain
    methods: ["GET", "POST"]
  }
});

app.use(cors());
app.use(express.json());

// Database connection
const dbConfig = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'damsmsdb'
};

let db;

async function connectDB() {
  try {
    db = await mysql.createConnection(dbConfig);
    console.log('✅ Connected to MySQL database');
  } catch (error) {
    console.error('❌ Database connection failed:', error);
    process.exit(1);
  }
}

// Store connected users
const connectedUsers = new Map();
const appointmentRooms = new Map();

io.on('connection', (socket) => {
  console.log(`🔗 User connected: ${socket.id}`);

  // Handle user joining (doctor or patient)
  socket.on('join-appointment', async (data) => {
    try {
      const { appointmentId, userType, userId, userName } = data;
      const roomName = `appointment-${appointmentId}`;
      
      // Join the room
      socket.join(roomName);
      
      // Store user info
      connectedUsers.set(socket.id, {
        appointmentId,
        userType,
        userId,
        userName,
        roomName
      });
      
      // Add to appointment room tracking
      if (!appointmentRooms.has(appointmentId)) {
        appointmentRooms.set(appointmentId, new Set());
      }
      appointmentRooms.get(appointmentId).add(socket.id);
      
      console.log(`👤 ${userName} (${userType}) joined appointment ${appointmentId}`);
      
      // Notify others in the room
      socket.to(roomName).emit('user-joined', {
        userType,
        userName,
        message: `${userName} joined the chat`
      });
      
      // Send confirmation to user
      socket.emit('joined-successfully', {
        appointmentId,
        roomName,
        message: 'Connected to chat'
      });
      
      // Send online users list
      const roomUsers = Array.from(appointmentRooms.get(appointmentId) || [])
        .map(socketId => connectedUsers.get(socketId))
        .filter(user => user);
      
      io.to(roomName).emit('online-users', roomUsers);
      
    } catch (error) {
      console.error('Error joining appointment:', error);
      socket.emit('error', { message: 'Failed to join chat' });
    }
  });

  // Handle sending messages
  socket.on('send-message', async (data) => {
    try {
      const { appointmentId, message, senderType, senderName } = data;
      const user = connectedUsers.get(socket.id);
      
      if (!user || user.appointmentId != appointmentId) {
        socket.emit('error', { message: 'Not authorized for this chat' });
        return;
      }
      
      // Save message to database
      const [result] = await db.execute(
        'INSERT INTO tblchat (AppointmentID, Message, SenderType, SenderName, CreatedAt) VALUES (?, ?, ?, ?, NOW())',
        [appointmentId, message, senderType, senderName]
      );
      
      const messageData = {
        id: result.insertId,
        appointmentId,
        message,
        senderType,
        senderName,
        createdAt: new Date().toISOString(),
        socketId: socket.id
      };
      
      // Broadcast to all users in the appointment room
      const roomName = `appointment-${appointmentId}`;
      io.to(roomName).emit('new-message', messageData);
      
      console.log(`💬 Message sent in appointment ${appointmentId}: ${message.substring(0, 50)}...`);
      
    } catch (error) {
      console.error('Error sending message:', error);
      socket.emit('error', { message: 'Failed to send message' });
    }
  });

  // Handle typing indicators
  socket.on('typing', (data) => {
    const { appointmentId, isTyping, userName, userType } = data;
    const user = connectedUsers.get(socket.id);
    
    if (user && user.appointmentId == appointmentId) {
      const roomName = `appointment-${appointmentId}`;
      socket.to(roomName).emit('user-typing', {
        userName,
        userType,
        isTyping
      });
    }
  });

  // Handle marking messages as read
  socket.on('mark-as-read', async (data) => {
    try {
      const { appointmentId, readerType } = data;
      const user = connectedUsers.get(socket.id);
      
      if (!user || user.appointmentId != appointmentId) {
        return;
      }
      
      // Update read status in database
      const otherType = readerType === 'doctor' ? 'patient' : 'doctor';
      await db.execute(
        'UPDATE tblchat SET IsRead = 1 WHERE AppointmentID = ? AND SenderType = ? AND IsRead = 0',
        [appointmentId, otherType]
      );
      
      // Notify other users in room
      const roomName = `appointment-${appointmentId}`;
      socket.to(roomName).emit('messages-read', {
        appointmentId,
        readerType
      });
      
    } catch (error) {
      console.error('Error marking messages as read:', error);
    }
  });

  // Handle disconnection
  socket.on('disconnect', () => {
    const user = connectedUsers.get(socket.id);
    
    if (user) {
      const { appointmentId, roomName, userName, userType } = user;
      
      // Remove from appointment room
      if (appointmentRooms.has(appointmentId)) {
        appointmentRooms.get(appointmentId).delete(socket.id);
        if (appointmentRooms.get(appointmentId).size === 0) {
          appointmentRooms.delete(appointmentId);
        }
      }
      
      // Notify others
      socket.to(roomName).emit('user-left', {
        userType,
        userName,
        message: `${userName} left the chat`
      });
      
      // Update online users list
      const roomUsers = Array.from(appointmentRooms.get(appointmentId) || [])
        .map(socketId => connectedUsers.get(socketId))
        .filter(user => user);
      
      io.to(roomName).emit('online-users', roomUsers);
      
      console.log(`👋 ${userName} (${userType}) disconnected from appointment ${appointmentId}`);
    }
    
    connectedUsers.delete(socket.id);
    console.log(`🔌 User disconnected: ${socket.id}`);
  });
});

// API endpoint to get chat history
app.get('/api/chat-history/:appointmentId', async (req, res) => {
  try {
    const { appointmentId } = req.params;
    
    const [rows] = await db.execute(
      'SELECT * FROM tblchat WHERE AppointmentID = ? ORDER BY CreatedAt ASC',
      [appointmentId]
    );
    
    res.json({ success: true, messages: rows });
  } catch (error) {
    console.error('Error fetching chat history:', error);
    res.json({ success: false, message: 'Failed to fetch chat history' });
  }
});

// Health check endpoint
app.get('/health', (req, res) => {
  res.json({ 
    status: 'OK', 
    connectedUsers: connectedUsers.size,
    activeRooms: appointmentRooms.size,
    timestamp: new Date().toISOString()
  });
});

const PORT = process.env.PORT || 3000;

// Start server
async function startServer() {
  await connectDB();
  
  server.listen(PORT, () => {
    console.log(`🚀 WebSocket server running on port ${PORT}`);
    console.log(`📡 Socket.IO endpoint: http://localhost:${PORT}`);
    console.log(`🏥 Health check: http://localhost:${PORT}/health`);
  });
}

startServer();