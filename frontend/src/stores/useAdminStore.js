import { defineStore } from 'pinia';
import api from '../services/api';
import router from '../routers';

export const useAdminStore = defineStore('admin', {
  state: () => ({
    admin: null,
    token: null,
    isAuthenticated: false,
  }),
  actions: {
    async login(credentials) {
      try {
        const response = await api.post('/admin/login', {
          email: credentials.email,
          password: credentials.password,
        });
        this.admin = response.data.admin;
        this.token = response.data.token;
        this.isAuthenticated = true;
        location.reload();

        localStorage.setItem('admin_token', this.token);
        api.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
      } catch (error) {
        const message = error.response?.data?.message || 'Đăng nhập thất bại';
        throw new Error(message);
      }
    },
    async fetchProfile() {
      try {
        const response = await api.get('/admin/profile');
        this.admin = response.data.data;
        console.log('Admin profile:', this.admin);
        this.isAuthenticated = true;
      } catch (error) {
        this.admin = null;
        this.isAuthenticated = false;
        localStorage.removeItem('admin_token');
        delete api.defaults.headers.common['Authorization'];
        throw new Error(error.response?.data?.message || 'Lấy thông tin thất bại');
      }
    },
    async checkToken() {
      try {
        const response = await api.get('/admin/kiem-tra-token');
        if (response.data.status) {
          await this.fetchProfile();
          
        }
      } catch (error) {
        this.admin = null;
        this.isAuthenticated = false;
        localStorage.removeItem('admin_token');
        delete api.defaults.headers.common['Authorization'];
        console.error('Lỗi khi kiểm tra token:', error);
      }
    },
    async logout() {
      try {
        await api.post('/admin/logout');
      } catch (error) {
        console.error('Logout failed:', error);
      }
      this.admin = null;
      this.token = null;
      this.isAuthenticated = false;
      localStorage.removeItem('admin_token');
      delete api.defaults.headers.common['Authorization'];
    },
    initializeAuth() {
      const token = localStorage.getItem('admin_token');
      if (token) {
        this.token = token;
        this.isAuthenticated = true;
        api.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        this.checkToken();
      }
    },
  },
  getters: {
    getAdmin: (state) => state.admin,
    isLoggedIn: (state) => state.isAuthenticated,
  },
});