import { defineStore } from 'pinia';
import api from '../services/api';

export const useUserStore = defineStore('user', {
  state: () => ({
    customer: null,
    token: null,
    isAuthenticated: false,
  }),
  actions: {
    async login(credentials) {
      try {
        const response = await api.post('/login', {
          email: credentials.email,
          mat_khau: credentials.password,
        });
        this.customer = response.data.customer;
        this.token = response.data.token;
        this.isAuthenticated = true;

        localStorage.setItem('token', this.token);
        api.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
      } catch (error) {
        const message = error.response?.data?.message || 'Đăng nhập thất bại';
        throw new Error(message);
      }
    },
    async fetchProfile() {
      try {
        const response = await api.get('/profile');
        this.customer = response.data.data;
        this.isAuthenticated = true;
      } catch (error) {
        this.customer = null;
        this.isAuthenticated = false;
        localStorage.removeItem('token');
        delete api.defaults.headers.common['Authorization'];
        throw new Error(error.response?.data?.message || 'Lấy thông tin thất bại');
      }
    },
    async checkToken() {
      try {
        const response = await api.get('/kiem-tra-token-khach-hang');
        if (response.data.status) {
          await this.fetchProfile();
        }
      } catch (error) {
        this.customer = null;
        this.isAuthenticated = false;
        localStorage.removeItem('token');
        delete api.defaults.headers.common['Authorization'];
        console.error('Lỗi khi kiểm tra token:', error);
      }
    },
    async logout() {
      try {
        await api.post('/logout');
      } catch (error) {
        console.error('Logout failed:', error);
      }
      this.customer = null;
      this.token = null;
      this.isAuthenticated = false;
      localStorage.removeItem('token');
      delete api.defaults.headers.common['Authorization'];
    },
    initializeAuth() {
      const token = localStorage.getItem('token');
      if (token) {
        this.token = token;
        this.isAuthenticated = true;
        api.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        this.checkToken();
      }
    },
  },
  getters: {
    getCustomer: (state) => state.customer,
    isLoggedIn: (state) => state.isAuthenticated,
  },
});