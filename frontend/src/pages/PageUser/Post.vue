<template>
  <div class="container py-4">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img style="width:100%; height: 650px; object-fit: cover;"
            src="https://mia.vn/media/uploads/blog-du-lich/homestay-da-nang-22-1701757275.jpg" class="d-block w-100"
            alt="...">
        </div>
        <div class="carousel-item">
          <img style="width:100%; height:650px; object-fit: cover;"
            src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(15).jpg" class="d-block w-100" alt="homestay danang">
        </div>
        <div class="carousel-item">
          <img style="width:100%; height:650px; object-fit: cover;"
            src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(5).jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="row mt-5 ">
      <!-- Danh sách bài viết chính -->
      <div class="col-lg-8">
        <!-- Bài viết 1 -->
        <a>
          <div class="d-flex mb-4 border-bottom pb-3">
            <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(8).jpg" class="me-3"
              alt="Homestay Đà Nẵng" style="width: 170px;">
            <div>
              <h6 class="fw-bold">Top 5 Homestay Đà Nẵng gần biển đẹp nhất</h6>
              <p class="mb-0 text-muted">Trải nghiệm không gian gần biển với thiết kế hiện đại, chỉ cách
                cầu Rồng và chợ đêm vài bước chân. Phù hợp cho cả nghỉ dưỡng và làm việc từ xa.</p>
            </div>
          </div>
        </a>
        <!-- Bài viết 2 -->
        <div class="d-flex mb-4 border-bottom pb-3">
          <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(8).jpg" class="me-3" alt="Homestay Hội An"
            style="width: 170px;">
          <div>
            <h6 class="fw-bold">Homestay Đà nẵng, giá tốt cho cặp đôi</h6>
            <p class="mb-0 text-muted">Ẩn mình giữa lòng phố cổ, các homestay tại Hội An mang vẻ đẹp lãng
              mạn, phù hợp với cặp đôi muốn tìm kiếm không gian yên bình và riêng tư.</p>
          </div>
        </div>
        <!-- Bài viết 3 -->
        <div class="d-flex mb-4 border-bottom pb-3">
          <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(9).jpg" class="me-3" alt="Homestay Đà Nẵng"
            style="width: 170px;">
          <div>
            <h6 class="fw-bold">Homestay Đà Nẵng cho nhóm bạn</h6>
            <p class="mb-0 text-muted">Không gian rộng rãi, nhiều tiện ích giải trí và phòng riêng. Lựa chọn
              lý tưởng cho hội nhóm muốn tận hưởng kỳ nghỉ trọn vẹn.</p>
          </div>
        </div>
        <!-- Bài viết 4 -->
        <div class="d-flex mb-4 border-bottom pb-3">
          <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(10).jpg" class="me-3"
            alt="Workation Homestay" style="width: 170px;">
          <div>
            <h6 class="fw-bold">Homestay Đà Nẵng lý tưởng cho Workation</h6>
            <p class="mb-0 text-muted">Yên tĩnh, có bàn làm việc, wifi mạnh, gần quán cà phê và bãi biển –
              hoàn hảo cho những ai muốn vừa làm việc vừa thư giãn.</p>
          </div>
        </div>
        <!-- Bài viết 5 -->
        <div class="d-flex mb-4 border-bottom pb-3">
          <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(11).jpg" class="me-3" alt="Mẹo đặt homestay"
            style="width: 170px;">
          <div>
            <h6 class="fw-bold">5 Mẹo đặt homestay giá tốt tại Đà Nẵng</h6>
            <p class="mb-0 text-muted">Chọn thời điểm đặt phòng, sử dụng voucher và ưu đãi theo mùa là những
              bí quyết giúp bạn tiết kiệm chi phí hiệu quả.</p>
          </div>
        </div>
      </div>

      <!-- Sidebar Bài viết mới -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header ">
            <h6 class="fw-bold   p-2">BÀI VIẾT MỚI</h6>
          </div>
          <div class="card-body">
            <div class="d-flex mb-3">
              <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(5).jpg" class="me-2"
                alt="Top 5 Homestay" style="width: 100px;">
              <small>Top 5 Homestay Đà Nẵng gần biển đẹp nhất</small>
            </div>

            <div class="d-flex mb-3">
              <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(6).jpg" class="me-2"
                alt="Homestay Hội An" style="width: 100px;">
              <small>Homestay Đẵng nẵng, giá tốt cho cặp đôi</small>
            </div>

            <div class="d-flex mb-3">
              <img
                src="https://media.vov.vn/sites/default/files/styles/large_watermark/public/2024-03/luong_khach_den_tham_quan_va_trai_nghiem_tai_diem_du_lich_cua_anh_dinh_van_khoa_ngay_cang_dong.jpg"
                class="me-2" alt="Workation Homestay" style="width: 100px;">
              <small>Homestay lý tưởng cho làm việc từ xa (Workation)</small>
            </div>

            <div class="d-flex mb-3">
              <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(15).jpg" class="me-2"
                alt="Mẹo đặt homestay" style="width: 100px;">
              <small>5 Mẹo đặt homestay giá tốt tại Đà Nẵng</small>
            </div>
          </div>
        </div>
        <div class="mt-5">
          <div class="card">
            <div class="card-header ">
              <h6 class="fw-bold  p-2">Bài Viết Nổi Bật</h6>
            </div>
            <div class="card-body">
              <div class="d-flex mb-3">
                <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(1).jpg" class="me-3" alt="Zozi Coffee"
                  style="width: 90px;">
                <small>1986 Homestay – Phong cách vintage, góc sống ảo siêu chất, gần biển Mỹ Khê.</small>
              </div>

              <div class="d-flex mb-3">
                <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(1).jpg" class="me-3" alt="Yenday"
                  style="width: 90px;">
                <small>Yenday Cafe – Tiệm cafe xinh đẹp và ấm cúng giữa lòng thành phố</small>
              </div>

              <div class="d-flex">
                <img src="https://dsdhome.vn/uploads/products/homestay-da-nang%20(14).jpg" class="me-3" alt="Xóm Mèo"
                  style="width: 90px;">
                <small>Xóm Mèo Coffee – Thiên đường mà team CON SEN ở Đà Nẵng không thể bỏ qua</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
</template>
<script>
export default {
  mounted() {
  const carouselElement = document.getElementById('carouselExampleFade')
  if (carouselElement) {
    new bootstrap.Carousel(carouselElement, {
      interval: 4000,
      ride: 'carousel',
      pause: false
    })
  }
}

}
</script>
<style></style>