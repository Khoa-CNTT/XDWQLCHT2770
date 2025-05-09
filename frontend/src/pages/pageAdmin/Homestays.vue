<template>
  <div class="container">
    <h6 class="m-2 pt-2">Quản lý Homestay</h6>

    <div class="d-flex justify-content-between align-item-center mb-4">
      <div class="position-relative">
        <input
          type="text"
          class="form-control my-auto ps-5 radius-30"
          v-model="searchQuery"
          placeholder="Tìm homestay"
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
        <table class="table table-hover mb-0">
          <thead class="table-primary">
            <tr class="align-middle">
              <th>ID#</th>
              <th>Ảnh</th>
              <th>Tên homestay</th>
              <th>Địa chỉ</th>
              <th>Mô tả</th>
              <th>Tiện ích</th>
              <th>Tình trạng</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(value, index) in filteredHomestays" :key="index">
              <tr class="align-middle">
                <td>
                  <div class="ms-2">
                    <h6 class="mb-0 font-14">{{ value.id }}</h6>
                  </div>
                </td>
                <td>
                  <img
                    :src="value.fullImageUrl"
                    class=""
                    style="height: 100px; width: 100px; object-fit: cover"
                    alt="Homestay"
                  />
                </td>
                <td>{{ value.ten_homestay }}</td>
                <td style="white-space: normal;">{{ value.dia_chi }}</td>
                <td
                  style="
                     min-width: 300px;/* Giới hạn chiều rộng tối đa */
                
                    white-space: normal; /* Ngăn giữ nguyên một dòng */
                    
                  "
                >
                  {{ value.mo_ta }}
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span v-html="value.tien_ich || ''"></span>
                  </div>
                </td>
                <td>
                  <span
                    v-if="value.tinh_trang === 1"
                    class="badge rounded-pill text-success bg-light-success p-2"
                  >
                    <i class="bx bxs-circle me-1"></i>
                    Hoạt động
                  </span>
                  <span
                    v-else
                    class="badge rounded-pill text-danger bg-light-danger p-2"
                  >
                    <i class="bx bxs-circle me-1"></i>
                    Ngưng hoạt động
                  </span>
                </td>
                <td>
                  <div class="d-flex order-actions">
                    <button
                      class="btn"
                      @click="editHomestay(value)"
                      data-bs-toggle="modal"
                      data-bs-target="#suaScrollableModal"
                    >
                      <i class="bx bxs-edit text-warning"></i>
                    </button>
                    <button
                      class="btn"
                      href="javascript:;"
                      data-bs-toggle="modal" data-bs-target="#deleteModal"
                      @click="Object.assign(xoaHomestay, value)"
                    >
                      <i class="bx bxs-trash text-danger"></i>
                    </button>
                  </div>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Modal Thêm homestay -->
  <div
    class="modal fade"
    id="exampleScrollableModal"
    tabindex="-1"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm Homestay Mới</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div>
            <label class="mt-2">Tên homestay</label>
            <input
              type="text"
              class="form-control"
              v-model="newHomestay.ten_homestay"
              placeholder="Nhập tên homestay"
            />
            <label class="mt-2">Địa chỉ</label>
            <input
              type="text"
              class="form-control"
              v-model="newHomestay.dia_chi"
              placeholder="Nhập địa chỉ"
            />
            <label class="mt-2">Mô tả</label>
            <textarea
              class="form-control"
              v-model="newHomestay.mo_ta"
              placeholder="Nhập mô tả"
              rows="4"
            ></textarea>
            <label class="mt-2">Tiện ích (HTML)</label>
            <textarea
              class="form-control"
              v-model="newHomestay.tien_ich"
              placeholder="Nhập tiện ích dưới dạng HTML, ví dụ: <ul><li>Wifi</li><li>Bãi đỗ xe</li></ul>"
              rows="6"
            ></textarea>
            <label class="mt-2">Tình trạng</label>
            <select
              class="form-select"
              v-model="newHomestay.tinh_trang"
              aria-label="Chọn tình trạng"
            >
              <option value="" disabled>Chọn tình trạng</option>
              <option value="1">Hoạt động</option>
              <option value="0">Ngưng hoạt động</option>
            </select>
            <div class="mb-4">
              <label class="mt-2">Thêm ảnh</label>
              <div
                class="form-control d-flex flex-wrap align-items-center gap-1"
                style="min-height: 50px"
              >
                <span
                  v-if="mainImageSet"
                  class="badge bg-primary d-flex align-items-center"
                  style="padding-right: 0.5rem"
                >
                  {{ mainImageName }}
                  <button
                    type="button"
                    class="btn-close btn-close-white btn-sm ms-2"
                    @click="removeMainImage"
                    aria-label="Remove"
                  ></button>
                </span>
                <label style="cursor: pointer" class="ms-auto mb-1">
                  <i class="fas fa-upload me-1"></i> Chọn ảnh
                  <input
                    type="file"
                    accept="image/*"
                    @change="handleMainImage"
                    class="d-none"
                  />
                </label>
              </div>
            </div>
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
            @click="addHomestay"
          >
            Thêm
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Sửa homestay -->
  <div
    class="modal fade"
    id="suaScrollableModal"
    tabindex="-1"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sửa Thông Tin Homestay</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div>
            <label class="mt-2">Tên homestay</label>
            <input
              type="text"
              class="form-control"
              v-model="selectedHomestay.ten_homestay"
              placeholder="Nhập tên homestay"
            />
            <label class="mt-2">Địa chỉ</label>
            <input
              type="text"
              class="form-control"
              v-model="selectedHomestay.dia_chi"
              placeholder="Nhập địa chỉ"
            />
            <label class="mt-2">Mô tả</label>
            <textarea
              class="form-control"
              v-model="selectedHomestay.mo_ta"
              placeholder="Nhập mô tả"
              rows="4"
            ></textarea>
            <label class="mt-2">Tiện ích (HTML)</label>
            <textarea
              class="form-control"
              v-model="selectedHomestay.tien_ich"
              placeholder="Nhập tiện ích dưới dạng HTML, ví dụ: <ul><li>Wifi</li><li>Bãi đỗ xe</li></ul>"
              rows="6"
            ></textarea>
            <label class="mt-2">Tình trạng</label>
            <select
              class="form-select"
              v-model="selectedHomestay.tinh_trang"
              aria-label="Chọn tình trạng"
            >
              <option value="" disabled>Chọn tình trạng</option>
              <option value="1">Hoạt động</option>
              <option value="0">Ngưng hoạt động</option>
            </select>
            <div class="mb-4">
              <label class="mt-2">Thêm ảnh</label>
              <div
                class="form-control d-flex flex-wrap align-items-center gap-1"
                style="min-height: 50px"
              >
                <span
                  v-if="mainImageSet"
                  class="badge bg-primary d-flex align-items-center"
                  style="padding-right: 0.5rem"
                >
                  {{ mainImageName }}
                  <button
                    type="button"
                    class="btn-close btn-close-white btn-sm ms-2"
                    @click="removeMainImage"
                    aria-label="Remove"
                  ></button>
                </span>
                <label style="cursor: pointer" class="ms-auto mb-1">
                  <i class="fas fa-upload me-1"></i> Chọn ảnh
                  <input
                    type="file"
                    accept="image/*"
                    @change="handleMainImage"
                    class="d-none"
                  />
                </label>
              </div>
            </div>
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
            @click="saveHomestay"
          >
            Lưu
          </button>
        </div>
      </div>
    </div>
  </div>
   <!-- Modal Xóa -->
   <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white"><b>Xóa homestay</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        Bạn có chắc chắn muốn xóa <strong>{{xoaHomestay.ten_homestay }}</strong>?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" v-on:click="xoa()" data-bs-dismiss="modal">Xác
                        nhận</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import baseRequest from "../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "bottom-right", duration: 3000 });
