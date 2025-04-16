<template>
  <div class="chatbot-container">
    <!-- Nút toggle chatbot -->
    <div class="chatbot-toggle" @click="toggleChat">
   
    <img v-if="!isOpen" src="../../../public/iconchat.png" style="height: 7rem;" alt=""></div>

    <!-- Cửa sổ chatbot -->
    <div v-if="isOpen" class="chatbot-window">
      <div class="chatbot-header">
        <h3 class="text-warning"><img  src="../../../public/iconchat.png" style="height: 3rem;" alt="">HomeS AI</h3>
        <button @click="toggleChat" class="close-btn">×</button>
      </div>
      <div class="chatbot-body">
        <!-- Nội dung chat -->
        <div class="messages">
          <div
            v-for="(message, index) in messages"
            :key="index"
            :class="['message', message.isUser ? 'user-message' : 'ai-message']"
          >
            {{ message.text }}
          </div>
        </div>
        <div class="input-area">
          <input
            v-model="userInput"
            @keyup.enter="sendMessage"
            placeholder="Nhập tin nhắn..."
          />
          <button @click="sendMessage">Gửi</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Chatbot",
  data() {
    return {
      isOpen: false,
      userInput: "",
      messages: [
        { text: "Xin chào! Tôi là Chatbot AI, sẵn sàng giúp bạn!", isUser: false },
      ],
    };
  },
  methods: {
    toggleChat() {
      this.isOpen = !this.isOpen;
    },
    sendMessage() {
      if (this.userInput.trim()) {
        // Thêm tin nhắn người dùng
        this.messages.push({ text: this.userInput, isUser: true });
        this.userInput = "";
        // Giả lập phản hồi AI
        setTimeout(() => {
          this.messages.push({
            text: "Đang xử lý... (Phản hồi mẫu)",
            isUser: false,
          });
        }, 500);
      }
    },
  },
};
</script>

<style scoped>
.chatbot-container {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 1000;
}

.chatbot-toggle {
 
  
  border: none;
  padding: 10px 20px;
  border-radius: 25px;
  cursor: pointer;
  font-size: 16px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease;
}



.chatbot-window {
  width: 300px;
  height: 400px;
  background: white;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  animation: slideIn 0.3s ease;
}

.chatbot-header {
  background: #002b58f3;
  color: rgba(255, 255, 255, 0.123);
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.close-btn {
  background: none;
  border: none;
  color: white;
  font-size: 18px;
  cursor: pointer;
}

.chatbot-body {
  flex: 1;
  display: flex;
  flex-direction: column;
  padding: 10px;
}

.messages {
  flex: 1;
  overflow-y: auto;
  padding: 10px;
  background: #f9f9f9;
  border-radius: 5px;
}

.message {
  margin: 5px 0;
  padding: 8px 12px;
  border-radius: 10px;
  max-width: 80%;
  word-wrap: break-word;
}

.ai-message {
  background: #e1f5fe;
  color: #333;
  align-self: flex-start;
}

.user-message {
  background: #007bff;
  color: white;
  align-self: flex-end;
  margin-left: auto; /* Căn phải */
}

.input-area {
  display: flex;
  gap: 10px;
  padding: 10px 0;
}

input {
  flex: 1;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

button {
  background: #007bff;
  color: white;
  border: none;
  padding: 8px 15px;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background: #0056b3;
}

@keyframes slideIn {
  from {
    transform: translateY(100%);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}
</style>