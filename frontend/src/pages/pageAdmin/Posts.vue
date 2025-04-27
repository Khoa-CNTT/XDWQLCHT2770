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
				  <td>{{ post.title }}</td>
				  <td v-html="truncateContent(post.content, 50)"></td>
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
	  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Thêm bài viết mới</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<div>
			  <label class="mt-2">Tiêu đề</label>
			  <input type="text" class="form-control" v-model="newPost.title" placeholder="Nhập tiêu đề bài viết">
				<div class="mb-3">
				  <label class="mt-2">Nội dung</label>
				  <div id="newPostEditor" class="editor-container"></div>
				</div>
				<div class="mb-3">
				  <label class="mt-2">Tình trạng</label>
				  <select class="form-select" v-model="newPost.status" aria-label="Default select example">
					<option value="" disabled>Chọn tình trạng</option>
					<option value="1">Công khai</option>
					<option value="0">Nháp</option>
				  </select>
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
	  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
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
			  <div id="editPostEditor" class="editor-container"></div>
			  <label class="mt-2">Tình trạng</label>
			  <select class="form-select" v-model="selectedPost.status" aria-label="Default select example">
				<option value="" disabled>Chọn tình trạng</option>
				<option value="1">Công khai</option>
				<option value="0">Nháp</option>
			  </select>
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
import Quill from 'quill';
import 'quill/dist/quill.snow.css';
import axios from 'axios';

