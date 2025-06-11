<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['damsid']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ma Clinique | Chat Dashboard</title>
    
    <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css assets/css/app.min.css -->
    <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <!-- endbuild -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/doctor-chat.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
    <script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"> -->
    <script>
        Breakpoints();
    </script>
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">
                                <i class="bi bi-chat-dots me-2"></i>
                                Patient Chat
                            </h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                            <div class="row">
                                <!-- Chat List -->
                                <div class="col-md-4">
                                    <div class="chat-list-container">
                                        <div class="chat-list-header d-flex justify-content-between align-items-center p-3 border-bottom">
                                            <h5 class="mb-0">
                                                <i class="bi bi-people me-2"></i>
                                                Active Chats
                                            </h5>
                                            <button class="btn btn-sm btn-primary" onclick="refreshChatList()" title="Refresh">
                                                <i class="bi bi-arrow-clockwise"></i>
                                            </button>
                                        </div>
                                        <div id="chatList" class="chat-list">
                                            <div class="text-center p-4">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <p class="mt-2 text-muted">Loading chats...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Chat Window -->
                                <div class="col-md-8">
                                    <div class="chat-window-container" style="height: 600px;">
                                        <div id="chatWindow" class="h-100">
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <div class="text-center text-muted">
                                                    <i class="bi bi-chat-square-dots" style="font-size: 3rem; opacity: 0.3;"></i>
                                                    <h5 class="mt-3">Select a chat to start messaging</h5>
                                                    <p class="mb-0">Choose a patient from the list to view conversation</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                </div><!-- END column -->
            </div><!-- .row -->
        </section><!-- .app-content -->
    </div><!-- .wrap -->
    
    <!-- APP FOOTER -->
    <?php include_once('includes/footer.php');?>
    <!-- /#app-footer -->
</main>
<!--========== END app main -->

<!-- APP CUSTOMIZER -->
<?php include_once('includes/customizer.php');?>

<!-- build:js assets/js/core.min.js -->
<script src="libs/bower/jquery/dist/jquery.js"></script>
<script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
<script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
<script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="libs/bower/PACE/pace.min.js"></script>
<!-- endbuild -->

<!-- build:js assets/js/app.min.js -->
<script src="assets/js/library.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/app.js"></script>
<!-- endbuild -->

