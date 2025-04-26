<template>
  <div class="chatbot-container">
    <!-- Nút toggle chatbot -->
    <div class="chatbot-toggle" @click="toggleChat">
      <img v-if="!isOpen" src="/iconchat.png" style="height: 7rem;" alt="Chat Icon">
    </div>

    <!-- Cửa sổ chatbot -->
    <div v-if="isOpen" class="chatbot-window">
      <div class="chatbot-header">
        <h3 class="text-white"><img src="/iconchat.png"  style="height: 3rem; vertical-align: middle;" alt="Chat Icon"> HomeS AI</h3>
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
import { GoogleGenerativeAI } from "@google/generative-ai";

export default {
  name: "Chatbot",
  data() {
    return {
      isOpen: false,
      userInput: "",
      messages: [
        { text: "Xin chào! Tôi là HomeS AI, nhân viên hỗ trợ homestay tại Đà Nẵng. Tôi có thể giúp gì cho bạn hôm nay?", isUser: false },
      ],
      ai: new GoogleGenerativeAI("AIzaSyBKJUREcPl0maAMh7CfxSu9fmNbx6bIUNI"),
    };
  },
  methods: {
    toggleChat() {
      this.isOpen = !this.isOpen;
    },
    async sendMessage() {
      if (this.userInput.trim()) {
        this.messages.push({ text: this.userInput, isUser: true });
        const userMessage = this.userInput;
        this.userInput = "";

        try {
          const prompt = `
            Bạn là một nhân viên hỗ trợ homestay tại Đà Nẵng, làm việc cho chuỗi homestay HomeS. 
            Chuỗi homestay này có nhiều homestay khác nhau, mỗi homestay có phong cách trang trí độc đáo (ví dụ: phong cách hiện đại, cổ điển, tối giản, gần gũi thiên nhiên). 
            Tất cả các homestay đều nằm ở Đà Nẵng. Nhiệm vụ của bạn là:

            1. Trả lời các câu hỏi của khách hàng về homestay, bao gồm thông tin về phòng, giá cả, địa điểm, tiện ích, hoặc kinh nghiệm du lịch Đà Nẵng.
            2. Hỗ trợ khách tìm phòng phù hợp dựa trên nhu cầu của họ (ví dụ: phòng cho cặp đôi, nhóm bạn, gia đình, phong cách trang trí, ngân sách).
            3. Cung cấp thông tin về các bài viết chia sẻ kinh nghiệm du lịch Đà Nẵng nếu khách hỏi.
            4. Trả lời bằng tiếng Việt, với giọng điệu lịch sự, thân thiện, chuyên nghiệp, và nhiệt tình.

            Nếu khách hỏi về thông tin cụ thể mà bạn không có (ví dụ: giá chính xác, tình trạng phòng), hãy trả lời rằng bạn sẽ kiểm tra với quản lý và gợi ý khách để lại thông tin liên hệ hoặc kiểm tra trực tiếp trên website.

            Dưới đây là câu hỏi hoặc yêu cầu của khách hàng: ${userMessage}
          `;

          const model = this.ai.getGenerativeModel({ model: "gemini-1.5-flash" });
          const result = await model.generateContent(prompt);
          const response = await result.response.text();

          this.messages.push({ text: response, isUser: false });
        } catch (error) {
          console.error("Lỗi khi gọi API Gemini:", error);
          this.messages.push({
            text: "Đã xảy ra lỗi, vui lòng thử lại!",
            isUser: false,
          });
        }

        this.$nextTick(() => {
          const messagesContainer = this.$el.querySelector(".messages");
          if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
          }
        });
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
  padding: 10px;
  
  cursor: pointer;
 
  transition: all 0.3s ease;
  
}

.chatbot-toggle img {
  display: block;
}

.chatbot-window {
  width: 350px;
  height: 500px;
  background: white;
  border-radius: 15px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  animation: slideIn 0.3s ease;
}

.chatbot-header {
  background: #132e63; /* Màu nền tiêu đề */
  color: white; /* Màu chữ trắng */
  padding: 15px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.chatbot-header h3 {
  margin: 0;
  font-size: 1.2rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.close-btn {
  background: none;
  border: none;
  color: white;
  font-size: 24px;
  cursor: pointer;
  transition: color 0.3s ease;
}

.close-btn:hover {
  color: #ddd;
}

.chatbot-body {
  flex: 1;
  display: flex;
  flex-direction: column;
  padding: 15px;
  background: #f5f5f5; /* Nền nhẹ cho phần nội dung */
  overflow: hidden;
}

.messages {
  flex: 1;
  max-height: 400px;
  overflow-y: auto;
  padding: 10px;
  background: white;
  border-radius: 10px;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
}

.message {
  margin: 8px 0;
  padding: 10px 15px;
  border-radius: 15px;
  max-width: 80%;
  word-wrap: break-word;
  line-height: 1.4;
}

.ai-message {
  background: #e1f5fe;
  color: #333;
  align-self: flex-start;
}

.user-message {
  background: #132e63;
  color: white;
  align-self: flex-end;
  margin-left: auto;
}

.input-area {
  display: flex;
  gap: 10px;
  padding: 10px 0;
  background: white;
  border-top: 1px solid #ddd;
}

.input-area input {
  flex: 1;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 20px;
  outline: none;
  font-size: 14px;
}

.input-area button {
  background: #132e63;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 20px;
  cursor: pointer;
  font-size: 14px;
  transition: background 0.3s ease;
}

.input-area button:hover {
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