import axios from 'axios';
import { createToaster } from '@meforma/vue-toaster';
import { useAdminStore } from '../stores/useAdminStore';

const apiUrl = 'http://127.0.0.1:8000/api/';
const toaster = createToaster({ position: 'top-right' });

// Tạo instance của Axios để có thể thêm interceptor
const axiosInstance = axios.create({
  baseURL: apiUrl,
});

// Interceptor để xử lý lỗi 401 (Unauthorized)
axiosInstance.interceptors.response.use(
  (response) => response,
  async (error) => {
    if (error.response?.status === 401) {
      const adminStore = useAdminStore();
      await adminStore.logout();
      toaster.error('Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');
      window.location.href = '/admin/login';
    }
    return Promise.reject(error);
  }
);

export default {
  getHeader() {
    const adminStore = useAdminStore();
    const token = adminStore.token; // Lấy token từ useAdminStore
    if (!token) {
      return {};
    }
    return {
      Authorization: `Bearer ${token}`,
    };
  },
  get(url) {
    return axiosInstance.get(url, { headers: this.getHeader() }).catch((res) => {
      if (res.response?.data?.errors) {
        const result = Object.entries(res.response.data.errors);
        result.forEach((v) => {
          toaster.error(v[1][0]);
        });
      } else {
        toaster.error(res.response?.data?.message || 'Đã có lỗi xảy ra');
      }
      return Promise.reject(res);
    });
  },
  post(url, data) {
    return axiosInstance.post(url, data, { headers: this.getHeader() }).catch((res) => {
      if (res.response?.data?.errors) {
        const result = Object.entries(res.response.data.errors);
        result.forEach((v) => {
          toaster.error(v[1][0]);
        });
      } else {
        toaster.error(res.response?.data?.message || 'Đã có lỗi xảy ra');
      }
      return Promise.reject(res);
    });
  },
  delete(url) {
    return axiosInstance.delete(url, { headers: this.getHeader() }).catch((res) => {
      if (res.response?.data?.errors) {
        const result = Object.entries(res.response.data.errors);
        result.forEach((v) => {
          toaster.error(v[1][0]);
        });
      } else {
        toaster.error(res.response?.data?.message || 'Đã có lỗi xảy ra');
      }
      return Promise.reject(res);
    });
  },
  put(url, data) {
    return axiosInstance.put(url, data, { headers: this.getHeader() }).catch((res) => {
      if (res.response?.data?.errors) {
        const result = Object.entries(res.response.data.errors);
        result.forEach((v) => {
          toaster.error(v[1][0]);
        });
      } else {
        toaster.error(res.response?.data?.message || 'Đã có lỗi xảy ra');
      }
      return Promise.reject(res);
    });
  },
};