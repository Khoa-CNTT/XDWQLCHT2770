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
import axios from "axios";

export default {
  name: "Login",
  data() {
    return {
      form: {
        email: "",
        mat_khau: "",
      },
     
    };
  },
  mounted() {
    this.checkLogin();
    
  },
  methods: {
    dangNhap() {
      axios
        .post("http://127.0.0.1:8000/api/login", this.form)
        .then((res) => {
          if (res.data.status) {
            alert("Đăng nhập thành công");
            localStorage.setItem("token_khachhang", res.data.token);
            localStorage.setItem("ho_ten", res.data.customer.ho_ten);
            localStorage.setItem("email", res.data.customer.email);
            localStorage.setItem("avatar", res.data.customer.avatar || this.defaultAvatar);
            localStorage.setItem("ngay_sinh", res.data.customer.ngay_sinh || null);
            localStorage.setItem("so_dien_thoai", res.data.customer.so_dien_thoai || null);
            window.location.reload();
          } else {
            this.error = res.data.message;
          }
        })
        .catch((error) => {
          this.error = "Đã xảy ra lỗi trong quá trình đăng nhập.";
        });
    },
    checkLogin() {
    axios
      .get("http://127.0.0.1:8000/api/kiem-tra-token-khach-hang", {
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token_khachhang"),
        },
      })
      .then((res) => {
        if (res.data.status) {
          this.$router.push('/');
        }
      });
      
  },
  },
  checkLogin() {
    axios
      .get("http://127.0.0.1:8000/api/kiem-tra-token-khach-hang", {
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token_khachhang"),
        },
      })
      .then((res) => {
        if (res.data.status) {
          this.$router.push('/');
        }
      });
      
  },
};
</script>

<style scoped>
.wrapper {
  min-height: 100vh;
  background-color: #f8f9fa;
}
</style>