<template >
  <div class="container mt-4">
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="card">
          <div class="card-body">
            <div
              class="w-100 d-flex justify-content-between align-items-center"
            >
              <h5>Healing Homestay</h5>
              <div class="d-flex">
                <button class="btn btn-sm">
                  <i class="fa-regular fa-heart"></i>
                </button>
                <a
                  href="#datngay"
                  class="btn"
                  style="
                    background: #062d62;
                    color: aliceblue;
                    border-radius: 0;
                  "
                  >Đặt ngay</a
                >
              </div>
            </div>

            <p>
              <i class="fa-solid fa-location-dot"></i> 131 Nguyễn Văn Linh, Hải
              Châu, Đà Nẵng
            </p>
            <div
              id="carouselExampleIndicators"
              class="carousel slide"
              data-bs-ride="carousel"
            >
              <div class="carousel-indicators">
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="0"
                  class="active"
                  aria-current="true"
                  aria-label="Slide 1"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="1"
                  aria-label="Slide 2"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="2"
                  aria-label="Slide 3"
                ></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img
                    src="https://i.pinimg.com/474x/36/50/5d/36505d61dac64b53188dcdeecef24dea.jpg"
                    class="d-block w-100"
                    style="
                      max-height: 500px;
                      min-height: 250px;
                      object-fit: cover;
                      height: calc(100vw * (6 / 19));
                    "
                    alt="..."
                  />
                </div>
                <div class="carousel-item">
                  <img
                    src="https://i.pinimg.com/736x/b9/69/0a/b9690ac7ec4b7c94d44d9e519b6c30e7.jpg"
                    class="d-block w-100"
                    style="
                      max-height: 500px;
                      min-height: 250px;
                      object-fit: cover;
                      height: calc(100vw * (6 / 19));
                    "
                    alt="..."
                  />
                </div>
                <div class="carousel-item">
                  <img
                    src="https://i.pinimg.com/736x/79/c5/dd/79c5ddf24f3fc7d71f2904b03754eefb.jpg"
                    class="d-block w-100"
                    style="
                      max-height: 500px;
                      min-height: 250px;
                      object-fit: cover;
                      height: calc(100vw * (6 / 19));
                    "
                    alt="..."
                  />
                </div>
              </div>
              <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev"
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next"
              >
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <!-- mô tả -->
            <p class="mt-2">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab
              corrupti sequi delectus odio perspiciatis quas error vero ullam.
              Reprehenderit quaerat magni repellat enim aut mollitia laudantium
              porro qui recusandae exercitationem.
            </p>
            <!-- tiện ích -->
            <h5>Tiện ích</h5>
            <div class="">
              <span
                class="me-2 mt-2 p-2 badge"
                style="
                  font-size: 1rem;
                  font-weight: 300;
                  background: #062d62;
                  color: #ffc107;
                "
              >
                <i class="me-1 fa-solid fa-wifi"></i>
                <span>Wifi miễn phí</span>
              </span>
              <span
                class="me-2 mt-2 p-2 badge"
                style="
                  font-size: 1rem;
                  font-weight: 300;
                  background: #062d62;
                  color: #ffc107;
                "
              >
                <i class="me-1 fa-solid fa-utensils"></i>
                <span>Nhà hàng</span>
              </span>
              <span
                class="me-2 mt-2 p-2 badge"
                style="
                  font-size: 1rem;
                  font-weight: 300;
                  background: #062d62;
                  color: #ffc107;
                "
              >
                <i class="me-1 fa-solid fa-parking"></i>
                <span>Chỗ đậu xe miễn phí</span>
              </span>
              <span
                class="me-2 mt-2 p-2 badge"
                style="
                  font-size: 1rem;
                  font-weight: 300;
                  background: #062d62;
                  color: #ffc107;
                "
              >
                <i class="me-1 fa-solid fa-bath"></i>
                <span>Phòng tắm riêng</span>
              </span>
            </div>
            <div class="w-100 text-end py-1">
              <a class="text-nowrap" href=""
                >Xem tất cả tiện ích<i class="fa-solid fa-chevron-right"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="card sticky-top">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h5>Đánh giá</h5>
              <div class="d-flex justify-content-center align-items-center">
                <span class="text-center mx-1">500 đánh giá</span>
                <span
                  class="badge p-2"
                  style="background: #062d62; color: white"
                  >5 <i class="fa-solid fa-star"></i
                ></span>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="p-1 mb-3 shadow-sm rounded">
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex ms-1 mt-1 align-items-center">
                  <img
                    src="../../assets/images/avatars/avatar-2.png"
                    class="user-img ms-0"
                    alt="user avatar"
                  />
                  <div class="ms-2">
                    <div class="fw-bold">Trần Thi Mai</div>
                    <span
                      class="badge"
                      style="background: #062d62; color: white"
                      >5 <i class="fa-solid fa-star"></i
                    ></span>
                  </div>
                </div>
              </div>
              <p class="ms-3 mt-1">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
              </p>
            </div>
            <div class="p-1 mb-3 shadow-sm rounded">
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex ms-1 mt-1 align-items-center">
                  <img
                    src="../../assets/images/avatars/avatar-2.png"
                    class="user-img ms-0"
                    alt="user avatar"
                  />
                  <div class="ms-2">
                    <div class="fw-bold">Trần Thi Mai</div>
                    <span
                      class="badge"
                      style="background: #062d62; color: white"
                      >5 <i class="fa-solid fa-star"></i
                    ></span>
                  </div>
                </div>
              </div>
              <p class="ms-3 mt-1">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
              </p>
            </div>
            <div class="p-1 mb-3 shadow-sm rounded">
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex ms-1 mt-1 align-items-center">
                  <img
                    src="../../assets/images/avatars/avatar-2.png"
                    class="user-img ms-0"
                    alt="user avatar"
                  />
                  <div class="ms-2">
                    <div class="fw-bold">Trần Thi Mai</div>
                    <span
                      class="badge"
                      style="background: #062d62; color: white"
                      >5 <i class="fa-solid fa-star"></i
                    ></span>
                  </div>
                </div>
              </div>
              <p class="ms-3 mt-1">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr />
    <div
      id="datngay"
      class="d-flex justify-content-between align-items-center w-100"
    >
      <h5>Vui lòng chọn phòng</h5>
      <a href="/bookingdetail"
        class="btn"
        style="background: #062d62; color: aliceblue; border-radius: 0"
      >
        Xác nhận
      </a>
    </div>
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="card">
          <div
            id="carouselExampleControls"
            class="carousel slide"
            data-bs-ride="carousel"
          >
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img
                  src="https://i.pinimg.com/474x/d3/36/04/d3360418ce81a727be467a9eae0085ba.jpg"
                  style="max-height: 250px"
                  class="d-block w-100"
                  alt="..."
                />
              </div>
              <div class="carousel-item">
                <img
                  src="https://i.pinimg.com/474x/d3/36/04/d3360418ce81a727be467a9eae0085ba.jpg"
                  style="max-height: 250px"
                  class="d-block w-100"
                  alt="..."
                />
              </div>
              <div class="carousel-item">
                <img
                  src="https://i.pinimg.com/474x/d3/36/04/d3360418ce81a727be467a9eae0085ba.jpg"
                  style="max-height: 250px"
                  class="d-block w-100"
                  alt="..."
                />
              </div>
            </div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselExampleControls"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselExampleControls"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

          <div class="card-body">
            <div class="row">
              <h5>Muse room</h5>
              <div class="col">
                <p class="m-0">Diện tích: 15 m2</p>
                <p class="m-0">Số lượng khách: 2</p>
                <p class="m-0">Giường đôi: 1</p>
              </div>
              <div class="col text-end">
                <p class="m-0 fs-6 fw-bold" style="color: #062d62">700.000 <i class="fa-solid fa-dong-sign"></i></p>
                <div class="d-flex w-100 justify-content-end align-items-center">
                  <span>Chọn số phòng</span>
                  <select class="form-select-sm ms-2" aria-label="Default select example">
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
                </div>
              </div>
            </div>
            <hr />
            <div>
              <span class="me-3"><i class="fa-solid fa-tv"></i> TV</span>
              <span class="me-3"><i class="fa-solid fa-film"></i> Netflix</span>
              <span class="me-3"
                ><i class="fa-solid fa-kitchen-set"></i> Bếp</span
              >
              <span class="me-3"
                ><i class="fa-solid fa-shower"></i> WC in room</span
              >
              <span><i class="fa-solid fa-snowflake"></i> Điều hòa</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>
<style >
</style>