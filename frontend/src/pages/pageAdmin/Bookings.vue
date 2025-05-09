<template>
  <div class="container mt-4">
    <h2>Quản lý đặt phòng</h2>

    <!-- Nút thêm mới đặt phòng -->
    <div class="mb-3">
      <button class="btn btn-success" @click="openCheckAvailabilityModal">Thêm mới đặt phòng</button>
    </div>

    <!-- Bộ lọc và tìm kiếm -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <label for="search">Tìm kiếm</label>
            <input
              type="text"
              id="search"
              class="form-control"
              v-model="filters.search"
              placeholder="Mã đặt phòng hoặc tên khách hàng"
              @input="fetchBookings"
            />
          </div>
          <div class="col-md-2">
            <label for="is_thanh_toan">Trạng thái thanh toán</label>
            <select
              id="is_thanh_toan"
              class="form-select"
              v-model="filters.is_thanh_toan"
              @change="fetchBookings"
            >
              <option value="">Tất cả</option>
              <option value="true">Đã thanh toán</option>
              <option value="false">Chưa thanh toán</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="tinh_trang">Trạng thái đặt phòng</label>
            <select
              id="tinh_trang"
              class="form-select"
              v-model="filters.tinh_trang"
              @change="fetchBookings"
            >
              <option value="">Tất cả</option>
              <option value="pending">Đang chờ</option>
              <option value="confirmed">Đã xác nhận</option>
              <option value="cancelled">Đã hủy</option>
              <option value="completed">Đã hoàn thành</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="start_date">Từ ngày</label>
            <input
              type="date"
              id="start_date"
              class="form-control"
              v-model="filters.start_date"
              @change="fetchBookings"
            />
          </div>
          <div class="col-md-2">
            <label for="end_date">Đến ngày</label>
            <input
              type="date"
              id="end_date"
              class="form-control"
              v-model="filters.end_date"
              @change="fetchBookings"
            />
          </div>
        </div>
      </div>
    </div>

    <!-- Bảng danh sách đặt phòng -->
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Mã đặt phòng</th>
              <th>Tên khách hàng</th>
              <th>Email</th>
              <th>Homestay</th>
              <th>Ngày đặt</th>
              <th>Tổng tiền</th>
              <th>Thanh toán</th>
              <th>Ghi chú</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking in bookings" :key="booking.id">
              <td>{{ booking.id }}</td>
              <td>{{ booking.ten_khach_hang }}</td>
              <td>{{ booking.email_khach_hang }}</td>
              <td>{{ booking.ten_homestay }}</td>
              <td>{{ formatDate(booking.ngay_dat) }}</td>
              <td>{{ formatPrice(booking.tong_tien) }}đ</td>
              <td>
                <select
                  class="form-select"
                  :value="booking.is_thanh_toan ? 'true' : 'false'"
                  @change="updatePaymentStatus(booking.id, $event.target.value)"
                >
                  <option value="false">Chưa thanh toán</option>
                  <option value="true">Đã thanh toán</option>
                </select>
              </td>
              <td>{{ booking.ghi_chu || 'Không có' }}</td>
              <td>
                <button class="btn btn-primary btn-sm me-1" @click="openDetailModal(booking)">
                  Xem chi tiết
                </button>
                <button class="btn btn-warning btn-sm me-1" @click="openEditModal(booking)">
                  Sửa
                </button>
                <button class="btn btn-danger btn-sm" @click="deleteBooking(booking.id)">
                  Xóa
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal hiển thị chi tiết đặt phòng -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailModalLabel">Chi tiết đặt phòng #{{ selectedBooking?.id }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Phòng</th>
                  <th>Ngày nhận phòng</th>
                  <th>Ngày trả phòng</th>
                  <th>Check-out thực tế</th>
                  <th>Giá</th>
                  <th>Trạng thái</th>
                  <th>Ghi chú</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="detail in selectedBooking?.chi_tiet_dat_phongs" :key="detail.id">
                  <td>{{ detail.ten_phong }}</td>
                  <td>{{ formatDate(detail.ngay_nhan_phong) }}</td>
                  <td>{{ formatDate(detail.ngay_tra_phong) }}</td>
                  <td>{{ detail.check_out_thuc_te ? formatDate(detail.check_out_thuc_te) : 'Chưa có' }}</td>
                  <td>{{ formatPrice(detail.gia) }}đ</td>
                  <td>
                    <select
                      class="form-select"
                      :value="detail.tinh_trang"
                      @change="updateDetailStatus(detail.id, $event.target.value)"
                    >
                      <option value="pending">Đang chờ</option>
                      <option value="confirmed">Đã xác nhận</option>
                      <option value="cancelled">Đã hủy</option>
                      <option value="completed">Đã hoàn thành</option>
                    </select>
                  </td>
                  <td>{{ detail.ghi_chu || 'Không có' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal kiểm tra phòng trống -->
    <div class="modal fade" id="checkAvailabilityModal" tabindex="-1" aria-labelledby="checkAvailabilityModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="checkAvailabilityModalLabel">Kiểm tra phòng trống</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="checkAvailability">
              <div class="mb-3">
                <label for="check_in" class="form-label">Ngày nhận phòng</label>
                <input
                  type="date"
                  id="check_in"
                  class="form-control"
                  v-model="availabilityForm.check_in"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="check_out" class="form-label">Ngày trả phòng</label>
                <input
                  type="date"
                  id="check_out"
                  class="form-control"
                  v-model="availabilityForm.check_out"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="suc_chua" class="form-label">Số người</label>
                <input
                  type="number"
                  id="suc_chua"
                  class="form-control"
                  v-model.number="availabilityForm.suc_chua"
                  min="1"
                  required
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" @click="checkAvailability">Kiểm tra</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal thêm/sửa đặt phòng -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">{{ isEditMode ? 'Sửa đặt phòng' : 'Thêm mới đặt phòng' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="saveBooking">
              <div class="mb-3">
                <label for="id_khach_hang" class="form-label">Khách hàng</label>
                <select
                  id="id_khach_hang"
                  class="form-select"
                  v-model="form.id_khach_hang"
                  required
                >
                  <option value="">Chọn khách hàng</option>
                  <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                    {{ customer.ho_ten }} ({{ customer.email }})
                  </option>
                </select>
              </div>
              <div class="mb-3">
                <label for="homestay_id" class="form-label">Homestay</label>
                <select
                  id="homestay_id"
                  class="form-select"
                  v-model="form.homestay_id"
                  @change="updateAvailableRooms"
                  required
                >
                  <option value="">Chọn homestay</option>
                  <option v-for="homestay in availableHomestays" :key="homestay.id" :value="homestay.id">
                    {{ homestay.ten_homestay }}
                  </option>
                </select>
              </div>
              <div class="mb-3">
                <label for="ngay_dat" class="form-label">Ngày đặt</label>
                <input
                  type="date"
                  id="ngay_dat"
                  class="form-control"
                  v-model="form.ngay_dat"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="tong_tien" class="form-label">Tổng tiền</label>
                <input
                  type="number"
                  id="tong_tien"
                  class="form-control"
                  v-model="form.tong_tien"
                  readonly
                />
              </div>
              <div class="mb-3">
                <label for="ghi_chu" class="form-label">Ghi chú</label>
                <textarea
                  id="ghi_chu"
                  class="form-control"
                  v-model="form.ghi_chu"
                  rows="3"
                ></textarea>
              </div>

              <!-- Danh sách phòng -->
              <h5>Phòng</h5>
              <div v-for="(room, index) in form.rooms" :key="index" class="border p-3 mb-3">
                <div class="row">
                  <div class="col-md-3">
                    <label :for="'roomId-' + index" class="form-label">Phòng</label>
                    <select
                      :id="'roomId-' + index"
                      class="form-select"
                      v-model="room.roomId"
                      @change="updateRoomPrice(index)"
                      required
                    >
                      <option value="">Chọn phòng</option>
                      <option v-for="roomOption in availableRooms" :key="roomOption.id" :value="roomOption.id">
                        {{ roomOption.ten_phong }} ({{ formatPrice(roomOption.gia) }}đ/ngày)
                      </option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label :for="'quantity-' + index" class="form-label">Số lượng</label>
                    <input
                      :id="'quantity-' + index"
                      type="number"
                      class="form-control"
                      v-model.number="room.quantity"
                      @input="updateRoomPrice(index)"
                      min="1"
                      required
                    />
                  </div>
                  <div class="col-md-2">
                    <label :for="'checkIn-' + index" class="form-label">Ngày nhận</label>
                    <input
                      :id="'checkIn-' + index"
                      type="date"
                      class="form-control"
                      v-model="room.checkIn"
                      @change="updateRoomPrice(index)"
                      required
                    />
                  </div>
                  <div class="col-md-2">
                    <label :for="'checkOut-' + index" class="form-label">Ngày trả</label>
                    <input
                      :id="'checkOut-' + index"
                      type="date"
                      class="form-control"
                      v-model="room.checkOut"
                      @change="updateRoomPrice(index)"
                      required
                    />
                  </div>
                  <div class="col-md-2">
                    <label class="form-label">Giá</label>
                    <p class="form-control-static">{{ formatPrice(room.gia || 0) }}đ</p>
                  </div>
                  <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm" @click="removeRoom(index)">
                      Xóa
                    </button>
                  </div>
                </div>
                <div class="mt-2">
                  <label :for="'ghiChuRoom-' + index" class="form-label">Ghi chú phòng</label>
                  <textarea
                    :id="'ghi_tiet_dat_phong' + index"
                    class="form-control"
                    v-model="room.ghi_chu"
                    rows="2"
                  ></textarea>
                </div>
              </div>
              <button type="button" class="btn btn-primary mb-3" @click="addRoom">
                Thêm phòng
              </button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" @click="saveBooking">
              {{ isEditMode ? 'Cập nhật' : 'Thêm mới' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { Modal } from 'bootstrap';

export default {
  data() {
    return {
      bookings: [],
      selectedBooking: null,
      detailModal: null,
      checkAvailabilityModal: null,
      editModal: null,
      filters: {
        search: '',
        is_thanh_toan: '',
        tinh_trang: '',
        start_date: '',
        end_date: '',
      },
      availabilityForm: {
        check_in: '',
        check_out: '',
        suc_chua: 1,
      },
      availableHomestays: [],
      availableRooms: [],
      isEditMode: false,
      form: {
        id: null,
        id_khach_hang: '',
        homestay_id: '',
        ngay_dat: '',
        tong_tien: 0,
        ghi_chu: '',
        rooms: [],
      },
      homestays: [],
      customers: [],
    };
  },
  mounted() {
    this.fetchBookings();
    this.fetchCustomers();
    this.detailModal = new Modal(document.getElementById('detailModal'));
    this.checkAvailabilityModal = new Modal(document.getElementById('checkAvailabilityModal'));
    this.editModal = new Modal(document.getElementById('editModal'));
  },
  methods: {
    async fetchBookings() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/admin/bookings', {
          params: this.filters,
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        this.bookings = response.data;
      } catch (error) {
        console.error('Lỗi khi lấy danh sách đặt phòng:', error);
        alert('Đã có lỗi xảy ra khi lấy danh sách đặt phòng.');
      }
    },
    async fetchCustomers() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/admin/customers', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        this.customers = response.data;
      } catch (error) {
        console.error('Lỗi khi lấy danh sách khách hàng:', error);
        alert('Đã có lỗi xảy ra khi lấy danh sách khách hàng.');
      }
    },
    async checkAvailability() {
      try {
        const response = await axios.post(
          'http://127.0.0.1:8000/api/admin/check-available-rooms',
          this.availabilityForm,
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('token')}`,
            },
          }
        );
        this.availableHomestays = response.data;
        this.checkAvailabilityModal.hide();
        this.openAddModal();
      } catch (error) {
        console.error('Lỗi khi kiểm tra phòng trống:', error);
        alert('Đã có lỗi xảy ra: ' + (error.response?.data?.message || error.message));
      }
    },
    updateAvailableRooms() {
      const selectedHomestay = this.availableHomestays.find(h => h.id === this.form.homestay_id);
      this.availableRooms = selectedHomestay ? selectedHomestay.available_rooms : [];
    },
    async updatePaymentStatus(bookingId, isThanhToan) {
      try {
        await axios.put(
          `http://127.0.0.1:8000/api/admin/bookings/${bookingId}/payment-status`,
          { is_thanh_toan: isThanhToan === 'true' },
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('token')}`,
            },
          }
        );
        this.fetchBookings();
        alert('Cập nhật trạng thái thanh toán thành công!');
      } catch (error) {
        console.error('Lỗi khi cập nhật trạng thái thanh toán:', error);
        alert('Đã có lỗi xảy ra khi cập nhật trạng thái thanh toán.');
      }
    },
    async updateDetailStatus(detailId, tinhTrang) {
      try {
        await axios.put(
          `http://127.0.0.1:8000/api/admin/booking-details/${detailId}/status`,
          { tinh_trang: tinhTrang },
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('token')}`,
            },
          }
        );
        this.fetchBookings();
        alert('Cập nhật trạng thái chi tiết đặt phòng thành công!');
      } catch (error) {
        console.error('Lỗi khi cập nhật trạng thái chi tiết đặt phòng:', error);
        alert('Đã có lỗi xảy ra khi cập nhật trạng thái chi tiết đặt phòng.');
      }
    },
    async deleteBooking(bookingId) {
      if (!confirm('Bạn có chắc chắn muốn xóa đặt phòng này?')) return;
      try {
        await axios.delete(`http://127.0.0.1:8000/api/admin/bookings/${bookingId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        this.fetchBookings();
        alert('Xóa đặt phòng thành công!');
      } catch (error) {
        console.error('Lỗi khi xóa đặt phòng:', error);
        alert('Đã có lỗi xảy ra khi xóa đặt phòng.');
      }
    },
    openDetailModal(booking) {
      this.selectedBooking = booking;
      this.detailModal.show();
    },
    openCheckAvailabilityModal() {
      this.availabilityForm = {
        check_in: '',
        check_out: '',
        suc_chua: 1,
      };
      this.availableHomestays = [];
      this.availableRooms = [];
      this.checkAvailabilityModal.show();
    },
    openAddModal() {
      this.isEditMode = false;
      this.form = {
        id: null,
        id_khach_hang: '',
        homestay_id: '',
        ngay_dat: new Date().toISOString().split('T')[0], // Ngày hiện tại
        tong_tien: 0,
        ghi_chu: '',
        rooms: [],
      };
      this.form.rooms.push({
        roomId: '',
        quantity: 1,
        checkIn: this.availabilityForm.check_in,
        checkOut: this.availabilityForm.check_out,
        ghi_chu: '',
        gia: 0,
      });
      this.editModal.show();
    },
    openEditModal(booking) {
      this.isEditMode = true;
      this.form = {
        id: booking.id,
        id_khach_hang: this.customers.find(c => c.email === booking.email_khach_hang)?.id || '',
        homestay_id: this.homestays.find(h => h.ten_homestay === booking.ten_homestay)?.id || '',
        ngay_dat: booking.ngay_dat,
        tong_tien: booking.tong_tien,
        ghi_chu: booking.ghi_chu,
        rooms: booking.chi_tiet_dat_phongs.map(detail => ({
          id: detail.id,
          roomId: detail.id_phong,
          quantity: 1,
          checkIn: detail.ngay_nhan_phong,
          checkOut: detail.ngay_tra_phong,
          ghi_chu: detail.ghi_chu,
          gia: detail.gia,
        })),
      };
      // Để chỉnh sửa, cần lấy danh sách homestay và phòng trống
      this.availableHomestays = this.homestays;
      this.updateAvailableRooms();
      this.editModal.show();
    },
    addRoom() {
      this.form.rooms.push({
        id: null,
        roomId: '',
        quantity: 1,
        checkIn: this.availabilityForm.check_in,
        checkOut: this.availabilityForm.check_out,
        ghi_chu: '',
        gia: 0,
      });
    },
    removeRoom(index) {
      this.form.rooms.splice(index, 1);
      this.calculateTotalPrice();
    },
    updateRoomPrice(index) {
      const room = this.form.rooms[index];
      const selectedRoom = this.availableRooms.find(r => r.id === room.roomId);
      if (selectedRoom && room.checkIn && room.checkOut) {
        const checkIn = new Date(room.checkIn);
        const checkOut = new Date(room.checkOut);
        const numberOfDays = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        room.gia = selectedRoom.gia * room.quantity * (numberOfDays > 0 ? numberOfDays : 0);
      } else {
        room.gia = 0;
      }
      this.calculateTotalPrice();
    },
    calculateTotalPrice() {
      this.form.tong_tien = this.form.rooms.reduce((total, room) => total + (room.gia || 0), 0);
    },
    async saveBooking() {
      try {
        const payload = {
          id_khach_hang: this.form.id_khach_hang,
          homestay_id: this.form.homestay_id,
          ngay_dat: this.form.ngay_dat,
          tong_tien: this.form.tong_tien,
          ghi_chu: this.form.ghi_chu,
          rooms: this.form.rooms.map(room => ({
            id: room.id,
            roomId: room.roomId,
            quantity: room.quantity,
            checkIn: room.checkIn,
            checkOut: room.checkOut,
            ghi_chu: room.ghi_chu,
          })),
        };

        if (this.isEditMode) {
          await axios.put(
            `http://127.0.0.1:8000/api/admin/bookings/${this.form.id}`,
            payload,
            {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
              },
            }
          );
          alert('Cập nhật đặt phòng thành công!');
        } else {
          await axios.post(
            'http://127.0.0.1:8000/api/admin/bookings',
            payload,
            {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
              },
            }
          );
          alert('Thêm mới đặt phòng thành công!');
        }
        this.editModal.hide();
        this.fetchBookings();
      } catch (error) {
        console.error('Lỗi khi lưu đặt phòng:', error);
        alert('Đã có lỗi xảy ra: ' + (error.response?.data?.message || error.message));
      }
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString('vi-VN');
    },
    formatPrice(price) {
      return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    },
  },
};
</script>

<style scoped>
.table th, .table td {
  vertical-align: middle;
}
.form-select, .form-control {
  width: 100%;
}
.form-control-static {
  margin: 0;
}
</style>