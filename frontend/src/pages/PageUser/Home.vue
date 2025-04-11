<template>
    <div>
        <div class="container mb-4">
            <div
                style="display: flex; align-items: center; border-radius: 40px; overflow: hidden; background-color: white; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

                <!-- Địa điểm -->
                <div style="flex: 1; padding: 20px; border-right: 1px solid #eee; cursor: pointer;">
                    <label for="diaDiem" style="font-weight: bold; color: #222; display: block; margin-bottom: 5px;">
                        Địa điểm
                    </label>
                    <input id="diaDiem" type="text" placeholder="Tìm kiếm điểm đến"
                        style="border: none; outline: none; color: #888; width: 100%;">
                </div>

                <!-- Nhận phòng -->
                <div style="flex: 1; padding: 20px; border-right: 1px solid #eee; cursor: pointer;">
                    <label for="nhanPhong" style="font-weight: bold; color: #222; display: block; margin-bottom: 5px;">
                        Nhận phòng
                    </label>
                    <input id="nhanPhong" type="date" min=""
                        style="border: none; outline: none; color: #888; width: 100%;">
                </div>

                <!-- Trả phòng -->
                <div style="flex: 1; padding: 20px; border-right: 1px solid #eee; cursor: pointer;">
                    <label for="traPhong" style="font-weight: bold; color: #222; display: block; margin-bottom: 5px;">
                        Trả phòng
                    </label>
                    <input id="traPhong" type="date" min=""
                        style="border: none; outline: none; color: #888; width: 100%;">
                </div>

                <!-- Khách -->
                <div
                    style="flex: 1.2; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="width: 100%;">
                        <label for="soKhach"
                            style="font-weight: bold; color: #222; display: block; margin-bottom: 5px;">
                            Khách
                        </label>
                        <input id="soKhach" type="number" min="1" placeholder="Thêm khách"
                            style="border: none; outline: none; color: #888; width: 100%;">
                    </div>

                    <!-- Nút tìm kiếm -->
                    <button
                        style="background-color: #b9ff38; border: none; border-radius: 50%; min-width: 48px; min-height: 48px; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; margin-left: 10px;">
                        <i style="color: #222;" class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
                <div class="col">
                    <div class="card">
                        <div
                            style="margin: 15px 15px 0 15px; border-radius: 10px; overflow: hidden; height: 300px; position: relative;">
                            <i class="fa-regular fa-heart"
                                style="position: absolute; top: 15px; right: 15px; font-size: 18px; color: red; cursor: pointer; z-index: 2;"></i>
                          
                            <img src="../../assets/images/gallery/01.png" class="d-block w-100"
                                style="height: 300px; object-fit: cover;" alt="Ảnh chính">
                        </div>
                        <div class="card-title mt-1"
                            style="padding: 0 15px; display: flex; justify-content: space-between; align-items: center;">
                            <b style="font-size: 16px;">Vũng Tàu, Việt Nam</b>
                            <div style="display: flex; align-items: center; gap: 3px;">
                                <i class="fa-solid fa-star" style="color: black;"></i>
                                <span style="font-size: 14px;">4,86</span>
                            </div>
                        </div>

                        <div class="card-body" style="padding: 0px 15px 15px 15px;">
                            <p style="margin: 2px 0;">Bãi trước</p>
                            <p style="margin: 2px 0;">8-13 thg 4</p>
                            <p style="margin: 2px 0;"><b><u>đ4.128.208</u></b> cho 5 đêm</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div
                            style="margin: 15px 15px 0 15px; border-radius: 10px; overflow: hidden; height: 300px; position: relative;">
                            <i class="fa-regular fa-heart"
                                style="position: absolute; top: 15px; right: 15px; font-size: 18px; color: red; cursor: pointer; z-index: 2;"></i>
                          
                            <img src="../../assets/images/gallery/02.png" class="d-block w-100"
                                style="height: 300px; object-fit: cover;" alt="Ảnh chính">
                        </div>
                        <div class="card-title mt-1"
                            style="padding: 0 15px; display: flex; justify-content: space-between; align-items: center;">
                            <b style="font-size: 16px;">Vũng Tàu, Việt Nam</b>
                            <div style="display: flex; align-items: center; gap: 3px;">
                                <i class="fa-solid fa-star" style="color: black;"></i>
                                <span style="font-size: 14px;">4,86</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px 15px 15px 15px;">
                            <p style="margin: 2px 0;">Bãi trước</p>
                            <p style="margin: 2px 0;">8-13 thg 4</p>
                            <p style="margin: 2px 0;"><b><u>đ4.128.208</u></b> cho 5 đêm</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div
                            style="margin: 15px 15px 0 15px; border-radius: 10px; overflow: hidden; height: 300px; position: relative;">
                            <i class="fa-regular fa-heart"
                                style="position: absolute; top: 15px; right: 15px; font-size: 18px; color: red; cursor: pointer; z-index: 2;"></i>
                          
                            <img src="../../assets/images/gallery/03.png" class="d-block w-100"
                                style="height: 300px; object-fit: cover;" alt="Ảnh chính">
                        </div>
                        <div class="card-title mt-1"
                            style="padding: 0 15px; display: flex; justify-content: space-between; align-items: center;">
                            <b style="font-size: 16px;">Vũng Tàu, Việt Nam</b>
                            <div style="display: flex; align-items: center; gap: 3px;">
                                <i class="fa-solid fa-star" style="color: black;"></i>
                                <span style="font-size: 14px;">4,86</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px 15px 15px 15px;">
                            <p style="margin: 2px 0;">Bãi trước</p>
                            <p style="margin: 2px 0;">8-13 thg 4</p>
                            <p style="margin: 2px 0;"><b><u>đ4.128.208</u></b> cho 5 đêm</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div
                            style="margin: 15px 15px 0 15px; border-radius: 10px; overflow: hidden; height: 300px; position: relative;">
                            <i class="fa-regular fa-heart"
                                style="position: absolute; top: 15px; right: 15px; font-size: 18px; color: red; cursor: pointer; z-index: 2;"></i>
                          
                            <img src="../../assets/images/gallery/04.png" class="d-block w-100"
                                style="height: 300px; object-fit: cover;" alt="Ảnh chính">
                        </div>
                        <div class="card-title mt-1"
                            style="padding: 0 15px; display: flex; justify-content: space-between; align-items: center;">
                            <b style="font-size: 16px;">Vũng Tàu, Việt Nam</b>
                            <div style="display: flex; align-items: center; gap: 3px;">
                                <i class="fa-solid fa-star" style="color: black;"></i>
                                <span style="font-size: 14px;">4,86</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px 15px 15px 15px;">
                            <p style="margin: 2px 0;">Bãi trước</p>
                            <p style="margin: 2px 0;">8-13 thg 4</p>
                            <p style="margin: 2px 0;"><b><u>đ4.128.208</u></b> cho 5 đêm</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
                <div class="col">
                    <div class="card">
                        <div
                            style="margin: 15px 15px 0 15px; border-radius: 10px; overflow: hidden; height: 300px; position: relative;">
                            <i class="fa-regular fa-heart"
                                style="position: absolute; top: 15px; right: 15px; font-size: 18px; color: red; cursor: pointer; z-index: 2;"></i>
                          
                            <img src="../../assets/images/gallery/05.png" class="d-block w-100"
                                style="height: 300px; object-fit: cover;" alt="Ảnh chính">
                        </div>
                        <div class="card-title mt-1"
                            style="padding: 0 15px; display: flex; justify-content: space-between; align-items: center;">
                            <b style="font-size: 16px;">Vũng Tàu, Việt Nam</b>
                            <div style="display: flex; align-items: center; gap: 3px;">
                                <i class="fa-solid fa-star" style="color: black;"></i>
                                <span style="font-size: 14px;">4,86</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px 15px 15px 15px;">
                            <p style="margin: 2px 0;">Bãi trước</p>
                            <p style="margin: 2px 0;">8-13 thg 4</p>
                            <p style="margin: 2px 0;"><b><u>đ4.128.208</u></b> cho 5 đêm</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div
                            style="margin: 15px 15px 0 15px; border-radius: 10px; overflow: hidden; height: 300px; position: relative;">
                            <i class="fa-regular fa-heart"
                                style="position: absolute; top: 15px; right: 15px; font-size: 18px; color: red; cursor: pointer; z-index: 2;"></i>
                          
                            <img src="../../assets/images/gallery/06.png" class="d-block w-100"
                                style="height: 300px; object-fit: cover;" alt="Ảnh chính">
                        </div>
                        <div class="card-title mt-1"
                            style="padding: 0 15px; display: flex; justify-content: space-between; align-items: center;">
                            <b style="font-size: 16px;">Vũng Tàu, Việt Nam</b>
                            <div style="display: flex; align-items: center; gap: 3px;">
                                <i class="fa-solid fa-star" style="color: black;"></i>
                                <span style="font-size: 14px;">4,86</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px 15px 15px 15px;">
                            <p style="margin: 2px 0;">Bãi trước</p>
                            <p style="margin: 2px 0;">8-13 thg 4</p>
                            <p style="margin: 2px 0;"><b><u>đ4.128.208</u></b> cho 5 đêm</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div
                            style="margin: 15px 15px 0 15px; border-radius: 10px; overflow: hidden; height: 300px; position: relative;">
                            <i class="fa-regular fa-heart"
                                style="position: absolute; top: 15px; right: 15px; font-size: 18px; color: red; cursor: pointer; z-index: 2;"></i>
                          
                            <img src="../../assets/images/gallery/07.png" class="d-block w-100"
                                style="height: 300px; object-fit: cover;" alt="Ảnh chính">
                        </div>
                        <div class="card-title mt-1"
                            style="padding: 0 15px; display: flex; justify-content: space-between; align-items: center;">
                            <b style="font-size: 16px;">Vũng Tàu, Việt Nam</b>
                            <div style="display: flex; align-items: center; gap: 3px;">
                                <i class="fa-solid fa-star" style="color: black;"></i>
                                <span style="font-size: 14px;">4,86</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px 15px 15px 15px;">
                            <p style="margin: 2px 0;">Bãi trước</p>
                            <p style="margin: 2px 0;">8-13 thg 4</p>
                            <p style="margin: 2px 0;"><b><u>đ4.128.208</u></b> cho 5 đêm</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div
                            style="margin: 15px 15px 0 15px; border-radius: 10px; overflow: hidden; height: 300px; position: relative;">
                            <i class="fa-regular fa-heart"
                                style="position: absolute; top: 15px; right: 15px; font-size: 18px; color: red; cursor: pointer; z-index: 2;"></i>
                          
                            <img src="../../assets/images/gallery/08.png" class="d-block w-100"
                                style="height: 300px; object-fit: cover;" alt="Ảnh chính">
                        </div>
                        <div class="card-title mt-1"
                            style="padding: 0 15px; display: flex; justify-content: space-between; align-items: center;">
                            <b style="font-size: 16px;">Vũng Tàu, Việt Nam</b>
                            <div style="display: flex; align-items: center; gap: 3px;">
                                <i class="fa-solid fa-star" style="color: black;"></i>
                                <span style="font-size: 14px;">4,86</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px 15px 15px 15px;">
                            <p style="margin: 2px 0;">Bãi trước</p>
                            <p style="margin: 2px 0;">8-13 thg 4</p>
                            <p style="margin: 2px 0;"><b><u>đ4.128.208</u></b> cho 5 đêm</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../../assets/images/gallery/10.png" alt="..." class="card-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../../assets/images/gallery/11.png" alt="..." class="card-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../../assets/images/gallery/10.png" alt="..." class="card-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../../assets/images/gallery/11.png" alt="..." class="card-img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
                <div class="col">
                    <div class="card"
                        style="border-radius: 15px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                        <div class="card-body" style="padding: 20px;">
                            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                <div style="display: flex; margin-right: 10px;">
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star-half-alt" style="color: #FFD700; font-size: 18px;"></i>
                                </div>
                                <span style="font-weight: bold; font-size: 16px;">4.5/5</span>
                            </div>
                            <p style="font-style: italic; margin-bottom: 15px;">
                                "Khách sạn tuyệt vời với dịch vụ chu đáo, phòng ốc sạch sẽ và view đẹp. Nhân viên nhiệt
                                tình!"
                            </p>
                            <div style="display: flex; align-items: center;">
                                <img src="../../assets/images/avatars/avatar-3.png"
                                    style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                                <div>
                                    <p style="font-weight: bold; margin: 0;">Nguyễn Văn A</p>
                                    <p style="font-size: 12px; color: #888; margin: 0;">Khách hàng thân thiết</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card"
                        style="border-radius: 15px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                        <div class="card-body" style="padding: 20px;">
                            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                <div style="display: flex; margin-right: 10px;">
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                </div>
                                <span style="font-weight: bold; font-size: 16px;">5/5</span>
                            </div>
                            <p style="font-style: italic; margin-bottom: 15px;">
                                "Trải nghiệm tuyệt vời! Mọi thứ từ phòng nghỉ đến dịch vụ đều hoàn hảo. Sẽ quay lại vào
                                lần tới."
                            </p>
                            <div style="display: flex; align-items: center;">
                                <img src="../../assets/images/avatars/avatar-2.png"
                                    style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                                <div>
                                    <p style="font-weight: bold; margin: 0;">Trần Thị B</p>
                                    <p style="font-size: 12px; color: #888; margin: 0;">Khách du lịch</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card"
                        style="border-radius: 15px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                        <div class="card-body" style="padding: 20px;">
                            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                <div style="display: flex; margin-right: 10px;">
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="fa-solid fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                    <i class="far fa-star" style="color: #FFD700; font-size: 18px;"></i>
                                </div>
                                <span style="font-weight: bold; font-size: 16px;">4/5</span>
                            </div>
                            <p style="font-style: italic; margin-bottom: 15px;">
                                "Khách sạn tốt, vị trí thuận tiện. Chỉ có wifi hơi chậm một chút nhưng không ảnh hưởng
                                nhiều."
                            </p>
                            <div style="display: flex; align-items: center;">
                                <img src="../../assets/images/avatars/avatar-1.png"
                                    style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                                <div>
                                    <p style="font-weight: bold; margin: 0;">Lê Văn C</p>
                                    <p style="font-size: 12px; color: #888; margin: 0;">Khách công tác</p>
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
export default {

}
</script>
<style></style>