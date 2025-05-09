<template>
  <div class="container">
    <h6 class="m-2 pt-2">Quản lý phòng</h6>

    <div class="d-flex justify-content-between align-item-center mb-4">
      <div class="position-relative">
        <input
          type="text"
          class="form-control my-auto ps-5 radius-30"
          v-model="searchQuery"
          placeholder="Tìm phòng"
        />
        <span class="position-absolute top-50 product-show translate-middle-y">
          <i class="bx bx-search"></i>
        </span>
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
              <th>Tên phòng</th>
              <th>Homestay</th>
              <th>Mô tả</th>
              <th>Diện tích (m²)</th>
              <th>Giá (đêm)</th>
              <th>Tiện ích</th>
              <th>Sức chứa</th>
              <th>Số giường</th>
              <th>Tình trạng</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(value, index) in filteredPhong" :key="index">
              <tr class="align-middle">
                <td>
                  <div class="ms-2">
                    <h6 class="mb-0 font-14">{{ value.id }}</h6>
                  </div>
                </td>
                <td>
                  <a
                    class="btn text-primary"
                    @click="openImageModal(value)"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                  >
                    <i class="fa-solid fa-images"></i>
                  </a>
                </td>
                <td>{{ value.ten_phong }}</td>
                <td>{{ homestayMap[value.id_homestay] }}</td>
                <td
                  style="
                     /* Đảm bảo nội dung nằm trên cùng */
                     min-width: 300px;/* Giới hạn chiều rộng tối đa */
                
                    white-space: normal;
                  "
                >
                  {{ value.mo_ta }}
                </td>
                <td>{{ value.dien_tich }}</td>
                <td>{{ value.gia.toLocaleString("vi-VN") }}đ</td>
                <td><span v-html="value.tien_ich"></span></td>
                <td>{{ value.suc_chua }}</td>
                <td>{{ value.so_giuong }}</td>
                <td>
                  <span
                    v-if="value.trang_thai === 1"
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
                    Bảo trì
                  </span>
                </td>
                <td>
                  <div class="d-flex order-actions">
                    <button
                      class="btn"
                      @click="editPhong(value)"
                      data-bs-toggle="modal"
                      data-bs-target="#suaScrollableModal"
                    >
                      <i class="bx bxs-edit text-warning"></i>
                    </button>
                    <button
                      class="btn"
                      href="javascript:;"
                      data-bs-toggle="modal"
                      data-bs-target="#deleteModal"
                      @click="Object.assign(xoaPhong, value)"
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

  <!-- Modal Thêm phòng -->
  <div
    class="modal fade"
    id="exampleScrollableModal"
    tabindex="-1"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm Phòng Mới</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div>
            <label class="mt-2">Homestay</label>
            <select
              class="form-select"
              v-model="newPhong.id_homestay"
              aria-label="Chọn homestay"
            >
              <option value="" disabled>Chọn homestay</option>
              <option
                v-for="homestay in homestays"
                :key="homestay.id"
                :value="homestay.id"
              >
                {{ homestay.ten_homestay }}
              </option>
            </select>
            <label class="mt-2">Tên phòng</label>
            <input
              type="text"
              class="form-control"
              v-model="newPhong.ten_phong"
              placeholder="Nhập tên phòng"
            />
            <label class="mt-2">Mô tả</label>
            <textarea
              class="form-control"
              v-model="newPhong.mo_ta"
              placeholder="Nhập mô tả"
              rows="4"
            ></textarea>
            <label class="mt-2">Diện tích (m²)</label>
            <input
              type="number"
              step="0.1"
              class="form-control"
              v-model="newPhong.dien_tich"
              placeholder="Nhập diện tích"
            />
            <label class="mt-2">Giá (VND)</label>
            <input
              type="number"
              class="form-control"
              v-model="newPhong.gia"
              placeholder="Nhập giá"
            />
            <label class="mt-2">Tiện ích</label>
            <input
              type="text"
              class="form-control"
              v-model="newPhong.tien_ich"
              placeholder="Nhập tiện ích, ví dụ: Wi-Fi, Điều hòa"
            />
            <label class="mt-2">Sức chứa</label>
            <input
              type="number"
              class="form-control"
              v-model="newPhong.suc_chua"
              placeholder="Nhập sức chứa"
            />
            <label class="mt-2">Số giường</label>
            <input
              type="number"
              class="form-control"
              v-model="newPhong.so_giuong"
              placeholder="Nhập số giường"
            />
            <label class="mt-2">Trạng thái</label>
            <select
              class="form-select"
              v-model="newPhong.trang_thai"
              aria-label="Chọn trạng thái"
            >
              <option value="" disabled>Chọn trạng thái</option>
              <option value="1">Hoạt động</option>
              <option value="0">Bảo trì</option>
            </select>
            <div class="mb-4">
              <label class="mt-2">Ảnh</label>
              <div
                class="form-control d-flex align-items-center gap-1 p-2"
                style="min-height: 50px"
              >
                <div
                  v-for="(image, index) in newPhong.hinh_anhs"
                  :key="index"
                  class="position-relative me-2"
                >
                  <img
                    :src="image"
                    style="height: 80px; width: 80px; object-fit: cover"
                    alt="Preview"
                  />
                  <button
                    type="button"
                    class="btn-close btn-sm position-absolute top-0 end-0"
                    @click="newPhong.hinh_anhs.splice(index, 1)"
                    aria-label="Remove"
                  ></button>
                </div>
                <label style="cursor: pointer" class="ms-auto mb-1">
                  <i class="fas fa-upload me-1"></i> Chọn ảnh
                  <input
                    type="file"
                    accept="image/*"
                    @change="handleNewImages"
                    class="d-none"
                    multiple
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
          <button type="button" class="btn btn-primary" @click="addPhong">
            Thêm
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal xóa phòng -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white"><b>Xóa phòng</b></h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" role="alert">
            Bạn có chắc chắn muốn xóa <strong>{{ xoaPhong.ten_phong }}</strong
            >?
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
            type="button"
            class="btn btn-danger"
            v-on:click="deletePhong()"
            data-bs-dismiss="modal"
          >
            Xác nhận
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Sửa phòng -->
  <div
    class="modal fade"
    id="suaScrollableModal"
    tabindex="-1"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sửa Thông Tin Phòng</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div>
            <label class="mt-2">Homestay</label>
            <select
              class="form-select"
              v-model="selectedPhong.id_homestay"
              aria-label="Chọn homestay"
            >
              <option value="" disabled>Chọn homestay</option>
              <option
                v-for="homestay in homestays"
                :key="homestay.id"
                :value="homestay.id"
              >
                {{ homestay.ten_homestay }}
              </option>
            </select>
            <label class="mt-2">Tên phòng</label>
            <input
              type="text"
              class="form-control"
              v-model="selectedPhong.ten_phong"
              placeholder="Nhập tên phòng"
            />
            <label class="mt-2">Mô tả</label>
            <textarea
              class="form-control"
              v-model="selectedPhong.mo_ta"
              placeholder="Nhập mô tả"
              rows="4"
            ></textarea>
            <label class="mt-2">Diện tích (m²)</label>
            <input
              type="number"
              step="0.1"
              class="form-control"
              v-model="selectedPhong.dien_tich"
              placeholder="Nhập diện tích"
            />
            <label class="mt-2">Giá (VND)</label>
            <input
              type="number"
              class="form-control"
              v-model="selectedPhong.gia"
              placeholder="Nhập giá"
            />
            <label class="mt-2">Tiện ích</label>
            <input
              type="text"
              class="form-control"
              v-model="selectedPhong.tien_ich"
              placeholder="Nhập tiện ích, ví dụ: Wi-Fi, Điều hòa"
            />
            <label class="mt-2">Sức chứa</label>
            <input
              type="number"
              class="form-control"
              v-model="selectedPhong.suc_chua"
              placeholder="Nhập sức chứa"
            />
            <label class="mt-2">Số giường</label>
            <input
              type="number"
              class="form-control"
              v-model="selectedPhong.so_giuong"
              placeholder="Nhập số giường"
            />
            <label class="mt-2">Trạng thái</label>
            <select
              class="form-select"
              v-model="selectedPhong.trang_thai"
              aria-label="Chọn trạng thái"
            >
              <option value="" disabled>Chọn trạng thái</option>
              <option value="1">Hoạt động</option>
              <option value="0">Bảo trì</option>
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
            @click="savePhong"
          >
            Lưu
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Quản Lý Ảnh -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Quản Lý Ảnh Phòng: {{ currentPhong?.ten_phong }}
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div v-if="currentImages.length > 0" class="row">
            <div
              v-for="(image, index) in currentImages"
              :key="image.id"
              class="col-md-3 mb-3"
            >
              <div class="position-relative">
                <img
                  :src="backendBaseUrl + image.url"
                  style="height: 120px; width: 100%; object-fit: cover"
                  alt="Phòng"
                />
                <button
                  type="button"
                  class="btn-close btn-sm position-absolute top-0 end-0"
                  @click="deleteImage(image.id)"
                  aria-label="Remove"
                ></button>
              </div>
            </div>
          </div>
          <div v-else>
            <p>Chưa có ảnh nào cho phòng này.</p>
          </div>
          <div class="mt-3">
            <label style="cursor: pointer" class="btn btn-primary">
              <i class="fas fa-upload me-1"></i> Thêm Ảnh Mới
              <input
                type="file"
                accept="image/*"
                @change="handleAddImage"
                class="d-none"
                multiple
              />
            </label>
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import baseRequest from "../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
  position: "bottom-right",
  duration: 3000,
});

