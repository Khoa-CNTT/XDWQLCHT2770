<template>
  <div class="hero-banner text-white text-start position-relative mb-3">
    <!-- Ảnh nền -->
    <img
      src="https://i.pinimg.com/1200x/25/cd/ef/25cdeff9a8542ff0af62cbe33d2a4a78.jpg"
      class="position-absolute top-0 start-0 w-100 h-100 "
      style="object-fit: cover"
      alt="Banner"
    />

    <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"></div>
    

    <!-- Nội dung -->
    <div class="position-relative h-100 d-flex flex-column justify-content-center px-3 px-md-5 z-2">
      
      <h2 class="hero-title  mb-3">Chuỗi homestay lớn nhất Đà Nẵng</h2>
      <h1 class="title">HomeS</h1>
      <p class="hero-subtext mb-4">
        Hãy để chúng tôi đồng hành với thời gian nghỉ dưỡng của bạn
      </p>
      <router-link to="/search" class="btn btn-light btn-lg  fw-bold shadow"
      style="width:fit-content">Đặt ngay</router-link>
    </div>
  </div>
</template>

<style scoped>
.hero-banner {
  height: calc(100vw * (6 / 19));
  min-height: 300px;
  max-height: 700px;
}

.hero-title {
  font-size: 2.2rem;
  color: aliceblue;
}
.title{
  font-size: 3rem;
  color: #ffb700;
  padding: 0;
  margin: 0;
}
.hero-subtext {
  font-size: 1rem;
  text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.7);
}

.tagline {
  font-size: 0.9rem;
  letter-spacing: 1px;
  text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.6);
}

/* Responsive chỉnh kích thước chữ */
@media (max-width: 768px) {
  .hero-title {
    font-size: 1.5rem;
  }

  .hero-subtext {
    font-size: 0.8rem;
  }
.title{
    font-size: 2rem;
  }
 

  .tagline {
    font-size: 1rem;
  }
}

</style>
