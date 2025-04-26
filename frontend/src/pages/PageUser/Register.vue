<template>
  <div class="wrapper">
    <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
      <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
          <div class="col mx-auto">
            <div class="my-4 text-center">
              <img src="../../../public/logodark.png" width="180" alt="" />
            </div>
            <div class="card">
              <div class="card-body">
                <div class="border p-4 rounded">
                  <div class="text-center">
                    <h3 class="">Đăng Ký</h3>
                    <p>
                      Đã có tài khoản? <a href="/login">Đăng nhập tại đây</a>
                    </p>
                  </div>

                  <div class="login-separater text-center mb-4">
                    <hr />
                  </div>

                  <div class="">
                    <div class="row g-3">
                      <div class="col-12">
                        <label class="form-label">Họ và Tên</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="dangKyTK.ho_ten"
                          required
                        />
                      </div>

                      <div class="col-12">
                        <label class="form-label">Địa chỉ Email</label>
                        <input
                          type="email"
                          class="form-control"
                          v-model="dangKyTK.email"
                          required
                        />
                      </div>

                      <div class="col-12">
                        <label class="form-label">Số Điện Thoại</label>
                        <input
                          type="phone"
                          class="form-control"
                          v-model="dangKyTK.so_dien_thoai"
                        />
                      </div>

                      <div class="col-12">
                        <label class="form-label">Ngày Sinh (dd-mm-yyyy)</label>
                        <input
                          type="date"
                          class="form-control"
                          v-model="dangKyTK.ngay_sinh"
                        />
                      </div>

                      <div class="col-12">
                        <label class="form-label">Giới Tính</label>
                        <select class="form-select" v-model="dangKyTK.gioi_tinh">
                          <option value="">Chọn giới tính</option>
                          <option value="1">Nam</option>
                          <option value="2">Nữ</option>
                          <option value="0">Khác</option>
                        </select>
                      </div>

                      <div class="col-12">
                        <label class="form-label">Mật Khẩu</label>
                        <div class="input-group">
                          <input
                            v-model="dangKyTK.mat_khau"
                            :type="passwordFieldType"
                            class="form-control"
                          />
                          <span
                            class="input-group-text"
                            @click="togglePasswordVisibility"
                            style="cursor: pointer"
                          >
                            <i
                              :class="
                                passwordFieldType === 'password'
                                  ? 'fa-regular fa-eye'
                                  : 'fa-regular fa-eye-slash'
                              "
                            ></i>
                          </span>
                        </div>
                      </div>

                      <div class="col-12">
                        <label class="form-label">Nhập Lại Mật Khẩu</label>
                        <div class="input-group">
                          <input
                            v-model="dangKyTK.mat_khau_confirmation"
                            :type="rePasswordFieldType"
                            class="form-control"
                          />
                          <span
                            class="input-group-text"
                            @click="toggleRePasswordVisibility"
                            style="cursor: pointer"
                          >
                            <i
                              :class="
                                rePasswordFieldType === 'password'
                                  ? 'fa-regular fa-eye'
                                  : 'fa-regular fa-eye-slash'
                              "
                            ></i>
                          </span>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="d-grid">
                          <button @click="dangKy()" class="btn btn-primary">
                            <i class="bx bx-user"></i> Đăng Ký
                          </button>
                        </div>
                      </div>
                    </div>
                    <p class="text-success mt-2" v-if="message">
                      {{ message }}
                    </p>
                    <p class="text-danger mt-2" v-if="error">{{ error }}</p>
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
import axios from "axios";

export default {
  data() {
    return {
      dangKyTK: {
        ho_ten: "",
        email: "",
        so_dien_thoai: "",
        ngay_sinh: "",
        gioi_tinh: "",
        mat_khau: "",
        mat_khau_confirmation: "",
      },
      message: "",
      error: "",
      passwordFieldType: "password",
      rePasswordFieldType: "password",
    };
  },
  methods: {
    togglePasswordVisibility() {
      this.passwordFieldType =
        this.passwordFieldType === "password" ? "text" : "password";
    },
    toggleRePasswordVisibility() {
      this.rePasswordFieldType =
        this.rePasswordFieldType === "password" ? "text" : "password";
    },
    dangKy() {
      axios
        .post("http://127.0.0.1:8000/api/register", this.dangKyTK)
        .then((res) => {
          if (res.data.status == 201) {
            this.message = res.data.message;
           
            this.dangKyTK = {};
            
          } else {
            this.error = res.data.message;
          }
        })
        .catch((res) => {
         alert("Có lỗi xảy ra, vui lòng thử lại sau.");
          console.error(res);
        });
    },
    kichhoatTK(){
      axios
      .post("http://127.0.0.1:8000/api/gui-mail-kich-hoat", this.dangKyTK)
      .then((res) => {
        if (res.data.status) {
          this.message = res.data.message;
          this.dangKyTK = {};
        } else {
          this.error = res.data.message;
        }
      })
    }
  },
};
</script>

<style scoped>
/* Giữ nguyên style tùy chỉnh nếu có */
</style>