export default {
  name: "PhongManagement",
  data() {
    return {
      searchQuery: "",
      listPhong: [],
      homestays: [],
      homestayMap: {},
      backendBaseUrl: "http://127.0.0.1:8000",
      xoaPhong: {},
      selectedPhong: {
        id: null,
        id_homestay: "",
        ten_phong: "",
        mo_ta: "",
        dien_tich: "",
        gia: "",
        tien_ich: "",
        suc_chua: "",
        so_giuong: "",
        trang_thai: "",
      },
      newPhong: {
        id_homestay: "",
        ten_phong: "",
        mo_ta: "",
        dien_tich: "",
        gia: "",
        tien_ich: "",
        suc_chua: "",
        so_giuong: "",
        trang_thai: "",
        hinh_anhs: [],
      },
      currentPhong: null,
      currentImages: [],
    };
  },
  computed: {
    filteredPhong() {
      if (!this.searchQuery) {
        return this.listPhong;
      }
      const query = this.searchQuery.toLowerCase();
      return this.listPhong.filter(
        (phong) =>
          phong.ten_phong.toLowerCase().includes(query) ||
          this.homestayMap[phong.id_homestay]?.toLowerCase().includes(query)
      );
    },
  },
  mounted() {
    this.getHomestays();
    this.getPhong();
  },
  methods: {
    getHomestays() {
      baseRequest
        .get("/admin/homestay/data")
        .then((response) => {
          console.log("Homestays:", response.data);
          this.homestays = response.data;
          this.homestayMap = this.homestays.reduce((map, h) => {
            map[h.id] = h.ten_homestay;
            return map;
          }, {});
        })
        .catch((error) => {
          console.error("Lỗi khi lấy homestay:", error);
          alert(
            "Không thể lấy danh sách homestay: " +
              (error.response?.data?.message || "Lỗi không xác định")
          );
        });
    },
    getPhong() {
      baseRequest
        .get("/admin/phong/data")
        .then((response) => {
          console.log("Phòng:", response.data);
          this.listPhong = response.data;
        })
        .catch((error) => {
          console.error("Lỗi khi lấy danh sách phòng:", error);
          alert(
            "Không thể lấy danh sách phòng: " +
              (error.response?.data?.message || "Lỗi không xác định")
          );
        });
    },
    async uploadImage(file) {
      const formData = new FormData();
      formData.append("image", file);
      try {
        const response = await baseRequest.post(
          "/admin/tai-anh-len",
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        return response.data.url;
      } catch (error) {
        console.error("Lỗi khi tải ảnh lên:", error);

        throw error;
      }
    },
    async handleNewImages(event) {
      const files = Array.from(event.target.files);
      if (!files.length) return;
      try {
        for (const file of files) {
          const url = await this.uploadImage(file);
          this.newPhong.hinh_anhs.push(url);
        }
      } catch (error) {
        // Đã xử lý lỗi trong uploadImage
      }
    },
    async handleAddImage(event) {
      const files = Array.from(event.target.files);
      if (!files.length) return;
      try {
        for (const file of files) {
          const url = await this.uploadImage(file);
          const response = await baseRequest.post(
            `/admin/phong/${this.currentPhong.id}/add-image`,
            {
              hinh_anh: url,
            }
          );
          this.currentImages.push({
            id: response.data.id,
            url: response.data.url,
          });
          this.getPhong();
        }
      } catch (error) {
        console.error("Thêm ảnh thất bại:", error);
        toaster.error(
          "Thêm ảnh thất bại: " +
            (error.response?.data?.message || "Lỗi không xác định")
        );
      }
    },
    async deleteImage(imageId) {
      const confirmDelete = confirm("Bạn có chắc chắn muốn xóa ảnh này?");
      if (confirmDelete) {
        try {
          await baseRequest.delete(
            `/admin/phong/${this.currentPhong.id}/delete-image/${imageId}`
          );
          this.currentImages = this.currentImages.filter(
            (image) => image.id !== imageId
          );
          this.getPhong();
          toaster.success("Xóa ảnh thành công!");
        } catch (error) {
          console.error("Xóa ảnh thất bại:", error);
          toaster.error(
            "Xóa ảnh thất bại: " +
              (error.response?.data?.message || "Lỗi không xác định")
          );
        }
      }
    },
    async addPhong() {
      if (!this.newPhong.trang_thai) {
        toaster.warning("Vui lòng chọn trạng thái!");
        return;
      }
      if (!this.newPhong.hinh_anhs.length) {
        toaster.warning("Vui lòng chọn ít nhất một ảnh!");
        return;
      }
      try {
        const data = { ...this.newPhong };
        await baseRequest.post("/admin/phong/add", data);
        this.getPhong();
        this.newPhong = {
          id_homestay: "",
          ten_phong: "",
          mo_ta: "",
          dien_tich: "",
          gia: "",
          tien_ich: "",
          suc_chua: "",
          so_giuong: "",
          trang_thai: "",
          hinh_anhs: [],
        };
        
        toaster.success("Thêm phòng thành công!");
      } catch (error) {
        console.error("Thêm phòng thất bại:", error);
        const message = error.response?.data?.message || "Lỗi không xác định";
        const errors = error.response?.data?.errors
          ? Object.values(error.response.data.errors).flat().join(", ")
          : "";
        toaster.error(
          `Thêm phòng thất bại: ${message}${errors ? " - " + errors : ""}`
        );
      }
    },
    editPhong(phong) {
      this.selectedPhong = { ...phong };
    },
    async savePhong() {
      if (!this.selectedPhong.trang_thai) {
        toaster.warning("Vui lòng chọn trạng thái!");
        return;
      }
      try {
        const response = await baseRequest.post(
          `/admin/phong/update/${this.selectedPhong.id}`,
          this.selectedPhong
        );
        if (response.status === 200) {
          this.getPhong();
          this.selectedPhong = {
            id: null,
            id_homestay: "",
            ten_phong: "",
            mo_ta: "",
            dien_tich: "",
            gia: "",
            tien_ich: "",
            suc_chua: "",
            so_giuong: "",
            trang_thai: "",
          };

          toaster.success("Cập nhật phòng thành công!");
        } else {
          throw new Error("Cập nhật thất bại với status: " + response.status);
        }
      } catch (error) {
        console.error("Cập nhật phòng thất bại:", error);
        const message =
          error.response?.data?.message ||
          error.message ||
          "Lỗi không xác định";
        const errors = error.response?.data?.errors
          ? Object.values(error.response.data.errors).flat().join(", ")
          : "";
        toaster.error(
          `Cập nhật phòng thất bại: ${message}${errors ? " - " + errors : ""}`
        );
      }
    },
    deletePhong(id) {
      baseRequest
        .delete(`/admin/phong/destroy/` + this.xoaPhong.id)
        .then((response) => {
          this.getPhong();
          toaster.success("Xóa phòng thành công!");
        })
        .catch((error) => {
          console.error("Xóa phòng thất bại:", error);
          const message = error.response?.data?.message || "Lỗi không xác định";
          toaster.error("Xóa phòng thất bại: " + message);
        });
    },
    openImageModal(phong) {
      this.currentPhong = phong;
      this.currentImages = phong.hinh_anhs;
    },
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