<template>
  <div class="container mt-4">
    <h2>Quản lý đặt phòng</h2>

    <!-- Báo cáo cơ bản -->
    <div class="card mb-4">
      <div class="card-body">
        <h5>Thống kê</h5>
        <p><strong>Tổng doanh thu:</strong> {{ formatPrice(totalRevenue) }}đ</p>
        <p><strong>Số đặt phòng:</strong> {{ bookingStats.total }}</p>
        <p><strong>Đang chờ:</strong> {{ bookingStats.pending }}</p>
        <p><strong>Đã xác nhận:</strong> {{ bookingStats.confirmed }}</p>
        <p><strong>Đã hủy:</strong> {{ bookingStats.cancelled }}</p>
        <p><strong>Đã hoàn thành:</strong> {{ bookingStats.completed }}</p>
      </div>
    </div>

    <!-- Nút thêm mới đặt phòng -->
    <div class="mb-3">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Tạo đặt phòng</button>
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
        <div v-if="loading" class="text-center">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Đang tải...</span>
          </div>
        </div>
        <table class="table table-bordered table-hover" v-else>
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

    <!-- Modal tạo/sửa đặt phòng -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ isEditMode ? 'Sửa đặt phòng' : 'Tạo đặt phòng' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Thông tin khách hàng và ngày đặt -->
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="customer">Khách hàng</label>
                <select class="form-select" v-model="form.id_khach_hang" required>
                  <option value="">Chọn khách hàng</option>
                  <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                    {{ customer.ten_khach_hang }}
                  </option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="ngay_dat">Ngày đặt</label>
                <input type="date" class="form-control" v-model="form.ngay_dat" required />
              </div>
            </div>

            <!-- Tìm kiếm phòng trống -->
            <div class="row">
              <div class="col-lg-4">
                <label>Check-in</label>
                <input
                  class="form-control"
                  type="date"
                  placeholder="Nhập ngày nhận phòng"
                  v-model="timphong.check_in"
                  @change="checkAvailability"
                />
              </div>
              <div class="col-lg-4">
                <label>Check-out</label>
                <input
                  class="form-control"
                  type="date"
                  placeholder="Nhập ngày trả phòng"
                  v-model="timphong.check_out"
                  @change="checkAvailability"
                />
              </div>
              <div class="col-lg-4">
                <label>Sức chứa</label>
                <div class="d-flex justify-content-between">
                  <input
                    class="form-control"
                    type="number"
                    placeholder="Nhập sức chứa"
                    v-model.number="timphong.suc_chua"
                    @change="checkAvailability"
                  />
                  <button @click="checkAvailability()" class="btn btn-danger ms-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                  </button>
                </div>
              </div>
            </div>
            <hr>
            <h6>Kết quả tìm kiếm</h6>
            <div class="accordion" id="accordionExample">
              <template v-for="(homestay, index) in availableHomestays" :key="homestay.id">
                <div class="accordion-item">
                  <h2 class="accordion-header" :id="`heading-${homestay.id}`">
                    <button
                      class="accordion-button"
                      type="button"
                      data-bs-toggle="collapse"
                      :data-bs-target="`#collapse-${homestay.id}`"
                      :aria-expanded="index === 0"
                      :aria-controls="`collapse-${homestay.id}`"
                    >
                      {{ homestay.ten_homestay }}
                    </button>
                  </h2>
                  <div
                    :id="`collapse-${homestay.id}`"
                    class="accordion-collapse collapse"
                    :class="{ show: index === 0 }"
                    :aria-labelledby="`heading-${homestay.id}`"
                    data-bs-parent="#accordionExample"
                  >
                    <div class="accordion-body">
                      <ul class="list-group">
                        <li
                          v-for="room in homestay.available_rooms"
                          :key="room.id"
                          class="list-group-item d-flex justify-content-between align-items-center"
                        >
                          <div>
                            <strong>Tên phòng:</strong> {{ room.ten_phong }}<br />
                            <strong>Sức chứa:</strong> {{ room.suc_chua }} người<br />
                            <strong>Giá/ngày:</strong> {{ room.gia.toLocaleString() }} VNĐ
                          </div>
                          <button class="btn btn-sm btn-primary" @click="selectRoom(homestay, room)">
                            Chọn
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </template>
            </div>

            <!-- Danh sách phòng đã chọn -->
            <hr>
            <h6>Phòng đã chọn</h6>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Homestay</th>
                  <th>Phòng</th>
                  <th>Ngày nhận</th>
                  <th>Ngày trả</th>
                  <th>Số lượng</th>
                  <th>Ghi chú</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(room, index) in form.rooms" :key="index">
                  <td>{{ room.homestayName }}</td>
                  <td>{{ room.roomName }}</td>
                  <td>
                    <input type="date" class="form-control" v-model="room.checkIn" @change="validateDates(index)" />
                  </td>
                  <td>
                    <input type="date" class="form-control" v-model="room.checkOut" @change="validateDates(index)" />
                  </td>
                  <td>
                    <input type="number" class="form-control" v-model.number="room.quantity" min="1" @change="calculateTotalPrice" />
                  </td>
                  <td>
                    <input type="text" class="form-control" v-model="room.ghi_chu" />
                  </td>
                  <td>
                    <button class="btn btn-danger btn-sm" @click="removeRoom(index)">Xóa</button>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Ghi chú và tổng tiền -->
            <div class="row">
              <div class="col-md-6">
                <label for="ghi_chu">Ghi chú</label>
                <textarea class="form-control" v-model="form.ghi_chu" rows="3"></textarea>
              </div>
              <div class="col-md-6">
                <label>Tổng tiền</label>
                <input class="form-control" type="text" :value="formatPrice(form.tong_tien) + 'đ'" readonly />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" @click="saveBooking" :disabled="loading">
              <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              {{ isEditMode ? 'Cập nhật' : 'Lưu' }}
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
import baseRequest from '../../core/baseRequest';

