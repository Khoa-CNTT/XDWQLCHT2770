<template>
	<div class="card">
	  <div class="card-body">
		<!-- Tìm kiếm & lọc -->
		<div class="d-lg-flex justify-content-between mb-4">
		  <div class="position-relative">
			<input type="text" class="form-control ps-5 radius-30" placeholder="Tìm đánh giá" v-model="searchQuery" />
			<span class="position-absolute top-50 product-show translate-middle-y">
			  <i class="bx bx-search"></i>
			</span>
		  </div>
  
		  <div class="d-flex">
			<select v-model="filterStatus" class="form-select form-select-sm radius-30 mt-2 mt-lg-0" style="width:fit-content;">
			  <option value="">Trạng thái</option>
			  <option value="1">Hiện</option>
			  <option value="0">Ẩn</option>
			</select>
		  </div>
		</div>
  
		<!-- Danh sách đánh giá -->
		<div class="table-responsive">
		  <table class="table mb-0">
			<thead class="table-light">
			  <tr>
				<th>ID#</th>
				<th>Khách hàng</th>
				<th>Homestay</th>
				<th>Phòng</th>
				<th>Nội dung</th>
				<th>Số sao</th>
				<th>Ngày đánh giá</th>
				<th>Trạng thái</th>
				<th>Actions</th>
			  </tr>
			</thead>
			<tbody>
			  <tr v-for="review in filteredReviews" :key="review.id">
				<td>
				  <div class="ms-2">
					<h6 class="mb-0 font-14">#{{ review.id }}</h6>
				  </div>
				</td>
				<td>{{ review.customer_name }}</td>
				<td>{{ review.homestay }}</td>
				<td>{{ review.room }}</td>
				<td>{{ truncateContent(review.content, 50) }}</td>
				<td>
				  <div class="d-flex">
					<i v-for="n in 5" :key="n" class="bx" :class="n <= review.rating ? 'bxs-star text-warning' : 'bx-star text-muted'"></i>
				  </div>
				</td>
				<td>{{ formatDate(review.created_at) }}</td>
				<td>
				  <span :class="{
					'badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3': review.status === 1,
					'badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3': review.status === 0
				  }">
					<i class="bx bxs-circle me-1"></i>
					{{ review.status === 1 ? 'Hiện' : 'Ẩn' }}
				  </span>
				</td>
				<td>
				  <div class="d-flex order-actions">
					<a href="javascript:;" @click="viewReviewDetails(review)" data-bs-toggle="modal" data-bs-target="#modalReviewDetails">
					  <i class="bx bx-detail"></i>
					</a>
					<a href="javascript:;" class="ms-3" @click="toggleReviewStatus(review)">
					  <i class="bx" :class="review.status === 1 ? 'bxs-lock' : 'bxs-lock-open'" :title="review.status === 1 ? 'Hủy duyệt' : 'Duyệt'"></i>
					</a>
					<a href="javascript:;" class="ms-3" @click="deleteReview(review.id)">
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

	<!-- Modal Chi Tiết Đánh Giá -->
	<div class="modal fade" id="modalReviewDetails" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Chi Tiết Đánh Giá - {{ selectedReview?.customer_name }}</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div class="row">
			  <div class="col-md-6">
				<h6 class="text-primary fw-bold">Thông Tin Đánh Giá</h6>
				<div class="mb-2">
				  <label class="fw-bold">Khách hàng:</label>
				  <span class="ms-2">{{ selectedReview?.customer_name || 'N/A' }}</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Homestay:</label>
				  <span class="ms-2">{{ selectedReview?.homestay || 'N/A' }}</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Phòng:</label>
				  <span class="ms-2">{{ selectedReview?.room || 'N/A' }}</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Số sao:</label>
				  <span class="ms-2">
					<i v-for="n in 5" :key="n" class="bx" :class="n <= selectedReview?.rating ? 'bxs-star text-warning' : 'bx-star text-muted'"></i>
				  </span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Ngày đánh giá:</label>
				  <span class="ms-2">{{ formatDate(selectedReview?.created_at) || 'N/A' }}</span>
				</div>
				<div class="mb-2">
				  <label class="fw-bold">Trạng thái:</label>
				  <span class="ms-2" :class="{
					'badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3': selectedReview?.status === 1,
					'badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3': selectedReview?.status === 0
				  }">
					<i class="bx bxs-circle me-1"></i>
					{{ selectedReview?.status === 1 ? 'Đã duyệt' : 'Chưa duyệt' }}
				  </span>
				</div>
			  </div>
			  <div class="col-md-6">
				<h6 class="text-primary fw-bold">Nội Dung Đánh Giá</h6>
				<div class="border p-3 rounded">
				  <p>{{ selectedReview?.content || 'Không có nội dung' }}</p>
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
	name: 'ReviewManagement',
	data() {
	  return {
		searchQuery: '',
		filterStatus: '',
		selectedReview: null,
		reviews: [
		  {
			id: 'RV001',
			customer_name: 'Nguyễn Văn A',
			homestay: 'Bơ Yang',
			room: 'Gaspur Antunes',
			content: 'Phòng rất sạch sẽ, nhân viên thân thiện, view đẹp, sẽ quay lại lần sau!',
			rating: 5,
			created_at: '2025-04-01',
			status: 1
		  },
		  {
			id: 'RV002',
			customer_name: 'Trần Thị B',
			homestay: 'Healing',
			room: 'Sunset Villa',
			content: 'Phòng hơi nhỏ so với kỳ vọng, nhưng dịch vụ tốt, giá cả hợp lý.',
			rating: 4,
			created_at: '2025-04-10',
			status: 0
		  },
		  {
			id: 'RV003',
			customer_name: 'Lê Văn C',
			homestay: 'Rosie',
			room: 'Rose Garden',
			content: 'Không gian yên tĩnh, nhưng wifi hơi yếu, cần cải thiện thêm.',
			rating: 3,
			created_at: '2025-03-15',
			status: 1
		  },
		  {
			id: 'RV004',
			customer_name: 'Phạm Thị D',
			homestay: 'Bơ Yang',
			room: 'Gaspur Antunes',
			content: 'Trải nghiệm tuyệt vời, phòng đẹp, nhân viên nhiệt tình!',
			rating: 5,
			created_at: '2025-02-20',
			status: 0
		  }
		]
	  };
	},
	computed: {
	  filteredReviews() {
		let result = [...this.reviews];
  
		if (this.searchQuery) {
		  result = result.filter(r =>
			r.customer_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
			r.homestay.toLowerCase().includes(this.searchQuery.toLowerCase())
		  );
		}
  
		if (this.filterStatus !== '') {
		  result = result.filter(r => r.status === parseInt(this.filterStatus));
		}
  
		return result;
	  }
	},
	methods: {
	  truncateContent(content, maxLength) {
		if (content.length <= maxLength) return content;
		return content.substring(0, maxLength) + '...';
	  },
	  formatDate(date) {
		if (!date) return '';
		const d = new Date(date);
		return `${d.getDate().toString().padStart(2, '0')}/${(d.getMonth() + 1).toString().padStart(2, '0')}/${d.getFullYear()}`;
	  },
	  viewReviewDetails(review) {
		this.selectedReview = review;
	  },
	  toggleReviewStatus(review) {
		const index = this.reviews.findIndex(r => r.id === review.id);
		if (index !== -1) {
		  this.reviews[index].status = review.status === 1 ? 0 : 1;
		}
	  },
	  deleteReview(id) {
		if (confirm('Bạn có chắc muốn xóa đánh giá này?')) {
		  this.reviews = this.reviews.filter(review => review.id !== id);
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
.bg-light-warning {
  background-color: #fff3cd;
}
.text-warning {
  color: #ffc107;
}
.table-hover tbody tr:hover {
  background-color: #f8f9fa;
}
.border {
  border: 1px solid #dee2e6;
}
</style>