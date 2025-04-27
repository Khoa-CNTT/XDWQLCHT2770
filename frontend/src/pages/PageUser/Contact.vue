<template >
      <div class="alert alert-primary text-center mt-3" role="alert">
        <h3>Bạn cần trợ giúp chúng tôi ở đây vì bạn !</h3>
        <p class="fa-5x"> <i class="fa-regular fa-face-smile-wink"></i></p>
    </div>
    <div class="d-flex justify-content-between">
        <div class="container mt-5 ms-5 me-5 fs-5">
            <p>Cuộc sống bận rộn đôi khi khiến bạn quên mất việc thư giãn. Hãy đi du lịch để tìm lại sự cân bằng và niềm
                vui. Bài viết này sẽ giúp bạn chọn một chuyến đi phù hợp với Mytour.</p>
            <b>Cần giải quyết vấn đề phát sinh, xác nhận đặt - hủy phòng, hay đơn giản là có thắc mắc?</b>
            <p>Chúng tôi luôn sẵn sàng trợ giúp và giải đáp mọi câu hỏi, dù khẩn cấp hay không.
                Nếu đang gặp phải vấn đề
                <strong>không khẩn cấp</strong> hoặc <strong>vấn đề liên quan đến tài chính</strong>, Quý vị nên liên hệ
                với chúng tôi thông qua
                <a class="link-opacity-100" href="#">hộp thư</a>
                . Nếu Quý vị có câu hỏi khẩn cấp, vui lòng gọi cho chúng tôi
            </p>
            <p> Ngoài việc đặt phòng khách sạn trên <strong> HomeS.com</strong>, gửi yêu cầu, khiếu nại... qua mail, bạn cũng có thể
                liên hệ trực tiếp qua <strong>số điện thoại tổng đài HomeS</strong>.</p>
            <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                  
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Hộp Thư</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Gọi cho chúng tôi</a>
                      </li>
                  </div>
                </div>
              </nav> -->
        </div>
        <div class="d-flex justify-content-center align-items-center mt-4 me-5">
            <div class="card shadow-lg rounded-lg" style="width: 40rem;">
                <div class="card-body text-align: right;">
                    <h3 class="text-center">Liên Hệ Đặt Phòng Homestay</h3>
                    <form action="/submit-booking" method="POST">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="checkIn" class="form-label">Ngày nhận phòng</label>
                            <input type="date" class="form-control" id="checkIn" name="checkIn" required>
                        </div>
                        <div class="mb-3">
                            <label for="checkOut" class="form-label">Ngày trả phòng</label>
                            <input type="date" class="form-control" id="checkOut" name="checkOut" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Lời nhắn</label>
                            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">


            <h2 class="text-center mt-3">Thông Tin Liên Hệ</h2>
            <p class="text-center">Bạn có thể liên hệ với chúng tôi qua các phương thức dưới đây để đặt phòng hoặc giải
                đáp thắc mắc:</p>
            <ul class="list-unstyled text-center">
                <li>Email: <a href="mailto:info@homestay.com">info@homestay.com</a></li>
                <li>Điện thoại: <a href="tel:+84901234567">+84 901 234 567</a></li>
                <li>Hoặc điền vào mẫu liên hệ phía trên để gửi yêu cầu đặt phòng!</li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style >
    
</style>