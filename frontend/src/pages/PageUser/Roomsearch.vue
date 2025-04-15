<template >
   <div class="container">
   
    <SearchRoom class="my-5"></SearchRoom>
    <div class="d-flex pb-3 justify-content-between">
        <span class="fs-4">Đà Nẵng  |  Hiện thị 555 kết quả</span>
        <div class="">
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Basic modal</button>
										<!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur.</div>
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
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
          <router-link to="/roomdetail"
            ><div class="card">
              <img
                src="https://th.bing.com/th/id/OIP.1xQbxVxtMgK3MdN_mRN_RwHaFP?w=249&h=180&c=7&r=0&o=5&dpr=2.2&pid=1.7"
                class="card-img-top rouder"
                alt="..."
                style="overflow: hidden; position: relative"
              />
              <i
                class="fa-regular fa-heart"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  font-size: 18px;
                  color: red;
                  cursor: pointer;
                  z-index: 2;
                "
              ></i>
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
                  <b><u>đ4.128.208</u></b
                  >/đêm
                </p>
              </div>
            </div></router-link
          >
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
<style >
    
</style>