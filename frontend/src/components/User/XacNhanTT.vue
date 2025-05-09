<template>
  <div class="card">
    <div class="card-header">
      <h5>Thông tin khách hàng</h5>
    </div>
    <div class="card-body">
      <!-- Thông báo trạng thái đăng nhập -->
      <div v-if="!userStore.isLoggedIn" class="alert alert-warning">
        Vui lòng <router-link to="/login">đăng nhập</router-link> hoặc 
        <router-link to="/register">đăng ký</router-link> để tiếp tục.
      </div>
      <div v-else class="alert alert-success">
        Đã đăng nhập với tài khoản: {{ userStore.getCustomer.email }}
      </div>

      <!-- Form thông tin khách hàng -->
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="fullName" class="form-label">Họ và tên</label>
          <input
            type="text"
            class="form-control"
            id="fullName"
            v-model="form.fullName"
            :disabled="!userStore.isLoggedIn"
            required
          />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            id="email"
            v-model="form.email"
            :disabled="!userStore.isLoggedIn"
            required
          />
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Số điện thoại</label>
          <input
            type="tel"
            class="form-control"
            id="phone"
            v-model="form.phone"
            :disabled="!userStore.isLoggedIn"
            required
          />
        </div>
        <button type="submit" class="btn btn-primary" :disabled="!userStore.isLoggedIn">
          Xác nhận đặt phòng
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { useUserStore } from '../../stores/usesStore';
import { useBookingStore } from '../../stores/booking';
import axios from 'axios';

export default {
  setup() {
    const userStore = useUserStore();
    const bookingStore = useBookingStore();
    return { userStore, bookingStore };
  },
  data() {
    return {
      form: {
        fullName: '',
        email: '',
        phone: '',
      },
    };
  },
  mounted() {
    this.userStore.initializeAuth(); // Kiểm tra trạng thái đăng nhập
    this.fillCustomerInfo();
  },
  methods: {
    fillCustomerInfo() {
      if (this.userStore.isLoggedIn && this.userStore.getCustomer) {
        const customer = this.userStore.getCustomer;
        this.form.fullName = customer.ho_ten || ''; // Giả sử trường họ tên trong API là ho_ten
        this.form.email = customer.email || '';
        this.form.phone = customer.so_dien_thoai || ''; // Giả sử trường số điện thoại là so_dien_thoai
      }
    },
    async submitForm() {
      if (!this.userStore.isLoggedIn) {
        alert('Vui lòng đăng nhập để tiếp tục!');
        this.$router.push('/login');
        return;
      }

      try {
        const response = await axios.post('http://127.0.0.1:8000/api/bookings', {
          homestay_id: this.bookingStore.homestayId,
          ngay_dat: new Date().toISOString().split('T')[0], // Ngày hiện tại
          tong_tien: this.$parent.finalTotal, // Lấy từ parent (BookingDetail.vue)
          trang_thai: 'pending',
          rooms: this.bookingStore.selectedRooms.map(room => ({
            roomId: room.roomId,
            quantity: room.quantity,
            checkIn: room.checkIn,
            checkOut: room.checkOut,
          })),
        });

        alert('Đặt phòng thành công! Mã đặt phòng: ' + response.data.booking_id);
        this.bookingStore.clearBookingData(); // Xóa dữ liệu sau khi đặt phòng
        this.$router.push('/'); // Chuyển hướng về trang chủ
      } catch (error) {
        console.error('Lỗi khi đặt phòng:', error);
        alert('Đã có lỗi xảy ra khi đặt phòng. Vui lòng thử lại.');
      }
    },
  },
};
</script>