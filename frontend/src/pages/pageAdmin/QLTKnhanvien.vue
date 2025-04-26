<template>
	<div class="card">
	  <div class="card-body">
		<div class="d-lg-flex justify-content-between mb-4">
		  <div class="position-relative">
			<input type="text" class="form-control ps-5 radius-30" v-model="searchQuery" placeholder="Tìm nhân viên">
			<span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
		  </div>
		  <div class="d-flex">
			<button class="btn btn-primary radius-30 mt-2 mt-lg-0 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal">
			  <i class="bx bxs-plus-square"></i> Thêm nhân viên mới
			</button>
		  </div>
		</div>
		<div class="table-responsive">
		  <table class="table mb-0">
			<thead class="table-light">
			  <tr class="align-middle">
				<th>ID#</th>
				<th>Ảnh đại diện</th>
				<th>Tên nhân viên</th>
				<th>Email</th>
				<th>Số điện thoại</th>
				<th>Chức vụ</th>
				<th>Homestay đang làm việc</th>
				<th>Tình trạng</th>
				<th>Actions</th>
			  </tr>
			</thead>
			<tbody>
			  <template v-for="(employee, index) in filteredEmployees" :key="index">
				<tr class="align-middle">
				  <td>
					<div class="ms-2">
					  <h6 class="mb-0 font-14">{{ employee.id }}</h6>
					</div>
				  </td>
				  <td><img :src="employee.avatar" class="" style="height:100px;width:100px; object-fit:cover" alt="" /></td>
				  <td>{{ employee.name }}</td>
				  <td>{{ employee.email }}</td>
				  <td>{{ employee.phone }}</td>
				  <td>{{ employee.position }}</td>
				  <td>{{ employee.homestay }}</td>
				  <td>
					<span v-if="employee.status === 1" class="badge rounded-pill text-success bg-light-success p-2">
					  <i class="bx bxs-circle me-1"></i>
					  Hoạt động
					</span>
					<span v-else class="badge rounded-pill text-danger bg-light-danger p-2">
					  <i class="bx bxs-circle me-1"></i>
					  Nghỉ việc
					</span>
				  </td>
				  <td>
					<div class="d-flex order-actions">
					  <a @click="editEmployee(employee)" data-bs-toggle="modal" data-bs-target="#suaScrollableModal" class=""><i class="bx bxs-edit"></i></a>
					  <a href="javascript:;" class="ms-3" @click="deleteEmployee(employee.id)"><i class="bx bxs-trash"></i></a>
					</div>
				  </td>
				</tr>
			  </template>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
	<!-- Modal Thêm nhân viên -->
	<div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Thêm nhân viên mới</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div>
			  <label class="mt-2">Tên nhân viên</label>
			  <input type="text" class="form-control" v-model="newEmployee.name" placeholder="Nhập tên nhân viên">
			  <label class="mt-2">Email</label>
			  <input type="email" class="form-control" v-model="newEmployee.email" placeholder="Nhập email" autocomplete="off">
			  <label class="mt-2">Số điện thoại</label>
			  <input type="text" class="form-control" v-model="newEmployee.phone" placeholder="Nhập số điện thoại">
			  <label class="mt-2">Mật khẩu</label>
			  <input type="password" class="form-control" v-model="newEmployee.password" placeholder="Nhập mật khẩu" autocomplete="off">
			  <label class="mt-2">Chức vụ</label>
			  <select class="form-select" v-model="newEmployee.position" aria-label="Default select example">
				<option value="" disabled>Chọn chức vụ</option>
				<option value="Nhân viên lễ tân">Nhân viên lễ tân</option>
				<option value="Nhân viên tạp vụ">Nhân viên tạp vụ</option>
			  </select>
			  <label class="mt-2">Homestay đang làm việc</label>
			  <select class="form-select" v-model="newEmployee.homestay" aria-label="Default select example">
				<option value="" disabled>Chọn homestay</option>
				<option value="Bơ Yang homestay">Bơ Yang homestay</option>
				<option value="Healing homestay">Healing homestay</option>
				<option value="Rose homestay">Rose homestay</option>
				<option value="TiBi homestay">TiBi homestay</option>
			  </select>
			  <label class="mt-2">Tình trạng</label>
			  <select class="form-select" v-model="newEmployee.status" aria-label="Default select example">
				<option value="" disabled>Chọn tình trạng</option>
				<option value="1">Hoạt động</option>
				<option value="0">Nghỉ việc</option>
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
			<button type="button" class="btn btn-primary" @click="addEmployee">Thêm</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- Modal Sửa nhân viên -->
	<div class="modal fade" id="suaScrollableModal" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Sửa thông tin nhân viên</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div>
			  <label class="mt-2">Tên nhân viên</label>
			  <input type="text" class="form-control" v-model="selectedEmployee.name" placeholder="Nhập tên nhân viên">
			  <label class="mt-2">Email</label>
			  <input type="email" class="form-control" v-model="selectedEmployee.email" placeholder="Nhập email" autocomplete="off">
			  <label class="mt-2">Số điện thoại</label>
			  <input type="text" class="form-control" v-model="selectedEmployee.phone" placeholder="Nhập số điện thoại">
			  <label class="mt-2">Mật khẩu (để trống nếu không thay đổi)</label>
			  <input type="password" class="form-control" v-model="selectedEmployee.password" placeholder="Nhập mật khẩu mới" autocomplete="off">
			  <label class="mt-2">Chức vụ</label>
			  <select class="form-select" v-model="selectedEmployee.position" aria-label="Default select example">
				<option value="" disabled>Chọn chức vụ</option>
				<option value="Nhân viên lễ tân">Nhân viên lễ tân</option>
				<option value="Nhân viên tạp vụ">Nhân viên tạp vụ</option>
			  </select>
			  <label class="mt-2">Homestay đang làm việc</label>
			  <select class="form-select" v-model="selectedEmployee.homestay" aria-label="Default select example">
				<option value="" disabled>Chọn homestay</option>
				<option value="Bơ Yang homestay">Bơ Yang homestay</option>
				<option value="Healing homestay">Healing homestay</option>
				<option value="Rose homestay">Rose homestay</option>
				<option value="TiBi homestay">TiBi homestay</option>
			  </select>
			  <label class="mt-2">Tình trạng</label>
			  <select class="form-select" v-model="selectedEmployee.status" aria-label="Default select example">
				<option value="" disabled>Chọn tình trạng</option>
				<option value="1">Hoạt động</option>
				<option value="0">Nghỉ việc</option>
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
			<button type="button" class="btn btn-primary" @click="saveEmployee">Lưu</button>
		  </div>
		</div>
	  </div>
	</div>
