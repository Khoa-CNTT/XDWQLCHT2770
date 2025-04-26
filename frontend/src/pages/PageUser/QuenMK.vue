<template>
    <div class="forgot-password-page d-flex align-items-center justify-content-center min-vh-100 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
              <div class="card-body p-5">
                <h2 class="text-center mb-4">Quên mật khẩu</h2>
                <p class="text-center text-muted mb-4">
                  Vui lòng nhập email của bạn để nhận liên kết đặt lại mật khẩu.
                </p>
                <form @submit.prevent="submitForgotPassword">
                  <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                      </span>
                      <input
                        v-model="email"
                        type="email"
                        class="form-control"
                        id="email"
                        placeholder="Nhập email của bạn"
                        required
                      />
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 mb-3">
                    Gửi liên kết đặt lại
                  </button>
                </form>
                <div class="text-center">
                  <router-link to="/login" class="text-primary">
                    <i class="fas fa-arrow-left me-1"></i> Quay lại đăng nhập
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "ForgotPassword",
    data() {
      return {
        email: ""
      };
    },
    methods: {
      submitForgotPassword() {
        if (!this.email) {
          alert("Vui lòng nhập email!");
          return;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email)) {
          alert("Email không hợp lệ!");
          return;
        }
        // Simulate sending reset link (replace with actual API call in production)
        alert(`Liên kết đặt lại mật khẩu đã được gửi đến ${this.email}!`);
        this.email = "";
      }
    }
  };
  </script>
  
  <style scoped>
  .forgot-password-page {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  }
  
  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
  
  .btn-primary {
    background: #007bff;
    border: none;
    padding: 12px;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }
  
  .btn-primary:hover {
    background: #0056b3;
  }
  
  .input-group-text {
    background: #f8f9fa;
    border-right: none;
  }
  
  .form-control {
    border-left: none;
    padding: 10px;
  }
  
  .form-control:focus {
    box-shadow: none;
    border-color: #007bff;
  }
  
  .text-primary {
    text-decoration: none;
    font-weight: 500;
  }
  
  .text-primary:hover {
    text-decoration: underline;
  }
  
  /* Responsive Adjustments */
  @media (max-width: 576px) {
    .card-body {
      padding: 2rem;
    }
  
    h2 {
      font-size: 1.5rem;
    }
  
    .text-muted {
      font-size: 0.9rem;
    }
  }
  </style>