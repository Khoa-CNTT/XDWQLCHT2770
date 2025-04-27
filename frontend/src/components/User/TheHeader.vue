<template>
  <div style="background-color: #062d62">
    <div class="container d-flex">
      <nav
        class="navbar navbar-expand-lg navbar-dark"
        style="flex: 1; background-color: #062d62"
      >
        <div class="container-fluid">
          <router-link to="/" class="navbar-brand d-flex align-items-center">
            <img src="/logolight.png" alt="Logo" style="height: 40px" />
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
          <div
            class="collapse navbar-collapse justify-content-center"
            id="navbarContent"
          >
            <ul class="navbar-nav mb-2 mb-lg-0 w-100 justify-content-center">
              <li class="nav-item">
                <router-link to="/home" class="nav-link">Trang chủ</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/search" class="nav-link">Đặt phòng</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/post" class="nav-link">Bài viết</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/about" class="nav-link">Về chúng tôi</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/#" class="nav-link">Liên hệ</router-link>
              </li>
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
            :src="avatarUrl"
            alt="User"
            style="object-fit: cover;"
            width="40"
            height="40"
            class="rounded-circle"
          />
          <div class="ms-2 d-none d-lg-block text-start">
            <div class="fw-bold">{{ customer?.ho_ten || "Tài khoản" }}</div>
            <div class="small">{{ customer?.email || "Khách truy cập" }}</div>
          </div>
        </a>
        <ul
          class="dropdown-menu w-100 mt-2"
          style="z-index: 100000"
          aria-labelledby="userDropdown"
        >
          <template v-if="isLoggedIn">
            <li>
              <router-link class="dropdown-item" to="/profile">👤 Tài khoản</router-link>
            </li>
            <li>
              <button class="dropdown-item text-danger" @click="logout">🚪 Đăng xuất</button>
            </li>
          </template>
          <template v-else>
            <li>
              <router-link class="dropdown-item" to="/login">🔐 Đăng nhập</router-link>
            </li>
            <li>
              <router-link class="dropdown-item" to="/register">📝 Đăng ký</router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { useUserStore } from '../../stores/usesStore.js';
import { useRouter } from 'vue-router';

export default {
  name: "Navbar",
  setup() {
    const userStore = useUserStore();
    const router = useRouter();
    return { userStore, router };
  },
  data() {
    return {
      defaultAvatar: "/default-avatar.png",
      backendBaseUrl: "http://127.0.0.1:8000/storage/",
    };
  },
  computed: {
    customer() {
      return this.userStore.getCustomer;
    },
    isLoggedIn() {
      return this.userStore.isLoggedIn;
    },
    avatarUrl() {
      return this.customer?.avatar
        ? `${this.backendBaseUrl}${this.customer.avatar}`
        : this.defaultAvatar;
    },
  },
  mounted() {
    this.userStore.initializeAuth();
  },
  methods: {
    async logout() {
      try {
        await this.userStore.logout();
        this.router.push('/login');
        alert("Đăng xuất thành công");
      } catch (error) {
        console.error("Lỗi khi đăng xuất:", error);
        alert("Đã xảy ra lỗi khi đăng xuất!");
      }
    },
  },
};
</script>