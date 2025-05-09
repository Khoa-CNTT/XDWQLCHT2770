```vue
<template>
  <div class="container">
    <div class="d-flex justify-content-between mb-4">
      <div class="position-relative">
        <input
          class="form-control ps-5 radius-30"
          v-model="searchQuery"
          placeholder="Tìm khách hàng"
        />
        <span class="position-absolute top-50 product-show translate-middle-y"
          ><i class="bx bx-search"></i
        ></span>
      </div>
      <div class="d-flex">
        <button
          class="btn btn-primary radius-30 mt-lg-0 text-nowrap"
          data-bs-toggle="modal"
          data-bs-target="#exampleScrollableModal"
        >
          <i class="bx bxs-plus-square"></i> Thêm
        </button>
      </div>
    </div>
    <div class="card">
      <div class="table-responsive">
        <table class="table mb-0">
          <thead class="table-primary">
            <tr class="align-middle">
              <th>ID#</th>
              <th>Ảnh đại diện</th>
              <th>Tên khách hàng</th>
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Ngày sinh</th>
              <th>Giới tính</th>
              <th>Tình trạng</th>
              <th>Kích hoạt</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <template
              v-for="(customer, index) in filteredCustomers"
              :key="index"
            >
              <tr class="align-middle">
                <td>
                  <div class="ms-2">
                    <h6 class="mb-0 font-14">{{ customer.id }}</h6>
                  </div>
                </td>
                <td>
                  <img
                    :src="`${urlBackend}${customer.avatar}`"
                    style="height: 100px; width: 100px; object-fit: cover"
                    alt="Avatar"
                  />
                </td>
                <td>{{ customer.ho_ten }}</td>
                <td>{{ customer.email }}</td>
                <td>{{ customer.so_dien_thoai }}</td>
                <td>{{ formatDate(customer.ngay_sinh) }}</td>
                <td>
                  {{
                    customer.gioi_tinh === 1
                      ? "Nam"
                      : customer.gioi_tinh === 2
                      ? "Nữ"
                      : "Khác"
                  }}
                </td>

                <td>
                  <span
                    v-if="customer.is_block == 1"
                    class="badge rounded-pill text-danger bg-light-danger p-2"
                  >
                    <i class="bx bxs-circle me-1"></i> Đã khóa
                  </span>
                  <span
                    v-else
                    class="badge rounded-pill text-success bg-light-success p-2"
                  >
                    <i class="bx bxs-circle me-1"></i> Hoạt động
                  </span>
                </td>
                <td>
                  <span
                    v-if="customer.is_active == 1"
                    class="badge rounded-pill text-success bg-light-success p-2"
                  >
                    <i class="bx bxs-circle me-1"></i> Đã kích hoạt
                  </span>
                  <span
                    v-else
                    @click="kichhoat(customer)"
                    class="badge rounded-pill text-danger bg-light-danger p-2"
                  >
                    <i class="bx bxs-circle me-1"></i> Chưa kích hoạt
                  </span>
                </td>
                <td>
                  <div class="d-flex order-actions">
                    <a
                      @click="editCustomer(customer)"
                      data-bs-toggle="modal"
                      data-bs-target="#suaScrollableModal"
                      class=""
                    >
                      <i class="bx bxs-edit"></i>
                    </a>
                    <a
                      href="javascript:;"
                      class="ms-3"
                      @click="Object.assign(xoaNguoiDung, customer)"
                      data-bs-toggle="modal"
                      data-bs-target="#xoaModal"
                    >
                      <i class="bx bxs-trash"></i>
                    </a>
                  </div>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Thêm khách hàng -->
  <div
    class="modal fade"
    id="exampleScrollableModal"
    tabindex="-1"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm khách hàng mới</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div>
            <label class="mt-2">Tên khách hàng</label>
            <input
              type="text"
              class="form-control"
              v-model="newCustomer.ho_ten"
              placeholder="Nhập tên khách hàng"
            />
            <label class="mt-2">Email</label>
            <input
              type="email"
              class="form-control"
              v-model="newCustomer.email"
              placeholder="Nhập email"
            />
            <label class="mt-2">Số điện thoại</label>
            <input
              type="text"
              class="form-control"
              v-model="newCustomer.so_dien_thoai"
              placeholder="Nhập số điện thoại"
            />
            <label class="mt-2">Ngày sinh</label>
            <input
              type="date"
              class="form-control"
              v-model="newCustomer.ngay_sinh"
            />
            <label class="mt-2">Giới tính</label>
            <select class="form-select" v-model="newCustomer.gioi_tinh">
              <option value="" disabled>Chọn giới tính</option>
              <option value="1">Nam</option>
              <option value="2">Nữ</option>
              <option value="0">Khác</option>
            </select>
            <label class="mt-2">Mật khẩu</label>
            <input
              type="password"
              class="form-control"
              v-model="newCustomer.mat_khau"
              placeholder="Nhập mật khẩu"
            />
            <label class="mt-2">Ảnh đại diện</label>
            <input
              type="file"
              class="form-control"
              accept="image/*"
              @change="handleImageChange($event, 'new')"
            />
            <img
              v-if="newImagePreview"
              :src="newImagePreview"
              alt="Preview"
              style="
                width: 100px;
                height: 100px;
                object-fit: cover;
                margin-top: 10px;
              "
            />
            <label class="mt-2">Tình trạng</label>
            <select class="form-select" v-model="newCustomer.is_block">
              <option value="" disabled>Chọn tình trạng</option>
              <option value="0">Hoạt động</option>
              <option value="1">Khóa</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Thoát
          </button>
          <button type="button" class="btn btn-primary" @click="addCustomer">
            Thêm
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal xóa người dùng -->
  <div
    class="modal fade"
    id="xoaModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
            Xóa người dùng
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div
            class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2"
          >
            <div class="d-flex align-items-center">
              <div class="font-35 text-white">
                <i class="bx bxs-message-square-x"></i>
              </div>
              <div class="ms-3">
                <div class="text-white">
                  Bạn có chắc chắc chắn muốn xóa bài viết
                  <b>{{ xoaNguoiDung.ho_ten }}</b> này không?
                </div>
                <div class="text-white">
                  <b>Lưu ý:</b>Điều này không thể hoàn tác!!
                </div>
              </div>
            </div>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Đóng
          </button>
          <button
            @click="xoa()"
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
          >
            Xóa
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Sửa khách hàng -->
  <div
    class="modal fade"
    id="suaScrollableModal"
    tabindex="-1"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sửa thông tin khách hàng</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div>
            <label class="mt-2">Tên khách hàng</label>
            <input
              type="text"
              class="form-control"
              v-model="selectedCustomer.ho_ten"
              placeholder="Nhập tên khách hàng"
            />
            <label class="mt-2">Email</label>
            <input
              type="email"
              class="form-control"
              v-model="selectedCustomer.email"
              placeholder="Nhập email"
            />
            <label class="mt-2">Số điện thoại</label>
            <input
              type="text"
              class="form-control"
              v-model="selectedCustomer.so_dien_thoai"
              placeholder="Nhập số điện thoại"
            />
            <label class="mt-2">Ngày sinh</label>
            <input
              type="date"
              class="form-control"
              v-model="selectedCustomer.ngay_sinh"
            />
            <label class="mt-2">Giới tính</label>
            <select class="form-select" v-model="selectedCustomer.gioi_tinh">
              <option value="" disabled>Chọn giới tính</option>
              <option value="1">Nam</option>
              <option value="2">Nữ</option>
              <option value="0">Khác</option>
            </select>
            <label class="mt-2">Mật khẩu (để trống nếu không thay đổi)</label>
            <input
              type="password"
              class="form-control"
              v-model="selectedCustomer.mat_khau"
              placeholder="Nhập mật khẩu mới"
            />
            <label class="mt-2">Ảnh đại diện</label>
            <input
              type="file"
              class="form-control"
              accept="image/*"
              @change="handleImageChange($event, 'edit')"
            />
            <img
              v-if="editImagePreview || selectedCustomer.avatar"
              :src="editImagePreview || selectedCustomer.avatar"
              alt="Preview"
              style="
                width: 100px;
                height: 100px;
                object-fit: cover;
                margin-top: 10px;
              "
            />
            <label class="mt-2">Tình trạng</label>
            <select class="form-select" v-model="selectedCustomer.is_block">
              <option value="" disabled>Chọn tình trạng</option>
              <option value="0">Hoạt động</option>
              <option value="1">Khóa</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Thoát
          </button>
          <button
            type="button"
            class="btn btn-primary"
            data-bs-dismiss="modal"
            @click="saveCustomer"
          >
            Lưu
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import baseRequest from "../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ positions: "bottom-right", duration: 3000 });
export default {
  name: "QuanLyKhachHang",
  data() {
    return {
      searchQuery: "",
      xoaNguoiDung: {},
      listCustomers: [],
      urlimage: "",
      selectedCustomer: {
        id: null,
        ho_ten: "",
        email: "",
        so_dien_thoai: "",
        ngay_sinh: "",
        gioi_tinh: "",
        mat_khau: "",
        avatar: null,
        is_active: "",
        is_block: "",
      },
      newCustomer: {
        ho_ten: "",
        email: "",
        so_dien_thoai: "",
        ngay_sinh: "",
        gioi_tinh: "",
        mat_khau: "",
        avatar: null,
        is_active: "",
        is_block: "",
      },
      newImagePreview: null,
      editImagePreview: null,
      urlBackend: "http://127.0.0.1:8000",
    };
  },
  computed: {
    filteredCustomers() {
      if (!this.searchQuery) {
        return this.listCustomers;
      }
      const query = this.searchQuery.toLowerCase();
      return this.listCustomers.filter(
        (customer) =>
          customer.ho_ten.toLowerCase().includes(query) ||
          customer.email.toLowerCase().includes(query) ||
          customer.so_dien_thoai.toLowerCase().includes(query)
      );
    },
  },
  methods: {
    async layDanhSachKhachHang() {
      try {
        const response = await baseRequest.get(
          "admin/khach_hangs/lay-danh-sach"
        );
        this.listCustomers = response.data.du_lieu;
      } catch (error) {
        const thongBao =
          error.response?.data?.thong_bao ||
          error.message ||
          "Lỗi không xác định";
        toaster.error(thongBao);
        console.error("Lỗi khi tải danh sách khách hàng:", error);
      }
    },
    handleImageChange(event, type) {
      const file = event.target.files[0];
      if (file) {
        if (type === "new") {
          this.newCustomer.avatar = file;
          this.newImagePreview = URL.createObjectURL(file);
        } else {
          this.selectedCustomer.avatar = file;
          this.editImagePreview = URL.createObjectURL(file);
        }
      }
    },

    async addCustomer() {
      if (
        !this.newCustomer.ho_ten ||
        !this.newCustomer.email ||
        !this.newCustomer.so_dien_thoai ||
        !this.newCustomer.ngay_sinh ||
        !this.newCustomer.gioi_tinh ||
        !this.newCustomer.mat_khau ||
        !this.newCustomer.is_block
      ) {
        toaster.error("Vui lòng nhập đầy đủ thông tin!");
        return;
      }
      try {
        const formData = new FormData();
        formData.append("ho_ten", this.newCustomer.ho_ten);
        formData.append("email", this.newCustomer.email);
        formData.append("so_dien_thoai", this.newCustomer.so_dien_thoai);
        formData.append("ngay_sinh", this.newCustomer.ngay_sinh);
        formData.append("gioi_tinh", this.newCustomer.gioi_tinh);
        formData.append("mat_khau", this.newCustomer.mat_khau);
        formData.append("is_active", 1);
        formData.append("is_block", this.newCustomer.is_block || 0);
        if (this.newCustomer.avatar instanceof File) {
          formData.append("avatar", this.newCustomer.avatar);
        }

        const response = await baseRequest.post(
          "admin/khach_hangs/them-moi",
          formData
        );

        this.listCustomers.push(response.data.du_lieu);
        this.newCustomer = {
          ho_ten: "",
          email: "",
          so_dien_thoai: "",
          ngay_sinh: "",
          gioi_tinh: "",
          mat_khau: "",
          avatar: null,
          is_active: "",
          is_block: "",
        };
        this.newImagePreview = null;
        const modal = document.getElementById("exampleScrollableModal");
        if (modal) {
          const bootstrapModal = bootstrap.Modal.getInstance(modal);
          bootstrapModal.hide();
        }
        toaster.success("Thêm khách hàng thành công!");
      } catch (error) {
        const thongBao =
          error.response?.data?.thong_bao ||
          error.message ||
          "Lỗi không xác định";
        const loi = error.response?.data?.loi
          ? Object.values(error.response.data.loi).flat().join(", ")
          : "";
        toaster.error(
          `Thêm khách hàng thất bại: ${thongBao}${loi ? " - " + loi : ""}`
        );
        console.error("Lỗi khi thêm khách hàng:", error);
      }
    },
    editCustomer(customer) {
      this.selectedCustomer = { ...customer, mat_khau: "" }; // Không load mật khẩu cũ
      this.urlimage = "'${urlBackend}${selectedCustomer.avatar}`";
      this.editImagePreview = null;
    },
    async saveCustomer() {
      if (
        !this.selectedCustomer.ho_ten ||
        !this.selectedCustomer.email ||
        !this.selectedCustomer.so_dien_thoai ||
        !this.selectedCustomer.ngay_sinh ||
        !this.selectedCustomer.gioi_tinh ||
        !this.selectedCustomer.is_active
      ) {
        toaster.error("Vui lòng nhập đầy đủ thông tin!");
        return;
      }
      try {
        const formData = new FormData();
        formData.append("id", this.selectedCustomer.id);
        formData.append("ho_ten", this.selectedCustomer.ho_ten);
        formData.append("email", this.selectedCustomer.email);
        formData.append("so_dien_thoai", this.selectedCustomer.so_dien_thoai);
        formData.append("ngay_sinh", this.selectedCustomer.ngay_sinh);
        formData.append("gioi_tinh", this.selectedCustomer.gioi_tinh);
        if (this.selectedCustomer.mat_khau) {
          formData.append("mat_khau", this.selectedCustomer.mat_khau);
        }
        formData.append("is_active", this.selectedCustomer.is_active);
        formData.append("is_block", this.selectedCustomer.is_block || 0);
        if (this.selectedCustomer.avatar instanceof File) {
          formData.append("avatar", this.selectedCustomer.avatar);
        }

        const response = await baseRequest.post(
          "admin/khach_hangs/cap-nhat",
          formData
        );

        const index = this.listCustomers.findIndex(
          (c) => c.id === this.selectedCustomer.id
        );
        if (index !== -1) {
          this.listCustomers.splice(index, 1, response.data.du_lieu);
        }
        this.selectedCustomer = {
          id: null,
          ho_ten: "",
          email: "",
          so_dien_thoai: "",
          ngay_sinh: "",
          gioi_tinh: "",
          mat_khau: "",
          avatar: null,
          is_active: "",
          is_block: "",
        };
        this.editImagePreview = null;

        toaster.success("Cập nhật khách hàng thành công!");
      } catch (error) {
        const thongBao =
          error.response?.data?.thong_bao ||
          error.message ||
          "Lỗi không xác định";
        const loi = error.response?.data?.loi
          ? Object.values(error.response.data.loi).flat().join(", ")
          : "";
        alert(
          `Cập nhật khách hàng thất bại: ${thongBao}${loi ? " - " + loi : ""}`
        );
        console.error("Lỗi khi cập nhật khách hàng:", error);
      }
    },
   xoa(){
    baseRequest
    .post("admin/khach_hangs/xoa",this.xoaNguoiDung)
    .then((response) => {
      const index = this.listCustomers.findIndex(
        (c) => c.id === this.xoaNguoiDung.id
      );
      toaster.success("Xóa khách hàng thành công!");
      this.layDanhSachKhachHang();
      this.xoaNguoiDung = [];
    })
    .catch((error) => {
      const thongBao =
        error.response?.data?.thong_bao ||
        error.message ||
        "Lỗi không xác định";
      const loi = error.response?.data?.loi
        ? Object.values(error.response.data.loi).flat().join(", ")
        : "";
      toaster.error(
        `Xóa khách hàng thất bại: ${thongBao}${loi ? " - " + loi : ""}`
      );
      console.error("Lỗi khi xóa khách hàng:", error);
    });
   },
    formatDate(date) {
      const d = new Date(date);
      return `${d.getDate().toString().padStart(2, "0")}/${(d.getMonth() + 1)
        .toString()
        .padStart(2, "0")}/${d.getFullYear()}`;
    },
  },
  mounted() {
    this.layDanhSachKhachHang();
  },
};
</script>

<style scoped>
.bg-light-success {
  background-color: #d4edda;
}
.text-success {
  color: #28a745;
}
.bg-light-danger {
  background-color: #f8d7da;
}
.text-danger {
  color: #dc3545;
}
.position-relative .form-control {
  border: 1px solid #d1e7ff;
  border-radius: 30px;
  padding-left: 40px;
}
.position-relative .bx-search {
  color: #6c757d;
  font-size: 18px;
}
</style>
```