<template>
  <div class="container my-3">
    <div class="main-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <div class="avatar-container">
                  <img
                    :src="avatarUrl"
                    alt="Profile"
                    class="rounded-circle p-1"
                    style="
                      background: rgb(226 169 0);
                      width: 150px;
                      height: 150px;
                      object-fit: cover;
                    "
                    @error="handleImageError"
                  />
                  <label for="avatar-upload" class="avatar-upload-btn">
                    <i class="fa-solid fa-camera"></i>
                  </label>
                  <input
                    id="avatar-upload"
                    type="file"
                    accept="image/*"
                    @change="handleAvatarChange"
                    style="display: none;"
                  />
                </div>
                <div class="mt-3">
                  <h4>{{ customer?.ho_ten || "Khách hàng" }}</h4>
                  <p class="text-secondary mb-1">Khách hàng mới</p>
                </div>
              </div>
              <hr class="my-4" />
              <ul class="list-group list-group-flush">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6 class="mb-0">
                    <i class="fa-solid fa-envelope me-2"></i>Email
                  </h6>
                  <span class="text-secondary">{{ customer?.email || "Chưa cập nhật" }}</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6 class="mb-0">
                    <i class="fa-solid fa-mobile-screen-button me-2"></i>Số điện thoại
                  </h6>
                  <span class="text-secondary">{{ customer?.so_dien_thoai || "Chưa cập nhật" }}</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6 class="mb-0">
                    <i class="fa-solid fa-cake-candles me-2"></i>Ngày sinh
                  </h6>
                  <span class="text-secondary">{{ customer?.ngay_sinh || "Chưa cập nhật" }}</span>
                </li>
              </ul>
              <hr />
              <div class="d-flex justify-content-between align-items-center">
                <button
                  class="btn btn-outline-danger"
                  data-bs-toggle="modal"
                  data-bs-target="#editProfileModal"
                >
                  <i class="fa-solid fa-circle-info"></i> Chỉnh sửa
                </button>
                <button
                  class="btn btn-warning"
                  data-bs-toggle="modal"
                  data-bs-target="#changePasswordModal"
                >
                  <i class="fa-solid fa-key"></i> Đổi mật khẩu
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Profile Modal -->
    <div
      class="modal fade"
      id="editProfileModal"
      tabindex="-1"
      aria-labelledby="editProfileModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProfileModalLabel">
              Chỉnh sửa thông tin cá nhân
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="resetProfileForm"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submitProfile">
              <div class="mb-3">
                <label for="fullName" class="form-label">Họ và tên</label>
                <input
                  v-model="editProfile.fullName"
                  type="text"
                  class="form-control"
                  id="fullName"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input
                  v-model="editProfile.phone"
                  type="tel"
                  class="form-control"
                  id="phone"
                />
              </div>
              <div class="mb-3">
                <label for="dob" class="form-label">Ngày sinh</label>
                <input
                  v-model="editProfile.dob"
                  type="date"
                  class="form-control"
                  id="dob"
                />
              </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" :disabled="isLoading">
                  {{ isLoading ? "Đang lưu..." : "Lưu thay đổi" }}
                </button>
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                  @click="resetProfileForm"
                >
                  Hủy
                </button>
              </div>
              <p class="text-danger mt-2" v-if="profileError">{{ profileError }}</p>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Change Password Modal -->
    <div
      class="modal fade"
      id="changePasswordModal"
      tabindex="-1"
      aria-labelledby="changePasswordModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="changePasswordModalLabel">
              Đổi mật khẩu
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="resetPasswordForm"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submitPassword">
              <div class="mb-3">
                <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                <input
                  v-model="password.current"
                  type="password"
                  class="form-control"
                  id="currentPassword"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="newPassword" class="form-label">Mật khẩu mới</label>
                <input
                  v-model="password.new"
                  type="password"
                  class="form-control"
                  id="newPassword"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                <input
                  v-model="password.confirm"
                  type="password"
                  class="form-control"
                  id="confirmPassword"
                  required
                />
              </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" :disabled="isLoading">
                  {{ isLoading ? "Đang đổi..." : "Đổi mật khẩu" }}
                </button>
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                  @click="resetPasswordForm"
                >
                  Hủy
                </button>
              </div>
              <p class="text-danger mt-2" v-if="passwordError">{{ passwordError }}</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useUserStore } from '../../stores/usesStore.js';
import { useRouter } from 'vue-router';
import api from '../../services/api.js';

