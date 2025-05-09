<template>
  <div class="bg-gradient-to-br from-teal-50 to-blue-50 font-sans min-h-screen">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-700 to-blue-500 text-white py-10 shadow-lg">
      <div class="container mx-auto text-center px-6">
        <h1 class="text-5xl font-extrabold tracking-tight animate-fade-in-down">Về Chúng Tôi</h1>
        <p class="mt-3 text-lg text-blue-100 opacity-90">Khám phá hành trình và đam mê của chuỗi Homestay Đà Nẵng</p>
      </div>
    </header>

    <!-- Main Content -->
    <section class="container mx-auto py-20 px-6">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Card 1: About Us -->
        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <h2 class="text-2xl font-bold text-gray-900 mb-5 border-b-4 border-teal-500 pb-3">Chúng Tôi Là Ai?</h2>
          <p class="text-gray-700 leading-relaxed">
            Thành lập từ năm 2020, chúng tôi là chuỗi homestay tại Đà Nẵng, mang đến không gian lưu trú độc đáo với các phong cách từ hiện đại, tối giản đến vintage và bohemian. Mỗi phòng được thiết kế riêng biệt, đáp ứng mọi sở thích của du khách.
          </p>
        </div>

        <!-- Card 2: Mission -->
        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <h2 class="text-2xl font-bold text-gray-900 mb-5 border-b-4 border-teal-500 pb-3">Sứ Mệnh</h2>
          <p class="text-gray-700 leading-relaxed">
            Mang đến trải nghiệm lưu trú đáng nhớ tại Đà Nẵng, kết hợp khám phá văn hóa địa phương. Công nghệ AI giúp tìm phòng dễ dàng và cung cấp gợi ý cá nhân hóa cùng kinh nghiệm du lịch từ đội ngũ chúng tôi.
          </p>
        </div>

        <!-- Card 3: Vision -->
        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <h2 class="text-2xl font-bold text-gray-900 mb-5 border-b-4 border-teal-500 pb-3">Tầm Nhìn</h2>
          <p class="text-gray-700 leading-relaxed">
            Trở thành chuỗi homestay hàng đầu tại Đà Nẵng với dịch vụ đa dạng và tiện ích công nghệ. Chúng tôi sẽ mở rộng quy mô và cải tiến không ngừng để nâng cao trải nghiệm khách hàng.
          </p>
        </div>

        <!-- Core Values -->
        <div class="lg:col-span-3 bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300">
          <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b-4 border-teal-500 pb-3">Giá Trị Cốt Lõi</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div v-for="value in coreValues" :key="value.title" class="p-6 bg-teal-50 rounded-xl hover:bg-teal-100 transition-colors duration-300">
              <strong class="text-teal-700 font-semibold text-lg">{{ value.title }}</strong>
              <p class="text-gray-600 mt-2">{{ value.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-700 to-blue-500 text-white py-8">
      <div class="container mx-auto text-center px-6">
        <p class="text-base">© 2025 Chuỗi Homestay Đà Nẵng. Mọi quyền được bảo lưu.</p>
        <div class="mt-4 flex justify-center space-x-6">
          <a href="#" class="hover:text-teal-200 transition-colors duration-200">Liên hệ</a>
          <a href="#" class="hover:text-teal-200 transition-colors duration-200">Chính sách</a>
          <a href="#" class="hover:text-teal-200 transition-colors duration-200">Hỗ trợ</a>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'AboutUs',
  data() {
    return {
      coreValues: [
        { title: 'Đa dạng', description: 'Cung cấp nhiều phong cách phòng để khách hàng tự do lựa chọn theo sở thích.' },
        { title: 'Chất lượng', description: 'Đảm bảo mọi phòng đều được chăm chút tỉ mỉ, mang đến sự thoải mái tối đa.' },
        { title: 'Công nghệ', description: 'Ứng dụng AI để hỗ trợ khách hàng tìm kiếm và trải nghiệm dịch vụ tiện lợi.' },
        { title: 'Trải nghiệm', description: 'Kết hợp lưu trú và chia sẻ kinh nghiệm du lịch để khám phá Đà Nẵng trọn vẹn.' }
      ]
    }
  }
}
</script>

<style scoped>
@keyframes fadeInDown {
  from { opacity: 0; transform: translateY(-20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-down {
  animation: fadeInDown 0.8s ease-out;
}

.transition-all {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>