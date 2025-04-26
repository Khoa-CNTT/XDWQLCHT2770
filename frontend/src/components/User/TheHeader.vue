<template>
  <div style="background-color: #062d62;">
    <div class="container d-flex">
      <nav class="navbar navbar-expand-lg navbar-dark" style="flex: 1; background-color: #062d62;">
        <div class="container-fluid">
          <router-link to="/" class="navbar-brand d-flex align-items-center">
            <img src="/logolight.png" alt="Logo" style="height: 40px;" />
          </router-link>
          <button
            class="btn text-white d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarContent"
            aria-controls="navbarContent"
            aria-expanded="false"
          >
            <i class="fa-solid fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <ul class="navbar-nav mb-2 mb-lg-0 w-100 justify-content-center">
              <li class="nav-item"><router-link to="/home" class="nav-link">Trang chủ</router-link></li>
              <li class="nav-item"><router-link to="/search" class="nav-link">Đặt phòng</router-link></li>
              <li class="nav-item"><router-link to="/post" class="nav-link">Bài viết</router-link></li>
              <li class="nav-item"><router-link to="/about" class="nav-link">Về chúng tôi</router-link></li>
              <li class="nav-item"><router-link to="/#" class="nav-link">Liên hệ</router-link></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="dropdown mt-3">
        <a
          href="#"
          class="d-flex align-items-center text-white text-decoration-none"
          id="userDropdown"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            :src="defaultAvatar"
            alt="User"
            width="40"
            height="40"
            class="rounded-circle"
          />
          <div class="ms-2 d-none d-lg-block text-start">
            <div class="fw-bold">{{ ho_ten || 'Tài khoản' }}</div>
            <div class="small">{{ email || 'Khách truy cập' }}</div>
          </div>
        </a>
        <ul class="dropdown-menu w-100 mt-2" style="z-index: 100000;" aria-labelledby="userDropdown">
          <template v-if="isAuthenticated">
            <li><router-link class="dropdown-item" to="/profile">👤 Tài khoản</router-link></li>
            <li><a class="dropdown-item text-danger" href="#" @click="logout">🚪 Đăng xuất</a></li>
          </template>
          <template v-else>
            <li><router-link class="dropdown-item" to="/login">🔐 Đăng nhập</router-link></li>
            <li><router-link class="dropdown-item" to="/register">📝 Đăng ký</router-link></li>
          </template>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Navbar',
  data() {
    return {
      user: null, // Khởi tạo user là null (dùng để lưu thông tin avatar nếu có)
      defaultAvatar: '/default-avatar.png', // Đường dẫn đến ảnh đại diện mặc định
      isAuthenticated: false, // Trạng thái đăng nhập
      ho_ten: null, // Lưu họ tên từ localStorage
      email: null, // Lưu email từ localStorage
    };
  },
  mounted() {
    // Kiểm tra thông tin từ localStorage khi tải trang
    const token = localStorage.getItem('token_khachhang');
    this.ho_ten = localStorage.getItem('ho_ten');
    this.email = localStorage.getItem('email');
    this.defaultAvatar = localStorage.getItem('avatar') 

    if (token) {
      this.isAuthenticated = true;
      // Gọi API để kiểm tra token
      this.checkLogin();
    } else {
      this.isAuthenticated = false;
      this.ho_ten = null;
      this.email = null;
      this.defaultAvatar = '/default-avatar.png';
    }
  },
  methods: {
    async checkLogin() {
      const token = localStorage.getItem('token_khachhang');
      if (!token) {
        this.isAuthenticated = false;
        this.ho_ten = null;
        this.email = null;
        localStorage.removeItem('ho_ten');
        localStorage.removeItem('email');
        return;
      }

      try {
        const res = await axios.get('http://127.0.0.1:8000/api/kiem-tra-token-khach-hang', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        if (res.data.status) {
          // Nếu token hợp lệ, giữ trạng thái đăng nhập
          this.isAuthenticated = true;
          // Cập nhật lại ho_ten và email từ localStorage (đã lưu khi đăng nhập)
          this.ho_ten = localStorage.getItem('ho_ten');
          this.email = localStorage.getItem('email');
        } else {
          // Nếu token không hợp lệ, xóa dữ liệu và đánh dấu chưa đăng nhập
          this.isAuthenticated = false;
          this.ho_ten = null;
          this.email = null;
          localStorage.removeItem('token_khachhang');
          localStorage.removeItem('ho_ten');
          localStorage.removeItem('email');
        }
      } catch (error) {
        console.error('Lỗi khi kiểm tra token:', error);
        this.isAuthenticated = false;
        this.ho_ten = null;
        this.email = null;
        localStorage.removeItem('token_khachhang');
        localStorage.removeItem('ho_ten');
        localStorage.removeItem('email');
      }
    },
    logout() {
      // Xóa thông tin đăng nhập
      localStorage.removeItem('token_khachhang');
      localStorage.removeItem('ho_ten');
      localStorage.removeItem('email');
      localStorage.removeItem('avatar');
      this.isAuthenticated = false;
      this.ho_ten = null;
      this.email = null;
      alert('Đăng xuất thành công');
      window.location.reload();
    },
  },
};
</script>