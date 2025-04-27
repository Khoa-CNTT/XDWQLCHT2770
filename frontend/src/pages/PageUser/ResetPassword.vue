<template>
    <div class="wrapper">
      <div
        class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"
      >
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col mx-auto">
              <div class="mb-4 text-center">
                <img src="/logodark.png" width="180" alt="" />
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="text-center">
                      <h3>Đặt lại mật khẩu</h3>
                      <p>Nhập mật khẩu mới cho tài khoản của bạn.</p>
                    </div>
                    <div class="login-separater text-center mb-4"><hr /></div>
                    <form class="row g-3" @submit.prevent="submitDatLaiMatKhau">
                      <div class="col-12">
                        <label class="form-label">Mật khẩu mới</label>
                        <input
                          type="password"
                          class="form-control"
                          v-model="form.password"
                          placeholder="Nhập mật khẩu mới"
                          required
                        />
                      </div>
                      <div class="col-12">
                        <label class="form-label">Xác nhận mật khẩu</label>
                        <input
                          type="password"
                          class="form-control"
                          v-model="form.password_confirmation"
                          placeholder="Xác nhận mật khẩu"
                          required
                        />
                      </div>
                      <div class="col-12">
                        <button
                          type="submit"
                          class="btn btn-primary w-100"
                          :disabled="isLoading"
                        >
                          {{ isLoading ? "Đang lưu..." : "Lưu mật khẩu" }}
                        </button>
                      </div>
                      <p class="text-danger mt-2" v-if="error">{{ error }}</p>
                      <p class="text-success mt-2" v-if="success">{{ success }}</p>
                    </form>
                    <div class="text-center mt-3">
                      <router-link to="/login">Quay lại đăng nhập</router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import api from '../../services/api';
  import { useRoute, useRouter } from 'vue-router';
  
  export default {
    setup() {
      const route = useRoute();
      const router = useRouter();
      return { route, router };
    },
    data() {
      return {
        form: {
          hash_reset_password: '',
          password: '',
          password_confirmation: '',
        },
        isLoading: false,
        error: null,
        success: null,
      };
    },
    mounted() {
      // Lấy hash từ URL
      this.form.hash_reset_password = this.route.params.hash;
    },
    methods: {
      async submitDatLaiMatKhau() {
        if (!this.form.password || !this.form.password_confirmation) {
          this.error = 'Vui lòng điền đầy đủ thông tin!';
          return;
        }
        if (this.form.password.length < 6) {
          this.error = 'Mật khẩu phải có ít nhất 6 ký tự!';
          return;
        }
        if (this.form.password !== this.form.password_confirmation) {
          this.error = 'Mật khẩu xác nhận không khớp!';
          return;
        }
  
        this.isLoading = true;
        this.error = null;
        this.success = null;
  
        try {
          const response = await api.post('/dat-lai-mat-khau', this.form);
          this.success = response.data.message;
          this.form.password = '';
          this.form.password_confirmation = '';
          setTimeout(() => {
            this.router.push('/login');
          }, 2000); // Chuyển hướng sau 2 giây
        } catch (error) {
          this.error = error.response?.data?.message || 'Đặt lại mật khẩu thất bại!';
          console.error('Lỗi khi đặt lại mật khẩu:', error);
        } finally {
          this.isLoading = false;
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .wrapper {
    min-height: 100vh;
    background-color: #f8f9fa;
  }
  </style>