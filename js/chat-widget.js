class MedicalChatBot {
  constructor() {
    this.isOpen = false;
    this.isTyping = false;
    this.conversationHistory = [];

    // Free Hugging Face API - no key needed for some models
    this.apiUrl =
      "https://api-inference.huggingface.co/models/microsoft/DialoGPT-medium";

    this.medicalResponses = {
      // Pre-defined medical responses
      appointment:
        "I can help you book an appointment! Click the 'Book Appointment' button on our website or call us directly.",
      hours:
        "Our clinic hours are Monday-Friday 9AM-5PM, Saturday 9AM-2PM. For emergencies, please call 911.",
      services:
        "We offer general consultation, specialized treatments, preventive care, and emergency services. What specific service interests you?",
      emergency:
        "⚠️ For medical emergencies, call 911 immediately! For non-urgent concerns, book an appointment.",
      contact:
        "You can reach us at: Phone: (555) 123-4567, Email: info@clinic.com, or visit us at our location.",
      insurance:
        "We accept most major insurance plans. Please call us to verify your specific coverage.",
      covid:
        "We follow all COVID-19 safety protocols. Masks required, temperature checks, and social distancing measures in place.",
    };
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
    const message = input.value.trim();

    if (!message || this.isTyping) return;

    // Add user message
    this.addMessage(message, "user");
    input.value = "";

    // Show typing indicator
    this.showTyping();

    try {
      // Get AI response
      const response = await this.getAIResponse(message);
      this.hideTyping();
      this.addMessage(response, "bot");
    } catch (error) {
      this.hideTyping();
      this.addMessage(
        "Sorry, I'm having trouble connecting. Please try again later.",
        "bot"
      );
      console.error("Chat error:", error);
    }
  }

  async getAIResponse(message) {
    // First check for simple medical responses
    const simpleResponse = this.getSimpleResponse(message);
    if (simpleResponse) return simpleResponse;

    try {
      // Try Hugging Face API for more complex queries
      const response = await fetch(this.apiUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          inputs: message,
          parameters: {
            max_length: 100,
            temperature: 0.7,
            do_sample: true,
          },
        }),
      });

      if (response.ok) {
        const data = await response.json();
        let aiResponse =
          data[0]?.generated_text ||
          "I'm here to help with your medical questions!";

        // Clean up the response and add medical context
        aiResponse = this.addMedicalContext(aiResponse);
        return aiResponse;
      } else {
        return this.getFallbackResponse(message);
      }
    } catch (error) {
      console.log("AI API unavailable, using fallback");
      return this.getFallbackResponse(message);
    }
  }

  getSimpleResponse(message) {
    const msg = message.toLowerCase();

    // Check for keywords and return appropriate responses
    for (const [keyword, response] of Object.entries(this.medicalResponses)) {
      if (msg.includes(keyword)) {
        return response;
      }
    }

    // Greetings
    if (msg.match(/^(hi|hello|hey|good morning|good afternoon)/i)) {
      return "Hello! Welcome to our medical center. I'm here to help you with appointments, clinic information, and general health guidance. How can I assist you today?";
    }

    // Questions about symptoms (be careful with medical advice)
    if (
      msg.includes("symptom") ||
      msg.includes("pain") ||
      msg.includes("hurt")
    ) {
      return "I understand you're concerned about symptoms. While I can provide general information, it's important to consult with our healthcare providers for proper diagnosis and treatment. Would you like to book an appointment?";
    }

    // Pricing/cost questions
    if (msg.includes("cost") || msg.includes("price") || msg.includes("fee")) {
      return "For pricing information, please call our office at (555) 123-4567. Costs vary depending on services and insurance coverage.";
    }

    return null; // Let AI handle it
  }

  getFallbackResponse(message) {
    const fallbacks = [
      "Thank you for your question! For specific medical concerns, I recommend speaking with one of our healthcare providers. You can book an appointment through our website.",
      "I'm here to help! While I can provide general information, our medical professionals can give you the best guidance for your specific situation.",
      "That's a great question! Our medical team would be the best to answer that for you. Would you like me to help you schedule an appointment?",
      "I understand your concern. For personalized medical advice, please consult with our healthcare providers. I can help you book an appointment right away!",
    ];

    return fallbacks[Math.floor(Math.random() * fallbacks.length)];
  }

  addMedicalContext(response) {
    // Add medical disclaimer to AI responses
    const disclaimer =
      "\n\n*Please note: This is general information only. Always consult with healthcare professionals for medical advice.*";
    return response + disclaimer;
  }

  addMessage(content, sender) {
    const messagesContainer = document.getElementById("chatMessages");
    const messageDiv = document.createElement("div");
    messageDiv.className = `message ${sender}`;

    const avatar = sender === "bot" ? "🤖" : "👤";

    messageDiv.innerHTML = `
            <div class="message-avatar">${avatar}</div>
            <div class="message-content">${content}</div>
        `;

    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
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
    if (event.key === "Enter") {
      this.sendMessage();
    }
  }
}

// Initialize chatbot
const chatBot = new MedicalChatBot();

// Global functions for HTML onclick events
function toggleChat() {
  chatBot.toggleChat();
}

function sendMessage() {
  chatBot.sendMessage();
}

function handleKeyPress(event) {
  chatBot.handleKeyPress(event);
}
