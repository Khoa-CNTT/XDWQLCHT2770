<template>
    <div class="bg-gray-100 font-sans min-h-screen">
      <!-- Header -->
      <header class="bg-blue-600 text-white py-6">
        <div class="container mx-auto text-center">
          <h1 class="text-3xl font-bold">Về Chúng Tôi</h1>
        </div>
      </header>
  
      <!-- Main Content -->
      <section class="container mx-auto py-12">
        <div class="bg-white shadow-lg rounded-lg p-8">
          <h2 class="text-2xl font-semibold mb-4">Chúng Tôi Là Ai?</h2>
          <p class="text-gray-700 mb-6">
            Thành lập từ năm 2020, chúng tôi là một chuỗi homestay tại Đà Nẵng, tự hào mang đến cho khách hàng những không gian lưu trú độc đáo với nhiều phong cách trang trí khác nhau. Mỗi phòng tại homestay của chúng tôi đều được thiết kế riêng biệt, từ hiện đại, tối giản đến vintage hay bohemian, đáp ứng mọi sở thích và nhu cầu của du khách.
          </p>
  
          <h2 class="text-2xl font-semibold mb-4">Sứ Mệnh Của Chúng Tôi</h2>
          <p class="text-gray-700 mb-6">
            Chúng tôi mong muốn mang đến cho khách hàng những trải nghiệm lưu trú đáng nhớ tại Đà Nẵng, không chỉ là nơi nghỉ ngơi mà còn là hành trình khám phá văn hóa và vẻ đẹp địa phương. Hệ thống của chúng tôi tích hợp công nghệ AI hiện đại, giúp khách hàng dễ dàng tìm kiếm phòng phù hợp và nhận gợi ý cá nhân hóa, cùng với các bài viết chia sẻ kinh nghiệm du lịch do đội ngũ của chúng tôi thực hiện.
          </p>
  
          <h2 class="text-2xl font-semibold mb-4">Tầm Nhìn</h2>
          <p class="text-gray-700 mb-6">
            Chúng tôi hướng đến việc trở thành chuỗi homestay hàng đầu tại Đà Nẵng, được yêu thích bởi sự đa dạng trong phong cách phòng, chất lượng dịch vụ và sự tiện lợi từ công nghệ. Trong tương lai, chúng tôi sẽ tiếp tục mở rộng quy mô, đồng thời không ngừng cải tiến để mang lại trải nghiệm tốt nhất cho khách hàng.
          </p>
  
          <h2 class="text-2xl font-semibold mb-4">Giá Trị Cốt Lõi</h2>
          <ul class="list-disc list-inside text-gray-700">
            <li v-for="value in coreValues" :key="value.title">
              <strong>{{ value.title }}:</strong> {{ value.description }}
            </li>
          </ul>
        </div>
      </section>
  
      <!-- Footer -->
      <footer class="bg-blue-600 text-white py-4">
        <div class="container mx-auto text-center">
          <p>© 2025 Chuỗi Homestay Đà Nẵng. Mọi quyền được bảo lưu.</p>
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
          { title: 'Trải nghiệm', description: 'Kết hợp lưu trú và chia sẻ kinh nghiệm du lịch để khách hàng khám phá Đà Nẵng trọn vẹn.' }
        ]
      }
    }
  }
  </script>
  
  <style scoped>
  /* Tailwind CSS is included via CDN in the main HTML file */
  </style>