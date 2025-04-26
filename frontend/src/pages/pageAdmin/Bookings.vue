<template>
  <div class="card">
    <div class="card-body">
      <!-- Tìm kiếm & lọc -->
      <div class="d-lg-flex justify-content-between mb-4">
        <div class="position-relative">
          <input type="text" class="form-control ps-5 radius-30" placeholder="Tìm booking" v-model="searchQuery" />
          <span class="position-absolute top-50 product-show translate-middle-y">
            <i class="bx bx-search"></i>
          </span>
        </div>

        <div class="d-flex">
          <select v-model="filterStatus" class="form-select form-select-sm radius-30 mt-2 mt-lg-0"
            style="width: fit-content">
            <option value="">Trạng thái</option>
            <option value="1">Đã thanh toán</option>
            <option value="0">Chưa thanh toán</option>
          
          </select>
          <select v-model="filterSort" class="form-select form-select-sm mx-1 radius-30 mt-2 mt-lg-0"
            style="width: fit-content">
            <option value="">Sắp xếp</option>
            <option value="asc">Tổng tiền tăng</option>
            <option value="desc">Tổng tiền giảm</option>
            <option value="checkin">Ngày nhận phòng</option>
          </select>
          <button class="btn btn-primary radius-30 mt-2 mt-lg-0 text-nowrap" data-bs-toggle="modal"
            data-bs-target="#exampleScrollableModal">
            <i class="bx bxs-plus-square"></i> Thêm booking mới
          </button>
        </div>
      </div>

      <!-- Danh sách booking -->
      <div class="table-responsive">
        <table class="table mb-0">
          <thead class="table-light">
            <tr>
              <th>ID#</th>
              <th>Tên khách hàng</th>
              <th>Homestay</th>
              <th>Ngày nhận phòng</th>
              <th>Ngày trả phòng</th>
              <th>Tiền giảm</th>
              <th>Tổng tiền</th>
              <th>Thanh toán</th>
              <th>Xem chi tiết</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking in filteredBookings" :key="booking.id">
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-2">
                    <h6 class="mb-0 font-14">#{{ booking.id }}</h6>
                  </div>
                </div>
              </td>
              <td>{{ booking.ten_khach_hang }}</td>
              <td>{{ booking.homestay }}</td>
              <td>{{ formatDate(booking.ngay_nhan_phong) }}</td>
              <td>{{ formatDate(booking.ngay_tra_phong) }}</td>
              <td>{{ booking.tien_giam.toLocaleString() }}đ</td>
              <td>{{ booking.tong_tien.toLocaleString() }}đ</td>
              <td>
                <div v-if="booking.is_thanh_toan == 1"
                  class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                  <i class="bx bxs-circle me-1"></i>Đã thanh toán
                </div>
                <div v-if="booking.is_thanh_toan == 0"
                  class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                  <i class="bx bxs-circle me-1"></i>Chưa thanh toán
                </div>
              </td>
              <td>
                <button class="btn btn-sm radius-30 btn-danger">
                  Xem chi tiết
                </button>
              </td>
              <td>
                <div class="d-flex order-actions">
                  <a @click="editBooking(booking)" data-bs-toggle="modal" data-bs-target="#modalEditBooking">
                    <i class="bx bxs-edit"></i>
                  </a>
                  <a class="ms-3" @click="deleteBooking(booking.id)">
                    <i class="bx bxs-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Thêm Booking -->
  <div class="modal fade" id="exampleScrollableModal" tabindex="" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm booking</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <label for="text">Nhập tên khách hàng</label>
              <input type="text" class="form-control" placeholder="Nhập tên khách hàng"
                v-model="newBooking.ten_khach_hang" required>
              <div class="row">
                <div class="col-6">
                  <label class="mt-2">Số điện thoại</label>
                  <input type="text" class="form-control" placeholder="Nhập tên khách hàng"
                    v-model="newBooking.so_dien_thoai" required />
                </div>
                <div class="col-6">
                  <label class="mt-2">Email khách hàng</label>
                  <input type="email" class="form-control" placeholder="Nhập tên phòng"
                    v-model="newBooking.email_khach_hang" required />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label class="mt-2">Chọn ngày đến</label>
                  <input type="date" class="form-control" placeholder="Nhập tên khách hàng"
                    v-model="newBooking.so_dien_thoai" required />
                </div>
                <div class="col-6">
                  <label class="mt-2">Chọn ngày đi</label>
                  <input type="date" class="form-control" placeholder="Nhập tên phòng"
                    v-model="newBooking.email_khach_hang" required />
                </div>
              </div>

              <label class="mt-2">Chọn Homestay</label>
              <div class="row">
                <div class="col">
                  <select class=" form-control  mt-2">
                    <option value="">Homestay</option>
                    <option value="Bơ Yang">Bơ Yang</option>
                    <option value="Healing">Healing</option>
                    <option value="Rosie">Rosie</option>
                  </select>
                </div>
                <div class="col">
                  <button class="btn btn-danger mt-2 w-100  text-nowrap">Kiểm tra</button>
                </div>
                <hr>
                <div class="card">

                  <div class="card-body">
                    <div class="row">
                      <h5>Muse room</h5>
                      <div class="col">
                        <p class="m-0">Diện tích: 15 m2</p>
                        <p class="m-0">Số lượng khách: 2</p>
                        <p class="m-0">Giường đôi: 1</p>
                      </div>
                      <div class="col text-end">
                        <p class="m-0 fs-6 fw-bold" style="color:#062d62;">700.000 <i class="fa-solid fa-dong-sign"></i>
                        </p>
                        <div class="d-flex w-100 justify-content-end align-items-center"><span>Chọn số
                            phòng</span><select class="form-select-sm ms-2" aria-label="Default select example">
                            <option value="1" selected="">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select></div>
                      </div>
                    </div>
                    <hr>
                    <div><span class="me-3"><i class="fa-solid fa-tv"></i> TV</span><span class="me-3"><i
                          class="fa-solid fa-film"></i> Netflix</span><span class="me-3"><i
                          class="fa-solid fa-kitchen-set"></i> Bếp</span><span class="me-3"><i
                          class="fa-solid fa-shower"></i> WC in room</span><span><i class="fa-solid fa-snowflake"></i>
                        Điều hòa</span></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <label for="">Chọn thêm dịch vụ</label>
              <div class="row">
                <div class="col-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <h6 class="p-0 m-0"><i class="fa-solid fa-motorcycle"></i> Xe máy</h6>
                          <p class="m-0 p-0 ">300,000 đ/ngày</p>
                        </div>
                        <div><select class="form-select-sm ms-2" aria-label="Default select example" data-v-41373be6="">
                            <option value="1" selected="" data-v-41373be6="">1</option>
                            <option value="2" data-v-41373be6="">2</option>
                            <option value="3" data-v-41373be6="">3</option>
                          </select></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <h6 class="p-0 m-0"><i class="fa-solid fa-motorcycle"></i> Xe máy</h6>
                          <p class="m-0 p-0 ">300,000 đ/ngày</p>
                        </div>
                        <div><select class="form-select-sm ms-2" aria-label="Default select example" data-v-41373be6="">
                            <option value="1" selected="" data-v-41373be6="">1</option>
                            <option value="2" data-v-41373be6="">2</option>
                            <option value="3" data-v-41373be6="">3</option>
                          </select></div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Chi tiết đặt phòng</h5>
                  <div class="row">
                    <div class="col-6">
                      <p class="fs-8 fw-bold p-0">Nhận phòng</p>
                      <p class="fw-bold p-0 m-0" style="font-size: 1.2rem;">2023-10-01</p>
                      <p>từ 14:00</p>
                    </div>
                    <div class="col-6">
                      <p class="fs-8 fw-bold p-0">Trả phòng</p>
                      <p class="fw-bold p-0 m-0" style="font-size: 1.2rem;">2023-10-05</p>
                      <p>lúc 12:00</p>
                    </div>
                  </div>
                  <hr>
                  <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne"><button class="accordion-button collapsed"
                          type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                          aria-controls="collapseOne">
                          <div>
                            <p class="fs-8 fw-bold p-0">Bạn đã chọn</p>
                            <p class="fw-bold p-0 m-0" style="font-size:1.2rem;"> 2 phòng cho 2 người, xe máy </p>
                          </div>
                        </button></h2>
                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">2 x phòng ABC</div>
                        <div class="accordion-body">2 x xe máy</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <p>Tóm tắt giá</p>
                  <div class="d-flex justify-content-between">
                    <p class="fw-bold">Giá phòng</p>
                    <p class="fw-bold">2.000.000đ</p>
                  </div>
                  <div class="d-flex justify-content-between">
                    <p class="fw-bold">Phí dịch vụ</p>
                    <p class="fw-bold">200.000đ</p>
                  </div>
                  <div class="d-flex justify-content-between">
                    <p class="fw-bold">Ưu đãi</p>
                    <p class="fw-bold">199.000đ</p>
                  </div>
                  <div class="p-3 mt-3 rounded d-flex justify-content-between align-items-center py-4"
                    style="background:#062d62;color:aliceblue;">
                    <p class="fs-5 fw-bold p-0 m-0">Tổng</p>
                    <div class="">
                      <p class="text-decoration-line-through text-danger p-0 m-0">1.000.000đ</p>
                      <p class="fs-5 fw-bold p-0 m-0">700.000đ</p>
                      <p class="fst-italic text-light p-0 m-0">Đã bao gồm thuế</p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mt-2 ms-5">
                    <p><i class="fa-solid fa-money-bill"></i> bao gồm 10% Thuế GTGT</p>
                    <p>100.000đ</p>
                  </div>
                </div>
              </div>
              <button class="btn btn-success w-100">Tạo ngay</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Sửa Booking -->
  <div class="modal fade" id="modalEditBooking" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sửa booking</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="updateBooking">
            <div class="row">
              <div class="col-12">
                <label class="mt-2">Tên khách hàng</label>
                <input type="text" class="form-control" placeholder="Nhập tên khách hàng"
                  v-model="editBookingData.ten_khach_hang" required />
                <label class="mt-2">Trạng thái</label>
                <select class="form-select form-select mt-2 mt-lg-0" v-model="editBookingData.trang_thai" required>
                  <option value="Đã xác nhận">Đã xác nhận</option>
                  <option value="Chờ xác nhận">Chờ xác nhận</option>
                  <option value="Đã hủy">Đã hủy</option>
                </select>
                <label class="mt-2">Ngày nhận phòng</label>
                <input type="date" class="form-control" v-model="editBookingData.ngay_nhan_phong" required />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">
                Save changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import SearchRoom from "../../components/User/SearchRoom.vue";
  export default {
    components: {
      SearchRoom,
    },
    data() {
      return {
        searchQuery: "",
        filterStatus: "",
        filterSort: "",
        newBooking: {
          ten_khach_hang: "",
          phong: "",
          ngay_nhan_phong: "",
          ngay_tra_phong: "",
          trang_thai: "Chờ xác nhận",
          tong_tien: 0,
        },
        editBookingData: {
          id: null,
          ten_khach_hang: "",
          trang_thai: "",
          ngay_nhan_phong: "",
        },
        bookings: [
          {
            id: "BK-000001",
            ten_khach_hang: "Nguyễn Văn A",
            homestay: "Studio Biển",
            ngay_nhan_phong: "2025-04-20",
            ngay_tra_phong: "2025-04-22",
            tien_giam: 0,
            tong_tien: 1200000,
            is_thanh_toan: "1",
            tong_tien: 1000000,
          },
          {
            id: "BK-000002",
            ten_khach_hang: "Nguyễn Văn B",
            homestay: "Bơ Yang",
            ngay_nhan_phong: "2025-04-20",
            ngay_tra_phong: "2025-04-22",
            tien_giam: 100,
            tong_tien: 1200000,
            is_thanh_toan: "0",
            tong_tien: 1200000,
          },
        ],
      };
    },
    computed: {
      filteredBookings() {
        let result = [...this.bookings];

        if (this.searchQuery) {
          result = result.filter(
            (b) =>
              b.ten_khach_hang
                .toLowerCase()
                .includes(this.searchQuery.toLowerCase()) ||
              b.phong.toLowerCase().includes(this.searchQuery.toLowerCase())
          );
        }

        if (this.filterStatus) {
          result = result.filter((b) => b.is_thanh_toan === this.filterStatus);
        }

        if (this.filterSort === "asc") {
          result.sort((a, b) => a.tong_tien - b.tong_tien);
        } else if (this.filterSort === "desc") {
          result.sort((a, b) => b.tong_tien - a.tong_tien);
        } else if (this.filterSort === "checkin") {
          result.sort(
            (a, b) => new Date(a.ngay_nhan_phong) - new Date(b.ngay_nhan_phong)
          );
        }

        return result;
      },
    },
    methods: {
      formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString("vi-VN", {
          day: "2-digit",
          month: "2-digit",
          year: "numeric",
        });
      },
      addBooking() {
        if (
          !this.newBooking.ten_khach_hang ||
          !this.newBooking.phong ||
          !this.newBooking.ngay_nhan_phong ||
          !this.newBooking.ngay_tra_phong ||
          !this.newBooking.tong_tien
        ) {
          alert(
            "Vui lòng điền đầy đủ thông tin bắt buộc (Tên khách hàng, Phòng, Ngày nhận phòng, Ngày trả phòng, Tổng tiền)!"
          );
          return;
        }

        const newBookingData = {
          id: `BK-${Math.floor(100000 + Math.random() * 900000)}`,
          ten_khach_hang: this.newBooking.ten_khach_hang,
          phong: this.newBooking.phong,
          ngay_nhan_phong: this.newBooking.ngay_nhan_phong,
          ngay_tra_phong: this.newBooking.ngay_tra_phong,
          trang_thai: this.newBooking.trang_thai,
          tong_tien: parseInt(this.newBooking.tong_tien),
        };

        this.bookings.push(newBookingData);

        // Reset form
        this.newBooking = {
          ten_khach_hang: "",
          phong: "",
          ngay_nhan_phong: "",
          ngay_tra_phong: "",
          trang_thai: "Chờ xác nhận",
          tong_tien: 0,
        };

        // Đóng modal
        const modal = document.getElementById("exampleScrollableModal");
        modal.querySelector(".btn-close").click();
      },
      editBooking(booking) {
        this.editBookingData = {
          id: booking.id,
          ten_khach_hang: booking.ten_khach_hang,
          trang_thai: booking.trang_thai,
          ngay_nhan_phong: booking.ngay_nhan_phong,
        };
      },
      updateBooking() {
        if (
          !this.editBookingData.ten_khach_hang ||
          !this.editBookingData.ngay_nhan_phong
        ) {
          alert(
            "Vui lòng điền đầy đủ thông tin bắt buộc (Tên khách hàng, Ngày nhận phòng)!"
          );
          return;
        }

        const index = this.bookings.findIndex(
          (b) => b.id === this.editBookingData.id
        );
        if (index !== -1) {
          this.bookings[index] = {
            ...this.bookings[index],
            ten_khach_hang: this.editBookingData.ten_khach_hang,
            trang_thai: this.editBookingData.trang_thai,
            ngay_nhan_phong: this.editBookingData.ngay_nhan_phong,
          };
        }

        // Đóng modal
        const modal = document.getElementById("modalEditBooking");
        modal.querySelector(".btn-close").click();
      },
      deleteBooking(id) {
        if (confirm("Bạn có chắc muốn xóa booking này?")) {
          this.bookings = this.bookings.filter((b) => b.id !== id);
        }
      },
    },
  };
</script>

<style scoped>
  /* Tương tự RoomManagement.vue */
</style>