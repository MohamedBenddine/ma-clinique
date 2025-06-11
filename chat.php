<?php
session_start();
include('doctor/includes/dbconnection.php');
require_once('includes/translations.php');

$currentLang = getCurrentLang();
$isRTL = isRTL();

// Get appointment ID from URL
$appointmentId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$appointmentId) {
    header('Location: check-appointment.php');
    exit();
}

// Verify appointment exists
$sql = "SELECT ta.*, td.FullName as DoctorName FROM tblappointment ta 
        LEFT JOIN tbldoctor td ON ta.Doctor = td.ID 
        WHERE ta.ID = :id";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $appointmentId, PDO::PARAM_INT);
$query->execute();
$appointment = $query->fetch(PDO::FETCH_OBJ);

if (!$appointment) {
    header('Location: check-appointment.php');
    exit();
}

// Patient information
$currentUser = 'patient';
$currentUserName = $appointment->Name;
?>

<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo t('chat_title'); ?></title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <?php if ($isRTL): ?>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <?php endif; ?>
    <link rel="stylesheet" href="css/chat.css">
</head>

<body>
    <div class="chat-container">
        <!-- Chat Header -->
        <div class="chat-header">
            <div class="chat-header-left">
                <a href="check-appointment.php" class="back-btn">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div class="chat-info">
                    <h5>Dr. <?php echo $appointment->DoctorName; ?></h5>
                    <small><?php echo t('appointment'); ?> #<?php echo $appointment->AppointmentNumber; ?></small>
                </div>
            </div>
            <div class="chat-status">
                <span class="status-indicator" id="onlineStatus"></span>
                <small id="statusText"><?php echo t('connecting'); ?></small>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="chat-messages" id="chatMessages">
            <div class="loading-messages">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <!-- Typing Indicator -->
        <div class="typing-indicator" id="typingIndicator">
            <span class="typing-text"></span>
        </div>

        <!-- Chat Input -->
        <div class="chat-input">
            <div class="input-group">
                <input type="text" class="form-control" id="messageInput" 
                       placeholder="<?php echo t('type_message'); ?>" maxlength="1000">
                <button class="btn btn-primary" type="button" id="sendBtn">
                    <i class="bi bi-send"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
    <script>
        // Global variables
        const chatMessages = document.getElementById('chatMessages');
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const typingIndicator = document.getElementById('typingIndicator');
        const onlineStatus = document.getElementById('onlineStatus');
        const statusText = document.getElementById('statusText');
        
        const appointmentId = <?php echo $appointmentId; ?>;
        const currentUser = '<?php echo $currentUser; ?>';
        const currentUserName = '<?php echo addslashes($currentUserName); ?>';
        const isRTL = <?php echo $isRTL ? 'true' : 'false'; ?>;
        
        let socket = null;
        let typingTimer = null;

        // Initialize WebSocket connection
        function initializeWebSocket() {
            socket = io('http://localhost:3000');
            
            socket.on('connect', () => {
                console.log('🔗 Connected to WebSocket server');
                updateConnectionStatus(true);
                
                // Join appointment room
                socket.emit('join-appointment', {
                    appointmentId: appointmentId,
                    userType: currentUser,
                    userId: 'patient_' + appointmentId, // Simple patient ID
                    userName: currentUserName
                });
            });
            
            socket.on('disconnect', () => {
                console.log('🔌 Disconnected from WebSocket server');
                updateConnectionStatus(false);
            });
            
            socket.on('joined-successfully', (data) => {
                console.log('✅ Joined chat room:', data);
                updateConnectionStatus(true);
            });
            
            socket.on('new-message', (messageData) => {
                if (messageData.appointmentId == appointmentId) {
                    displayNewMessage(messageData);
                }
            });
            
            socket.on('user-typing', (data) => {
                if (data.userType === 'doctor') {
                    showTypingIndicator(data);
                }
            });
            
            socket.on('user-joined', (data) => {
                console.log('👤 User joined:', data);
                if (data.userType === 'doctor') {
                    updateDoctorOnlineStatus(true);
                }
            });
            
            socket.on('user-left', (data) => {
                console.log('👋 User left:', data);
                if (data.userType === 'doctor') {
                    updateDoctorOnlineStatus(false);
                }
            });
            
            socket.on('online-users', (users) => {
                const hasDoctor = users.some(user => user.userType === 'doctor');
                updateDoctorOnlineStatus(hasDoctor);
            });
            
            socket.on('error', (error) => {
                console.error('❌ WebSocket error:', error);
                updateConnectionStatus(false);
            });
        }

        // Update connection status
        function updateConnectionStatus(isConnected) {
            if (isConnected) {
                onlineStatus.className = 'status-indicator online';
                statusText.textContent = '<?php echo t("connected"); ?>';
            } else {
                onlineStatus.className = 'status-indicator offline';
                statusText.textContent = '<?php echo t("disconnected"); ?>';
            }
        }

        // Update doctor online status
        function updateDoctorOnlineStatus(isOnline) {
            if (isOnline) {
                onlineStatus.className = 'status-indicator online';
                statusText.textContent = '<?php echo t("doctor_online"); ?>';
            } else {
                onlineStatus.className = 'status-indicator offline';
                statusText.textContent = '<?php echo t("doctor_offline"); ?>';
            }
        }

        // Load messages from WebSocket server
        function loadMessages() {
            fetch(`http://localhost:3000/api/chat-history/${appointmentId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayMessages(data.messages);
                    }
                })
                .catch(error => {
                    console.error('Error loading messages:', error);
                    // Fallback to PHP API
                    fetch(`api/chat-messages.php?appointment_id=${appointmentId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                displayMessages(data.messages);
                            }
                        });
                });
        }

        // Display messages
        function displayMessages(messages) {
            chatMessages.innerHTML = '';
            
            if (messages.length === 0) {
                chatMessages.innerHTML = `
                    <div class="no-messages">
                        <i class="bi bi-chat-dots"></i>
                        <p><?php echo t('no_messages_yet'); ?></p>
                        <small><?php echo t('start_conversation'); ?></small>
                    </div>
                `;
                return;
            }

            messages.forEach(message => {
                const messageDiv = document.createElement('div');
                const isOwn = (message.SenderType || message.senderType) === currentUser;
                
                messageDiv.className = `message ${isOwn ? 'own' : 'other'}`;
                messageDiv.setAttribute('data-message-id', message.ID || message.id);
                messageDiv.innerHTML = `
                    <div class="message-content">
                        <div class="message-text">${escapeHtml(message.Message || message.message)}</div>
                        <div class="message-time">${formatTime(message.CreatedAt || message.createdAt)}</div>
                    </div>
                `;
                
                chatMessages.appendChild(messageDiv);
            });

            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Display new real-time message
        function displayNewMessage(messageData) {
            const messageDiv = document.createElement('div');
            const isOwn = messageData.senderType === currentUser;
            
            messageDiv.className = `message ${isOwn ? 'own' : 'other'} new-message`;
            messageDiv.setAttribute('data-message-id', messageData.id);
            messageDiv.innerHTML = `
                <div class="message-content">
                    <div class="message-text">${escapeHtml(messageData.message)}</div>
                    <div class="message-time">${formatTime(messageData.createdAt)}</div>
                </div>
            `;
            
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            // Remove new message animation after a delay
            setTimeout(() => {
                messageDiv.classList.remove('new-message');
            }, 1000);
        }

        // Show typing indicator
        function showTypingIndicator(data) {
            if (data.isTyping) {
                typingIndicator.classList.add('show');
                typingIndicator.querySelector('.typing-text').textContent = `${data.userName} <?php echo t('is_typing'); ?>...`;
            } else {
                typingIndicator.classList.remove('show');
            }
        }

        // Send message via WebSocket
        function sendMessage() {
            const message = messageInput.value.trim();
            if (!message || !socket) return;

            sendBtn.disabled = true;
            sendBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin"></i>';

            // Send via WebSocket
            socket.emit('send-message', {
                appointmentId: appointmentId,
                message: message,
                senderType: currentUser,
                senderName: currentUserName
            });

            // Clear input
            messageInput.value = '';
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="bi bi-send"></i>';
            messageInput.focus();
        }

        // Setup input listeners
        function setupInputListeners() {
            // Send button click
            sendBtn.addEventListener('click', sendMessage);
            
            // Enter key to send
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });
            
            // Typing indicator
            messageInput.addEventListener('input', function() {
                if (socket && appointmentId) {
                    socket.emit('typing', {
                        appointmentId: appointmentId,
                        isTyping: true,
                        userName: currentUserName,
                        userType: currentUser
                    });
                    
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(() => {
                        socket.emit('typing', {
                            appointmentId: appointmentId,
                            isTyping: false,
                            userName: currentUserName,
                            userType: currentUser
                        });
                    }, 1000);
                }
            });
        }

        // Utility functions
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatTime(timestamp) {
            const date = new Date(timestamp);
            const now = new Date();
            const diffInHours = Math.abs(now - date) / 36e5;

            if (diffInHours < 24) {
                return date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            } else {
                return date.toLocaleDateString();
            }
        }

        // Initialize everything
        document.addEventListener('DOMContentLoaded', function() {
            initializeWebSocket();
            setupInputListeners();
            
            // Load initial messages
            setTimeout(() => {
                loadMessages();
            }, 1000);
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', function() {
            if (socket) {
                socket.disconnect();
            }
        });
    </script>
</body>
</html>