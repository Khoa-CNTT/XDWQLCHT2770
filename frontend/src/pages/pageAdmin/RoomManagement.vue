<template>
	<div class="card">
	  <div class="card-body">
		<!-- Tìm kiếm & lọc -->
		<div class="d-lg-flex justify-content-between mb-4">
		  <div class="position-relative">
			<input type="text" class="form-control ps-5 radius-30" placeholder="Tìm phòng" v-model="searchQuery" />
			<span class="position-absolute top-50 product-show translate-middle-y">
			  <i class="bx bx-search"></i>
			</span>
		  </div>
  
		  <div class="d-flex">
			<select v-model="filterHomestay" class="form-select form-select-sm radius-30 mt-2 mt-lg-0" style="width:fit-content;">
			  <option value="">Homestay</option>
			  <option value="Bơ Yang">Bơ Yang</option>
			  <option value="Healing">Healing</option>
			  <option value="Rosie">Rosie</option>
			</select>
			<select v-model="filterLoaiPhong" class="form-select form-select-sm radius-30 mt-2 mt-lg-0" style="width:fit-content;">
				<option value="">Loại phòng</option>
				<option value="Sea room">Sea room</option>
				<option value="Bia Room">Bia Room</option>
				<option value="Muse room">Muse room</option>
			  </select>
			<select v-model="filterSort" class="form-select form-select-sm mx-1 radius-30 mt-2 mt-lg-0" style="width:fit-content;">
			  <option value="">Sắp xếp</option>
			  <option value="asc">Giá tăng</option>
			  <option value="desc">Giá giảm</option>
			  <option value="rating">Đánh giá</option>
			</select>
			<button class="btn btn-primary radius-30 mt-2 mt-lg-0 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal">
			  <i class="bx bxs-plus-square"></i> Thêm phòng mới
			</button>
		  </div>
		</div>
  
		<!-- Danh sách phòng -->
		<div class="table-responsive">
		  <table class="table mb-0">
			<thead class="table-light">
			  <tr>
				<th>ID#</th>
				<th>Image</th>
				<th>Tên phòng</th>
				<th>Homestay</th>
				<th>Loại phòng</th>
				<th>Tình trạng</th>
				<th>Giá (đêm)</th>
				
				<th>Actions</th>
			  </tr>
			</thead>
			<tbody>
			  <tr v-for="room in filteredRooms" :key="room.id">
				<td>
				  <div class="d-flex align-items-center">
					<div>
					  <input class="form-check-input me-3" type="checkbox" :value="room.id" aria-label="...">
					</div>
					<div class="ms-2">
					  <h6 class="mb-0 font-14">#{{ room.id }}</h6>
					</div>
				  </div>
				</td>
				<td><img :src="room.image" class="user-img" alt="room image" /></td>
				<td>{{ room.ten_phong }}</td>
				<td>{{ room.homestay }}</td>
				<td>{{room.loai_phong}}</td>
				<td>
				 <div v-if="room.tinh_trang == 1" class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">Sẵn sàng</div>
				 <div v-else class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">Ngưng hoạt động</div>
				
				</td>
				<td>{{ room.gia.toLocaleString() }}đ</td>
				
				<td>
				  <div class="d-flex order-actions">
					<a href="javascript:;" @click="editRoom(room)" data-bs-toggle="modal" data-bs-target="#modalEditRoom">
					  <i class="bx bxs-edit"></i>
					</a>
					<a href="javascript:;" class="ms-3" @click="deleteRoom(room.id)">
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
  
	<!-- Modal Thêm Phòng -->
	<div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Thêm phòng</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form @submit.prevent="addRoom">
			  <div class="row">
				<div class="col-lg-6">
				  <label class="mt-2">Homestay</label>
				  <select class="form-select form-select mt-2 mt-lg-0" v-model="newRoom.homestay" required>
					<option value="">Chọn homestay</option>
					<option value="Bơ Yang">Bơ Yang</option>
					<option value="Healing">Healing</option>
					<option value="Rosie">Rosie</option>
				  </select>
				  <label class="mt-2">Tên phòng</label>
				  <input type="text" class="form-control" placeholder="Nhập tên phòng" v-model="newRoom.ten_phong" required />
				  <label class="mt-2">Mô tả</label>
				  <textarea class="form-control" aria-label="With textarea" v-model="newRoom.mo_ta"></textarea>
				  <label class="mt-2">Diện tích</label>
				  <input type="number" class="form-control" placeholder="Nhập diện tích" v-model="newRoom.dien_tich" min="0" />
				  <label class="mt-2">Sức chứa tối đa</label>
				  <input type="number" class="form-control" placeholder="Nhập sức chứa tối đa" v-model="newRoom.suc_chua" min="1" />
				  <label class="mt-2">Giá (VND)</label>
				  <input type="number" class="form-control" placeholder="Nhập giá" v-model="newRoom.gia" required min="0" />
				  <label class="mt-2">Tình trạng</label>
				  <select class="form-select form-select mt-2 mt-lg-0" v-model="newRoom.tinh_trang" required>
					<option value="1">Sẵn sàng</option>
					<option value="0">Ngưng hoạt động</option>
					
				  </select>
				</div>
				<div class="col-lg-6">
				  <div class="mb-4">
					<label class="mt-2">Thêm ảnh chính</label>
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
				  <div class="mb-4">
					<label class="mt-2 d-block">Thêm ảnh phụ</label>
					<div class="form-control p-2" style="overflow-x: auto; white-space: nowrap; max-width: 100%;">
					  <span v-for="(name, index) in subImageNames" :key="index" class="badge bg-secondary d-inline-flex align-items-center me-2" style="padding-right: 0.5rem;">
						{{ name }}
						<button type="button" class="btn-close btn-close-white btn-sm ms-2" @click="removeSubImage(index)" aria-label="Remove"></button>
					  </span>
					  <label class="d-inline-block" style="cursor: pointer;">
						<i class="fas fa-plus-circle me-1"></i> Thêm ảnh
						<input type="file" multiple accept="image/*" @change="handleSubImages" class="d-none" />
					  </label>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
  
	<!-- Modal Sửa Phòng -->
	<div class="modal fade" id="modalEditRoom" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Sửa phòng</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form @submit.prevent="updateRoom">
			  <div class="row">
				<div class="col-12">
				  <label class="mt-2">Tên phòng</label>
				  <input type="text" class="form-control" placeholder="Nhập tên phòng" v-model="editRoomData.ten_phong" required />
				  <label class="mt-2">Giá (VND)</label>
				  <input type="number" class="form-control" placeholder="Nhập giá" v-model="editRoomData.gia" required min="0" />
				  <label class="mt-2">Tình trạng</label>
				  <select class="form-select form-select mt-2 mt-lg-0" v-model="editRoomData.tinh_trang" required>
					<option value="1">Sẵn sàng</option>
					<option value="0">Ngưng hoạt động</option>
				  </select>
				  <label class="mt-2">Thêm ảnh chính</label>
				  <div class="form-control d-flex flex-wrap align-items-center gap-1" style="min-height: 50px;">
					<span v-if="editRoomData.mainImageSet" class="badge bg-primary d-flex align-items-center" style="padding-right: 0.5rem;">
					  {{ editRoomData.mainImageName }}
					  <button type="button" class="btn-close btn-close-white btn-sm ms-2" @click="removeEditMainImage" aria-label="Remove"></button>
					</span>
					<label style="cursor: pointer;" class="ms-auto mb-1">
					  <i class="fas fa-upload me-1"></i> Chọn ảnh
					  <input type="file" accept="image/*" @change="handleEditMainImage" class="d-none" />
					</label>
				  </div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			</form>
		  </div>
		</div>
	  </div>
	</div>

	<!-- Modal Thông Tin Đặt Phòng -->
	<div class="modal fade" id="modalBookingDetails" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Thông Tin Đặt Phòng - {{ selectedRoom?.ten_phong }}</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div class="row">
			  <!-- Thông tin khách -->
			  <div class="col-md-6">
				<h6 class="text-primary fw-bold">Thông Tin Khách Hàng</h6>
				<div class="mb-2">
				  <label class="fw-bold">Họ tên:</label>
				  <span class="ms-2">{{ selectedRoom?.booking?.customer?.name || 'N/A' }}</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Email:</label>
				  <span class="ms-2">{{ selectedRoom?.booking?.customer?.email || 'N/A' }}</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Số điện thoại:</label>
				  <span class="ms-2">{{ selectedRoom?.booking?.customer?.phone || 'N/A' }}</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">CMND/CCCD:</label>
				  <span class="ms-2">{{ selectedRoom?.booking?.customer?.id_number || 'N/A' }}</span>
				</div>
			  </div>
			  <!-- Thông tin đặt phòng -->
			  <div class="col-md-6">
				<h6 class="text-primary fw-bold">Thông Tin Đặt Phòng</h6>
				<div class="mb-2">
				  <label class="fw-bold">Mã đặt phòng:</label>
				  <span class="ms-2">{{ selectedRoom?.booking?.booking_id || 'N/A' }}</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Ngày nhận phòng:</label>
				  <span class="ms-2">{{ formatDate(selectedRoom?.booking?.check_in) || 'N/A' }}</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Ngày trả phòng:</label>
				  <span class="ms-2">{{ formatDate(selectedRoom?.booking?.check_out) || 'N/A' }}</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Tổng tiền:</label>
				  <span class="ms-2">{{ selectedRoom?.booking?.total_price?.toLocaleString('vi-VN') || 'N/A' }}đ</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Trạng thái:</label>
				  <span class="ms-2 badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
					<i class="bx bxs-circle me-1"></i>{{ selectedRoom?.booking?.status || 'N/A' }}
				  </span>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
		  </div>
		</div>
	  </div>
	</div>
