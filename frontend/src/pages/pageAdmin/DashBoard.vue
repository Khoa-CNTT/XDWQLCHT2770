<template>
	<div class="container-fluid">
	  <!-- Tiêu đề Dashboard -->
	  <h3 class="mb-4 text-primary fw-bold">Dashboard Quản Lý Homestay</h3>

	  <!-- Thống kê tổng quan -->
	  <div class="row mb-4">
		<div class="col-md-3 col-sm-6 mb-3">
		  <div class="card shadow-sm border-0 text-white bg-primary hover-effect">
			<div class="card-body d-flex align-items-center">
			  <i class="bx bx-home-alt fs-2 me-3"></i>
			  <div>
				<h5 class="card-title mb-1">Tổng số homestay</h5>
				<p class="card-text display-6 mb-0">{{ totalHomestays }}</p>
				<small>Hoạt động: {{ activeHomestays }} | Ngừng: {{ inactiveHomestays }}</small>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
		  <div class="card shadow-sm border-0 text-white bg-success hover-effect">
			<div class="card-body d-flex align-items-center">
			  <i class="bx bx-user fs-2 me-3"></i>
			  <div>
				<h5 class="card-title mb-1">Tổng số khách hàng</h5>
				<p class="card-text display-6 mb-0">{{ totalCustomers }}</p>
				<small>Khách mới tháng này: {{ newCustomersThisMonth }}</small>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
		  <div class="card shadow-sm border-0 text-white bg-info hover-effect">
			<div class="card-body d-flex align-items-center">
			  <i class="bx bx-group fs-2 me-3"></i>
			  <div>
				<h5 class="card-title mb-1">Tổng số nhân viên</h5>
				<p class="card-text display-6 mb-0">{{ totalEmployees }}</p>
				<small>Lễ tân: {{ receptionists }} | Tạp vụ: {{ housekeepers }}</small>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
		  <div class="card shadow-sm border-0 text-white bg-warning hover-effect">
			<div class="card-body d-flex align-items-center">
			  <i class="bx bx-calendar-check fs-2 me-3"></i>
			  <div>
				<h5 class="card-title mb-1">Tổng số đặt phòng</h5>
				<p class="card-text display-6 mb-0">{{ totalBookings }}</p>
				<small>Xác nhận: {{ confirmedBookings }} | Chờ: {{ pendingBookings }} | Hủy: {{ cancelledBookings }}</small>
			  </div>
			</div>
		  </div>
		</div>
	  </div>

	  <!-- Báo cáo doanh thu -->
	  <div class="row mb-4">
		<div class="col-md-6">
		  <div class="card shadow-sm border-0">
			<div class="card-body">
			  <div class="d-flex justify-content-between align-items-center mb-3">
				<h5 class="card-title text-primary fw-bold mb-0">Báo cáo doanh thu</h5>
				<div class="d-flex align-items-center">
				  <select class="form-select me-2" v-model="revenueFilter" @change="filterRevenue">
					<option value="day">Theo ngày</option>
					<option value="week">Theo tuần</option>
					<option value="month">Theo tháng</option>
					<option value="year">Theo năm</option>
				  </select>
				  <input v-if="revenueFilter === 'day'" type="date" class="form-control" v-model="selectedDate" @change="filterRevenue">
				  <select v-if="revenueFilter === 'month'" class="form-select" v-model="selectedMonth" @change="filterRevenue">
					<option v-for="month in months" :value="month.value" :key="month.value">{{ month.label }}</option>
				  </select>
				  <select v-if="revenueFilter === 'year'" class="form-select" v-model="selectedYear" @change="filterRevenue">
					<option v-for="year in years" :value="year" :key="year">{{ year }}</option>
				  </select>
				</div>
			  </div>
			  <div class="table-responsive">
				<table class="table mb-0 table-hover">
				  <thead class="table-light">
					<tr>
					  <th>Thời gian</th>
					  <th>Doanh thu (VNĐ)</th>
					  <th>Xu hướng</th>
					</tr>
				  </thead>
				  <tbody>
					<tr v-for="(revenue, index) in filteredRevenue" :key="index">
					  <td>{{ revenue.time }}</td>
					  <td>{{ revenue.amount.toLocaleString('vi-VN') }}</td>
					  <td>
						<span v-if="revenue.trend > 0" class="text-success">
						  <i class="bx bx-up-arrow-alt"></i> +{{ revenue.trend }}%
						</span>
						<span v-else-if="revenue.trend < 0" class="text-danger">
						  <i class="bx bx-down-arrow-alt"></i> {{ revenue.trend }}%
						</span>
						<span v-else class="text-muted">
						  <i class="bx bx-minus"></i> 0%
						</span>
					  </td>
					</tr>
					<tr v-if="!filteredRevenue.length">
					  <td colspan="3" class="text-center text-muted">Không có dữ liệu</td>
					</tr>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
		<!-- Doanh thu theo homestay -->
		<div class="col-md-6">
		  <div class="card shadow-sm border-0">
			<div class="card-body">
			  <h5 class="card-title text-primary fw-bold">Doanh thu theo homestay</h5>
			  <div class="table-responsive">
				<table class="table mb-0 table-hover">
				  <thead class="table-light">
					<tr>
					  <th>Homestay</th>
					  <th>Doanh thu (VNĐ)</th>
					  <th>Tỷ lệ</th>
					</tr>
				  </thead>
				  <tbody>
					<tr v-for="(homestay, index) in homestayRevenue" :key="index">
					  <td>{{ homestay.name }}</td>
					  <td>{{ homestay.revenue.toLocaleString('vi-VN') }}</td>
					  <td>
						<div class="progress" style="height: 20px;">
						  <div class="progress-bar bg-info" :style="{ width: homestay.percentage + '%' }">
							{{ homestay.percentage }}%
						  </div>
						</div>
					  </td>
					</tr>
					<tr v-if="!homestayRevenue.length">
					  <td colspan="3" class="text-center text-muted">Không có dữ liệu</td>
					</tr>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	  </div>

	  <!-- Đặt phòng gần đây và Nhân viên hiệu suất cao -->
	  <div class="row">
		<div class="col-md-6 mb-4">
		  <div class="card shadow-sm border-0">
			<div class="card-body">
			  <h5 class="card-title text-primary fw-bold">Đặt phòng gần đây</h5>
			  <div class="table-responsive">
				<table class="table mb-0 table-hover">
				  <thead class="table-light">
					<tr>
					  <th>Mã đặt phòng</th>
					  <th>Khách hàng</th>
					  <th>Homestay</th>
					  <th>Ngày đặt</th>
					  <th>Trạng thái</th>
					</tr>
				  </thead>
				  <tbody>
					<tr v-for="(booking, index) in recentBookings" :key="index">
					  <td>{{ booking.booking_id }}</td>
					  <td>{{ booking.customer }}</td>
					  <td>{{ booking.homestay }}</td>
					  <td>{{ formatDate(booking.date) }}</td>
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
					<tr v-if="!recentBookings.length">
					  <td colspan="5" class="text-center text-muted">Không có dữ liệu</td>
					</tr>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-md-6 mb-4">
		  <div class="card shadow-sm border-0">
			<div class="card-body">
			  <h5 class="card-title text-primary fw-bold">Nhân viên hiệu suất cao</h5>
			  <div class="table-responsive">
				<table class="table mb-0 table-hover">
				  <thead class="table-light">
					<tr>
					  <th>Tên nhân viên</th>
					  <th>Chức vụ</th>
					  <th>Số đặt phòng xử lý</th>
					</tr>
				  </thead>
				  <tbody>
					<tr v-for="(employee, index) in topEmployees" :key="index">
					  <td>{{ employee.name }}</td>
					  <td>{{ employee.position }}</td>
					  <td>{{ employee.bookingsHandled }}</td>
					</tr>
					<tr v-if="!topEmployees.length">
					  <td colspan="3" class="text-center text-muted">Không có dữ liệu</td>
					</tr>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</template>

