<template>
	<div class="card">
	  <div class="card-body">
		<div class="d-lg-flex justify-content-between mb-4">
		  <div class="position-relative">
			<input type="text" class="form-control ps-5 radius-30" v-model="searchQuery" placeholder="Tìm bài viết">
			<span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
		  </div>
		  <div class="d-flex">
			<button class="btn btn-primary radius-30 mt-2 mt-lg-0 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal">
			  <i class="bx bxs-plus-square"></i> Thêm bài viết mới
			</button>
		  </div>
		</div>
		<div class="table-responsive">
		  <table class="table mb-0">
			<thead class="table-light">
			  <tr class="align-middle">
				<th>ID#</th>
				<th>Ảnh</th>
				<th>Tiêu đề</th>
				<th>Nội dung</th>
				<th>Ngày đăng</th>
				<th>Tình trạng</th>
				<th>Actions</th>
			  </tr>
			</thead>
			<tbody>
			  <template v-for="(post, index) in filteredPosts" :key="index">
				<tr class="align-middle">
				  <td>
					<div class="ms-2">
					  <h6 class="mb-0 font-14">{{ post.id }}</h6>
					</div>
				  </td>
				  <td><img :src="post.image" class="" style="height:100px;width:100px; object-fit:cover" alt="" /></td>
				  <td>{{ post.title }}</td>
				  <td>{{ truncateContent(post.content, 50) }}</td>
				  <td>{{ formatDate(post.created_at) }}</td>
				  <td>
					<span v-if="post.status === 1" class="badge rounded-pill text-success bg-light-success p-2">
					  <i class="bx bxs-circle me-1"></i>
					  Công khai
					</span>
					<span v-else class="badge rounded-pill text-danger bg-light-danger p-2">
					  <i class="bx bxs-circle me-1"></i>
					  Nháp
					</span>
				  </td>
				  <td>
					<div class="d-flex order-actions">
					  <a @click="editPost(post)" data-bs-toggle="modal" data-bs-target="#suaScrollableModal" class=""><i class="bx bxs-edit"></i></a>
					  <a href="javascript:;" class="ms-3" @click="deletePost(post.id)"><i class="bx bxs-trash"></i></a>
					</div>
				  </td>
				</tr>
			  </template>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
	<!-- Modal Thêm bài viết -->
	<div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Thêm bài viết mới</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div>
			  <label class="mt-2">Tiêu đề</label>
			  <input type="text" class="form-control" v-model="newPost.title" placeholder="Nhập tiêu đề bài viết">
			  <label class="mt-2">Nội dung</label>
			  <textarea class="form-control" v-model="newPost.content" placeholder="Nhập nội dung bài viết"></textarea>
			  <label class="mt-2">Tình trạng</label>
			  <select class="form-select" v-model="newPost.status" aria-label="Default select example">
				<option value="" disabled>Chọn tình trạng</option>
				<option value="1">Công khai</option>
				<option value="0">Nháp</option>
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
			<button type="button" class="btn btn-primary" @click="addPost">Thêm</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- Modal Sửa bài viết -->
	<div class="modal fade" id="suaScrollableModal" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Sửa thông tin bài viết</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div>
			  <label class="mt-2">Tiêu đề</label>
			  <input type="text" class="form-control" v-model="selectedPost.title" placeholder="Nhập tiêu đề bài viết">
			  <label class="mt-2">Nội dung</label>
			  <textarea class="form-control" v-model="selectedPost.content" placeholder="Nhập nội dung bài viết"></textarea>
			  <label class="mt-2">Tình trạng</label>
			  <select class="form-select" v-model="selectedPost.status" aria-label="Default select example">
				<option value="" disabled>Chọn tình trạng</option>
				<option value="1">Công khai</option>
				<option value="0">Nháp</option>
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
			<button type="button" class="btn btn-primary" @click="savePost">Lưu</button>
		  </div>
		</div>
	  </div>
	</div>
</template>

