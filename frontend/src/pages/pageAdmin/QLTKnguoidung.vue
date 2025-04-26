<template>
	<div class="card">
	  <div class="card-body">
		<div class="d-lg-flex justify-content-between mb-4">
		  <div class="position-relative">
			<input type="text" class="form-control ps-5 radius-30" v-model="searchQuery" placeholder="Tìm khách hàng">
			<span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
		  </div>
		  <div class="d-flex">
			<button class="btn btn-primary radius-30 mt-2 mt-lg-0 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal">
			  <i class="bx bxs-plus-square"></i> Thêm khách hàng mới
			</button>
		  </div>
		</div>
		<div class="table-responsive">
		  <table class="table mb-0">
			<thead class="table-light">
			  <tr class="align-middle">
				<th>ID#</th>
				<th>Ảnh đại diện</th>
				<th>Tên khách hàng</th>
				<th>Email</th>
				<th>Số điện thoại</th>
				<th>Lịch sử đặt phòng</th>
				<th>Tình trạng</th>
				<th>Actions</th>
			  </tr>
			</thead>
			<tbody>
			  <template v-for="(customer, index) in filteredCustomers" :key="index">
				<tr class="align-middle">
				  <td>
					<div class="ms-2">
					  <h6 class="mb-0 font-14">{{ customer.id }}</h6>
					</div>
				  </td>
				  <td><img :src="customer.avatar" class="" style="height:100px;width:100px; object-fit:cover" alt="" /></td>
				  <td>{{ customer.username }}</td>
				  <td>{{ customer.email }}</td>
				  <td>{{ customer.phone }}</td>
				  <td>
					<a href="javascript:;" @click="showBookingHistory(customer)" data-bs-toggle="modal" data-bs-target="#bookingHistoryModal">Xem lịch sử</a>
				  </td>
				  <td>
					<span v-if="customer.status === 1" class="badge rounded-pill text-success bg-light-success p-2">
					  <i class="bx bxs-circle me-1"></i>
					  Hoạt động
					</span>
					<span v-else class="badge rounded-pill text-danger bg-light-danger p-2">
					  <i class="bx bxs-circle me-1"></i>
					  Khóa
					</span>
				  </td>
				  <td>
					<div class="d-flex order-actions">
					  <a @click="editCustomer(customer)" data-bs-toggle="modal" data-bs-target="#suaScrollableModal" class=""><i class="bx bxs-edit"></i></a>
					  <a href="javascript:;" class="ms-3" @click="deleteCustomer(customer.id)"><i class="bx bxs-trash"></i></a>
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
	<div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Thêm khách hàng mới</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div>
			  <label class="mt-2">Tên khách hàng</label>
			  <input type="text" class="form-control" v-model="newCustomer.username" placeholder="Nhập tên khách hàng">
			  <label class="mt-2">Email</label>
			  <input type="email" class="form-control" v-model="newCustomer.email" placeholder="Nhập email">
			  <label class="mt-2">Số điện thoại</label>
			  <input type="text" class="form-control" v-model="newCustomer.phone" placeholder="Nhập số điện thoại">
			  <label class="mt-2">Mật khẩu</label>
			  <input type="password" class="form-control" v-model="newCustomer.password" placeholder="Nhập mật khẩu">
			  <label class="mt-2">Tình trạng</label>
			  <select class="form-select" v-model="newCustomer.status" aria-label="Default select example">
				<option value="" disabled>Chọn tình trạng</option>
				<option value="1">Hoạt động</option>
				<option value="0">Khóa</option>
			  </select>
			  <div class="mb-4">
				<label class="mt-2">Ảnh đại diện</label>
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
			<button type="button" class="btn btn-primary" @click="addCustomer">Thêm</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- Modal Sửa khách hàng -->
	<div class="modal fade" id="suaScrollableModal" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Sửa thông tin khách hàng</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div>
			  <label class="mt-2">Tên khách hàng</label>
			  <input type="text" class="form-control" v-model="selectedCustomer.username" placeholder="Nhập tên khách hàng">
			  <label class="mt-2">Email</label>
			  <input type="email" class="form-control" v-model="selectedCustomer.email" placeholder="Nhập email">
			  <label class="mt-2">Số điện thoại</label>
			  <input type="text" class="form-control" v-model="selectedCustomer.phone" placeholder="Nhập số điện thoại">
			  <label class="mt-2">Mật khẩu (để trống nếu không thay đổi)</label>
			  <input type="password" class="form-control" v-model="selectedCustomer.password" placeholder="Nhập mật khẩu mới">
			  <label class="mt-2">Tình trạng</label>
			  <select class="form-select" v-model="selectedCustomer.status" aria-label="Default select example">
				<option value="" disabled>Chọn tình trạng</option>
				<option value="1">Hoạt động</option>
				<option value="0">Khóa</option>
			  </select>
			  <div class="mb-4">
				<label class="mt-2">Ảnh đại diện</label>
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
			<button type="button" class="btn btn-primary" @click="saveCustomer">Lưu</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- Modal Lịch sử đặt phòng -->
	<div class="modal fade" id="bookingHistoryModal" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Lịch sử đặt phòng của {{ selectedCustomer.username }}</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div v-if="selectedCustomer.bookingHistory && selectedCustomer.bookingHistory.length">
			  <table class="table mb-0">
				<thead class="table-light">
				  <tr>
					<th>Mã đặt phòng</th>
					<th>Homestay</th>
					<th>Ngày đặt</th>
					<th>Ngày nhận</th>
					<th>Ngày trả</th>
					<th>Tổng tiền</th>
					<th>Trạng thái</th>
				  </tr>
				</thead>
				<tbody>
				  <tr v-for="(booking, index) in selectedCustomer.bookingHistory" :key="index">
					<td>{{ booking.booking_id }}</td>
					<td>{{ booking.homestay_name }}</td>
					<td>{{ formatDate(booking.booking_date) }}</td>
					<td>{{ formatDate(booking.check_in) }}</td>
					<td>{{ formatDate(booking.check_out) }}</td>
					<td>{{ booking.total_price.toLocaleString('vi-VN') }} VNĐ</td>
					<td>
					  <span :class="{
						'badge rounded-pill text-success bg-light-success p-2': booking.status === 'Confirmed',
						'badge rounded-pill text-warning bg-light-warning p-2': booking.status === 'Pending',
						'badge rounded-pill text-danger bg-light-danger p-2': booking.status === 'Cancelled'
					  }">
						<i class="bx bxs-circle me-1"></i>
						{{ booking.status }}
					  </span>
					</td>
				  </tr>
				</tbody>
			  </table>
			</div>
			<div v-else>
			  <p>Khách hàng này chưa có lịch sử đặt phòng.</p>
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
	name: 'CustomerManagement',
	data() {
		return {
			searchQuery: '',
			mainImage: null,
			mainImageName: '',
			mainImageSet: false,
			listCustomers: [
				{
					id: 1,
					username: 'Nguyễn Văn A',
					email: 'vana@example.com',
					phone: '0901234567',
					status: 1,
					avatar: 'https://i.pinimg.com/474x/ac/bb/de/acbbde00d2c652f55f5b993a41a0387d.jpg',
					bookingHistory: [
						{
							booking_id: 'BK001',
							homestay_name: 'Bơ Yang homestay',
							booking_date: '2025-04-01',
							check_in: '2025-04-05',
							check_out: '2025-04-07',
							total_price: 1500000,
							status: 'Confirmed'
						},
						{
							booking_id: 'BK002',
							homestay_name: 'Healing homestay',
							booking_date: '2025-03-20',
							check_in: '2025-03-25',
							check_out: '2025-03-27',
							total_price: 1200000,
							status: 'Cancelled'
						}
					]
				},
				{
					id: 2,
					username: 'Trần Thị B',
					email: 'thib@example.com',
					phone: '0912345678',
					status: 1,
					avatar: 'https://i.pinimg.com/474x/29/99/e5/2999e5d1fc2a2227c56497c69d869d01.jpg',
					bookingHistory: [
						{
							booking_id: 'BK003',
							homestay_name: 'Rose homestay',
							booking_date: '2025-03-10',
							check_in: '2025-03-15',
							check_out: '2025-03-18',
							total_price: 1800000,
							status: 'Confirmed'
						}
					]
				},
				{
					id: 3,
					username: 'Lê Văn C',
					email: 'vanc@example.com',
					phone: '0923456789',
					status: 0,
					avatar: 'https://i.pinimg.com/474x/8b/99/90/8b999091298d0e2d376d2e5fdd2a3e53.jpg',
					bookingHistory: []
				},
				{
					id: 4,
					username: 'Phạm Thị D',
					email: 'thid@example.com',
					phone: '0934567890',
					status: 1,
					avatar: 'https://i.pinimg.com/474x/e8/50/a2/e850a2270c2ae0969c89d50703b90a77.jpg',
					bookingHistory: [
						{
							booking_id: 'BK004',
							homestay_name: 'TiBi homestay',
							booking_date: '2025-02-15',
							check_in: '2025-02-20',
							check_out: '2025-02-22',
							total_price: 1000000,
							status: 'Pending'
						}
					]
				}
			],
			selectedCustomer: {
				id: null,
				username: '',
				email: '',
				phone: '',
				password: '',
				status: '',
				avatar: '',
				bookingHistory: []
			},
			newCustomer: {
				id: null,
				username: '',
				email: '',
				phone: '',
				password: '',
				status: '',
				avatar: '',
				bookingHistory: []
			}
		};
	},
	computed: {
		filteredCustomers() {
			if (!this.searchQuery) {
				return this.listCustomers;
			}
			const query = this.searchQuery.toLowerCase();
			return this.listCustomers.filter(customer =>
				customer.username.toLowerCase().includes(query) ||
				customer.email.toLowerCase().includes(query) ||
				customer.phone.toLowerCase().includes(query)
			);
		}
	},
	methods: {
		handleMainImage(event) {
			const file = event.target.files[0];
			if (file) {
				this.mainImage = file;
				this.mainImageName = file.name;
				this.mainImageSet = true;
				const imageUrl = URL.createObjectURL(file);
				if (this.selectedCustomer.id) {
					this.selectedCustomer.avatar = imageUrl;
				} else {
					this.newCustomer.avatar = imageUrl;
				}
			}
		},
		removeMainImage() {
			this.mainImage = null;
			this.mainImageName = '';
			this.mainImageSet = false;
			if (this.selectedCustomer.id) {
				this.selectedCustomer.avatar = '';
			} else {
				this.newCustomer.avatar = '';
			}
		},
		addCustomer() {
			if (!this.newCustomer.username || !this.newCustomer.email || !this.newCustomer.password) {
				alert('Vui lòng nhập đầy đủ thông tin!');
				return;
			}
			const newId = this.listCustomers.length ? Math.max(...this.listCustomers.map(c => c.id)) + 1 : 1;
			this.listCustomers.push({
				...this.newCustomer,
				id: newId,
				status: parseInt(this.newCustomer.status) || 0,
				bookingHistory: []
			});
			this.newCustomer = {
				id: null,
				username: '',
				email: '',
				phone: '',
				password: '',
				status: '',
				avatar: '',
				bookingHistory: []
			};
			this.mainImage = null;
			this.mainImageName = '';
			this.mainImageSet = false;
			$('#exampleScrollableModal').modal('hide');
		},
		editCustomer(customer) {
			this.selectedCustomer = { ...customer, password: '' }; // Không load mật khẩu cũ
			this.mainImageSet = !!customer.avatar;
			this.mainImageName = customer.avatar ? 'Hình ảnh hiện tại' : '';
		},
		saveCustomer() {
			const index = this.listCustomers.findIndex(c => c.id === this.selectedCustomer.id);
			if (index !== -1) {
				const updatedCustomer = {
					...this.selectedCustomer,
					status: parseInt(this.selectedCustomer.status),
					bookingHistory: this.selectedCustomer.bookingHistory // Giữ nguyên lịch sử đặt phòng
				};
				if (!this.selectedCustomer.password) {
					delete updatedCustomer.password;
				}
				this.listCustomers.splice(index, 1, updatedCustomer);
			}
			this.selectedCustomer = {
				id: null,
				username: '',
				email: '',
				phone: '',
				password: '',
				status: '',
				avatar: '',
				bookingHistory: []
			};
			this.mainImage = null;
			this.mainImageName = '';
			this.mainImageSet = false;
			$('#suaScrollableModal').modal('hide');
		},
		deleteCustomer(id) {
			const confirmDelete = confirm('Bạn có chắc chắn muốn xóa khách hàng này?');
			if (confirmDelete) {
				this.listCustomers = this.listCustomers.filter(customer => customer.id !== id);
			}
		},
		showBookingHistory(customer) {
			this.selectedCustomer = { ...customer };
		},
		formatDate(date) {
			const d = new Date(date);
			return `${d.getDate().toString().padStart(2, '0')}/${(d.getMonth() + 1).toString().padStart(2, '0')}/${d.getFullYear()}`;
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
.bg-light-warning {
	background-color: #fff3cd;
}
.text-warning {
	color: #ffc107;
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