<template>
	<div class="container-fluid">
	  <!-- Tiêu đề Dashboard -->
	  <h3 class="mb-4 text-primary fw-bold">Dashboard Quản Lý Homestay</h3>

	  <!-- Thống kê tổng quan -->
	  <div class="row mb-4">
		<div class="col-md-3 col-sm-6 mb-3">
		  <div class="card shadow-sm border-0 text-white  hover-effect" style="background-color: #132e63;">
			<div class="card-body d-flex align-items-center">
			  <i class="bx bx-home-alt fs-2 me-3"></i>
			  <div>
				<h5 class="card-title mb-1 text-white">Tổng số homestay</h5>
				<p class="card-text display-6 mb-0">{{ stats.homestays.soluong }}</p>
				<small>Hoạt động: {{ stats.homestays.hd }} | Ngừng: {{ stats.homestays.nhd }}</small>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
		  <div class="card shadow-sm border-0 text-white hover-effect" style="background-color: #132e63;">
			<div class="card-body d-flex align-items-center">
			  <i class="bx bx-user fs-2 me-3"></i>
			  <div>
				<h5 class="card-title mb-1 text-white">Tổng khách hàng</h5>
				<p class="card-text display-6 mb-0">{{ stats.khach_hangs.soluong}}</p>
				<small>Khách mới tháng này: {{ stats.khach_hangs.new }}</small>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
		  <div class="card shadow-sm border-0 text-white hover-effect" style="background-color: #132e63;">
			<div class="card-body d-flex align-items-center">
				<i class="fa-solid fa-circle-dollar-to-slot fs-2 me-3"></i>
			  <div>
				<h5 class="card-title mb-1 text-white">Tổng doanh thu</h5>
				<p class="card-text display-6 mb-0">{{ stats.doanhthu.total }}</p>
				
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-6 mb-3">
		  <div class="card shadow-sm border-0 text-white  hover-effect" style="background-color: #132e63;">
			<div class="card-body d-flex align-items-center">
			  <i class="bx bx-calendar-check fs-2 me-3"></i>
			  <div>
				<h5 class="card-title mb-1 text-white">Tổng số đặt phòng</h5>
				<p class="card-text display-6 mb-0">{{ stats.datphong.so_luong}}</p>
				<small>Xác nhận: {{ confirmedBookings }} | Chờ: {{ pendingBookings }} | Hủy: {{ cancelledBookings }}</small>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<BarChart/>
			</div>
		</div>
	</div>
</div>
	 


	
	</div>
</template>

<script>
import BarChart from '../../components/Admin/testChart.vue';
import baseRequest from '../../core/baseRequest';
export default {
	name: 'App',
	components: {
		BarChart
	},
	data() {
		return {
			stats: {
				homestays: {
					soluong: 0,
					hd: 0,
					nhd: 0
				},
				khach_hangs: {
					soluong: 0,
					new: 0
				},
				datphong: {
					so_luong:null,
				},
				doanhthu:{total:null
				}
				
			},
			
		};
	},
	computed: {
	},
	methods: {
		getstats (){
			baseRequest.get('/admin/dashboard/stats')
			.then(response => {
				this.stats = response.data;
			})
			.catch(error => {
				console.error('Error fetching stats:', error);
			});
		}
		
	},
	mounted() {
		this.getstats();
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