</template>

<script>
export default {
	name: 'EmployeeManagement',
	data() {
		return {
			searchQuery: '',
			mainImage: null,
			mainImageName: '',
			mainImageSet: false,
			listEmployees: [
				{
					id: 1,
					name: 'Nguyễn Thị An',
					email: 'an.nguyen@example.com',
					phone: '0901234567',
					position: 'Nhân viên lễ tân',
					homestay: 'Bơ Yang homestay',
					status: 1,
					avatar: 'https://i.pinimg.com/474x/ac/bb/de/acbbde00d2c652f55f5b993a41a0387d.jpg'
				},
				{
					id: 2,
					name: 'Trần Văn Bình',
					email: 'binh.tran@example.com',
					phone: '0912345678',
					position: 'Nhân viên lễ tân',
					homestay: 'Healing homestay',
					status: 1,
					avatar: 'https://i.pinimg.com/474x/29/99/e5/2999e5d1fc2a2227c56497c69d869d01.jpg'
				},
				{
					id: 3,
					name: 'Lê Thị Cẩm',
					email: 'cam.le@example.com',
					phone: '0923456789',
					position: 'Nhân viên tạp vụ',
					homestay: 'Rose homestay',
					status: 0,
					avatar: 'https://i.pinimg.com/474x/8b/99/90/8b999091298d0e2d376d2e5fdd2a3e53.jpg'
				},
				{
					id: 4,
					name: 'Phạm Văn Đức',
					email: 'duc.pham@example.com',
					phone: '0934567890',
					position: 'Nhân viên tạp vụ',
					homestay: 'TiBi homestay',
					status: 1,
					avatar: 'https://i.pinimg.com/474x/e8/50/a2/e850a2270c2ae0969c89d50703b90a77.jpg'
				}
			],
			selectedEmployee: {
				id: null,
				name: '',
				email: '',
				phone: '',
				password: '',
				position: '',
				homestay: '',
				status: '',
				avatar: ''
			},
			newEmployee: {
				id: null,
				name: '',
				email: '',
				phone: '',
				password: '',
				position: '',
				homestay: '',
				status: '',
				avatar: ''
			}
		};
	},
	computed: {
		filteredEmployees() {
			if (!this.searchQuery) {
				return this.listEmployees;
			}
			const query = this.searchQuery.toLowerCase();
			return this.listEmployees.filter(employee =>
				employee.name.toLowerCase().includes(query) ||
				employee.email.toLowerCase().includes(query) ||
				employee.phone.toLowerCase().includes(query) ||
				employee.homestay.toLowerCase().includes(query)
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
				if (this.selectedEmployee.id) {
					this.selectedEmployee.avatar = imageUrl;
				} else {
					this.newEmployee.avatar = imageUrl;
				}
			}
		},
		removeMainImage() {
			this.mainImage = null;
			this.mainImageName = '';
			this.mainImageSet = false;
			if (this.selectedEmployee.id) {
				this.selectedEmployee.avatar = '';
			} else {
				this.newEmployee.avatar = '';
			}
		},
		addEmployee() {
			if (!this.newEmployee.name || !this.newEmployee.email || !this.newEmployee.password || !this.newEmployee.position || !this.newEmployee.homestay) {
				alert('Vui lòng nhập đầy đủ thông tin!');
				return;
			}
			const newId = this.listEmployees.length ? Math.max(...this.listEmployees.map(e => e.id)) + 1 : 1;
			this.listEmployees.push({
				...this.newEmployee,
				id: newId,
				status: parseInt(this.newEmployee.status) || 0
			});
			this.newEmployee = {
				id: null,
				name: '',
				email: '',
				phone: '',
				password: '',
				position: '',
				homestay: '',
				status: '',
				avatar: ''
			};
			this.mainImage = null;
			this.mainImageName = '';
			this.mainImageSet = false;
			$('#exampleScrollableModal').modal('hide');
		},
		editEmployee(employee) {
			this.selectedEmployee = { ...employee, password: '' }; // Không load mật khẩu cũ
			this.mainImageSet = !!employee.avatar;
			this.mainImageName = employee.avatar ? 'Hình ảnh hiện tại' : '';
		},
		saveEmployee() {
			const index = this.listEmployees.findIndex(e => e.id === this.selectedEmployee.id);
			if (index !== -1) {
				const updatedEmployee = {
					...this.selectedEmployee,
					status: parseInt(this.selectedEmployee.status)
				};
				if (!this.selectedEmployee.password) {
					delete updatedEmployee.password;
				}
				this.listEmployees.splice(index, 1, updatedEmployee);
			}
			this.selectedEmployee = {
				id: null,
				name: '',
				email: '',
				phone: '',
				password: '',
				position: '',
				homestay: '',
				status: '',
				avatar: ''
			};
			this.mainImage = null;
			this.mainImageName = '';
			this.mainImageSet = false;
			$('#suaScrollableModal').modal('hide');
		},
		deleteEmployee(id) {
			const confirmDelete = confirm('Bạn có chắc chắn muốn xóa nhân viên này?');
			if (confirmDelete) {
				this.listEmployees = this.listEmployees.filter(employee => employee.id !== id);
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