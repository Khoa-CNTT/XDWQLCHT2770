<template >
  <div class="container">
    <SearchRoom class="my-5"></SearchRoom>
    <div class="d-flex pb-3 justify-content-between">
      <span class="fs-4">Đà Nẵng | Hiện thị 555 kết quả</span>
      <div class="">
        <!-- Button trigger modal -->
        <button
          type="button"
          class="btn btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#exampleModal"
        >
          Bộ lọc
        </button>
        <!-- Modal -->
        <div
          class="modal fade"
          id="exampleModal"
          tabindex="-1"
          aria-labelledby="exampleModalLabel"
          style="display: none"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bộ lọc</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
                <button type="button" class="btn btn-primary">
                  Save changes
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div
          class="card mb-3 shadow-sm border-0 rounded-4"
          style="max-width: 100%"
        >
          <div class="row g-0">
            <!-- Ảnh -->
            <div class="col-md-4 position-relative">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="  h-100 w-100 radius-30"
                style="object-fit: cover;"
                alt="homestay"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  background-color: white;
                  padding: 5px;

                  border-radius: 50%;
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 1rem;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
            </div>

            <!-- Nội dung -->
            <div class="col-md-8">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <h5 class="card-title fw-bold mb-1" style="color: #003087;">
                    Doha Central Bliss Danang Hotel by Haviland
                  </h5>
                  <div class="text-end">
                    <div class="badge bg-primary text-white">9.2</div>
                    <div class="small text-muted">
                      Tuyệt hảo<br /><span class="fw-normal">310 đánh giá</span>
                    </div>
                  </div>
                </div>

                <p class="mb-1 text-decoration-underline text-muted small">
                  Trung tâm Thành phố Đà Nẵng, Đà Nẵng ·
                  <a href="#">Xem trên bản đồ</a>
                </p>

                <p class="text-muted small mb-2">
                  <i class="bi bi-geo-alt"></i> Cách trung tâm 1,1km · Cách bãi
                  biển 2km · Gần biển
                </p>

                <p class="fw-bold mb-1">Phòng Tiêu Chuẩn 2 Giường Đơn</p>
                <p class="mb-2 text-muted small">2 giường đơn</p>

                <ul class="list-unstyled small mb-2">
                  <li class="text-success">
                    <i class="bi bi-check-circle-fill me-1"></i> Miễn phí huỷ
                  </li>
                  <li class="text-success">
                    <i class="bi bi-check-circle-fill me-1"></i> Không cần thanh
                    toán trước
                  </li>
                </ul>

                <p class="text-danger small fw-bold mb-2">
                  Chỉ còn 2 phòng với giá này trên trang của chúng tôi
                </p>

                <div class="d-flex justify-content-between align-items-end">
                  <div>
                    <p
                      class="mb-0 text-muted small text-decoration-line-through"
                    >
                      VND 2.325.600
                    </p>
                    <p class="mb-0 fs-5 text-danger fw-bold">VND 1.297.685</p>
                    <p class="mb-0 small text-muted">Đã bao gồm thuế và phí</p>
                  </div>
                  <a href="/homestaydetail" class="btn btn-primary stretched-link btn-sm rounded-3"
                    >Xem chỗ trống</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</template>
<script>
import SearchRoom from "../../components/User/SearchRoom.vue";

export default {
  components: {
    SearchRoom,
  },
  data() {
    return {
      // Define any data properties you need here
    };
  },
  methods: {
    // Define any methods you need here
  },
};
</script>
<style >
</style>