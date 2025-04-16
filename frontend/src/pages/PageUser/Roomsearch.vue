<template>
  <div class="container">

    <SearchRoom class="my-5"></SearchRoom>
    <div class="d-flex pb-3 justify-content-between">
      <span class="fs-4">Đà Nẵng | Hiện thị 555 kết quả</span>
      <div class="">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Basic
          modal</button>
        <!-- Modal -->
        <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
          style="display: none;" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <!-- Sidebar bên trái -->
                  <div class="col-md-3">
                    <h5>Chọn lọc theo:</h5>
                    <div class="mb-3">
                      <label class="form-label">Ngân sách của bạn (mỗi đêm)</label>
                      <input type="range" class="form-range" min="100000" max="4000000">
                      <small>VND 100.000 - VND 4.000.000+</small>
                    </div>
                    <div>
                      <h6>Các bộ lọc phổ biến</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-hotel">
                        <label class="form-check-label" for="filter-hotel">Khách sạn (630)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-excellent">
                        <label class="form-check-label" for="filter-excellent">Tuyệt hảo: 9 điểm trở lên (268)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-private-bath">
                        <label class="form-check-label" for="filter-private-bath">Phòng tắm riêng (1010)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-free-cancel">
                        <label class="form-check-label" for="filter-free-cancel">Miễn phí hủy (985)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-4star">
                        <label class="form-check-label" for="filter-4star">4 sao (341)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-under3km">
                        <label class="form-check-label" for="filter-under3km">Dưới 3 km (562)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-breakfast">
                        <label class="form-check-label" for="filter-breakfast">Bao gồm bữa sáng (310)</label>
                      </div>
                      <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="filter-pool">
                        <label class="form-check-label" for="filter-pool">Hồ bơi (521)</label>
                      </div>

                      <h6 class="mt-4">Khoảng cách từ trung tâm Đà Nẵng</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dist-1km">
                        <label class="form-check-label" for="dist-1km">Dưới 1 km (74)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dist-3km">
                        <label class="form-check-label" for="dist-3km">Dưới 3 km (562)</label>
                      </div>
                      <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="dist-5km">
                        <label class="form-check-label" for="dist-5km">Dưới 5 km (927)</label>
                      </div>

                      <h6 class="mt-4">Bữa ăn</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="meal-self">
                        <label class="form-check-label" for="meal-self">Tự nấu (612)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="meal-breakfast">
                        <label class="form-check-label" for="meal-breakfast">Bao gồm bữa sáng (310)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="meal-all">
                        <label class="form-check-label" for="meal-all">Bao gồm tất cả các bữa ăn (1)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="meal-all2">
                        <label class="form-check-label" for="meal-all2">Tất cả các bữa (1)</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="meal-brunch">
                        <label class="form-check-label" for="meal-brunch">Bao bữa sáng & bữa trưa (6)</label>
                      </div>
                      <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="meal-breakfast-dinner">
                        <label class="form-check-label" for="meal-breakfast-dinner">Bao bữa sáng & bữa tối (12)</label>
                      </div>

                      <h6 class="mt-4">Địa danh</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="landmark-caurong">
                        <label class="form-check-label" for="landmark-caurong">Cầu Rồng (93)</label>
                      </div>
                      <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="landmark-nguhanhson">
                        <label class="form-check-label" for="landmark-nguhanhson">Ngũ Hành Sơn (7)</label>
                      </div>
                      <!-- Thêm các bộ lọc khác tương tự -->
                    </div>
                  </div>

                  <!-- Danh sách chỗ nghỉ -->
                  <div class="col-md-9">
                    <div class="card shadow-sm">
                      <div class="row">
                        <!-- Hình ảnh bên trái -->
                        <div class="col-lg-5 position-relative">
                          <img src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                          class="card-img-top rouder"  height="320px" alt="Hotel image">
                        </div>
                        <!-- Thông tin bên phải -->
                        <div class="col-lg-7">
                          <div class="card-body">
                            <div class="d-flex justify-content-between">
                              <h5 class="card-title mb-2 text-primary fw-bold">Mint Airport Central By Haviland <span
                                  class="badge bg-secondary">Nổi bật</span></h5>
                              <div class="text-end">
                                <div class="fw-semibold text-dark">Tuyệt hảo</div>
                                <div class="badge bg-primary fs-6">9.3</div>
                                <div class="text-muted small">34 đánh giá</div>
                                <div class="text-primary small">Địa điểm 9.6</div>
                              </div>
                            </div>
                            <p class="mb-1 small text-muted">Ở trung tâm thành phố · Gần biển</p>
                            <p class="mb-2 small text-muted"><i class="bi bi-geo-alt"></i> Cách bãi biển 1,7km</p>

                            <p class="mb-1"><strong>Phòng Tiêu Chuẩn Giường Đôi</strong></p>
                            <p class="mb-1 small">1 giường đôi</p>
                            <p class="text-success small fw-semibold"><i class="bi bi-check-circle-fill"></i> Miễn phí
                              hủy</p>

                            <div class="d-flex justify-content-between align-items-end">
                              <div>
                                <p class="mb-0 small">1 đêm, 2 người lớn</p>
                                <p class="mb-0 text-dark fw-bold fs-5">VND 386.889</p>
                                <p class="mb-0 small text-muted">Đã bao gồm thuế và phí</p>
                              </div>
                              <a href="#" class="btn btn-primary">Xem chỗ trống</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
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
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
          <router-link to="/roomdetail">
            <div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder" alt="..." style="overflow: hidden; position: relative" />
              <i class="fa-regular fa-heart" style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "></i>
              <div class="card-body text-dark">
                <div class="d-flex">
                  <h5 class="">Muse room</h5>
                  <div class="ms-auto">
                    <i class="fa-solid fa-star" style="color: black"></i>
                    <span style="font-size: 14px">4,86</span>
                  </div>
                </div>
                <div class="d-flex">
                  <i class="fa-solid fa-house me-2"></i>
                  <span>Bơ Yang Home stay</span>
                </div>
                <div class="d-flex justify-content-start align-items-center">
                  <i class="fa-solid fa-location-dot me-2"></i>
                  <span>32 Đinh Thị Hòa, Đà Nẵng</span>
                </div>
                <hr />
                <p style="margin: 2px 0">
                  <b><u>đ4.128.208</u></b>/đêm
                </p>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

import SearchRoom from '../../components/User/SearchRoom.vue';


export default {


  components: {
    SearchRoom
  },
  data() {
    return {
      // Define any data properties you need here
    };
  },
  methods: {
    // Define any methods you need here
  }
}
</script>
<style></style>