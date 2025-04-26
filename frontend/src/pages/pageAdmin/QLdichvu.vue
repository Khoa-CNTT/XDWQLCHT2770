<template>
    <div class="container mt-3">
      <h4 class="mb-3">Quản lý dịch vụ</h4>
      <div class=" d-lg-flex justify-content-between mb-1">
		  <div class="position-relative">
			<input type="text" class="form-control ps-5 radius-30" v-model="searchDichVu" placeholder="Tìm kiếm dịch vụ" />
			<span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
		  </div>
		  <div class="d-flex">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
          <i class="bx bxs-plus-square"></i> Thêm dịch vụ
        </button>
		  </div>
		</div>
      <div class=" my-3 d-flex justify-content-between align-items-center">
        
        
      </div>
  
      <!-- Services Table -->
      <div class="card table-responsive">
        <table class="table mb-0">
          <thead class="table-light">
            <tr>
              <th>ID#</th>
              <th>Icon</th>
              <th>Tên dịch vụ</th>
              <th>Mô tả</th>
              <th>Đơn giá</th>
              <th>Đơn vị</th>
              <th>Tình trạng</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(value, index) in filteredDichvu " :key="index">
              <tr>
                <td><h6 class="mb-0 font-14">{{ value.id }}</h6></td>
                <td v-html="value.icon"></td>
                <td>{{ value.ten_dich_vu }}</td>
                <td>{{ value.mo_ta }}</td>
                <td>{{ value.gia.toLocaleString() }} VNĐ</td> 
                <td>{{ value.don_vi }}</td>
                <td>
                  <div
                    v-if="value.tinh_trang == 1"
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
                    <a v-on:click="Object.assign(update_dich_vu, value)" class="ms-3" data-bs-toggle="modal" data-bs-target="#updateModal">
                      <i class="bx bxs-edit"></i>
                    </a>
                    <a v-on:click="Object.assign(delete_dich_vu, value)" class="ms-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                      <i class="bx bxs-trash"></i>
                    </a>
                  </div>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
  
      <!-- Modal them dich vu -->
      <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary"> ">
                    <h5 class="modal-title text-white">Thêm dịch vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Tên dịch vụ</label>
                            <input v-model="create_dich_vu.ten_dich_vu" type="text" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Icon dịch vụ</label>
                            <input v-model="create_dich_vu.icon" type="text" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Mô tả</label>
                            <input v-model="create_dich_vu.mo_ta" type="text" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Đơn giá</label>
                            <input v-model="create_dich_vu.gia" type="number" step="10000" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Đơn vị tính</label>
                            <input v-model="create_dich_vu.don_vi" type="text" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Tình Trạng</label>
                            <select v-model="create_dich_vu.tinh_trang" class="form-select">
                                <option value="1">Hoạt động</option>
                                <option value="0">Ngừng hoạt động</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="themDichVu()"
                        data-bs-dismiss="modal">Thêm
                        mới</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Cập nhật dịch vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Tên dịch vụ</label>
                            <input v-model="update_dich_vu.ten_dich_vu" type="text" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Icon dịch vụ</label>
                            <input v-model="update_dich_vu.icon" type="text" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Mô tả</label>
                            <input v-model="update_dich_vu.mo_ta" type="text" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Đơn giá</label>
                            <input v-model="update_dich_vu.gia" type="number" step="10000" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Đơn vị tính</label>
                            <input v-model="update_dich_vu.don_vi" type="text" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Tình Trạng</label>
                            <select v-model="update_dich_vu.tinh_trang" class="form-select">
                                <option value="1">Hoạt động</option>
                                <option value="0">Ngừng hoạt động</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" v-on:click="capnhatDichVu()"
                        data-bs-dismiss="modal">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Xóa -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title"><b>Xóa dịch vụ</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        Bạn có chắc chắn muốn xóa dịch vụ <strong>{{ delete_dich_vu.ten_dich_vu }}</strong>?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" v-on:click="xoaDichVu()" data-bs-dismiss="modal">Xác
                        nhận</button>
                </div>
            </div>
        </div>
    </div>
    
    </div>
  </template>
  
  <script>
import axios from 'axios';
  export default {
    data() {
      return {
        searchDichVu: '',
        update_dich_vu:{},
        delete_dich_vu:{},
        create_dich_vu: {
          icon: '',
          ten_dich_vu: '',
          mo_ta: '',
          gia: 0,
          don_vi: '',
          tinh_trang: 1,
        },
        listDichVu: [
         
        ],
      };
    },
   computed: {
    filteredDichvu() {
		if (!this.searchDichVu) {
		  return this.listDichVu;
		}
		const query = this.searchDichVu.toLowerCase();
		return this.listDichVu.filter(dichvu =>
		  dichvu.ten_dich_vu.toLowerCase().includes(query) 
		  
		)}	
    },
    mounted() {
      this.getDichVu();
    } 
   ,
    methods: {
     getDichVu(){
      axios
      .get('http://127.0.0.1:8000/api/admin/dichvu/data')
      .then((response) => {
        this.listDichVu = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
     },
     themDichVu(){
      axios
      .post('http://127.0.0.1:8000/api/admin/dichvu/store', this.create_dich_vu)
      .then((response) => {
        if(response.data.status){
          this.listDichVu.push(response.data);
          this.create_dich_vu = {
            icon: '',
            ten_dich_vu: '',
            mo_ta: '',
            gia: 0,
            don_vi: '',
            tinh_trang: 1,
          };
          this.getDichVu();
        }
        else{
          alert('Thêm dịch vụ thất bại');
        }
      })
      .catch((error) => {
        console.log(error);
      });
     },
     xoaDichVu(){
      axios
      .post('http://127.0.0.1:8000/api/admin/dichvu/delete', this.delete_dich_vu)
      .then((response)=>{
        if(response.data.status){
          this.getDichVu();
          alert(response.data.message);
        }
        else{
          alert('Xóa dịch vụ thất bại');
        }
       
      })
      .catch((error) => {
        console.log(error);
      });
     },
     capnhatDichVu(){
      axios
      .post('http://127.0.0.1:8000/api/admin/dichvu/update', this.update_dich_vu)
      .then((response)=>{
        if(response.data.status){
          this.getDichVu();
          alert(response.data.message);
        }
        else{
          alert('Cập nhật dịch vụ thất bại');
        }
       
      })
      .catch((error) => {
        console.log(error);
      });
     },
  }
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