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
                    <h3>Đăng nhập</h3>
                    <p>
                      Bạn chưa có tài khoản?
                      <router-link to="/register">Đăng ký ngay</router-link>
                    </p>
                  </div>
                  <div class="login-separater text-center mb-4"><hr /></div>
                  <form class="row g-3" @submit.prevent="dangNhap">
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
                      <label class="form-label">Mật khẩu</label>
                      <input
                        type="password"
                        class="form-control"
                        v-model="form.mat_khau"
                        placeholder="Nhập mật khẩu"
                        required
                      />
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-switch">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          id="flexSwitchCheckChecked"
                          v-model="form.remember"
                        />
                        <label
                          class="form-check-label"
                          for="flexSwitchCheckChecked"
                          >Lưu mật khẩu</label
                        >
                      </div>
                    </div>
                    <div class="col-md-6 text-end">
                      <router-link to="/quenmk">Quên mật khẩu?</router-link>
                    </div>
                    <div class="col-12">
                      <button
                        type="submit"
                        class="btn btn-primary w-100"
                        :disabled="isLoading"
                      >
                        {{ isLoading ? "Đang đăng nhập..." : "Đăng nhập" }}
                      </button>
                    </div>
                    <p class="text-danger mt-2" v-if="error">{{ error }}</p>
                  </form>
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
import { useUserStore } from '../../stores/usesStore.js';
import { useRouter } from 'vue-router';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right", duration: 3000 });
export default {
  setup() {
    const userStore = useUserStore();
    const router = useRouter();
    return { userStore, router };
  },
  data() {
    return {
      form: {
        email: '',
        mat_khau: '',
        remember: false,
      },
      isLoading: false,
      error: null,
    };
  },
  mounted() {
    this.checkLogin();
  },
  methods: {
    async checkLogin() {
      // Kiểm tra trạng thái đăng nhập
      await this.userStore.initializeAuth();
      if (this.userStore.isLoggedIn) {
        this.router.push('/'); // Chuyển hướng nếu đã đăng nhập
      }
    },
    async dangNhap() {
      this.isLoading = true;
      this.error = null;
      try {
        await this.userStore.login({
          email: this.form.email,
          password: this.form.mat_khau,
        });
        toaster.success= ('Đăng nhập thành công');
        this.router.push('/'); // Chuyển hướng sau khi đăng nhập thành công
      } catch (error) {
        toaster.error = (error.response.data.message || "Đăng nhập thất bại");
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