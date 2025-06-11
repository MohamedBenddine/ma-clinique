class OllamaChatBot {
  constructor() {
    this.isOpen = false;
    this.isTyping = false;
    this.apiUrl = "api/local-ai.php";
    this.conversationHistory = [];
    this.maxHistory = 10; // Keep last 10 messages for context

    this.init();
  }

  init() {
    // Check if Ollama is available
    this.checkAIStatus();

    // Add welcome message
    this.addMessage(
      "مرحباً! أنا المساعد الطبي الذكي. كيف يمكنني مساعدتك اليوم؟",
      "bot"
    );
  }

  async checkAIStatus() {
    try {
      const response = await fetch(this.apiUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          message: "test connection",
        }),
      });

      const statusElement = document.getElementById("aiStatus");
      if (response.ok) {
        statusElement.textContent = "AI Assistant Online";
        statusElement.className = "ai-status online";
      } else {
        statusElement.textContent = "AI Assistant Offline";
        statusElement.className = "ai-status offline";
      }
    } catch (error) {
      const statusElement = document.getElementById("aiStatus");
      statusElement.textContent = "AI Assistant Offline";
      statusElement.className = "ai-status offline";
    }
  }

  toggleChat() {
    const container = document.getElementById("chatContainer");
    this.isOpen = !this.isOpen;
    container.style.display = this.isOpen ? "flex" : "none";

    if (this.isOpen) {
      document.getElementById("chatInput").focus();
    }
  }

  async sendMessage() {
    const input = document.getElementById("chatInput");
    const sendButton = document.getElementById("sendButton");
    const message = input.value.trim();

    if (!message || this.isTyping) return;

    // Disable input while processing
    input.disabled = true;
    sendButton.disabled = true;

    // Add user message
    this.addMessage(message, "user");
    input.value = "";

    // Add to conversation history
    this.conversationHistory.push({ role: "user", content: message });

    // Show typing indicator
    this.showTyping();

    try {
      // Get AI response
      const response = await this.getAIResponse(message);
      this.hideTyping();
      this.addMessage(response, "bot");

      // Add to conversation history
      this.conversationHistory.push({ role: "assistant", content: response });

      // Keep history manageable
      if (this.conversationHistory.length > this.maxHistory * 2) {
        this.conversationHistory = this.conversationHistory.slice(
          -this.maxHistory * 2
        );
      }
    } catch (error) {
      this.hideTyping();
      console.error("Chat error:", error);
      this.addMessage(
        "عذراً، أواجه مشكلة في الاتصال. يرجى المحاولة مرة أخرى لاحقاً.",
        "bot"
      );
    } finally {
      // Re-enable input
      input.disabled = false;
      sendButton.disabled = false;
      input.focus();
    }
  }

  async getAIResponse(message) {
    // First check for simple responses
    const quickResponse = this.getQuickResponse(message);
    if (quickResponse) return quickResponse;

    // Detect the language of the current message
    const isArabic = /[\u0600-\u06FF]/.test(message);

    // Build comprehensive context for the AI
    let context = isArabic
      ? `أنت مساعد طبي ذكي متخصص في موقع حجز المواعيد الطبية. معلومات مهمة عنك:

🏥 السياق: أنت تعمل في موقع إلكتروني لحجز المواعيد الطبية
📋 مهمتك الأساسية: مساعدة المرضى في حجز المواعيد وتقديم المعلومات الطبية العامة
🌍 اللغة: يجب أن ترد باللغة العربية فقط عندما يسأل المريض بالعربية

التعليمات المهمة:
1. قدم معلومات صحية مفيدة وموثوقة باللغة العربية
2. ساعد في عملية حجز المواعيد وتوجيه المرضى للتخصص المناسب
3. في حالات الطوارئ، وجه فوراً لطلب المساعدة الطبية العاجلة (الرقم 14)
4. انصح دائماً بمراجعة الأطباء المختصين للحصول على تشخيص دقيق
5. اجعل إجاباتك مختصرة وواضحة وودودة ومفيدة
6. قدم معلومات عن العيادة وساعات العمل والخدمات عند الطلب
7. لا تقدم تشخيصات طبية محددة - فقط معلومات عامة ونصائح وقائية

معلومات العيادة:
- ساعات العمل: الإثنين-الجمعة 9:00ص-5:00م، السبت 9:00ص-2:00م
- الهاتف: 0562542839
- الخدمات: الطب العام، التخصصات المختلفة، الفحوصات، الرعاية الوقائية

المحادثة:`
      : `You are an intelligent medical assistant AI specialized for a medical appointment booking website. Important information about you:

🏥 CONTEXT: You work on a medical appointment booking website
📋 PRIMARY ROLE: Help patients book appointments and provide general medical information
🌍 LANGUAGE: You must respond in ENGLISH ONLY when the patient asks in English

Important Instructions:
1. Provide helpful and reliable health information in English
2. Assist with appointment booking process and direct patients to appropriate specialists
3. For emergencies, immediately direct to seek urgent medical help (call 14 or 911)
4. Always recommend consulting with specialized doctors for accurate diagnosis
5. Keep your answers brief, clear, friendly, and helpful
6. Provide clinic information, hours, and services when requested
7. Do not provide specific medical diagnoses - only general information and preventive advice

Clinic Information:
- Hours: Monday-Friday 9:00AM-5:00PM, Saturday 9:00AM-2:00PM
- Phone: 0562542839
- Services: General Medicine, Various Specialties, Tests, Preventive Care

Conversation:`;

    // Add recent conversation for context
    const recentHistory = this.conversationHistory.slice(-6);
    for (const msg of recentHistory) {
      if (isArabic) {
        context += `\n${msg.role === "user" ? "المريض" : "المساعد الطبي"}: ${
          msg.content
        }`;
      } else {
        context += `\n${
          msg.role === "user" ? "Patient" : "Medical Assistant"
        }: ${msg.content}`;
      }
    }

    // Add current message
    context += isArabic
      ? `\nالمريض: ${message}\nالمساعد الطبي:`
      : `\nPatient: ${message}\nMedical Assistant:`;

    console.log("Sending request to:", this.apiUrl);
    console.log("Message context:", context);

    try {
      const response = await fetch(this.apiUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          message: context,
        }),
      });

      console.log("Response status:", response.status);
      console.log("Response ok:", response.ok);

      if (!response.ok) {
        const errorText = await response.text();
        console.error("Response error:", errorText);
        throw new Error(`HTTP ${response.status}: ${errorText}`);
      }

      const data = await response.json();
      console.log("Response data:", data);

      if (data.error) {
        throw new Error(data.error);
      }

      let aiResponse =
        data.response ||
        (isArabic
          ? "عذراً، لم أتمكن من توليد إجابة."
          : "Sorry, I couldn't generate a response.");

      // Clean up the response
      aiResponse = this.cleanResponse(aiResponse, isArabic);

      return aiResponse;
    } catch (error) {
      console.error("Fetch error:", error);

      // Return a helpful fallback message in appropriate language
      return isArabic
        ? `عذراً، أواجه مشكلة في الاتصال بالمساعد الذكي. يمكنك:\n• الاتصال بنا مباشرة: (555) 123-4567\n• حجز موعد من خلال الموقع\n• زيارة العيادة خلال ساعات العمل\n\nخطأ تقني: ${error.message}`
        : `Sorry, I'm having trouble connecting to the AI assistant. You can:\n• Call us directly: (555) 123-4567\n• Book appointment through website\n• Visit clinic during office hours\n\nTechnical error: ${error.message}`;
    }
  }

  getQuickResponse(message) {
    const msg = message.toLowerCase();

    // Detect if the message is in Arabic
    const isArabic = /[\u0600-\u06FF]/.test(message);

    // Emergency keywords (Arabic & English)
    if (
      msg.includes("طوارئ") ||
      msg.includes("عاجل") ||
      msg.includes("ألم شديد") ||
      msg.includes("emergency") ||
      msg.includes("urgent") ||
      msg.includes("severe pain")
    ) {
      return isArabic
        ? "🚨 في حالات الطوارئ الطبية، يرجى الاتصال بالإسعاف فوراً على الرقم 14 أو زيارة أقرب قسم طوارئ!"
        : "🚨 For medical emergencies, call 14 immediately or visit the nearest emergency room!";
    }

    // Appointment booking
    if (
      msg.includes("موعد") ||
      msg.includes("حجز") ||
      msg.includes("appointment") ||
      msg.includes("book")
    ) {
      return isArabic
        ? "يمكنني مساعدتك في حجز موعد! 📅\n\n• انقر على زر 'احجز موعد' في الموقع\n• اتصل بنا: (555) 123-4567\n• زرنا خلال ساعات العمل\n\nما نوع التخصص الذي تحتاجه؟"
        : "I can help you book an appointment! 📅\n\n• Click 'Book Appointment' on website\n• Call us: (555) 123-4567\n• Visit during office hours\n\nWhat type of specialist do you need?";
    }

    // Clinic hours
    if (
      msg.includes("ساعات") ||
      msg.includes("وقت") ||
      msg.includes("متى") ||
      msg.includes("hours") ||
      msg.includes("time") ||
      msg.includes("when")
    ) {
      return isArabic
        ? "⏰ ساعات عمل العيادة:\n• الإثنين-الجمعة: 9:00 ص - 5:00 م\n• السبت: 9:00 ص - 2:00 م\n• الأحد: مغلق\n• الطوارئ: 24/7"
        : "⏰ Clinic Hours:\n• Mon-Fri: 9:00 AM - 5:00 PM\n• Saturday: 9:00 AM - 2:00 PM\n• Sunday: Closed\n• Emergency: 24/7";
    }

    // Services
    if (
      msg.includes("خدمات") ||
      msg.includes("علاج") ||
      msg.includes("تخصص") ||
      msg.includes("services") ||
      msg.includes("treatment") ||
      msg.includes("specialties")
    ) {
      return isArabic
        ? "🏥 خدماتنا الطبية:\n• الطب العام\n• التخصصات المختلفة\n• الفحوصات والتحاليل\n• الرعاية الوقائية\n\nأي تخصص يهمك؟"
        : "🏥 Our Medical Services:\n• General Medicine\n• Various Specialties\n• Tests & Examinations\n• Preventive Care\n\nWhich specialty interests you?";
    }

    // Greetings
    if (
      msg.includes("مرحبا") ||
      msg.includes("أهلا") ||
      msg.includes("السلام") ||
      msg.includes("hello") ||
      msg.includes("hi") ||
      msg.includes("hey")
    ) {
      return isArabic
        ? "مرحباً بك! 👋 أنا المساعد الطبي الذكي. كيف يمكنني مساعدتك اليوم؟"
        : "Hello! 👋 I'm the AI medical assistant. How can I help you today?";
    }

    return null; // Let AI handle it
  }

  cleanResponse(response) {
    // Remove any unwanted prefixes
    response = response.replace(/^(المساعد:|Assistant:|AI:)/i, "").trim();

    // Ensure medical disclaimer
    if (!response.includes("استشارة طبية") && !response.includes("طبيب مختص")) {
      response +=
        "\n\n*ملاحظة: هذه معلومات عامة فقط. يرجى استشارة الأطباء المختصين للحصول على استشارة طبية.*";
    }

    return response;
  }

  addMessage(content, sender) {
    const messagesContainer = document.getElementById("chatMessages");
    const messageDiv = document.createElement("div");
    messageDiv.className = `message ${sender}`;

    const avatar = sender === "bot" ? "🤖" : "👤";

    messageDiv.innerHTML = `
            <div class="message-avatar">${avatar}</div>
            <div class="message-content">${this.formatMessage(content)}</div>
        `;

    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
  }

  formatMessage(content) {
    // Convert newlines to HTML breaks
    content = content.replace(/\n/g, "<br>");

    // Make phone numbers clickable
    content = content.replace(
      /(\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4})/g,
      '<a href="tel:$1">$1</a>'
    );

    // Make emails clickable
    content = content.replace(
      /([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/g,
      '<a href="mailto:$1">$1</a>'
    );

    return content;
  }

  showTyping() {
    this.isTyping = true;
    const messagesContainer = document.getElementById("chatMessages");
    const typingDiv = document.createElement("div");
    typingDiv.className = "message bot";
    typingDiv.id = "typingIndicator";

    typingDiv.innerHTML = `
            <div class="message-avatar">🤖</div>
            <div class="message-content">
                <div class="typing-indicator">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
        `;

    messagesContainer.appendChild(typingDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
  }

  hideTyping() {
    this.isTyping = false;
    const typingIndicator = document.getElementById("typingIndicator");
    if (typingIndicator) {
      typingIndicator.remove();
    }
  }

  handleKeyPress(event) {
    if (event.key === "Enter" && !event.shiftKey) {
      event.preventDefault();
      this.sendMessage();
    }
  }
}

// Initialize chatbot when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
  window.chatBot = new OllamaChatBot();
});

// Global functions for HTML onclick events
function toggleChat() {
  window.chatBot.toggleChat();
}

function sendMessage() {
  window.chatBot.sendMessage();
}

function handleKeyPress(event) {
  window.chatBot.handleKeyPress(event);
}
