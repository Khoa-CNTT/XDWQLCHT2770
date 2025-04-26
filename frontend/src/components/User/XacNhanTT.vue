<template >
    <div>
         <!-- thẻ thông báo đăng ký, đăng nhập -->
         <div class="card">
          <div class="card-body">
            <p>
              Vui lòng đăng nhập để hoàn tất đặt phòng và nhận được nhiều ưu đãi
            </p>
            <div class="d-flex">
              <a href="/login">Đăng nhập</a>

              <a class="ms-3" href="/regitster">Đăng ký</a>
            </div>
          </div>
        </div>
        <!-- thẻ xác nhận thông tin -->
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold mb-3">Nhập thông tin chi tiết của bạn</h5>

            <div class="alert alert-secondary" style="font-size: 14px">
              <i class="bi bi-info-circle-fill me-2"></i>
              Gần xong rồi! Chỉ cần điền phần thông tin
              <span class="text-danger">*</span> bắt buộc <br />
              <span class="ms-4"
                >Vui lòng nhập thông tin của bạn bằng ký tự Latin để chỗ nghỉ có
                thể hiểu được</span
              >
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label"
                  >Họ<span class="text-danger">*</span></label
                >
                <input type="text" class="form-control" placeholder="Nhập họ" />
              </div>
              <div class="col-md-6">
                <label class="form-label"
                  >Tên<span class="text-danger">*</span></label
                >
                <input
                  type="text"
                  class="form-control"
                  placeholder="Nhập tên"
                />
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label"
                >Địa chỉ email <span class="text-danger">*</span></label
              >
              <input
                type="email"
                class="form-control"
                placeholder="abc@gmail.com"
              />
              <div class="form-text">
                Email xác nhận đặt phòng sẽ được gửi đến địa chỉ này
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-md-4">
                <label class="form-label"
                  >Số điện thoại <span class="text-danger">*</span></label
                >
                <div class="input-group">
                  <select class="form-select" style="max-width: 100px">
                    <option selected>VN +84</option>
                    <option>+1</option>
                    <option>+81</option>
                  </select>
                  <input
                    type="tel"
                    class="form-control"
                    placeholder="0866 791 931"
                  />
                </div>
                <div class="form-text">
                  Cần thiết để chỗ nghỉ xác nhận đặt phòng của bạn
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label"
                >Vùng/quốc gia <span class="text-danger">*</span></label
              >
              <select class="form-select">
                <option selected>Việt Nam</option>
                <option>Hoa Kỳ</option>
                <option>Nhật Bản</option>
              </select>
            </div>

            <div class="form-check mb-4">
              <input
                class="form-check-input"
                type="checkbox"
                id="freeConfirm"
                checked
              />
              <label class="form-check-label" for="freeConfirm">
                Có, tôi muốn xác nhận điện tử miễn phí (được đề xuất)
              </label>
              <div class="form-text">
                Chúng tôi sẽ nhắc cho bạn đường dẫn để tải ứng dụng
              </div>
            </div>

            <div class="border-top pt-3 mt-3">
              <div class="mb-3">
                <label class="form-label"
                  >Bạn đặt phòng cho ai?
                  <span class="text-muted">(không bắt buộc)</span></label
                >
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="forWhom"
                    id="self"
                    checked
                  />
                  <label class="form-check-label" for="self"
                    >Tôi là khách lưu trú chính</label
                  >
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="forWhom"
                    id="other"
                  />
                  <label class="form-check-label" for="other"
                    >Đặt phòng này cho người khác</label
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- thẻ chi tiết phòng đã chọn -->
        <div class="card">
          <div class="card-body">
            <h5 class="fw-bold mb-1">Sea Room</h5>
            <p class="text-success"><i class="fa-solid fa-check"></i> Miễn phí hủy trước 8/9/2025</p>
            <ul class="d-flex flex-wrap list-unstyled">
              <li class="me-2"><i class="fa-solid fa-bed"></i>: 1 giường đơn</li>
              <li class="me-2"><i class="fa-solid fa-people-roof"></i>: 2 người</li>
              <li class="me-2"><i class="fa-solid fa-bath"></i>: 1 phòng tắm</li>
            </ul>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum dolore adipisci enim minus blanditiis autem facere quae obcae</p>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h5 class="fw-bold mb-1">Sea Room</h5>
            <p class="text-success"><i class="fa-solid fa-check"></i> Miễn phí hủy trước 8/9/2025</p>
            <ul class="d-flex flex-wrap list-unstyled">
              <li class="me-2"><i class="fa-solid fa-bed"></i>: 1 giường đơn</li>
              <li class="me-2"><i class="fa-solid fa-people-roof"></i>: 2 người</li>
              <li class="me-2"><i class="fa-solid fa-bath"></i>: 1 phòng tắm</li>
            </ul>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum dolore adipisci enim minus blanditiis autem facere quae obcae</p>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
                      <h6>Bạn muốn dùng thêm dịch vụ ?</h6>
                    </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="col-6">
                  <div class="card">
                    
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <h6 class="p-0 m-0"><i class="fa-solid fa-motorcycle"></i> Xe máy</h6>
                          <p class="m-0 p-0 ">300,000 đ/ngày</p>
                        </div>
                        <div><select class="form-select-sm ms-2" aria-label="Default select example" data-v-41373be6="">
                            <option value="1" selected="" data-v-41373be6="">1</option>
                            <option value="2" data-v-41373be6="">2</option>
                            <option value="3" data-v-41373be6="">3</option>
                          </select></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="w-100 text-end">
       <router-link to="/payment"> <button class="btn p-3 w-sm-100" style="background-color: #062d62; color: #efb401;" >Thanh toán để hoàn tất</button></router-link>
        </div>
    </div>
</template>
<script>
export default {
  props: {
    customer: Object
  }
};
</script>
<style >
    
</style>