export default {
  data() {
    return {
      timphong: {
        check_in: '',
        check_out: '',
        suc_chua: 1,
      },
      bookings: [],
      selectedBooking: null,
      detailModal: null,
      editModal: null,
      filters: {
        search: '',
        is_thanh_toan: '',
        tinh_trang: '',
        start_date: '',
        end_date: '',
      },
      availableHomestays: [],
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
      customers: [],
      loading: false,
      bookingStats: {
        total: 0,
        pending: 0,
        confirmed: 0,
        cancelled: 0,
        completed: 0,
      },
      totalRevenue: 0,
    };
  },
  mounted() {
    this.fetchBookings();
    this.fetchCustomers();
    this.detailModal = new Modal(document.getElementById('detailModal'));
    this.editModal = new Modal(document.getElementById('exampleModal'));
  },
  methods: {
    async fetchBookings() {
      this.loading = true;
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/admin/bookings', {
          params: this.filters,
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        this.bookings = response.data;
        this.calculateStats();
      } catch (error) {
        console.error('Lỗi khi lấy danh sách đặt phòng:', error);
        alert('Đã có lỗi xảy ra khi lấy danh sách đặt phòng.');
      } finally {
        this.loading = false;
      }
    },
    async fetchCustomers() {
      this.loading = true;
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
      } finally {
        this.loading = false;
      }
    },
    async checkAvailability() {
      this.loading = true;
      try {
        const response = await baseRequest.post(
          'http://127.0.0.1:8000/api/admin/check-available-rooms',
          this.timphong
        );
        this.availableHomestays = response.data.data;
      } catch (error) {
        console.error('Lỗi khi kiểm tra phòng trống:', error);
        alert('Đã có lỗi xảy ra: ' + (error.response?.data?.message || error.message));
      } finally {
        this.loading = false;
      }
    },
    async updatePaymentStatus(bookingId, isThanhToan) {
      this.loading = true;
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
        if (isThanhToan === 'true') {
          await this.autoConfirmBooking(bookingId);
        }
        this.logChange('Thanh toán', bookingId, isThanhToan);
        this.fetchBookings();
        alert('Cập nhật trạng thái thanh toán thành công!');
      } catch (error) {
        console.error('Lỗi khi cập nhật trạng thái thanh toán:', error);
        alert('Đã có lỗi xảy ra khi cập nhật trạng thái thanh toán.');
      } finally {
        this.loading = false;
      }
    },
    async autoConfirmBooking(bookingId) {
      try {
        await axios.put(
          `http://127.0.0.1:8000/api/admin/bookings/${bookingId}/status`,
          { tinh_trang: 'confirmed' },
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('token')}`,
            },
          }
        );
        this.logChange('Xác nhận tự động', bookingId, 'confirmed');
      } catch (error) {
        console.error('Lỗi khi tự động xác nhận đặt phòng:', error);
      }
    },
    async updateDetailStatus(detailId, tinhTrang) {
      this.loading = true;
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
        this.logChange('Chi tiết đặt phòng', detailId, tinhTrang);
        this.fetchBookings();
        alert('Cập nhật trạng thái chi tiết đặt phòng thành công!');
      } catch (error) {
        console.error('Lỗi khi cập nhật trạng thái chi tiết đặt phòng:', error);
        alert('Đã có lỗi xảy ra khi cập nhật trạng thái chi tiết đặt phòng.');
      } finally {
        this.loading = false;
      }
    },
    async deleteBooking(bookingId) {
      if (!confirm('Bạn có chắc chắn muốn xóa đặt phòng này?')) return;
      this.loading = true;
      try {
        await axios.delete(`http://127.0.0.1:8000/api/admin/bookings/${bookingId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        this.logChange('Xóa đặt phòng', bookingId, 'deleted');
        this.fetchBookings();
        alert('Xóa đặt phòng thành công!');
      } catch (error) {
        console.error('Lỗi khi xóa đặt phòng:', error);
        alert('Đã có lỗi xảy ra khi xóa đặt phòng.');
      } finally {
        this.loading = false;
      }
    },
    openDetailModal(booking) {
      this.selectedBooking = booking;
      this.detailModal.show();
    },
    openEditModal(booking) {
      this.isEditMode = true;
      this.form = {
        id: booking.id,
        id_khach_hang: booking.id_khach_hang,
        homestay_id: booking.homestay_id,
        ngay_dat: booking.ngay_dat.split('T')[0],
        tong_tien: booking.tong_tien,
        ghi_chu: booking.ghi_chu,
        rooms: booking.chi_tiet_dat_phongs.map(detail => ({
          roomId: detail.phong_id,
          roomName: detail.ten_phong,
          homestayId: booking.homestay_id,
          homestayName: booking.ten_homestay,
          checkIn: detail.ngay_nhan_phong.split('T')[0],
          checkOut: detail.ngay_tra_phong.split('T')[0],
          quantity: 1,
          ghi_chu: detail.ghi_chu,
          pricePerDay: detail.gia / (new Date(detail.ngay_tra_phong).getDate() - new Date(detail.ngay_nhan_phong).getDate()),
        })),
      };
      this.timphong = {
        check_in: this.form.rooms[0]?.checkIn || '',
        check_out: this.form.rooms[0]?.checkOut || '',
        suc_chua: this.form.rooms.reduce((total, room) => total + room.quantity, 0),
      };
      this.editModal.show();
    },
    selectRoom(homestay, room) {
      this.form.homestay_id = homestay.id;
      this.form.rooms.push({
        roomId: room.id,
        roomName: room.ten_phong,
        homestayId: homestay.id,
        homestayName: homestay.ten_homestay,
        checkIn: this.timphong.check_in,
        checkOut: this.timphong.check_out,
        quantity: 1,
        ghi_chu: '',
        pricePerDay: room.gia,
      });
      this.calculateTotalPrice();
    },
    removeRoom(index) {
      this.form.rooms.splice(index, 1);
      this.calculateTotalPrice();
    },
    validateDates(index) {
      const room = this.form.rooms[index];
      if (room.checkIn && room.checkOut && new Date(room.checkIn) >= new Date(room.checkOut)) {
        alert('Ngày trả phòng phải sau ngày nhận phòng!');
        room.checkOut = '';
      }
      this.calculateTotalPrice();
    },
    calculateTotalPrice() {
      this.form.tong_tien = this.form.rooms.reduce((total, room) => {
        if (room.checkIn && room.checkOut) {
          const checkIn = new Date(room.checkIn);
          const checkOut = new Date(room.checkOut);
          const numberOfDays = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
          return total + (room.quantity * (numberOfDays > 0 ? numberOfDays : 0) * room.pricePerDay);
        }
        return total;
      }, 0);
    },
    async saveBooking() {
      if (!this.form.id_khach_hang || !this.form.ngay_dat || this.form.rooms.length === 0) {
        alert('Vui lòng điền đầy đủ thông tin khách hàng, ngày đặt và ít nhất một phòng!');
        return;
      }
      this.loading = true;
      try {
        const payload = {
          id_khach_hang: this.form.id_khach_hang,
          homestay_id: this.form.homestay_id,
          ngay_dat: this.form.ngay_dat,
          tong_tien: this.form.tong_tien,
          ghi_chu: this.form.ghi_chu,
          rooms: this.form.rooms.map(room => ({
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
          this.logChange('Cập nhật đặt phòng', this.form.id, payload);
          alert('Cập nhật đặt phòng thành công!');
        } else {
          const response = await axios.post(
            'http://127.0.0.1:8000/api/admin/bookings',
            payload,
            {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
              },
            }
          );
          this.logChange('Tạo đặt phòng', response.data.id, payload);
          alert('Thêm mới đặt phòng thành công!');
          this.notifyAdmin('Có đặt phòng mới: #' + response.data.id);
        }
        this.editModal.hide();
        this.fetchBookings();
      } catch (error) {
        console.error('Lỗi khi lưu đặt phòng:', error);
        const errorMessage = error.response?.data?.message || error.message;
        if (error.response?.data?.roomId) {
          alert(`Phòng ${error.response.data.roomId} không khả dụng trong khoảng thời gian đã chọn!`);
        } else {
          alert('Đã có lỗi xảy ra: ' + errorMessage);
        }
      } finally {
        this.loading = false;
      }
    },
    calculateStats() {
      this.totalRevenue = this.bookings.reduce((total, booking) => total + booking.tong_tien, 0);
      this.bookingStats.total = this.bookings.length;
      this.bookingStats.pending = this.bookings.filter(b => b.tinh_trang === 'pending').length;
      this.bookingStats.confirmed = this.bookings.filter(b => b.tinh_trang === 'confirmed').length;
      this.bookingStats.cancelled = this.bookings.filter(b => b.tinh_trang === 'cancelled').length;
      this.bookingStats.completed = this.bookings.filter(b => b.tinh_trang === 'completed').length;
    },
    logChange(action, id, data) {
      console.log(`[${new Date().toLocaleString()}] ${action} - ID: ${id}`, data);
    },
    notifyAdmin(message) {
      alert(`Thông báo cho quản lý: ${message}`);
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