</template>

<script>
export default {
	data() {
	  return {
		searchQuery: '',
		filterHomestay: '',
		filterLoaiPhong: '',
		filterSort: '',
		newRoom: {
		  ten_phong: '',
		  homestay: '',
		  loai_phong: '',
		  tinh_trang: '1',
		  gia: 0,
		  mo_ta: '',
		  dien_tich: null,
		  suc_chua: null
		},
		mainImage: null,
		mainImageName: '',
		mainImageSet: false,
		subImages: [],
		subImageNames: [],
		editRoomData: {
		  id: null,
		  ten_phong: '',
		  tinh_trang: '',
		  gia: 0,
		  mainImage: null,
		  mainImageName: '',
		  mainImageSet: false
		},
		selectedRoom: null,
		rooms: [
		  {
			id: 'OS-000354',
			ten_phong: 'Gaspur Antunes',
			homestay: 'Bơ Yang',
			loai_phong: 'Sea room',
			tinh_trang: 1,
			gia: 500000,
			image: '/image.png',
			subImages: [],
			mo_ta: '',
			dien_tich: null,
			suc_chua: null
		  },
		  {
			id: 'OS-000355',
			ten_phong: 'Sunset Villa',
			homestay: 'Healing',
			loai_phong: 'Game Room',
			tinh_trang: 1,
			gia: 750000,
			image: '/image2.png',
			subImages: [],
			mo_ta: 'Phòng đẹp, view biển',
			dien_tich: 30,
			suc_chua: 4,
			
		  },
		  {
			id: 'OS-000356',
			ten_phong: 'Rose Garden',
			homestay: 'Rosie',
			loai_phong: 'Muse Room',
			tinh_trang: 0,
			gia: 600000,
			image: '/image3.png',
			subImages: [],
			mo_ta: 'Phòng ấm cúng, gần trung tâm',
			dien_tich: 25,
			suc_chua: 2,
			
		  }
		]
	  };
	},
	computed: {
	  filteredRooms() {
		let result = [...this.rooms];
  
		if (this.searchQuery) {
		  result = result.filter(r =>
			r.ten_phong.toLowerCase().includes(this.searchQuery.toLowerCase())
		  );
		}
  
		if (this.filterHomestay) {
		  result = result.filter(r => r.homestay === this.filterHomestay);
		}
		if (this.filterLoaiPhong) {
		  result = result.filter(r => r.loai_phong === this.filterLoaiPhong);
		}
		if (this.filterSort === 'asc') {
		  result.sort((a, b) => a.gia - b.gia);
		} else if (this.filterSort === 'desc') {
		  result.sort((a, b) => b.gia - a.gia);
		}
  
		return result;
	  }
	},
	methods: {
	  handleMainImage(event) {
		const file = event.target.files[0];
		if (file) {
		  this.mainImage = file;
		  this.mainImageName = file.name;
		  this.mainImageSet = true;
		}
	  },
	  removeMainImage() {
		this.mainImage = null;
		this.mainImageName = '';
		this.mainImageSet = false;
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
	  addRoom() {
		if (!this.newRoom.ten_phong || !this.newRoom.homestay || !this.newRoom.gia) {
		  alert('Vui lòng điền đầy đủ thông tin bắt buộc (Tên phòng, Homestay, Giá)!');
		  return;
		}
  
		const newRoomData = {
		  id: `OS-${Math.floor(100000 + Math.random() * 900000)}`,
		  ten_phong: this.newRoom.ten_phong,
		  homestay: this.newRoom.homestay,
		  tinh_trang: this.newRoom.tinh_trang,
		  gia: parseInt(this.newRoom.gia),
		  mo_ta: this.newRoom.mo_ta,
		  dien_tich: this.newRoom.dien_tich,
		  suc_chua: this.newRoom.suc_chua,
		  image: this.mainImage ? URL.createObjectURL(this.mainImage) : '/image.png',
		  subImages: this.subImages.map(file => ({
			name: file.name,
			preview: URL.createObjectURL(file)
		  }))
		};
  
		this.rooms.push(newRoomData);
  
		// Reset form
		this.newRoom = {
		  ten_phong: '',
		  homestay: '',
		  tinh_trang: 1,
		  gia: 0,
		  mo_ta: '',
		  dien_tich: null,
		  suc_chua: null
		};
		this.removeMainImage();
		this.subImages = [];
		this.subImageNames = [];
  
		// Đóng modal
		const modal = document.getElementById('exampleScrollableModal');
		modal.querySelector('.btn-close').click();
	  },
	  editRoom(room) {
		this.editRoomData = {
		  id: room.id,
		  ten_phong: room.ten_phong,
		  tinh_trang: room.tinh_trang,
		  gia: room.gia,
		  mainImage: null,
		  mainImageName: room.image.includes('image.png') ? '' : 'Current Image',
		  mainImageSet: !room.image.includes('image.png')
		};
	  },
	  handleEditMainImage(event) {
		const file = event.target.files[0];
		if (file) {
		  this.editRoomData.mainImage = file;
		  this.editRoomData.mainImageName = file.name;
		  this.editRoomData.mainImageSet = true;
		}
	  },
	  removeEditMainImage() {
		this.editRoomData.mainImage = null;
		this.editRoomData.mainImageName = '';
		this.editRoomData.mainImageSet = false;
	  },
	  updateRoom() {
		if (!this.editRoomData.ten_phong || !this.editRoomData.gia) {
		  alert('Vui lòng điền đầy đủ thông tin bắt buộc (Tên phòng, Giá)!');
		  return;
		}
  
		const index = this.rooms.findIndex(room => room.id === this.editRoomData.id);
		if (index !== -1) {
		  this.rooms[index] = {
			...this.rooms[index],
			ten_phong: this.editRoomData.ten_phong,
			tinh_trang: this.editRoomData.tinh_trang,
			gia: parseInt(this.editRoomData.gia),
			image: this.editRoomData.mainImage ? URL.createObjectURL(this.editRoomData.mainImage) : this.rooms[index].image
		  };
		}
  
		// Đóng modal
		const modal = document.getElementById('modalEditRoom');
		modal.querySelector('.btn-close').click();
	  },
	  deleteRoom(id) {
		if (confirm('Bạn có chắc muốn xóa phòng này?')) {
		  this.rooms = this.rooms.filter(room => room.id !== id);
		}
	  },
	  showBookingDetails(room) {
		this.selectedRoom = room;
	  },
	  formatDate(date) {
		if (!date) return '';
		const d = new Date(date);
		return `${d.getDate().toString().padStart(2, '0')}/${(d.getMonth() + 1).toString().padStart(2, '0')}/${d.getFullYear()}`;
	  }
	}
};
</script>

<style scoped>
.user-img {
  width: 60px;
  height: 60px;
  border-radius: 10px;
  object-fit: cover;
}
.bg-light-success {
  background-color: #d4edda;
}
.text-success {
  color: #28a745;
}
.bg-light-warning {
  background-color: #fff3cd;
}
.text-warning {
  color: #ffc107;
}
.bg-light-danger {
  background-color: #f8d7da;
}
.text-danger {
  color: #dc3545;
}
.bg-light-info {
  background-color: #d1ecf1;
}
.text-info {
  color: #17a2b8;
}
</style>