export default {
  name: "HomestayManagement",
  data() {
    return {
      searchQuery: "",
      mainImage: null,
      mainImageName: "",
      mainImageSet: false,
      listHomestay: [],
      backendBaseUrl: "http://127.0.0.1:8000/storage/", // Base URL cho backend
      selectedHomestay: {
        id: null,
        ten_homestay: "",
        dia_chi: "",
        mo_ta: "",
        tinh_trang: "",
        tien_ich: "",
        anh_chinh: "",
        fullImageUrl: "",
      },
      xoaHomestay:{},
      newHomestay: {
        ten_homestay: "",
        dia_chi: "",
        mo_ta: "",
        tinh_trang: "",
        tien_ich: "",
        anh_chinh: null,
      },
    };
  },
  computed: {
    filteredHomestays() {
      if (!this.searchQuery) {
        return this.listHomestay;
      }
      const query = this.searchQuery.toLowerCase();
      return this.listHomestay.filter(
        (homestay) =>
          homestay.ten_homestay.toLowerCase().includes(query) ||
          homestay.dia_chi.toLowerCase().includes(query)
      );
    },
  },
  mounted() {
    this.getHomestay();
  },
  methods: {
    getHomestay() {
      baseRequest
        .get("/admin/homestay/data")
        .then((response) => {
          this.listHomestay = response.data.map((homestay) => ({
            ...homestay,
            fullImageUrl: homestay.anh_chinh
              ? `${this.backendBaseUrl}${homestay.anh_chinh}`
              : "",
          }));
        })
        .catch((error) => {
          console.error("Lỗi khi lấy danh sách homestay:", error);
          toaster.error(
            "Lỗi khi lấy danh sách homestay: " +
              (error.response?.data?.message || "Lỗi không xác định")
          );
        });
    },
    handleMainImage(event) {
      const file = event.target.files[0];
      if (file) {
        this.mainImage = file;
        this.mainImageName = file.name;
        this.mainImageSet = true;
        const imageUrl = URL.createObjectURL(file);
        if (this.selectedHomestay.id) {
          this.selectedHomestay.anh_chinh = imageUrl;
          this.selectedHomestay.fullImageUrl = imageUrl;
        } else {
          this.newHomestay.anh_chinh = imageUrl;
        }
      }
    },
    removeMainImage() {
      this.mainImage = null;
      this.mainImageName = "";
      this.mainImageSet = false;
      if (this.selectedHomestay.id) {
        this.selectedHomestay.anh_chinh = "";
        this.selectedHomestay.fullImageUrl = "";
      } else {
        this.newHomestay.anh_chinh = "";
      }
    },
    addHomestay() {
      if (!this.newHomestay.tinh_trang) {
        alert("Vui lòng chọn tình trạng!");
        return;
      }
      const formData = new FormData();
      formData.append("ten_homestay", this.newHomestay.ten_homestay);
      formData.append("dia_chi", this.newHomestay.dia_chi);
      formData.append("mo_ta", this.newHomestay.mo_ta);
      formData.append("tinh_trang", this.newHomestay.tinh_trang);
      formData.append("tien_ich", this.newHomestay.tien_ich || "");
      if (this.mainImage) {
        formData.append("image", this.mainImage);
      }

      baseRequest
        .post("/admin/homestay/store", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.getHomestay();
          this.newHomestay = {
            ten_homestay: "",
            dia_chi: "",
            mo_ta: "",
            tinh_trang: "",
            tien_ich: "",
            anh_chinh: null,
          };
          this.mainImage = null;
          this.mainImageName = "";
          this.mainImageSet = false;

          toaster.success("Thêm homestay thành công");
        })
        .catch((error) => {
          console.error("Thêm homestay thất bại:", error);
          const message = error.response?.data?.message || "Lỗi không xác định";
          const errors = error.response?.data?.errors
            ? Object.values(error.response.data.errors).flat().join(", ")
            : "";
          toaster.error(
            "Thêm homestay thất bại: " +
              message +
              (errors ? " - " + errors : "")
          );
        });
    },
    editHomestay(homestay) {
      this.selectedHomestay = { ...homestay };
      this.mainImageSet = !!homestay.anh_chinh;
      this.mainImageName = homestay.anh_chinh ? "Hình ảnh hiện tại" : "";
      this.mainImage = null;
    },
    saveHomestay() {
      if (!this.selectedHomestay.tinh_trang) {
        alert("Vui lòng chọn tình trạng!");
        return;
      }
      const formData = new FormData();
      formData.append("id", this.selectedHomestay.id);
      formData.append("ten_homestay", this.selectedHomestay.ten_homestay);
      formData.append("dia_chi", this.selectedHomestay.dia_chi);
      formData.append("mo_ta", this.selectedHomestay.mo_ta);
      formData.append("tinh_trang", this.selectedHomestay.tinh_trang);
      formData.append("tien_ich", this.selectedHomestay.tien_ich || "");
      if (this.mainImage) {
        formData.append("image", this.mainImage);
      }

      baseRequest
        .post("/admin/homestay/update", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.getHomestay();
          this.selectedHomestay = {
            id: null,
            ten_homestay: "",
            dia_chi: "",
            mo_ta: "",
            tinh_trang: "",
            tien_ich: "",
            anh_chinh: "",
            fullImageUrl: "",
          };
          this.mainImage = null;
          this.mainImageName = "";
          this.mainImageSet = false;
          toaster.success("Cập nhật homestay thành công");
        })
        .catch((error) => {
          console.error("Cập nhật homestay thất bại:", error);
          const message = error.response?.data?.message || "Lỗi không xác định";
          const errors = error.response?.data?.errors
            ? Object.values(error.response.data.errors).flat().join(", ")
            : "";
          alert(
            `Cập nhật homestay thất bại: ${message}${
              errors ? " - " + errors : ""
            }`
          );
        });
    },
    xoa() {
        baseRequest
          .post("/admin/homestay/delete/" + this.xoaHomestay.id)
          .then((response) => {
            this.getHomestay();
            toaster.success("Xóa homestay thành công");
          })
          .catch((error) => {
            console.error("Xóa homestay thất bại:", error);
            const message =
              error.response?.data?.message || "Lỗi không xác định";
            toaster.error(
              "Xóa homestay thất bại: " +
                message +
                (error.response?.data?.errors
                  ? " - " + error.response.data.errors.join(", ")
                  : "")
            );

          });
      }
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