<script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
<script>
    let currentAppointmentId = null;
    let socket = null;
    let typingTimer = null;
    const doctorId = <?php echo $_SESSION['damsid']; ?>;
    const doctorName = 'Dr. <?php echo $_SESSION['damsname'] ?? 'Doctor'; ?>';

    // Initialize WebSocket connection
    function initializeWebSocket() {
        socket = io('http://localhost:3000'); // Adjust to your WebSocket server URL
        
        socket.on('connect', () => {
            console.log('🔗 Connected to WebSocket server');
        });
        
        socket.on('disconnect', () => {
            console.log('🔌 Disconnected from WebSocket server');
        });
        
        socket.on('joined-successfully', (data) => {
            console.log('✅ Joined chat room:', data);
        });
        
        socket.on('new-message', (messageData) => {
            if (messageData.appointmentId == currentAppointmentId) {
                displayNewMessage(messageData);
                loadChatList(); // Refresh chat list to update last message
            }
        });
        
        socket.on('user-typing', (data) => {
            showTypingIndicator(data);
        });
        
        socket.on('user-joined', (data) => {
            console.log('👤 User joined:', data);
            updateOnlineStatus(true);
        });
        
        socket.on('user-left', (data) => {
            console.log('👋 User left:', data);
            updateOnlineStatus(false);
        });
        
        socket.on('online-users', (users) => {
            updateOnlineUsersList(users);
        });
        
        socket.on('error', (error) => {
            console.error('❌ WebSocket error:', error);
        });
    }

    // Load chat list (keep existing function but enhance it)
    function loadChatList() {
        fetch('api/doctor-chat-list.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayChatList(data.chats);
                } else {
                    document.getElementById('chatList').innerHTML = `
                        <div class="text-center p-4 text-muted">
                            <i class="bi bi-chat-slash"></i>
                            <p class="mt-2">No active chats found</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading chat list:', error);
                document.getElementById('chatList').innerHTML = `
                    <div class="text-center p-4 text-muted">
                        <i class="bi bi-exclamation-triangle"></i>
                        <p class="mt-2">Error loading chats</p>
                    </div>
                `;
            });
    }

    // Display chat list (keep existing function)
    function displayChatList(chats) {
        const chatList = document.getElementById('chatList');
        
        if (chats.length === 0) {
            chatList.innerHTML = `
                <div class="text-center p-4 text-muted">
                    <i class="bi bi-chat-slash"></i>
                    <p class="mt-2">No active chats found</p>
                </div>
            `;
            return;
        }

        let html = '';
        chats.forEach(chat => {
            const isActive = currentAppointmentId == chat.AppointmentID;
            const unreadCount = chat.UnreadCount > 0 ? `<span class="unread-badge">${chat.UnreadCount}</span>` : '';
            
            html += `
                <div class="chat-list-item ${isActive ? 'active' : ''}" 
                     onclick="openChat(${chat.AppointmentID}, '${escapeHtml(chat.PatientName)}', '${chat.AppointmentNumber}')">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-1">${escapeHtml(chat.PatientName)}</h6>
                                ${unreadCount}
                            </div>
                            <small class="text-muted">#${chat.AppointmentNumber}</small>
                            <div class="last-message">${escapeHtml(chat.LastMessage) || 'No messages yet'}</div>
                        </div>
                        <div class="message-time">
                            ${chat.LastMessageTime ? formatTime(chat.LastMessageTime) : ''}
                        </div>
                    </div>
                </div>
            `;
        });

        chatList.innerHTML = html;
    }

    // Enhanced openChat function with WebSocket integration
    function openChat(appointmentId, patientName, appointmentNumber) {
        // Leave previous room if exists
        if (currentAppointmentId && socket) {
            socket.emit('leave-appointment', { appointmentId: currentAppointmentId });
        }
        
        currentAppointmentId = appointmentId;
        
        // Update active state
        document.querySelectorAll('.chat-list-item').forEach(item => {
            item.classList.remove('active');
        });
        event.currentTarget.classList.add('active');

        // Load chat window
        const chatWindow = document.getElementById('chatWindow');
        chatWindow.innerHTML = `
            <div class="chat-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">${patientName}</h5>
                    <small class="text-muted">Appointment #${appointmentNumber}</small>
                </div>
                <div class="text-muted d-flex align-items-center">
                    <span class="status-indicator" id="onlineStatus"></span>
                    <small id="statusText">Connecting...</small>
                </div>
            </div>
            <div class="chat-messages flex-grow-1" id="doctorChatMessages">
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading messages...</span>
                    </div>
                </div>
            </div>
            <div class="typing-indicator" id="typingIndicator">
                <span class="typing-text"></span>
            </div>
            
            <div class="chat-input">
                <div class="input-group">
                    <input type="text" class="form-control" id="messageInput" 
                           placeholder="Type your message here..." maxlength="1000">
                    <button class="btn btn-primary" type="button" id="doctorSendBtn" 
                            onclick="sendDoctorMessage()">
                        <i class="bi bi-send"></i>
                    </button>
                </div>
            </div>
        `;

        // Join WebSocket room
        if (socket) {
            socket.emit('join-appointment', {
                appointmentId: appointmentId,
                userType: 'doctor',
                userId: doctorId,
                userName: doctorName
            });
        }

        // Load existing messages
        loadChatMessages(appointmentId);

        // Setup input listeners
        setupInputListeners();
    }

    // Setup input event listeners
    function setupInputListeners() {
        setTimeout(() => {
            const input = document.getElementById('messageInput'); // Changed from 'doctorMessageInput'
            if (input) {
                // Enter key to send
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        sendDoctorMessage();
                    }
                });
                
                // Typing indicator
                input.addEventListener('input', function() {
                    if (socket && currentAppointmentId) {
                        socket.emit('typing', {
                            appointmentId: currentAppointmentId,
                            isTyping: true,
                            userName: doctorName,
                            userType: 'doctor'
                        });
                        
                        clearTimeout(typingTimer);
                        typingTimer = setTimeout(() => {
                            socket.emit('typing', {
                                appointmentId: currentAppointmentId,
                                isTyping: false,
                                userName: doctorName,
                                userType: 'doctor'
                            });
                        }, 1000);
                    }
                });
                
                input.focus();
            }
        }, 100);
    }

    // Load messages from database
    function loadChatMessages(appointmentId) {
        fetch(`http://localhost:3000/api/chat-history/${appointmentId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayDoctorMessages(data.messages);
                    markMessagesAsRead(appointmentId);
                }
            })
            .catch(error => {
                console.error('Error loading messages:', error);
                // Fallback to PHP API
                fetch(`../api/chat-messages.php?appointment_id=${appointmentId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            displayDoctorMessages(data.messages);
                            markMessagesAsRead(appointmentId);
                        }
                    });
            });
    }

    // Display messages
    function displayDoctorMessages(messages) {
        const chatMessages = document.getElementById('doctorChatMessages');
        if (!chatMessages) return;

        if (messages.length === 0) {
            chatMessages.innerHTML = `
                <div class="text-center text-muted">
                    <i class="bi bi-chat-dots"></i>
                    <p class="mt-2">No messages yet</p>
                    <small>Start the conversation with your patient</small>
                </div>
            `;
            return;
        }

        let html = '';
        messages.forEach(message => {
            const isDoctor = message.SenderType === 'doctor';
            const messageClass = isDoctor ? 'own' : 'other';
            
            html += `
                <div class="message ${messageClass} mb-3" data-message-id="${message.ID || message.id}">
                    <div class="message-content">
                        <div class="message-text">${escapeHtml(message.Message || message.message)}</div>
                        <div class="message-time">${formatTime(message.CreatedAt || message.createdAt)}</div>
                    </div>
                </div>
            `;
        });

        chatMessages.innerHTML = html;
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Display new real-time message
    function displayNewMessage(messageData) {
        const chatMessages = document.getElementById('doctorChatMessages');
        if (!chatMessages) return;

        const isDoctor = messageData.senderType === 'doctor';
        const messageClass = isDoctor ? 'own' : 'other';
        
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${messageClass} mb-3 new-message`;
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

    // Enhanced send message function
    function sendDoctorMessage() {
        if (!currentAppointmentId || !socket) return;

        const messageInput = document.getElementById('messageInput'); // Fixed - was 'doctorMessageInput'
        const sendBtn = document.getElementById('doctorSendBtn');
        const message = messageInput.value.trim();

        if (!message) {
            messageInput.focus();
            return;
        }

        // Disable input and show loading
        messageInput.disabled = true;
        sendBtn.disabled = true;
        sendBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin"></i>';

        // Send via WebSocket
        socket.emit('send-message', {
            appointmentId: currentAppointmentId,
            message: message,
            senderType: 'doctor',
            senderName: doctorName
        });

        // Clear input
        messageInput.value = '';
        messageInput.disabled = false;
        sendBtn.disabled = false;
        sendBtn.innerHTML = '<i class="bi bi-send"></i>';
        messageInput.focus();
    }

    // Show typing indicator
    function showTypingIndicator(data) {
        const indicator = document.getElementById('typingIndicator');
        if (!indicator) return;

        if (data.isTyping && data.userType === 'patient') {
            indicator.classList.add('show');
            indicator.querySelector('.typing-text').textContent = `${data.userName} is typing...`;
        } else {
            indicator.classList.remove('show');
        }
    }

    // Update online status
    function updateOnlineStatus(isOnline) {
        const statusIndicator = document.getElementById('onlineStatus');
        const statusText = document.getElementById('statusText');
        
        if (statusIndicator && statusText) {
            if (isOnline) {
                statusIndicator.className = 'status-indicator online me-2';
                statusText.textContent = 'Online';
            } else {
                statusIndicator.className = 'status-indicator offline me-2';
                statusText.textContent = 'Offline';
            }
        }
    }

    // Update online users list
    function updateOnlineUsersList(users) {
        const hasPatient = users.some(user => user.userType === 'patient');
        updateOnlineStatus(hasPatient);
    }

    // Mark messages as read
    function markMessagesAsRead(appointmentId) {
        if (socket) {
            socket.emit('mark-as-read', {
                appointmentId: appointmentId,
                readerType: 'doctor'
            });
        }
    }

    // Refresh chat list
    function refreshChatList() {
        loadChatList();
    }

    // Utility functions (keep existing ones)
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
        loadChatList();
        
        // Refresh chat list every 30 seconds (less frequent since we have real-time updates)
        setInterval(loadChatList, 30000);
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

<?php } ?>