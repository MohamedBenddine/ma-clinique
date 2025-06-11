<?php
require_once('translations.php');
$currentLang = getCurrentLang();
$isRTL = isRTL();
?>

<div class="chat-widget">
    <button class="chat-toggle" onclick="toggleChat()">
        <i class="bi bi-robot"></i>
    </button>
    
    <div class="chat-container" id="chatContainer">
        <div class="chat-header">
            <h4 class="chat-title">
                <i class="bi bi-robot"></i>
                <?php echo $currentLang === 'ar' ? 'المساعد الذكي' : 'AI Assistant'; ?>
            </h4>
            <button class="chat-close" onclick="toggleChat()">×</button>
        </div>
        
        <div class="chat-messages" id="chatMessages">
            <!-- Messages will be added here dynamically -->
        </div>
        
        <div class="chat-input-container">
            <input type="text" class="chat-input" id="chatInput" 
                   placeholder="<?php echo $currentLang === 'ar' ? 'اكتب رسالتك...' : 'Type your message...'; ?>" 
                   onkeypress="handleKeyPress(event)"
                   dir="<?php echo $isRTL ? 'rtl' : 'ltr'; ?>">
            <button class="chat-send" id="sendButton" onclick="sendMessage()">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
        
        <div class="ai-status" id="aiStatus">
            <?php echo $currentLang === 'ar' ? 'جاري التحقق من المساعد الذكي...' : 'Checking AI Assistant...'; ?>
        </div>
    </div>
</div>

<link rel="stylesheet" href="css/chat-widget.css">
<script src="js/ollama-chat.js"></script>