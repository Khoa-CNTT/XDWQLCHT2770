<template >
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h1 class="h3">MINT AIRPORT CENTRAL BY HAVILAND</h1>
                <p class="text-muted">
                    <i class="bi bi-geo-alt-fill"></i> 302 Đ. Nguyễn Văn Linh, 500000 Đà Nẵng, Việt Nam.
                </p>
            </div>
            <div>
                <button class="btn btn-outline-primary me-2" title="Yêu thích">
                    <i class="fa-solid fa-heart"></i>
                </button>
                <button class="btn btn-outline-primary me-2" title="Chia sẻ">
                    <i class="fa-solid fa-share-nodes"></i>
                </button>
                <button class="btn btn-primary">Đặt ngay</button>
            </div>

        </div>
        <!-- Main Content -->
        <div class="row">
            <!-- Image Gallery -->
            <div class="col-lg-9">
                <div class="row">
                    <!-- Main Image -->
                    <div class="col-8 mb-3">
                        <img src="https://a0.muscache.com/im/pictures/f06bce03-0dc2-4719-acf8-25ec189ca8cf.jpg?im_w=1200"
                            style="height: 425px; width: 1200px;" class="img-fluid rounded" alt="Main Room">
                    </div>
                    <div class="col-4 mb-3">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <img src="https://a0.muscache.com/im/pictures/prohost-api/Hosting-39113140/original/43c49134-fefc-4806-bc66-efee37054665.jpeg?im_w=720"
                                    class="img-fluid rounded" alt="Thumbnail 1">
                            </div>
                            <div class="col-lg-12">
                                <img src="https://a0.muscache.com/im/pictures/prohost-api/Hosting-39113140/original/43c49134-fefc-4806-bc66-efee37054665.jpeg?im_w=720"
                                    class="img-fluid rounded" alt="Thumbnail 1">
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnails -->
                    <div class="col-3">
                        <img src="https://a0.muscache.com/im/pictures/prohost-api/Hosting-39113140/original/43c49134-fefc-4806-bc66-efee37054665.jpeg?im_w=720"
                            class="img-fluid rounded" alt="Thumbnail 1">
                    </div>
                    <div class="col-3">
                        <img src="https://a0.muscache.com/im/pictures/prohost-api/Hosting-39113140/original/43c49134-fefc-4806-bc66-efee37054665.jpeg?im_w=720"
                            class="img-fluid rounded" alt="Thumbnail 2">
                    </div>
                    <div class="col-3">
                        <img src="https://a0.muscache.com/im/pictures/prohost-api/Hosting-39113140/original/43c49134-fefc-4806-bc66-efee37054665.jpeg?im_w=720"
                            class="img-fluid rounded" alt="Thumbnail 3">
                    </div>
                    <div class="col-3">
                        <img src="https://a0.muscache.com/im/pictures/prohost-api/Hosting-39113140/original/43c49134-fefc-4806-bc66-efee37054665.jpeg?im_w=720"
                            class="img-fluid img-thumbnail" alt="Cityscape" data-bs-toggle="modal"
                            data-bs-target="#imageModal">
                    </div>
                </div>
            </div>


            <!-- Sidebar (Details) -->
            <div class="col-lg-3">
                <!-- Rating -->
                <div class="mb-3">
                    <span class="badge bg-primary me-1">Xuất sắc 9.6</span>
                    <small class="text-muted">27 đánh giá</small>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <strong>Chỗ nghỉ này là gì?</strong>
                    <p>
                        Nằm ngay gần trung tâm thành phố, Mint Airport Central by Haviland là lựa chọn hoàn hảo cho du
                        khách cả về mặt tiện nghi lẫn vị trí...
                    </p>
                    <a href="#" class="text-primary">Nguyen • Việt Nam</a>
                </div>

                <!-- Map -->

            </div>
        </div>

        <!-- Amenities -->
        <div class="row mt-2">
            <div class="col-12">
                <h5>Tiện nghi</h5>
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-house-door me-2"></i> Căn hộ
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-airplane me-2"></i> Xe đưa đón sân bay
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-wifi me-2"></i> WiFi miễn phí
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-no-smoking me-2"></i> Phòng không hút thuốc
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-table me-2"></i> Ban công
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-gear me-2"></i> Điều hòa không khí
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-door-open me-2"></i> Phòng tắm riêng
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-eye me-2"></i> Tầm nhìn ra khung cảnh
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-kitchen me-2"></i> Bếp
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-emoji-smile me-2"></i> Vui sen
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Cột bên trái: Nội dung mô tả -->
            <div class="col-8">
                <h5>Bạn có thể đặt ngay căn hộ chung cư cao cấp tại Mint Airport Central By Haviland, Đề biết giảm giá
                    Genius tại chỗ nghỉ này!</h5>
                <p class="mt-3">
                    Giảm giá Genius tại chỗ nghỉ này thuộc vào ngày đặt phòng, ngày lưu trú và các ưu đãi cơ bản khác.
                </p>
                <p>
                    Tọa lạc ở Đà Nẵng, cách Bãi biển Thanh Bình 2.6 km và trung tâm 1.7 km, Mint Airport Central By
                    Haviland cung cấp chỗ nghỉ có điều hòa, Wi-Fi miễn phí và sân hiên.
                </p>
                <p>
                    Khách sạn căn hộ này có TV màn hình phẳng và phòng tắm riêng với đồ vệ sinh cá nhân miễn phí, máy
                    sấy tóc và vòi sen.
                </p>
                <p>
                    Mint Airport Central By Haviland cách Bãi tắm Mỹ Khê 1.9 km và Trung tâm thương mại Indochina
                    Riverside 2.8 km. Chỗ nghỉ cách Sân bay Quốc tế Đà Nẵng 1 km và cung cấp dịch vụ đưa đón sân bay
                    miễn phí.
                </p>
                <p>
                    Các cặp đôi đặc biệt thích địa điểm này — họ chấm 9.8 điểm cho chuyến đi hai người.
                </p>

                <!-- Tiện nghi được ưa chuộng nhất -->
                <h6 class="mt-4">Tiện nghi được ưa chuộng nhất</h6>
                <div class="row">
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-airplane me-2"></i> Xe đưa đón sân bay
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-wifi me-2"></i> WiFi miễn phí
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-no-smoking me-2"></i> Phòng không hút thuốc
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-table me-2"></i> Ban công
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-gear me-2"></i> Điều hòa không khí
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-2">
                        <div class="alert alert-light d-flex align-items-center" role="alert">
                            <i class="bi bi-door-open me-2"></i> Phòng tắm riêng
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột bên phải: Card đặt phòng -->
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Điểm nổi bật của chỗ nghỉ</h5>
                        <p class="card-text">Hoàn hảo cho kỳ nghỉ 1 đêm!</p>
                        <p class="card-text">
                            <strong>Địa điểm hàng đầu:</strong> Được khách gần đây đánh giá cao (9.7 điểm)
                        </p>
                        <h6>Căn hộ có:</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">🛋 Nhìn ra thành phố</li>
                        </ul>
                        <a href="#" class="btn btn-primary mt-3 w-100">Đặt ngay</a>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="fw-bold">Đánh giá của khách</h4>

        <div class="d-flex align-items-center mb-3">
            <div class="bg-primary text-white px-2 py-1 rounded me-2 fw-bold">9,3</div>
            <span class="me-2">Tuyệt hảo</span>
            <span class="text-muted">· 29 đánh giá</span>
            <a href="#" class="ms-2">Đọc tất cả đánh giá</a>
        </div>

        <h6 class="fw-bold">Hạng mục:</h6>

        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="d-flex justify-content-between">
                    <span>Nhân viên phục vụ</span><span>9,5</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" style="width: 95%"></div>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="d-flex justify-content-between">
                    <span>Tiện nghi</span><span>9,2</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" style="width: 92%"></div>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="d-flex justify-content-between">
                    <span>Thoải mái</span><span>9,4</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" style="width: 94%"></div>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="d-flex justify-content-between">
                    <span>Sạch sẽ</span><span>9,3</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" style="width: 93%"></div>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="d-flex justify-content-between">
                    <span>WiFi miễn phí</span><span>8,7</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" style="width: 87%"></div>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="d-flex justify-content-between">
                    <span>Đáng giá tiền <span class="text-success">↑</span></span><span>9,7</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width: 97%"></div>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="d-flex justify-content-between">
                    <span>Địa điểm <span class="text-success">↑</span></span><span>9,8</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width: 98%"></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Phòng trống</h4>
            <a href="#" class="text-primary">Chúng Tôi Luôn Khớp Giá!</a>
        </div>

        <!-- Thông tin tìm kiếm -->
        <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
            <div class="border rounded px-3 py-2">
                <strong>T5, 29 tháng 5 — T6, 30 tháng 5</strong>
            </div>
            <div class="border rounded px-3 py-2">
                <strong>2 người lớn · 0 trẻ em · 1 phòng</strong>
            </div>
            <button class="btn btn-primary">Thay đổi tìm kiếm</button>
        </div>

        <!-- Tiêu đề bảng -->
        <div class="row fw-bold border-bottom py-2">
            <div class="col-md-3">Loại chỗ nghỉ</div>
            <div class="col-md-2">Số lượng khách</div>
            <div class="col-md-2">Giá hôm nay</div>
            <div class="col-md-3">Các lựa chọn</div>
            <div class="col-md-2">Chọn số lượng</div>
        </div>

        <!-- Mỗi dòng phòng -->
        <div class="row border-bottom py-3">
            <div class="col-md-3">
                <h6 class="text-primary">Phòng Tiêu Chuẩn Giường Đôi</h6>
                <p>1 giường đôi</p>
                <p><small>18 m² · WiFi miễn phí</small></p>
            </div>
            <div class="col-md-2">
                <div><i class="bi bi-person"></i> 2 người</div>
            </div>
            <div class="col-md-2">
                <div class="fw-bold text-success">VND 410.230</div>
                <div><small>Đã bao gồm thuế và phí</small></div>
            </div>
            <div class="col-md-3">
                <ul class="list-unstyled mb-1 text-success small">
                    <li>✓ Miễn phí hủy đến 23:59 27 tháng 5</li>
                    <li>✓ Thanh toán trước</li>
                </ul>
            </div>
            <div class="col-md-2">
                <select class="form-select form-select-sm mb-2">
                    <option>0</option>
                    <option>1</option>
                </select>
                <button class="btn btn-primary btn-sm w-100">Tôi sẽ đặt</button>
            </div>
        </div>
        <div class="row border-bottom py-3">
            <div class="col-md-3">
                <h6 class="text-primary">Phòng Tiêu Chuẩn Giường Đôi</h6>
                <p>1 giường đôi</p>
                <p><small>18 m² · WiFi miễn phí</small></p>
            </div>
            <div class="col-md-2">
                <div><i class="bi bi-person"></i> 2 người</div>
            </div>
            <div class="col-md-2">
                <div class="fw-bold text-success">VND 410.230</div>
                <div><small>Đã bao gồm thuế và phí</small></div>
            </div>
            <div class="col-md-3">
                <ul class="list-unstyled mb-1 text-success small">
                    <li>✓ Miễn phí hủy đến 23:59 27 tháng 5</li>
                    <li>✓ Thanh toán trước</li>
                </ul>
            </div>
            <div class="col-md-2">
                <select class="form-select form-select-sm mb-2">
                    <option>0</option>
                    <option>1</option>
                </select>
                <button class="btn btn-primary btn-sm w-100">Tôi sẽ đặt</button>
            </div>
        </div>
        

        <div class="modal fade modal-fx" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Xem Ảnh</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6> ảnh nè</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="prevImage">Trước</button>
                        <button type="button" class="btn btn-secondary" @click="nextImage">Tiếp</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style >
    
</style>