```vue
<template>
  <div class="container py-4">
    <div v-if="baiViet">
      <h2 class="fw-bold mb-4">{{ baiViet.tieu_de }}</h2>
      
      <p><strong>Ngày đăng:</strong> {{ dinhDangNgay(baiViet.ngay_tao) }}</p>
   
     
      <hr>
      <div v-html="baiViet.noi_dung" class="noi-dung-chi-tiet"></div>
      <button class="btn btn-secondary mt-4" @click="$router.go(-1)">Quay lại</button>
    </div>
    <div v-else>
      <p>Đang tải bài viết...</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ChiTietBaiViet',
  props: ['id'],
  data() {
    return {
      baiViet: null,
      urlBackend: 'http://127.0.0.1:8000'
    };
  },
  methods: {
    async layChiTietBaiViet() {
      try {
        const response = await axios.get(`${this.urlBackend}/api/bai_viets/chi-tiet/${this.id}`);
        this.baiViet = response.data.du_lieu;
      } catch (error) {
        const thongBao = error.response?.data?.thong_bao || error.message || 'Lỗi không xác định';
        alert(`Không thể tải chi tiết bài viết: ${thongBao}`);
        console.error('Lỗi khi tải chi tiết bài viết:', error);
      }
    },
    dinhDangNgay(ngay) {
      const d = new Date(ngay);
      return `${d.getDate().toString().padStart(2, '0')}/${(d.getMonth() + 1).toString().padStart(2, '0')}/${d.getFullYear()}`;
    }
  },
  mounted() {
    this.layChiTietBaiViet();
  }
};
</script>

<style scoped>
.noi-dung-chi-tiet {
  max-width: 100%;
}
.noi-dung-chi-tiet img {
  max-width: 100% !important;
  height: auto !important;
}
</style>
```