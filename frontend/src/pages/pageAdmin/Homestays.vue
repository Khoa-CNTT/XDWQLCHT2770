<template>
	<div class="card">
	  <div class="card-body">
		<div class="d-lg-flex justify-content-between mb-4">
		  <div class="position-relative">
			<input type="text" class="form-control ps-5 radius-30" v-model="searchQuery" placeholder="Tìm homestay">
			<span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
		  </div>
		  <div class="d-flex">
			<button class="btn btn-primary radius-30 mt-2 mt-lg-0 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal">
			  <i class="bx bxs-plus-square"></i> Thêm homestay mới
			</button>
		  </div>
		</div>
		<div class="table-responsive">
		  <table class="table mb-0">
			<thead class="table-light">
			  <tr class="align-middle">
				<th>ID#</th>
				<th>Ảnh</th>
				<th>Tên homestay</th>
				<th>Địa chỉ</th>
				<th>Mô tả</th>
				<th>Tiện ích</th>
				<th>Tình trạng</th>
				<th>Actions</th>
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
				  <td><img :src="value.image" class="" style="height:100px;width:100px; object-fit:cover" alt="" /></td>
				  <td>{{ value.ten_homestay }}</td>
				  <td>{{ value.dia_chi }}</td>
				  <td>{{ value.mo_ta }}</td>
				  <td>
					<div class="d-flex align-items-center">
					  <span v-html="value.tien_ich"></span>
					</div>
				  </td>
				  <td>
					<span v-if="value.tinh_trang === 1" class="badge rounded-pill text-success bg-light-success p-2">
					  <i class="bx bxs-circle me-1"></i>
					  Hoạt động
					</span>
					<span v-else class="badge rounded-pill text-danger bg-light-danger p-2">
					  <i class="bx bxs-circle me-1"></i>
					  Ngưng hoạt động
					</span>
				  </td>
				  <td>
					<div class="d-flex order-actions">
					  <a @click="editHomestay(value)" data-bs-toggle="modal" data-bs-target="#suaScrollableModal" class=""><i class="bx bxs-edit"></i></a>
					  <a href="javascript:;" class="ms-3" @click="deleteHomestay(value.id)"><i class="bx bxs-trash"></i></a>
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
	<div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Thêm HomeStay mới</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div>
			  <label class="mt-2">Tên homestay</label>
			  <input type="text" class="form-control" v-model="newHomestay.ten_homestay" placeholder="Nhập tên homestay">
			  <label class="mt-2">Địa chỉ</label>
			  <input type="text" class="form-control" v-model="newHomestay.dia_chi" placeholder="Nhập địa chỉ">
			  <label class="mt-2">Mô tả</label>
			  <textarea class="form-control" v-model="newHomestay.mo_ta" aria-label="With textarea"></textarea>
			  <label class="mt-2">Tiện ích</label>
			  <textarea class="form-control" v-model="newHomestay.tien_ich" placeholder="Nhập tiện nghi dưới dạng HTML"></textarea>
			  <label class="mt-2">Tình trạng</label>
			  <select class="form-select" v-model="newHomestay.tinh_trang" aria-label="Default select example">
				<option value="" disabled>Chọn tình trạng</option>
				<option value="1">Hoạt động</option>
				<option value="0">Ngưng hoạt động</option>
			  </select>
			  <div class="mb-4">
				<label class="mt-2">Thêm ảnh</label>
				<div class="form-control d-flex flex-wrap align-items-center gap-1" style="min-height: 50px;">
				  <span v-if="mainImageSet" class="badge bg-primary d-flex align-items-center" style="padding-right: 0.5rem;">
					{{ mainImageName }}
					<button type="button" class="btn-close btn-close-white btn-sm ms-2" @click="removeMainImage" aria-label="Remove"></button>
				  </span>
				  <label style="cursor: pointer;" class="ms-auto mb-1">
					<i class="fas fa-upload me-1"></i> Chọn ảnh
					<input type="file" accept="image/*" @change="handleMainImage" class="d-none" />
				  </label>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
			<button type="button" class="btn btn-primary" @click="addHomestay">Thêm</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- Modal Sửa homestay -->
	<div class="modal fade" id="suaScrollableModal" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Sửa thông tin homestay</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div>
			  <label class="mt-2">Tên homestay</label>
			  <input type="text" class="form-control" v-model="selectedHomestay.ten_homestay" placeholder="Nhập tên homestay">
			  <label class="mt-2">Địa chỉ</label>
			  <input type="text" class="form-control" v-model="selectedHomestay.dia_chi" placeholder="Nhập địa chỉ">
			  <label class="mt-2">Mô tả</label>
			  <textarea class="form-control" v-model="selectedHomestay.mo_ta" aria-label="With textarea"></textarea>
			  <label class="mt-2">Tiện ích</label>
			  <textarea class="form-control" v-model="selectedHomestay.tien_ich" placeholder="Nhập tiện nghi dưới dạng HTML"></textarea>
			  <label class="mt-2">Tình trạng</label>
			  <select class="form-select" v-model="selectedHomestay.tinh_trang" aria-label="Default select example">
				<option value="" disabled>Chọn tình trạng</option>
				<option value="1">Hoạt động</option>
				<option value="0">Ngưng hoạt động</option>
			  </select>
			  <div class="mb-4">
				<label class="mt-2">Thêm ảnh</label>
				<div class="form-control d-flex flex-wrap align-items-center gap-1" style="min-height: 50px;">
				  <span v-if="mainImageSet" class="badge bg-primary d-flex align-items-center" style="padding-right: 0.5rem;">
					{{ mainImageName }}
					<button type="button" class="btn-close btn-close-white btn-sm ms-2" @click="removeMainImage" aria-label="Remove"></button>
				  </span>
				  <label style="cursor: pointer;" class="ms-auto mb-1">
					<i class="fas fa-upload me-1"></i> Chọn ảnh
					<input type="file" accept="image/*" @change="handleMainImage" class="d-none" />
				  </label>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
			<button type="button" class="btn btn-primary" @click="saveHomestay">Lưu</button>
		  </div>
		</div>
	  </div>
	</div>
  </template>
  
  <script>
	import axios from 'axios';
  export default {
	name: 'HomestayManagement',
	data() {
	  return {
		searchQuery: '', // Từ khóa tìm kiếm
		mainImage: null,
		mainImageName: '',
		mainImageSet:false,
	subImages: [],
		subImageNames: [],
		listHomestay: [
		  {
			id: 1,
			ten_homestay: 'Bơ Yang homestay',
			dia_chi: 'Sơn Trà, Đà nẵng',
			mo_ta: 'Homestay đẹp, view núi',
			tinh_trang: 1,
			tien_ich: '<span class="me-3"><i class="fa-solid fa-tv"></i> TV</span><span class="me-3"><i class="fa-solid fa-film"></i> Netflix</span><span class="me-3"><i class="fa-solid fa-kitchen-set"></i> Bếp</span><span class="me-3"><i class="fa-solid fa-shower"></i> WC in room</span><span><i class="fa-solid fa-snowflake"></i> Điều hòa</span>',
			image: 'https://i.pinimg.com/474x/ac/bb/de/acbbde00d2c652f55f5b993a41a0387d.jpg',
		  },
		  {
			id: 2,
			ten_homestay: 'Healing homestay',
			dia_chi: 'Đà Lạt',
			mo_ta: 'Homestay đẹp, view núi',
			tinh_trang: 1,
			tien_ich: '<span class="me-3"><i class="fa-solid fa-tv"></i> TV</span><span class="me-3"><i class="fa-solid fa-film"></i> Netflix</span><span class="me-3"><i class="fa-solid fa-kitchen-set"></i> Bếp</span><span class="me-3"><i class="fa-solid fa-shower"></i> WC in room</span><span><i class="fa-solid fa-snowflake"></i> Điều hòa</span>',
			image: 'https://i.pinimg.com/474x/29/99/e5/2999e5d1fc2a2227c56497c69d869d01.jpg',
		  },
		  {
			id: 3,
			ten_homestay: 'Rose homestay',
			dia_chi: 'Đà Lạt',
			mo_ta: 'Homestay đẹp, view núi',
			tinh_trang: 1,
			tien_ich: '<span class="me-3"><i class="fa-solid fa-tv"></i> TV</span><span class="me-3"><i class="fa-solid fa-film"></i> Netflix</span><span class="me-3"><i class="fa-solid fa-kitchen-set"></i> Bếp</span><span class="me-3"><i class="fa-solid fa-shower"></i> WC in room</span><span><i class="fa-solid fa-snowflake"></i> Điều hòa</span>',
			image: 'https://i.pinimg.com/474x/8b/99/90/8b999091298d0e2d376d2e5fdd2a3e53.jpg',
		  },
		  {
			id: 4,
			ten_homestay: 'TiBi homestay',
			dia_chi: 'Đà Lạt',
			mo_ta: 'Homestay đẹp, view núi',
			tinh_trang: 1,
			tien_ich: '<span class="me-3"><i class="fa-solid fa-tv"></i> TV</span><span class="me-3"><i class="fa-solid fa-film"></i> Netflix</span><span class="me-3"><i class="fa-solid fa-kitchen-set"></i> Bếp</span><span class="me-3"><i class="fa-solid fa-shower"></i> WC in room</span><span><i class="fa-solid fa-snowflake"></i> Điều hòa</span>',
			image: 'https://i.pinimg.com/474x/e8/50/a2/e850a2270c2ae0969c89d50703b90a77.jpg',
		  },
		],
		selectedHomestay: {
		  id: null,
		  ten_homestay: '',
		  dia_chi: '',
		  mo_ta: '',
		  tinh_trang: '',
		  tien_ich: '',
		  image: ''
		},
		newHomestay: {
		  id: null,
		  ten_homestay: '',
		  dia_chi: '',
		  mo_ta: '',
		  tinh_trang: '',
		  tien_ich: '',
		  image: ''
		}
	  };
	},
	computed: {
	  filteredHomestays() {
		if (!this.searchQuery) {
		  return this.listHomestay;
		}
		const query = this.searchQuery.toLowerCase();
		return this.listHomestay.filter(homestay =>
		  homestay.ten_homestay.toLowerCase().includes(query) ||
		  homestay.dia_chi.toLowerCase().includes(query)
		);
	  }
	},
	methods: {
		getHomestay(){
			axios.get('http://localhost:3000/homestay')
			.then(response => {
				this.listHomestay = response.data;
			})
			.catch(error => {
				console.error('Error fetching homestays:', error);
			});
		},
	 
	  handleMainImage(event) {
		const file = event.target.files[0];
		if (file) {
		  this.mainImage = file;
		  this.mainImageName = file.name;
		  this.mainImageSet = true;
		  // Cập nhật URL hình ảnh cho newHomestay hoặc selectedHomestay
		  const imageUrl = URL.createObjectURL(file);
		  if (this.selectedHomestay.id) {
			this.selectedHomestay.image = imageUrl;
		  } else {
			this.newHomestay.image = imageUrl;
		  }
		}
	  },
	  removeMainImage() {
		this.mainImage = null;
		this.mainImageName = '';
		this.mainImageSet = false;
		if (this.selectedHomestay.id) {
		  this.selectedHomestay.image = '';
		} else {
		  this.newHomestay.image = '';
		}
	  },
	  handleSubImages(event) {
		const files = Array.from(event.target.files);
		for (const file of files) {
		  if (!this.subImageNames.includes(file.name)) {
			this.subImages.push(file);
			this.subImageNames.push(file.name);
		  }
		}
	  },
	  removeSubImage(index) {
		this.subImages.splice(index, 1);
		this.subImageNames.splice(index, 1);
	  },
	  addHomestay() {
		if (!this.newHomestay.ten_homestay || !this.newHomestay.dia_chi) {
		  alert('Vui lòng nhập đầy đủ thông tin!');
		  return;
		}
		const newId = this.listHomestay.length ? Math.max(...this.listHomestay.map(h => h.id)) + 1 : 1;
		this.listHomestay.push({
		  ...this.newHomestay,
		  id: newId,
		  tinh_trang: parseInt(this.newHomestay.tinh_trang) || 0
		});
		this.newHomestay = {
		  id: null,
		  ten_homestay: '',
		  dia_chi: '',
		  mo_ta: '',
		  tinh_trang: '',
		  tien_ich: '',
		  image: ''
		};
		this.mainImage = null;
		this.mainImageName = '';
		this.mainImageSet = false;
		$('#exampleScrollableModal').modal('hide');
	  },
	  editHomestay(homestay) {
		this.selectedHomestay = { ...homestay };
		this.mainImageSet = !!homestay.image;
		this.mainImageName = homestay.image ? 'Hình ảnh hiện tại' : '';
	  },
	  saveHomestay() {
		const index = this.listHomestay.findIndex(h => h.id === this.selectedHomestay.id);
		if (index !== -1) {
		  this.listHomestay.splice(index, 1, {
			...this.selectedHomestay,
			tinh_trang: parseInt(this.selectedHomestay.tinh_trang)
		  });
		}
		this.selectedHomestay = {
		  id: null,
		  ten_homestay: '',
		  dia_chi: '',
		  mo_ta: '',
		  tinh_trang: '',
		  tien_ich: '',
		  image: ''
		};
		this.mainImage = null;
		this.mainImageName = '';
		this.mainImageSet = false;
		$('#suaScrollableModal').modal('hide');
	  },
	  deleteHomestay(id) {
		const confirmDelete = confirm('Bạn có chắc chắn muốn xóa homestay này?');
		if (confirmDelete) {
		  this.listHomestay = this.listHomestay.filter(homestay => homestay.id !== id);
		}
	  }
	}
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
  textarea.form-control {
	min-height: 100px;
	resize: vertical;
  }
  </style>