export default {
	name: 'PostManagement',
	data() {
		return {
			searchQuery: '',
			newPostEditor: null,
			editPostEditor: null,
			listPosts: [
				{
					id: 1,
					title: 'Khám phá Đà Lạt mùa hoa mai anh đào',
					content: '<p>Đà Lạt mùa hoa mai anh đào luôn là điểm đến hấp dẫn với du khách. Những con đường ngập sắc hồng...</p>',
					created_at: '2025-04-01',
					status: 1,
				},
				{
					id: 2,
					title: 'Top 5 homestay đẹp tại Sơn Trà',
					content: '<p>Sơn Trà nổi tiếng với những homestay view biển tuyệt đẹp. Dưới đây là danh sách 5 homestay đáng trải nghiệm...</p>',
					created_at: '2025-03-25',
					status: 1,
				},
				{
					id: 3,
					title: 'Hành trình khám phá ẩm thực Đà Nẵng',
					content: '<p>Ẩm thực Đà Nẵng là sự kết hợp hài hòa giữa hương vị miền Trung và sự sáng tạo...</p>',
					created_at: '2025-03-15',
					status: 0,
				},
				{
					id: 4,
					title: 'Cẩm nang du lịch Hội An',
					content: '<p>Hội An - thành phố cổ kính với những con phố lồng đèn rực rỡ, là điểm đến không thể bỏ qua...</p>',
					created_at: '2025-02-20',
					status: 1,
				},
			],
			selectedPost: {
				id: null,
				title: '',
				content: '',
				created_at: '',
				status: ''
			},
			newPost: {
				id: null,
				title: '',
				content: '',
				created_at: '',
				status: ''
			}
		};
	},
	computed: {
		filteredPosts() {
			if (!this.searchQuery) {
				return this.listPosts;
			}
			const query = this.searchQuery.toLowerCase();
			return this.listPosts.filter(post => {
				const textContent = this.stripHtml(post.content).toLowerCase();
				return post.title.toLowerCase().includes(query) || textContent.includes(query);
			});
		}
	},
	methods: {
		initializeQuillEditors() {
			this.newPostEditor = new Quill('#newPostEditor', {
				theme: 'snow',
				modules: {
					toolbar: [
						[{ 'header': [1, 2, 3, false] }],
						['bold', 'italic', 'underline'],
						[{ 'list': 'ordered'}, { 'list': 'bullet' }],
						['link', 'image'],
						['clean']
					]
				}
			});
			this.editPostEditor = new Quill('#editPostEditor', {
				theme: 'snow',
				modules: {
					toolbar: [
						[{ 'header': [1, 2, 3, false] }],
						['bold', 'italic', 'underline'],
						[{ 'list': 'ordered'}, { 'list': 'bullet' }],
						['link', 'image'],
						['clean']
					]
				}
			});
			this.newPostEditor.on('text-change', () => {
				this.newPost.content = this.newPostEditor.root.innerHTML;
			});
			this.editPostEditor.on('text-change', () => {
				this.selectedPost.content = this.editPostEditor.root.innerHTML;
			});
			this.addImageHandler(this.newPostEditor);
			this.addImageHandler(this.editPostEditor);
		},
		addImageHandler(quill) {
			const toolbar = quill.getModule('toolbar');
			toolbar.addHandler('image', () => {
				const input = document.createElement('input');
				input.setAttribute('type', 'file');
				input.setAttribute('accept', 'image/*');
				input.click();
				input.onchange = async () => {
					const file = input.files[0];
					if (file) {
						try {
							const imageUrl = await this.uploadImage(file);
							const range = quill.getSelection();
							quill.insertEmbed(range.index, 'image', imageUrl);
						} catch (error) {
							alert('Lỗi khi tải ảnh lên!');
							console.error(error);
						}
					}
				};
			});
		},
		async uploadImage(file) {
			const formData = new FormData();
			formData.append('image', file);
			try {
				const response = await axios.post('http://localhost:3000/api/upload-image', formData, {
					headers: { 'Content-Type': 'multipart/form-data' }
				});
				return response.data.url;
			} catch (error) {
				throw new Error('Không thể tải ảnh lên');
			}
		},
		async addPost() {
			if (!this.newPost.title || !this.newPost.content) {
				alert('Vui lòng nhập đầy đủ thông tin!');
				return;
			}
			try {
				const response = await axios.post('http://localhost:3000/api/posts', this.newPost);
				this.listPosts.push({
					...this.newPost,
					id: response.data.id,
					created_at: new Date().toISOString().split('T')[0]
				});
				this.newPost = {
					id: null,
					title: '',
					content: '',
					created_at: '',
					status: ''
				};
				this.newPostEditor.setContents([]);
				$('#exampleScrollableModal').modal('hide');
			} catch (error) {
				alert('Lỗi khi thêm bài viết!');
				console.error(error);
			}
		},
		editPost(post) {
			this.selectedPost = { ...post };
			this.$nextTick(() => {
				this.editPostEditor.setContents([]);
				this.editPostEditor.clipboard.dangerouslyPasteHTML(post.content);
			});
		},
		async savePost() {
			try {
				await axios.put(`http://localhost:3000/api/posts/${this.selectedPost.id}`, this.selectedPost);
				const index = this.listPosts.findIndex(p => p.id === this.selectedPost.id);
				if (index !== -1) {
					this.listPosts.splice(index, 1, { ...this.selectedPost });
				}
				this.selectedPost = {
					id: null,
					title: '',
					content: '',
					created_at: '',
					status: ''
				};
				this.editPostEditor.setContents([]);
				$('#suaScrollableModal').modal('hide');
			} catch (error) {
				alert('Lỗi khi cập nhật bài viết!');
				console.error(error);
			}
		},
		async deletePost(id) {
			if (confirm('Bạn có chắc chắn muốn xóa bài viết này?')) {
				try {
					await axios.delete(`http://localhost:3000/api/posts/${id}`);
					this.listPosts = this.listPosts.filter(post => post.id !== id);
				} catch (error) {
					alert('Lỗi khi xóa bài viết!');
					console.error(error);
				}
			}
		},
		truncateContent(content, maxLength) {
			const textContent = this.stripHtml(content);
			if (textContent.length <= maxLength) return content;
			return textContent.substring(0, maxLength) + '...';
		},
		stripHtml(html) {
			const div = document.createElement('div');
			div.innerHTML = html;
			return div.textContent || div.innerText || '';
		},
		formatDate(date) {
			const d = new Date(date);
			return `${d.getDate().toString().padStart(2, '0')}/${(d.getMonth() + 1).toString().padStart(2, '0')}/${d.getFullYear()}`;
		},
		async fetchPosts() {
			try {
				const response = await axios.get('http://localhost:3000/api/posts');
				this.listPosts = response.data;
			} catch (error) {
				console.error('Lỗi khi tải danh sách bài viết:', error);
			}
		}
	},
	mounted() {
		this.initializeQuillEditors();
		this.fetchPosts();
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
.editor-container {
	min-height: 300px;
	border: 1px solid #ced4da;
	border-radius: 4px;
}
.editor-container .ql-editor {
	min-height: 250px;
}
.modal-fullscreen .modal-content {
	height: 100vh;
}
.modal-fullscreen .modal-body {
	padding: 2rem;
}
.modal-fullscreen .form-control,
.modal-fullscreen .form-select {
	max-width: 100%;
}
</style>