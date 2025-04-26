<template>
  <div class="container">
    <Steps :currentStep="2" />
    <!-- Step hiện tại -->
    <div class="row mt-4">
      <div class="col-lg-4 ">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Homestay</p>
            <h5 class="card-text">{{ bookingdetals.homestay }}</h5>
            <p class="card-text">{{ bookingdetals.diachi }}</p>
            <span class="badge bg-primary"
              >{{ bookingdetals.danh_gia }}
              <i class="fa-solid fa-star text-warning"></i> </span
            ><span> -- 255 lượt đánh giá</span>
            <hr />
            <span class="px-1" style="font-size: 0.8rem"
              ><i class="fa-solid fa-wifi"></i> Miễn phí wifi</span
            >
            <span class="px-1" style="font-size: 0.8rem"
              ><i class="fa-solid fa-square-parking"></i> Bãi đỗ xe</span
            >
            <span class="px-1" style="font-size: 0.8rem"
              ><i class="fa-solid fa-person-swimming"></i> Hồ bơi</span
            >
          </div>
        </div>
        <div class="card ">
          <div class="card-body">
            <h5 class="card-title">Chi tiết đặt phòng</h5>
            <div class="row">
              <div class="col-6">
                <p class="fs-8 fw-bold p-0">Nhận phòng</p>
                <p class="fw-bold p-0 m-0" style="font-size: 1.2rem">
                  {{ bookingdetals.checkin }}
                </p>
                <p>từ 14:00</p>
              </div>
              <div class="col-6">
                <p class="fs-8 fw-bold p-0">Trả phòng</p>
                <p class="fw-bold p-0 m-0" style="font-size: 1.2rem">
                  {{ bookingdetals.checkout }}
                </p>
                <p>lúc 12:00</p>
              </div>
            </div>
            <hr />
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne"
                    aria-expanded="false"
                    aria-controls="collapseOne"
                  >
                    <div>
                      <p class="fs-8 fw-bold p-0">Bạn đã chọn</p>
                      <p class="fw-bold p-0 m-0" style="font-size: 1.2rem">
                        2 phòng cho 2 người
                      </p>
                    </div>
                  </button>
                </h2>
                <div
                  id="collapseOne"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingOne"
                  data-bs-parent="#accordionExample"
                  style=""
                >
                  <div class="accordion-body">2 x phòng ABC</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card sticky-top">
          <div class="card-body">
            <p>Tóm tắt giá</p>
            <div class="d-flex justify-content-between">
              <p class="fw-bold">Giá phòng</p>
              <p class="fw-bold">2.000.000đ</p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="fw-bold">Phí dịch vụ</p>
              <p class="fw-bold">200.000đ</p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="fw-bold">Ưu đãi</p>
              <p class="fw-bold">199.000đ</p>
            </div>
            <div class=" p-3 mt-3 rounded d-flex justify-content-between align-items-center py-4" style="background: #062d62; color: aliceblue;">
              <p  class="fs-5 fw-bold p-0 m-0">Tổng</p>
              <div class="">
                <p class="text-decoration-line-through text-danger p-0 m-0">1.000.000đ</p>
                <p  class="fs-5 fw-bold p-0 m-0">700.000đ</p>
                <p class="fst-italic text-light p-0 m-0">Đã bao gồm thuế</p>
              </div>
            </div>
              <div class="d-flex justify-content-between align-items-center mt-2 ms-5">
                <p><i class="fa-solid fa-money-bill"></i> bao gồm 10% Thuế GTGT</p>
                <p>100.000đ</p>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
       <XacNhanTT></XacNhanTT>
      </div>
    </div>
  </div>
</template>
  
<script>
import Steps from "../../components/User/Step.vue";
import PaymentForm from "../../components/User/PaymentForm.vue";
import XacNhanTT from "../../components/User/XacNhanTT.vue";

export default {
  components: {
    Steps,
    PaymentForm,
    XacNhanTT,
  },
  data() {
    return {
      
      bookingdetals: {
        homestay: "Healling Homestay",
        diachi: "123 Đường ABC, Quận 1, TP.HCM",
        danh_gia: 4.5,
        checkin: "2023-10-01",
        checkout: "2023-10-05",
      },
    };
  },
 
};
</script>
  