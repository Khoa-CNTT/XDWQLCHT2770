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
                    <h3>Quên mật khẩu</h3>
                    <p>
                      Nhập email của bạn để nhận link đặt lại mật khẩu.
                    </p>
                  </div>
                  <div class="login-separater text-center mb-4"><hr /></div>
                  <form class="row g-3" @submit.prevent="submitQuenMatKhau">
                    <div class="col-12">
                      <label class="form-label">Email</label>
                      <input
                        type="email"
                        class="form-control"
                        v-model="form.email"
                        placeholder="Nhập email"
                        required
                      />
                    </div>
                    <div class="col-12">
                      <button
                        type="submit"
                        class="btn btn-primary w-100"
                        :disabled="isLoading"
                      >
                        {{ isLoading ? "Đang gửi..." : "Gửi link đặt lại" }}
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

export default {
  data() {
    return {
      form: {
        email: '',
      },
      isLoading: false,
      error: null,
      success: null,
    };
  },
  methods: {
    async submitQuenMatKhau() {
      this.isLoading = true;
      this.error = null;
      this.success = null;

      try {
        const response = await api.post('/quen-mat-khau', {
          email: this.form.email,
        });
        this.success = response.data.message;
        this.form.email = ''; // Xóa form sau khi thành công
      } catch (error) {
        this.error = error.response?.data?.message || 'Gửi yêu cầu thất bại!';
        console.error('Lỗi khi gửi yêu cầu quên mật khẩu:', error);
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