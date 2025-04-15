<template >
  <div class="container my-3">
    <div class="main-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img
                  src="https://scontent.fhan14-5.fna.fbcdn.net/v/t39.30808-6/480825499_1137689028097039_5666489940447021542_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeEGHw3tHcqLnRxNr_CqwIIMt9yoS-GOX8G33KhL4Y5fwUH1FpC9PyKBUtEibVrHyqCYuvY4-lbakQdEUoEJrrrn&_nc_ohc=38c9bEG0NUAQ7kNvwFJ0u62&_nc_oc=AdnmIgrh9sP8jMAQ5rEl-Pjpo-QMdqZcBso0QgC2MO0UJ3N3RyXzOYPlaGZPabujyLU&_nc_zt=23&_nc_ht=scontent.fhan14-5.fna&_nc_gid=hjQTYuzaIqo77NFHYAcgfA&oh=00_AfGW5nDIh--x_eNJQryySnHZtHDfL1DWc5FLFcLkKLdOcw&oe=6800820A"
                  alt="Admin"
                  class="rounded-circle p-1"
                  style="background: rgb(226 169 0)"
                  width="150"
                />
                <div class="mt-3">
                  <h4>Trần Viết Đức</h4>
                  <p class="text-secondary mb-1">Khách hàng mới</p>
                </div>
              </div>
              <hr class="my-4" />
              <ul class="list-group list-group-flush">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6 class="mb-0">
                    <i class="fa-solid fa-envelope me-2"></i>Website
                  </h6>
                  <span class="text-secondary">vietducdtu@gmail.com</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6 class="mb-0">
                    <i class="fa-solid fa-mobile-screen-button me-2"></i>Số điện
                    thoại
                  </h6>
                  <span class="text-secondary">0123456789</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                >
                  <h6 class="mb-0">
                    <i class="fa-solid fa-cake-candles me-2"></i>Ngày sinh
                  </h6>
                  <span class="text-secondary">29/05/2003</span>
                </li>
              </ul>
              <hr />
              <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa-solid fa-circle-info" ></i>Chỉnh sửa</button>
				
				
										<!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông tin cá nhân</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary">Save changes</button>
													</div>
												</div>
											</div>
										</div>
									
				<button class="btn btn-warning "><i class="fa-solid fa-key"></i>Đổi mật khẩu</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Full Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" value="John Doe" />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    type="text"
                    class="form-control"
                    value="john@example.com"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    type="text"
                    class="form-control"
                    value="(239) 816-9029"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Mobile</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    type="text"
                    class="form-control"
                    value="(320) 380-4539"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    type="text"
                    class="form-control"
                    value="Bay Area, San Francisco, CA"
                  />
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                  <input
                    type="button"
                    class="btn btn-primary px-4"
                    value="Save Changes"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="d-flex align-items-center mb-3">Project Status</h5>
                  <p>Web Design</p>
                  <div class="progress mb-3" style="height: 5px">
                    <div
                      class="progress-bar bg-primary"
                      role="progressbar"
                      style="width: 80%"
                      aria-valuenow="80"
                      aria-valuemin="0"
                      aria-valuemax="100"
                    ></div>
                  </div>
                  <p>Website Markup</p>
                  <div class="progress mb-3" style="height: 5px">
                    <div
                      class="progress-bar bg-danger"
                      role="progressbar"
                      style="width: 72%"
                      aria-valuenow="72"
                      aria-valuemin="0"
                      aria-valuemax="100"
                    ></div>
                  </div>
                  <p>One Page</p>
                  <div class="progress mb-3" style="height: 5px">
                    <div
                      class="progress-bar bg-success"
                      role="progressbar"
                      style="width: 89%"
                      aria-valuenow="89"
                      aria-valuemin="0"
                      aria-valuemax="100"
                    ></div>
                  </div>
                  <p>Mobile Template</p>
                  <div class="progress mb-3" style="height: 5px">
                    <div
                      class="progress-bar bg-warning"
                      role="progressbar"
                      style="width: 55%"
                      aria-valuenow="55"
                      aria-valuemin="0"
                      aria-valuemax="100"
                    ></div>
                  </div>
                  <p>Backend API</p>
                  <div class="progress" style="height: 5px">
                    <div
                      class="progress-bar bg-info"
                      role="progressbar"
                      style="width: 66%"
                      aria-valuenow="66"
                      aria-valuemin="0"
                      aria-valuemax="100"
                    ></div>
                  </div>
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
export default {};
</script>
<style >
</style>