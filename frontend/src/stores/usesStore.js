import { defineStore } from 'pinia';
import axios from 'axios';

// Thiết lập base URL cho Axios
axios.defaults.baseURL = 'http://127.0.0.1:8000/'; // Thay bằng URL backend của bạn

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    isAuthenticated: false,
  }),

  actions: {
    // Hàm đăng nhập
    async login(credentials) {
      try {
        // Lấy CSRF token (yêu cầu bởi Sanctum)
        await axios.get('/sanctum/csrf-cookie');

        // Gửi request đăng nhập (thay đổi endpoint nếu cần)
        await axios.post('/api/login', credentials);

        // Lấy thông tin người dùng từ API profile
        await this.fetchUser();

        return true;
      } catch (error) {
        console.error('Đăng nhập thất bại:', error);
        return false;
      }
    },

    // Hàm lấy thông tin người dùng
    async fetchUser() {
      try {
        const response = await axios.get('/api/profile');
        this.user = response.data;
        this.isAuthenticated = true;
      } catch (error) {
        console.error('Lấy thông tin người dùng thất bại:', error);
        this.user = null;
        this.isAuthenticated = false;
      }
    },

    // Hàm đăng xuất
    async logout() {
      try {
        // Gọi API logout
        await axios.post('/api/logout');
        // Xóa thông tin người dùng
        this.user = null;
        this.isAuthenticated = false;
      } catch (error) {
        console.error('Đăng xuất thất bại:', error);
      }
    },
  },
});