export default {
  setup() {
    const userStore = useUserStore();
    const router = useRouter();
    return { userStore, router };
  },
  data() {
    return {
      editProfile: {
        fullName: '',
        phone: '',
        dob: '',
      },
      password: {
        current: '',
        new: '',
        confirm: '',
      },
      defaultAvatar: 'https://i.pinimg.com/474x/4f/b1/6a/4fb16af4177b0e7bfcbc0423a3267a8a.jpg',
      backendBaseUrl: 'http://127.0.0.1:8000/storage/',
      isLoading: false,
      profileError: null,
      passwordError: null,
    };
  },
  computed: {
    customer() {
      return this.userStore.getCustomer;
    },
    avatarUrl() {
      return this.customer?.avatar
        ? `${this.backendBaseUrl}${this.customer.avatar}`
        : this.defaultAvatar;
    },
  },
 
  methods: {
    async checkAuthentication() {
      await this.userStore.initializeAuth();
      if (!this.userStore.isLoggedIn) {
        this.router.push('/login');
      } else {
        if (!this.userStore.getCustomer) {
          await this.userStore.fetchProfile();
        }
        this.loadCustomerInfo();
      }
    },
    loadCustomerInfo() {
      this.editProfile = {
        fullName: this.customer?.ho_ten || '',
        phone: this.customer?.so_dien_thoai || '',
        dob: this.customer?.ngay_sinh || '',
      };
    },
    async handleAvatarChange(event) {
      const file = event.target.files[0];
      if (!file) return;

      if (!file.type.match('image.*')) {
        alert('Vui lòng chọn một file ảnh!');
        return;
      }

      this.isLoading = true;
      const formData = new FormData();
      formData.append('avatar', file);

      try {
        const response = await api.post('/update-avatar', formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        });
        this.userStore.customer.avatar = response.data.avatar;
        await this.userStore.fetchProfile();
        this.loadCustomerInfo();
        alert('Cập nhật ảnh đại diện thành công!');
      } catch (error) {
        alert(error.response?.data?.message || 'Cập nhật ảnh đại diện thất bại!');
        console.error('Lỗi khi cập nhật avatar:', error);
      } finally {
        this.isLoading = false;
      }
    },
    handleImageError(event) {
      event.target.src = this.defaultAvatar;
    },
    async submitProfile() {
      if (!this.editProfile.fullName) {
        this.profileError = 'Họ tên là bắt buộc!';
        return;
      }

      this.isLoading = true;
      this.profileError = null;
      try {
        const response = await api.post('/update-profile', {
          ho_ten: this.editProfile.fullName,
          so_dien_thoai: this.editProfile.phone,
          ngay_sinh: this.editProfile.dob,
        });
        this.userStore.customer = response.data.data;
        alert('Cập nhật thông tin thành công!');
        document.querySelector('#editProfileModal .btn-close').click();
      } catch (error) {
        this.profileError = error.response?.data?.message || 'Cập nhật thông tin thất bại!';
        console.error('Lỗi khi cập nhật profile:', error);
      } finally {
        this.isLoading = false;
      }
    },
    resetProfileForm() {
      this.editProfile = {
        fullName: this.customer?.ho_ten || '',
        phone: this.customer?.so_dien_thoai || '',
        dob: this.customer?.ngay_sinh || '',
      };
      this.profileError = null;
    },
    async submitPassword() {
      if (!this.password.current || !this.password.new || !this.password.confirm) {
        this.passwordError = 'Vui lòng điền đầy đủ thông tin!';
        return;
      }
      if (this.password.new.length < 6) {
        this.passwordError = 'Mật khẩu mới phải có ít nhất 6 ký tự!';
        return;
      }
      if (this.password.new !== this.password.confirm) {
        this.passwordError = 'Mật khẩu xác nhận không khớp!';
        return;
      }

      this.isLoading = true;
      this.passwordError = null;
      try {
        await api.post('/change-password', {
          current_password: this.password.current,
          new_password: this.password.new,
          new_password_confirmation: this.password.confirm,
        });
        alert('Đổi mật khẩu thành công!');
        this.resetPasswordForm();
        document.querySelector('#changePasswordModal .btn-close').click();
      } catch (error) {
        this.passwordError = error.response?.data?.message || 'Đổi mật khẩu thất bại!';
        console.error('Lỗi khi đổi mật khẩu:', error);
      } finally {
        this.isLoading = false;
      }
    },
    resetPasswordForm() {
      this.password = {
        current: '',
        new: '',
        confirm: '',
      };
      this.passwordError = null;
    },
  },
};
</script>

<style scoped>
.avatar-container {
  position: relative;
  display: inline-block;
}

.avatar-upload-btn {
  position: absolute;
  bottom: 10px;
  right: 10px;
  background: rgba(0, 0, 0, 0.6);
  color: white;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background 0.3s ease;
}

.avatar-upload-btn:hover {
  background: rgba(0, 0, 0, 0.8);
}
</style>