<script>
export default {
	name: 'PostManagement',
	data() {
		return {
			searchQuery: '',
			mainImage: null,
			mainImageName: '',
			mainImageSet: false,
			listPosts: [
				{
					id: 1,
					title: 'Khám phá Đà Lạt mùa hoa mai anh đào',
					content: 'Đà Lạt mùa hoa mai anh đào luôn là điểm đến hấp dẫn với du khách. Những con đường ngập sắc hồng...',
					created_at: '2025-04-01',
					status: 1,
					image: 'https://i.pinimg.com/474x/ac/bb/de/acbbde00d2c652f55f5b993a41a0387d.jpg',
				},
				{
					id: 2,
					title: 'Top 5 homestay đẹp tại Sơn Trà',
					content: 'Sơn Trà nổi tiếng với những homestay view biển tuyệt đẹp. Dưới đây là danh sách 5 homestay đáng trải nghiệm...',
					created_at: '2025-03-25',
					status: 1,
					image: 'https://i.pinimg.com/474x/29/99/e5/2999e5d1fc2a2227c56497c69d869d01.jpg',
				},
				{
					id: 3,
					title: 'Hành trình khám phá ẩm thực Đà Nẵng',
					content: 'Ẩm thực Đà Nẵng là sự kết hợp hài hòa giữa hương vị miền Trung và sự sáng tạo...',
					created_at: '2025-03-15',
					status: 0,
					image: 'https://i.pinimg.com/474x/8b/99/90/8b999091298d0e2d376d2e5fdd2a3e53.jpg',
				},
				{
					id: 4,
					title: 'Cẩm nang du lịch Hội An',
					content: 'Hội An - thành phố cổ kính với những con phố lồng đèn rực rỡ, là điểm đến không thể bỏ qua...',
					created_at: '2025-02-20',
					status: 1,
					image: 'https://i.pinimg.com/474x/e8/50/a2/e850a2270c2ae0969c89d50703b90a77.jpg',
				},
			],
			selectedPost: {
				id: null,
				title: '',
				content: '',
				created_at: '',
				status: '',
				image: ''
			},
			newPost: {
				id: null,
				title: '',
				content: '',
				created_at: '',
				status: '',
				image: ''
			}
		};
	},
	computed: {
		filteredPosts() {
			if (!this.searchQuery) {
				return this.listPosts;
			}
			const query = this.searchQuery.toLowerCase();
			return this.listPosts.filter(post =>
				post.title.toLowerCase().includes(query) ||
				post.content.toLowerCase().includes(query)
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
				if (this.selectedPost.id) {
					this.selectedPost.image = imageUrl;
				} else {
					this.newPost.image = imageUrl;
				}
			}
		},
		removeMainImage() {
			this.mainImage = null;
			this.mainImageName = '';
			this.mainImageSet = false;
			if (this.selectedPost.id) {
				this.selectedPost.image = '';
			} else {
				this.newPost.image = '';
			}
		},
		addPost() {
			if (!this.newPost.title || !this.newPost.content) {
				alert('Vui lòng nhập đầy đủ thông tin!');
				return;
			}
			const newId = this.listPosts.length ? Math.max(...this.listPosts.map(p => p.id)) + 1 : 1;
			this.listPosts.push({
				...this.newPost,
				id: newId,
				created_at: new Date().toISOString().split('T')[0],
				status: parseInt(this.newPost.status) || 0
			});
			this.newPost = {
				id: null,
				title: '',
				content: '',
				created_at: '',
				status: '',
				image: ''
			};
			this.mainImage = null;
			this.mainImageName = '';
			this.mainImageSet = false;
			$('#exampleScrollableModal').modal('hide');
		},
		editPost(post) {
			this.selectedPost = { ...post };
			this.mainImageSet = !!post.image;
			this.mainImageName = post.image ? 'Hình ảnh hiện tại' : '';
		},
		savePost() {
			const index = this.listPosts.findIndex(p => p.id === this.selectedPost.id);
			if (index !== -1) {
				this.listPosts.splice(index, 1, {
					...this.selectedPost,
					status: parseInt(this.selectedPost.status)
				});
			}
			this.selectedPost = {
				id: null,
				title: '',
				content: '',
				created_at: '',
				status: '',
				image: ''
			};
			this.mainImage = null;
			this.mainImageName = '';
			this.mainImageSet = false;
			$('#suaScrollableModal').modal('hide');
		},
		deletePost(id) {
			const confirmDelete = confirm('Bạn có chắc chắn muốn xóa bài viết này?');
			if (confirmDelete) {
				this.listPosts = this.listPosts.filter(post => post.id !== id);
			}
		},
		truncateContent(content, maxLength) {
			if (content.length <= maxLength) return content;
			return content.substring(0, maxLength) + '...';
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