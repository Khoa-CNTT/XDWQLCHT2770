<template>
  <div class="slider-container" v-if="homestays.length > 0">
    <!-- Ảnh bên trái (mờ) -->
    <div class="side-image left">
      <transition name="slide-side">
        <img
          :key="homestays[(currentIndex - 1 + homestays.length) % homestays.length].id"
          :src="homestays[(currentIndex - 1 + homestays.length) % homestays.length].image || defaultImage"
          alt="Slide left"
          @error="handleImageError"
        />
      </transition>
    </div>

    <!-- Ảnh chính ở giữa -->
    <div class="main-image">
      <div class="overlay-text">
        <h2>{{ homestays[currentIndex].ten_homestay || 'Homestay' }}</h2>
        <p>{{ homestays[currentIndex].mo_ta || 'Không có mô tả' }}</p>
        <router-link to="/search">
          <button>Đặt phòng ngay</button>
        </router-link>
      </div>
      <transition name="slide">
        <img
          :key="homestays[currentIndex].id"
          :src="homestays[currentIndex].image || defaultImage"
          alt="Main slide"
          @error="handleImageError"
        />
      </transition>
      <button class="nav-button left" @click="prevSlide">❮</button>
      <button class="nav-button right" @click="nextSlide">❯</button>
    </div>

    <!-- Ảnh bên phải (mờ) -->
    <div class="side-image right">
      <transition name="slide-side">
        <img
          :key="homestays[(currentIndex + 1) % homestays.length].id"
          :src="homestays[(currentIndex + 1) % homestays.length].image || defaultImage"
          alt="Slide right"
          @error="handleImageError"
        />
      </transition>
    </div>
  </div>
  <div v-else class="text-center py-10">
    <p class="text-gray-500">Đang tải danh sách homestay...</p>
  </div>
</template>

<script>
import api from '../../services/api';

export default {
  name: 'Slider',
  data() {
    return {
      homestays: [],
      backendBaseUrl: "http://127.0.0.1:8000/storage/",
      defaultImage: "https://via.placeholder.com/600x400?text=No+Image",
      currentIndex: 0,
      interval: null,
    };
  },
  mounted() {
    this.startAutoSlide();
    this.getHomestay();
  },
  beforeDestroy() {
    this.stopAutoSlide();
  },
  methods: {
    async getHomestay() {
      try {
        const response = await api.get('/homestay/list');
        if (response && response.data) {
          this.homestays = response.data.map((homestay) => ({
            ...homestay,
            image: homestay.anh_chinh ? this.backendBaseUrl + homestay.anh_chinh : this.defaultImage,
          }));
        }
      } catch (error) {
        console.error('Error fetching homestays:', error);
      }
    },
    startAutoSlide() {
      this.interval = setInterval(() => {
        this.nextSlide();
      }, 4000);
    },
    stopAutoSlide() {
      clearInterval(this.interval);
    },
    nextSlide() {
      this.currentIndex = (this.currentIndex + 1) % this.homestays.length;
    },
    prevSlide() {
      this.currentIndex = (this.currentIndex - 1 + this.homestays.length) % this.homestays.length;
    },
    handleImageError(event) {
      event.target.src = this.defaultImage;
    },
  },
};
</script>

<style scoped>
.slider-container {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 15px;
  padding: 20px;
  overflow: hidden;
  width: 100%;
  max-width: 1400px;
  margin: 0 auto;
}

.main-image {
  position: relative;
  width: 60%;
  height: 450px;
  overflow: hidden;
  border-radius: 15px;
}

.main-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 15px;
  position: absolute;
  top: 0;
  left: 0;
}

.side-image {
  width: 20%;
  height: 450px;
  opacity: 0.6;
  overflow: hidden;
  position: relative;
}

.side-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 15px;
  position: absolute;
  top: 0;
  left: 0;
}

.overlay-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  text-align: center;
  z-index: 1;
  width: 80%;
  padding: 20px;
  border-radius: 10px;
}

.overlay-text h2 {
  font-size: 2.2rem;
  font-weight: 700;
  margin-bottom: 12px;
  color: #fff;
  text-shadow:
    -1px -1px 0 #062d62,
    1px -1px 0 #062d62,
    -1px 1px 0 #062d62,
    1px 1px 0 #062d62;
}

.overlay-text p {
  font-size: 1.1rem;
  margin-bottom: 20px;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
}

.overlay-text button {
  padding: 12px 24px;
  background: #007bff;
  color: white;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  font-weight: 600;
  transition: background-color 0.3s ease;
}

.overlay-text button:hover {
  background: #0056b3;
}

.nav-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.6);
  color: white;
  border: none;
  padding: 12px;
  cursor: pointer;
  border-radius: 50%;
  z-index: 2;
  font-size: 1.2rem;
  transition: background 0.3s ease;
}

.nav-button:hover {
  background: rgba(0, 0, 0, 0.8);
}

.nav-button.left {
  left: 15px;
}

.nav-button.right {
  right: 15px;
}

/* Hiệu ứng chuyển động mượt mà hơn cho ảnh chính */
.slide-enter-active,
.slide-leave-active {
  transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1), opacity 1s ease, filter 1s ease;
}

.slide-enter {
  transform: translateX(100%);
  opacity: 0;
  filter: blur(5px);
}

.slide-leave-to {
  transform: translateX(-100%);
  opacity: 0;
  filter: blur(5px);
}

/* Hiệu ứng chuyển động mượt mà hơn cho ảnh phụ */
.slide-side-enter-active,
.slide-side-leave-active {
  transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1), opacity 1s ease, filter 1s ease;
}

.slide-side-enter {
  transform: translateX(50%);
  opacity: 0;
  filter: blur(5px);
}

.slide-side-leave-to {
  transform: translateX(-50%);
  opacity: 0;
  filter: blur(5px);
}

/* Preload hình ảnh để tránh giật lag */
.main-image img,
.side-image img {
  will-change: transform, opacity, filter;
}

/* Responsive */
@media (max-width: 768px) {
  .slider-container {
    flex-direction: column;
    padding: 15px;
  }

  .main-image {
    width: 100%;
    height: 350px;
  }

  .side-image {
    display: none;
  }

  .overlay-text {
    width: 90%;
    padding: 15px;
  }

  .overlay-text h2 {
    font-size: 1.6rem;
  }

  .overlay-text p {
    font-size: 0.95rem;
  }

  .overlay-text button {
    padding: 10px 20px;
    font-size: 0.9rem;
  }

  .slide-enter-active,
  .slide-leave-active {
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.8s ease, filter 0.8s ease;
  }
}

@media (max-width: 480px) {
  .main-image {
    height: 250px;
  }

  .overlay-text h2 {
    font-size: 1.3rem;
  }

  .overlay-text p {
    font-size: 0.85rem;
  }

  .overlay-text button {
    padding: 8px 16px;
    font-size: 0.8rem;
  }
}
</style>