<script>
export default {
	name: 'Dashboard',
	data() {
		return {
			homestays: [
				{ id: 1, name: 'Bơ Yang homestay', status: 1, bookings: 20, revenue: 30000000 },
				{ id: 2, name: 'Healing homestay', status: 1, bookings: 15, revenue: 22500000 },
				{ id: 3, name: 'Rose homestay', status: 1, bookings: 25, revenue: 37500000 },
				{ id: 4, name: 'TiBi homestay', status: 0, bookings: 10, revenue: 15000000 }
			],
			customers: [
				{ id: 1, username: 'Nguyễn Văn A', created_at: '2025-04-01' },
				{ id: 2, username: 'Trần Thị B', created_at: '2025-04-10' },
				{ id: 3, username: 'Lê Văn C', created_at: '2025-03-15' },
				{ id: 4, username: 'Phạm Thị D', created_at: '2025-02-20' }
			],
			employees: [
				{ id: 1, name: 'Nguyễn Thị An', position: 'Nhân viên lễ tân', bookingsHandled: 15 },
				{ id: 2, name: 'Trần Văn Bình', position: 'Nhân viên lễ tân', bookingsHandled: 10 },
				{ id: 3, name: 'Lê Thị Cẩm', position: 'Nhân viên tạp vụ', bookingsHandled: 5 },
				{ id: 4, name: 'Phạm Văn Đức', position: 'Nhân viên tạp vụ', bookingsHandled: 8 }
			],
			bookings: [
				{ booking_id: 'BK001', customer: 'Nguyễn Văn A', homestay: 'Bơ Yang homestay', total_price: 1500000, date: '2025-04-01', status: 'Confirmed' },
				{ booking_id: 'BK002', customer: 'Trần Thị B', homestay: 'Healing homestay', total_price: 1200000, date: '2025-04-10', status: 'Cancelled' },
				{ booking_id: 'BK003', customer: 'Lê Văn C', homestay: 'Rose homestay', total_price: 1800000, date: '2025-03-15', status: 'Confirmed' },
				{ booking_id: 'BK004', customer: 'Phạm Thị D', homestay: 'TiBi homestay', total_price: 1000000, date: '2025-02-20', status: 'Pending' }
			],
			revenueData: [
				{ time: '2025-04-01', amount: 1500000, prevAmount: 1200000 },
				{ time: '2025-04-10', amount: 1200000, prevAmount: 1000000 },
				{ time: '2025-03-15', amount: 1800000, prevAmount: 2000000 },
				{ time: '2025-02-20', amount: 1000000, prevAmount: 800000 }
			],
			revenueFilter: 'month',
			selectedDate: '2025-04-20',
			selectedMonth: '2025-04',
			selectedYear: '2025',
			months: [
				{ label: 'Tháng 1/2025', value: '2025-01' },
				{ label: 'Tháng 2/2025', value: '2025-02' },
				{ label: 'Tháng 3/2025', value: '2025-03' },
				{ label: 'Tháng 4/2025', value: '2025-04' }
			],
			years: ['2024', '2025'],
			filteredRevenue: []
		};
	},
	computed: {
		totalHomestays() {
			return this.homestays.length;
		},
		activeHomestays() {
			return this.homestays.filter(h => h.status === 1).length;
		},
		inactiveHomestays() {
			return this.homestays.filter(h => h.status === 0).length;
		},
		totalCustomers() {
			return this.customers.length;
		},
		newCustomersThisMonth() {
			return this.customers.filter(c => c.created_at.startsWith('2025-04')).length;
		},
		totalEmployees() {
			return this.employees.length;
		},
		receptionists() {
			return this.employees.filter(e => e.position === 'Nhân viên lễ tân').length;
		},
		housekeepers() {
			return this.employees.filter(e => e.position === 'Nhân viên tạp vụ').length;
		},
		totalBookings() {
			return this.bookings.length;
		},
		confirmedBookings() {
			return this.bookings.filter(b => b.status === 'Confirmed').length;
		},
		pendingBookings() {
			return this.bookings.filter(b => b.status === 'Pending').length;
		},
		cancelledBookings() {
			return this.bookings.filter(b => b.status === 'Cancelled').length;
		},
		homestayRevenue() {
			const totalRevenue = this.homestays.reduce((sum, h) => sum + h.revenue, 0);
			return this.homestays.map(h => ({
				name: h.name,
				revenue: h.revenue,
				percentage: totalRevenue ? Math.round((h.revenue / totalRevenue) * 100) : 0
			}));
		},
		recentBookings() {
			return [...this.bookings].sort((a, b) => new Date(b.date) - new Date(a.date)).slice(0, 5);
		},
		topEmployees() {
			return [...this.employees].sort((a, b) => b.bookingsHandled - a.bookingsHandled).slice(0, 3);
		}
	},
	methods: {
		filterRevenue() {
			this.filteredRevenue = [];
			if (this.revenueFilter === 'day') {
				this.filteredRevenue = this.revenueData
					.filter(item => item.time === this.selectedDate)
					.map(item => ({
						...item,
						trend: this.calculateTrend(item.amount, item.prevAmount)
					}));
			} else if (this.revenueFilter === 'week') {
				const selectedDate = new Date(this.selectedDate);
				const startOfWeek = new Date(selectedDate.setDate(selectedDate.getDate() - selectedDate.getDay()));
				const endOfWeek = new Date(selectedDate.setDate(startOfWeek.getDate() + 6));
				const weekRevenue = this.revenueData.reduce((acc, item) => {
					const itemDate = new Date(item.time);
					if (itemDate >= startOfWeek && itemDate <= endOfWeek) {
						acc.amount += item.amount;
						acc.prevAmount += item.prevAmount;
					}
					return acc;
				}, { time: `Tuần ${this.formatDate(startOfWeek)} - ${this.formatDate(endOfWeek)}`, amount: 0, prevAmount: 0 });
				if (weekRevenue.amount > 0) {
					weekRevenue.trend = this.calculateTrend(weekRevenue.amount, weekRevenue.prevAmount);
					this.filteredRevenue.push(weekRevenue);
				}
			} else if (this.revenueFilter === 'month') {
				const monthRevenue = this.revenueData.reduce((acc, item) => {
					if (item.time.startsWith(this.selectedMonth)) {
						acc.amount += item.amount;
						acc.prevAmount += item.prevAmount;
					}
					return acc;
				}, { time: this.months.find(m => m.value === this.selectedMonth)?.label || this.selectedMonth, amount: 0, prevAmount: 0 });
				if (monthRevenue.amount > 0) {
					monthRevenue.trend = this.calculateTrend(monthRevenue.amount, monthRevenue.prevAmount);
					this.filteredRevenue.push(monthRevenue);
				}
			} else if (this.revenueFilter === 'year') {
				const yearRevenue = this.revenueData.reduce((acc, item) => {
					if (item.time.startsWith(this.selectedYear)) {
						acc.amount += item.amount;
						acc.prevAmount += item.prevAmount;
					}
					return acc;
				}, { time: `Năm ${this.selectedYear}`, amount: 0, prevAmount: 0 });
				if (yearRevenue.amount > 0) {
					yearRevenue.trend = this.calculateTrend(yearRevenue.amount, yearRevenue.prevAmount);
					this.filteredRevenue.push(yearRevenue);
				}
			}
		},
		calculateTrend(current, previous) {
			if (previous === 0) return current > 0 ? 100 : 0;
			return Math.round(((current - previous) / previous) * 100);
		},
		formatDate(date) {
			const d = new Date(date);
			return `${d.getDate().toString().padStart(2, '0')}/${(d.getMonth() + 1).toString().padStart(2, '0')}/${d.getFullYear()}`;
		}
	},
	mounted() {
		this.filterRevenue();
	}
};
</script>

<style scoped>
.container-fluid {
	padding: 20px;
}

h3 {
	font-size: 1.75rem;
}

.card {
	border-radius: 10px;
	transition: transform 0.2s;
}

.card:hover {
	transform: translateY(-5px);
}

.card-title {
	font-size: 1.1rem;
}

.card-text.display-6 {
	font-size: 2rem;
}

.bg-primary {
	background-color: #007bff !important;
}

.bg-success {
	background-color: #28a745 !important;
}

.bg-info {
	background-color: #17a2b8 !important;
}

.bg-warning {
	background-color: #ffc107 !important;
}

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

.table-hover tbody tr:hover {
	background-color: #f8f9fa;
}

.form-select, .form-control {
	max-width: 200px;
}

.progress {
	height: 20px;
}

.progress-bar {
	line-height: 20px;
}

.hover-effect {
	transition: transform 0.2s, box-shadow 0.2s;
}

.hover-effect:hover {
	transform: translateY(-5px);
	box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

small {
	font-size: 0.85rem;
}

@media (max-width: 576px) {
	.form-select, .form-control {
		max-width: 100%;
	}
}
</style>