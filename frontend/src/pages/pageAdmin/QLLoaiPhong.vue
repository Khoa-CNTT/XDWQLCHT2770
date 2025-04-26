<template>
  <div>
    <!-- Nút Thêm -->
    <div class="mb-3 text-end">
      <button class="btn btn-primary" @click="openAddModal">
        <i class="bx bxs-plus-square"></i> Thêm loại phòng
      </button>
    </div>

    <!-- Bảng loại phòng -->
    <div class="table-responsive">
      <table class="table mb-0">
        <thead class="table-light">
          <tr>
            <th>ID#</th>
            <th>Tên loại phòng</th>
            <th>Sức chứa</th>
            <th>Số giường</th>
            <th>Mô tả</th>
            <th>Tiện ích</th>
            <th>Tình trạng</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="(value, index) in listLoaiPhong" :key="value.id">
            <tr>
              <td><h6 class="mb-0 font-14">{{ value.id }}</h6></td>
              <td>{{ value.tenLoaiPhong }}</td>
              <td>{{ value.sucChua }}</td>
              <td>{{ value.soGiuong }}</td>
              <td>{{ value.moTa }}</td>
              <td v-html="value.tienIch"></td>
              <td>
                <div
                  v-if="value.tinhTrang === 1"
                  class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                >
                  <i class="bx bxs-circle me-1"></i>Hoạt động
                </div>
                <div
                  v-else
                  class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"
                >
                  <i class="bx bxs-circle me-1"></i>Tạm ngưng
                </div>
              </td>
              <td>
                <div class="d-flex order-actions">
                  <a href="javascript:;" @click="openEditModal(index)">
                    <i class="bx bxs-edit"></i>
                  </a>
                  <a href="javascript:;" class="ms-3" @click="deleteLoaiPhong(index)">
                    <i class="bx bxs-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>

    <!-- Modal Thêm/Sửa -->
    <div class="modal fade" id="modalLoaiPhong" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isEdit ? 'Chỉnh sửa loại phòng' : 'Thêm loại phòng' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Tên loại phòng</label>
              <input v-model="form.tenLoaiPhong" type="text" class="form-control" />
            </div>
            <div class="mb-3">
              <label class="form-label">Sức chứa</label>
              <input v-model.number="form.sucChua" type="number" class="form-control" />
            </div>
            <div class="mb-3">
              <label class="form-label">Số giường</label>
              <input v-model.number="form.soGiuong" type="number" class="form-control" />
            </div>
            <div class="mb-3">
              <label class="form-label">Mô tả</label>
              <textarea v-model="form.moTa" class="form-control"></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Tiện ích (HTML)</label>
              <textarea v-model="form.tienIch" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Tình trạng</label>
              <select v-model="form.tinhTrang" class="form-select">
                <option :value="1">Hoạt động</option>
                <option :value="0">Tạm ngưng</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" @click="saveLoaiPhong">
              {{ isEdit ? 'Cập nhật' : 'Thêm mới' }}
            </button>
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
      isEdit: false,
      editIndex: null,
      form: {
        id: null,
        tenLoaiPhong: '',
        sucChua: 1,
        soGiuong: 1,
        moTa: '',
        tienIch: '',
        tinhTrang: 1,
      },
      listLoaiPhong: [
        {
          id: 1,
          tenLoaiPhong: "Muse room",
          sucChua: 2,
          soGiuong: 1,
          tienIch: `
            <span class="me-3"><i class="fa-solid fa-tv"></i> TV</span>
            <span class="me-3"><i class="fa-solid fa-film"></i> Netflix</span>
            <span class="me-3"><i class="fa-solid fa-kitchen-set"></i> Bếp</span>
            <span class="me-3"><i class="fa-solid fa-shower"></i> WC in room</span>
            <span><i class="fa-solid fa-snowflake"></i> Điều hòa</span>`,
          moTa: "Phòng đơn với đầy đủ tiện nghi",
          tinhTrang: 1,
        },
        {
          id: 2,
          tenLoaiPhong: "Phòng đôi",
          sucChua: 4,
          soGiuong: 2,
          tienIch: `
            <span class="me-3"><i class="fa-solid fa-tv"></i> TV</span>
            <span class="me-3"><i class="fa-solid fa-film"></i> Netflix</span>
            <span class="me-3"><i class="fa-solid fa-kitchen-set"></i> Bếp</span>
            <span class="me-3"><i class="fa-solid fa-shower"></i> WC in room</span>
            <span><i class="fa-solid fa-snowflake"></i> Điều hòa</span>`,
          moTa: "Phòng đôi với đầy đủ tiện nghi",
          tinhTrang: 1,
        },
      ],
    };
  },
  methods: {
    openAddModal() {
      this.isEdit = false;
      this.form = {
        id: null,
        tenLoaiPhong: '',
        sucChua: 1,
        soGiuong: 1,
        moTa: '',
        tienIch: '',
        tinhTrang: 1,
      };
      new bootstrap.Modal(document.getElementById('modalLoaiPhong')).show();
    },
    openEditModal(index) {
      this.isEdit = true;
      this.editIndex = index;
      this.form = { ...this.listLoaiPhong[index] };
      new bootstrap.Modal(document.getElementById('modalLoaiPhong')).show();
    },
    saveLoaiPhong() {
      if (this.isEdit) {
        this.listLoaiPhong[this.editIndex] = { ...this.form };
      } else {
        this.form.id = Date.now(); // ID tạm thời
        this.listLoaiPhong.push({ ...this.form });
      }
      bootstrap.Modal.getInstance(document.getElementById('modalLoaiPhong')).hide();
    },
    deleteLoaiPhong(index) {
      if (confirm("Bạn có chắc chắn muốn xóa loại phòng này?")) {
        this.listLoaiPhong.splice(index, 1);
      }
    },
  },
};
</script>

<style scoped>
.table th,
.table td {
  vertical-align: middle;
}
.order-actions i {
  cursor: pointer;
  font-size: 20px;
}
</style>
