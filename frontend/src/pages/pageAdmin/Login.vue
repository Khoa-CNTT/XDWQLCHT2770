<template>
  <div class="wrapper">
    <div
      class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"
    >
      <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
          <div class="col mx-auto">
            <div class="mb-4 text-center">
              <img src="/logodark.png" width="180" alt="Logo" />
            </div>
            <div class="card">
              <div class="card-body">
                <div class="border p-4 rounded">
                  <div class="text-center">
                    <h3>Đăng nhập Admin</h3>
                  </div>
                  <div class="login-separater text-center mb-4"><hr /></div>
                  <form class="row g-3" @submit.prevent="handleLogin">
                    <div class="col-12">
                      <label for="inputEmailAddress" class="form-label">Email</label>
                      <input
                        v-model="credentials.email"
                        type="email"
                        class="form-control"
                        id="inputEmailAddress"
                        placeholder="Nhập email"
                        required
                      />
                    </div>
                    <div class="col-12">
                      <label for="inputChoosePassword" class="form-label">Mật khẩu</label>
                      <div class="input-group" id="show_hide_password">
                        <input
                          v-model="credentials.password"
                          :type="showPassword ? 'text' : 'password'"
                          class="form-control border-end-0"
                          id="inputChoosePassword"
                          placeholder="Nhập mật khẩu"
                          required
                        />
                        <button
                          type="button"
                          class="input-group-text bg-transparent"
                          @click="togglePassword"
                        >
                          <i :class="showPassword ? 'bx bx-show' : 'bx bx-hide'"></i>
                        </button>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-switch">
                        <input
                          v-model="rememberMe"
                          class="form-check-input"
                          type="checkbox"
                          id="flexSwitchCheckChecked"
                        />
                        <label class="form-check-label" for="flexSwitchCheckChecked"
                          >Ghi nhớ tôi</label
                        >
                      </div>
                    </div>
                    <div class="col-md-6 text-end">
                      <router-link to="/admin/forgotpassword">Quên mật khẩu?</router-link>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button
                          type="submit"
                          class="btn btn-primary w-100"
                          :disabled="isLoading"
                        >
                          <i class="bx bxs-lock-open me-1"></i>
                          {{ isLoading ? 'Đang đăng nhập...' : 'Đăng nhập' }}
                        </button>
                      </div>
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

<script setup>
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right", duration: 3000 });
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useAdminStore } from '../../stores/useAdminStore';

const router = useRouter();
const adminStore = useAdminStore();

const credentials = ref({
  email: '',
  password: '',
});
const showPassword = ref(false);
const rememberMe = ref(true);
const isLoading = ref(false);
const error = ref(null);

const togglePassword = () => {
  showPassword.value = !showPassword.value;
};

const handleLogin = async () => {
  isLoading.value = true;
  error.value = null;
  try {
    await adminStore.login(credentials.value);
    toaster.success('Đăng nhập thành công');
    router.push('/admin/dashboard');
  } catch (error) {
    error.value = error.message || 'Đăng nhập thất bại';
  } finally {
    isLoading.value = false;
  }
};

onMounted(async () => {
  await adminStore.initializeAuth();
  if (adminStore.isLoggedIn) {
    router.push('/admin/dashboard');
  }
});
</script>

<style scoped>
.section-authentication-signin {
  min-height: 100vh;
}
.card {
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
.form-control {
  border-radius: 0.375rem;
}
.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}
.btn-primary:hover {
  background-color: #0056b3;
  border-color: #004085;
}
.input-group-text {
  border-radius: 0 0.375rem 0.375rem 0;
}
.wrapper {
  min-height: 100vh;
  background-color: #f8f9fa;
}
</style>