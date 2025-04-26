<template>
  <div class="container my-3">
    <div class="main-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img
                  src="https://i.pinimg.com/474x/4f/b1/6a/4fb16af4177b0e7bfcbc0423a3267a8a.jpg"
                  alt="Profile"
                  class="rounded-circle p-1"
                  style="background: rgb(226 169 0); width: 150px; height: 150px; object-fit: cover;"
                />
                <div class="mt-3">
                  <h4>{{ profile.fullName }}</h4>
                  <p class="text-secondary mb-1">Khách hàng mới</p>
                </div>
              </div>
              <hr class="my-4" />
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                  <h6 class="mb-0"><i class="fa-solid fa-envelope me-2"></i>Website</h6>
                  <span class="text-secondary">{{ profile.email }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                  <h6 class="mb-0"><i class="fa-solid fa-mobile-screen-button me-2"></i>Số điện thoại</h6>
                  <span class="text-secondary">{{ profile.so_dien_thoai }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                  <h6 class="mb-0"><i class="fa-solid fa-cake-candles me-2"></i>Ngày sinh</h6>
                  <span class="text-secondary">{{ profile.ngay_sinh }}</span>
                </li>
              </ul>
              <hr />
              <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                  <i class="fa-solid fa-circle-info"></i> Chỉnh sửa
                </button>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                  <i class="fa-solid fa-key"></i> Đổi mật khẩu
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
              <h5>Lịch sử đặt phòng</h5>
            </div>
            <!-- <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Mã đặt phòng</th>
                      <th>Khách sạn</th>
                      <th>Ngày đặt</th>
                      <th>Trạng thái</th>
                      <th>Chi tiết</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="booking in bookings" :key="booking.id">
                      <td>{{ booking.id }}</td>
                      <td>{{ booking.hotel }}</td>
                      <td>{{ formatDate(booking.date) }}</td>
                      <td>
                        <span :class="getStatusClass(booking.status)">{{ booking.status }}</span>
                      </td>
                      <td>
                        <button
                          class="btn btn-sm btn-primary"
                          @click="showBookingDetails(booking)"
                          data-bs-toggle="modal"
                          data-bs-target="#bookingModal"
                        >
                          <i class="fa-solid fa-eye"></i> Xem
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProfileModalLabel">Chỉnh sửa thông tin cá nhân</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="resetProfileForm"></button>
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
                <label for="email" class="form-label">Email</label>
                <input
                  v-model="editProfile.email"
                  type="email"
                  class="form-control"
                  id="email"
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
                  required
                />
              </div>
              <div class="mb-3">
                <label for="dob" class="form-label">Ngày sinh</label>
                <input
                  v-model="editProfile.dob"
                  type="date"
                  class="form-control"
                  id="dob"
                  required
                />
              </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetProfileForm">Hủy</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="changePasswordModalLabel">Đổi mật khẩu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="resetPasswordForm"></button>
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
                <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetPasswordForm">Hủy</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Booking Details Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="bookingModalLabel">Chi tiết đặt phòng</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="resetModal"></button>
          </div>
          <div class="modal-body" v-if="selectedBooking">
            <div class="row">
              <div class="col-md-6">
                <h6>Mã đặt phòng: {{ selectedBooking.id }}</h6>
                <p><strong>Khách sạn:</strong> {{ selectedBooking.hotel }}</p>
                <p><strong>Ngày đặt:</strong> {{ formatDate(selectedBooking.date) }}</p>
                <p><strong>Check-in:</strong> {{ formatDate(selectedBooking.checkIn) }}</p>
                <p><strong>Check-out dự kiến:</strong> {{ formatDate(selectedBooking.checkOut) }}</p>
                <p v-if="selectedBooking.actualCheckOut">
                  <strong>Trả phòng thực tế:</strong> {{ formatDate(selectedBooking.actualCheckOut) }}
                </p>
                <p><strong>Tổng tiền:</strong> {{ formatCurrency(selectedBooking.total) }}</p>
                <p v-if="selectedBooking.refundedAmount">
                  <strong>Số tiền hoàn:</strong> {{ formatCurrency(selectedBooking.refundedAmount) }}
                </p>
              </div>
              <div class="col-md-6">
                <h6>Đánh giá</h6>
                <div v-if="selectedBooking.review">
                  <div class="d-flex align-items-center mb-2">
                    <div class="stars">
                      <i
                        v-for="n in 5"
                        :key="n"
                        :class="n <= selectedBooking.review.rating ? 'fas fa-star text-warning' : 'far fa-star'"
                      ></i>
                    </div>
                    <span class="ms-2">{{ selectedBooking.review.rating }}/5</span>
                  </div>
                  <p>{{ selectedBooking.review.comment }}</p>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary" @click="editReview">
                      <i class="fas fa-edit"></i> Sửa
                    </button>
                    <button class="btn btn-sm btn-outline-danger" @click="deleteReview">
                      <i class="fas fa-trash"></i> Xóa
                    </button>
                  </div>
                </div>
                <div v-else>
                  <p>Chưa có đánh giá</p>
                  <button class="btn btn-sm btn-primary" @click="showReviewForm = true">
                    <i class="fas fa-star"></i> Thêm đánh giá
                  </button>
                </div>
                <div v-if="showReviewForm" class="mt-3">
                  <form @submit.prevent="submitReview">
                    <div class="mb-3">
                      <label class="form-label">Điểm đánh giá</label>
                      <div class="stars">
                        <i
                          v-for="n in 5"
                          :key="n"
                          :class="n <= newReview.rating ? 'fas fa-star text-warning' : 'far fa-star'"
                          @click="newReview.rating = n"
                          style="cursor: pointer;"
                        ></i>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="reviewComment" class="form-label">Nhận xét</label>
                      <textarea
                        v-model="newReview.comment"
                        class="form-control"
                        id="reviewComment"
                        rows="4"
                        required
                      ></textarea>
                    </div>
                    <div class="d-flex gap-2">
                      <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                      <button type="button" class="btn btn-secondary" @click="cancelReview">Hủy</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="mt-3" v-if="canCancel || canEarlyCheckOut">
              <h6>Thao tác</h6>
              <div class="d-flex gap-2">
                <button
                  v-if="canCancel"
                  class="btn btn-sm btn-danger"
                  @click="cancelBooking"
                >
                  <i class="fas fa-ban"></i> Hủy phòng
                </button>
                <button
                  v-if="canEarlyCheckOut"
                  class="btn btn-sm btn-warning"
                  @click="earlyCheckOut"
                >
                  <i class="fas fa-sign-out-alt"></i> Trả phòng sớm
                </button>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetModal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      profile: {
        ho_ten: '',
        avatar:'',
        email: '',
        ngay_sinh: '',
        so_dien_thoai: ''
      },
      editProfile: {
        fullName: '',
        email: '',
        phone: '',
        dob: ''
      },
      password: {
        current: '',
        new: '',
        confirm: ''
      },
     
    };
  },
  computed: {
    canCancel() {
      if (!this.selectedBooking || this.selectedBooking.status !== 'Xác nhận') return false;
      const checkInDate = new Date(this.selectedBooking.checkIn);
      const daysUntilCheckIn = Math.ceil((checkInDate - this.currentDate) / (1000 * 60 * 60 * 24));
      return daysUntilCheckIn >= 7;
    },
    canEarlyCheckOut() {
      if (!this.selectedBooking || this.selectedBooking.status !== 'Xác nhận') return false;
      const checkInDate = new Date(this.selectedBooking.checkIn);
      const checkOutDate = new Date(this.selectedBooking.checkOut);
      const today = this.currentDate;
      if (today < checkInDate) return false;
      const bookedDays = Math.ceil((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24));
      const stayedDays = Math.max(0, Math.ceil((today - checkInDate) / (1000 * 60 * 60 * 24)));
      return stayedDays < bookedDays - 1; // Can check out if at least 1 day early
    }
  },
  mounted(){
    this.checkLogin();
  },
  methods: {
    async checkLogin() {
      const token = localStorage.getItem('token_khachhang');
      if (!token) {
        this.isAuthenticated = false;
        this.ho_ten = null;
        this.email = null;
        localStorage.removeItem('ho_ten');
        localStorage.removeItem('email');
        return;
      }

      try {
        const res = await axios.get('http://127.0.0.1:8000/api/kiem-tra-token-khach-hang', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        if (res.data.status) {
          // Nếu token hợp lệ, giữ trạng thái đăng nhập
          this.isAuthenticated = true;
          // Cập nhật lại ho_ten và email từ localStorage (đã lưu khi đăng nhập)
          this.profile.ho_ten = localStorage.getItem('ho_ten');
          this.profile.ngay_sinh = localStorage.getItem('ngay_sinh') || null;
          this.profile.so_dien_thoai = localStorage.getItem('so_dien_thoai') || null;
          this.profile.email = localStorage.getItem('email');
          this.profile.avatar = localStorage.getItem('avatar') || '/default-avatar.png';
        } else {
          // Nếu token không hợp lệ, xóa dữ liệu và đánh dấu chưa đăng nhập
          this.isAuthenticated = false;
          this.ho_ten = null;
          this.email = null;
          localStorage.removeItem('token_khachhang');
          localStorage.removeItem('ho_ten');
          localStorage.removeItem('email');
          this.$router.push('/login');
        }
      } catch (error) {
        console.error('Lỗi khi kiểm tra token:', error);
        this.isAuthenticated = false;
        this.ho_ten = null;
        this.email = null;
        localStorage.removeItem('token_khachhang');
        localStorage.removeItem('ho_ten');
        localStorage.removeItem('email');
        this.$router.push('/login');
      }
    },
    // Profile Editing
    submitProfile() {
      if (!this.editProfile.fullName || !this.editProfile.email || !this.editProfile.phone || !this.editProfile.dob) {
        alert('Vui lòng điền đầy đủ thông tin!');
        return;
      }
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.editProfile.email)) {
        alert('Email không hợp lệ!');
        return;
      }
      this.profile = { ...this.editProfile };
      alert('Cập nhật thông tin cá nhân thành công!');
      this.resetProfileForm();
      document.querySelector('#editProfileModal .btn-close').click(); // Programmatically close modal
    },
    resetProfileForm() {
      this.editProfile = {
        fullName: this.profile.fullName,
        email: this.profile.email,
        phone: this.profile.phone,
        dob: this.profile.dob
      };
    },
    // Password Change
    submitPassword() {
      if (!this.password.current || !this.password.new || !this.password.confirm) {
        alert('Vui lòng điền đầy đủ thông tin!');
        return;
      }
      if (this.password.new.length < 6) {
        alert('Mật khẩu mới phải có ít nhất 6 ký tự!');
        return;
      }
      if (this.password.new !== this.password.confirm) {
        alert('Mật khẩu xác nhận không khớp!');
        return;
      }
      alert('Đổi mật khẩu thành công!');
      this.resetPasswordForm();
      document.querySelector('#changePasswordModal .btn-close').click(); // Programmatically close modal
    },
    resetPasswordForm() {
      this.password = {
        current: '',
        new: '',
        confirm: ''
      };
    },
    // Booking Details
   
   
  },
  mounted() {
    this.resetProfileForm(); // Initialize editProfile with current profile data
  }
};
</script>

<style scoped>
.stars i {
  font-size: 1.2rem;
  margin-right: 0.2rem;
}
.badge {
  padding: 0.5em 1em;
}
.table-responsive {
  max-height: 500px;
  overflow-y: auto;
}
</style>