<template>
  <div class="slider-container">
    <!-- Ảnh bên trái (mờ) -->
    <div class="side-image left">
      <transition name="slide-side">
        <img
          :key="slides[(currentIndex - 1 + slides.length) % slides.length].image"
          :src="slides[(currentIndex - 1 + slides.length) % slides.length].image"
          alt="Slide left"
        />
      </transition>
    </div>

    <!-- Ảnh chính ở giữa -->
    <div class="main-image">
      <div class="overlay-text">
        <h2>{{ slides[currentIndex].roomType }}</h2>
        <p>{{ slides[currentIndex].description }}</p>
        <router-link to="/search">
          <button>Đặt phòng ngay</button>
        </router-link>
      </div>
      <transition name="slide">
        <img
          :key="slides[currentIndex].image"
          :src="slides[currentIndex].image"
          alt="Main slide"
        />
      </transition>
      <button class="nav-button left" @click="prevSlide">❮</button>
      <button class="nav-button right" @click="nextSlide">❯</button>
    </div>

    <!-- Ảnh bên phải (mờ) -->
    <div class="side-image right">
      <transition name="slide-side">
        <img
          :key="slides[(currentIndex + 1) % slides.length].image"
          :src="slides[(currentIndex + 1) % slides.length].image"
          alt="Slide right"
        />
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Slider',
  data() {
    return {
      slides: [
        {
          roomType: 'Phòng Deluxe View Biển',
          description: 'Tận hưởng không gian sang trọng với tầm nhìn toàn cảnh biển Đà Nẵng.',
          image: 'https://storage.googleapis.com/vinhomes-data-02/hinh-anh-top-20-y-tuong-thiet-ke-homestay-dep-an-tuong-hut-khach-so-1_1646321312.jpg'
        },
        {
          roomType: 'Phòng Gỗ Thiên Nhiên',
          description: 'Thư giãn trong không gian mộc mạc, hòa mình vào thiên nhiên.',
          image: 'https://th.bing.com/th/id/OIP.KS2r3thDPGpvo9xjCbNLJAHaFP?rs=1&pid=ImgDetMain'
        },
        {
          roomType: 'Phòng Lãng Mạn View Núi',
          description: 'Lý tưởng cho cặp đôi với khung cảnh núi non hùng vĩ.',
          image: 'https://charminghome.com.vn/wp-content/uploads/2018/01/Thi%E1%BA%BFt-K%E1%BA%BF-Homestay-5.jpg'
        }
      ],
      currentIndex: 0,
      interval: null
    };
  },
  mounted() {
    this.startAutoSlide();
  },
  beforeDestroy() {
    this.stopAutoSlide();
  },
  methods: {
    startAutoSlide() {
      this.interval = setInterval(() => {
        this.nextSlide();
      }, 3000);
    },
    stopAutoSlide() {
      clearInterval(this.interval);
    },
    nextSlide() {
      this.currentIndex = (this.currentIndex + 1) % this.slides.length;
    },
    prevSlide() {
      this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
    }
  }
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
}

.nav-button.left {
  left: 15px;
}

.nav-button.right {
  right: 15px;
}

/* Hiệu ứng chuyển động ngang mềm mại cho ảnh chính */
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.8s ease-in-out, opacity 0.8s ease-in-out;
}

.slide-enter {
  transform: translateX(100%);
  opacity: 0;
}

.slide-leave-to {
  transform: translateX(-100%);
  opacity: 0;
}

/* Hiệu ứng chuyển động ngang cho ảnh phụ */
.slide-side-enter-active,
.slide-side-leave-active {
  transition: transform 0.8s ease-in-out, opacity 0.8s ease-in-out;
}

.slide-side-enter {
  transform: translateX(50%);
  opacity: 0;
}

.slide-side-leave-to {
  transform: translateX(-50%);
  opacity: 0;
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