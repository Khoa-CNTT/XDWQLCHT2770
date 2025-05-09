<?php

use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\HomestayController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PhanQuyenController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\QLBookingController;
use App\Http\Controllers\QLKhachHangController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\NhanVienMiddleware;
use App\Models\LoaiPhong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Facades;


// routes/api.php
Route::get('/check-thanh-toan', [BookingController::class, 'checkThanhToan']);




Route::middleware('auth:sanctum')->post('/update-avatar', [KhachHangController::class, 'updateAvatar']);
Route::post('register', [KhachHangController::class, 'register']);
Route::middleware('auth:sanctum')->post('logout', [KhachHangController::class, 'logout']);
Route::get('kiem-tra-token-khach-hang', [KhachHangController::class, 'kiemTraToken']);
Route::post('/gui-mail-kich-hoat', [KhachHangController::class, 'kichHoatTK']);
Route::post('/login', [KhachHangController::class, 'login']);
Route::post('/quen-mat-khau', [KhachHangController::class, 'quenMatKhau']);
Route::post('/dat-lai-mat-khau', [KhachHangController::class, 'datLaiMatKhau']);
Route::post('reset-password', [KhachHangController::class, 'resetPassword']);
Route::get('/activate/{hash}', [KhachHangController::class, 'activateAccount']);
Route::post('/lich-su-dat-phong', [KhachHangController::class, 'getLichSu']);
Route::post('/cap-nhat-thong-tin', [KhachHangController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [KhachHangController::class, 'profile']);
    Route::post('logout', [KhachHangController::class, 'logout']);

    Route::post('change-password', [KhachHangController::class, 'changePassword']);
});

Route::get('/homestay/list', [HomestayController::class, 'data']);
Route::get('/bai_viets/lay-danh-sach', [App\Http\Controllers\BaiVietController::class, 'layDanhSach']);
Route::get('/bai_viets/chi-tiet/{id}', [BaiVietController::class, 'chiTiet']);


Route::group(['middleware' => 'admin'], function () {
    // QUản lý dịch vụ
    Route::get('/admin/dichvu/data', [ServiceController::class, 'getDichVu']);
    Route::post('/admin/dichvu/store', [ServiceController::class, 'store']);
    Route::post('/admin/dichvu/update', [ServiceController::class, 'update']);
    Route::post('/admin/dichvu/delete', [ServiceController::class, 'destroy']);

    //Dashboard
    Route::get('admin/dashboard/12thang', [App\Http\Controllers\ThongKeController::class, 'thongKeDoanhThuNam']);
    Route::get('admin/dashboard/stats', [App\Http\Controllers\ThongKeController::class, 'getDashboardStats']);
    // Quản lý homestay
    Route::get('/admin/homestay/data', [HomestayController::class, 'data']);
    Route::post('/admin/homestay/store', [HomestayController::class, 'store']);
    Route::post('/admin/homestay/update', [HomestayController::class, 'update']);
    Route::post('/admin/homestay/delete/{id}', [HomestayController::class, 'delete']);

    //Quản lý bài viết
    Route::prefix('admin')->group(function () {
        Route::get('/bai_viets/lay-danh-sach', [App\Http\Controllers\BaiVietController::class, 'layDanhSach']);
        Route::post('/bai_viets/them-moi', [App\Http\Controllers\BaiVietController::class, 'themMoi']);
        Route::post('/bai_viets/cap-nhat', [App\Http\Controllers\BaiVietController::class, 'capNhat']);
        Route::post('/bai_viets/xoa', [App\Http\Controllers\BaiVietController::class, 'xoa']);
        Route::post('/tai-anh-len', [App\Http\Controllers\BaiVietController::class, 'taiAnhLen']);
        Route::get('/bai_viets/chi-tiet/{id}', [BaiVietController::class, 'chiTiet']);
    });

    Route::get('/phan-quyen/data', [PhanQuyenController::class, 'getData']);
    Route::post('/phan-quyen/create', [PhanQuyenController::class, 'createData']);
    Route::delete('/phan-quyen/delete/{id}', [PhanQuyenController::class, 'deleteData']);
    Route::put('/phan-quyen/update', [PhanQuyenController::class, 'UpateData']);
    Route::post('/phan-quyen/tim-kiem', [PhanQuyenController::class, 'timKiem']);

     

    // Quản lý khach hàng
    Route::prefix('admin/khach_hangs')->group(function () {
        Route::get('/lay-danh-sach', [QLKhachHangController::class, 'getData']);
        Route::post('/them-moi', [QLKhachHangController::class, 'themMoi']);
        Route::post('/cap-nhat', [QLKhachHangController::class, 'capNhat']);
        Route::post('/xoa', [QLKhachHangController::class, 'xoa']);
    });

    // Quản lý phòng
    Route::prefix('admin/phong')->group(function () {
        Route::get('/data', [PhongController::class, 'index']);
        Route::post('/add', [PhongController::class, 'store']);
        Route::post('/update/{id}', [PhongController::class, 'update']);
        Route::delete('/destroy/{id}', [PhongController::class, 'destroy']);
        Route::post('/tai-anh-len', [App\Http\Controllers\PhongController::class, 'taiAnhLen']);
        Route::post('/{id}/add-image', [App\Http\Controllers\PhongController::class, 'addImage']);
        Route::delete('/{phongId}/delete-image/{imageId} ', [App\Http\Controllers\PhongController::class, 'deleteImage']);
    });
    //QUản lý đánh giá
    Route::get('/admin/danh-gia/data', [DanhGiaController::class, 'getDanhGia']);
    Route::post('/admin/danh-gia/store', [DanhGiaController::class, 'store']);
    Route::post('/admin/danh-gia/update', [DanhGiaController::class, 'update']);
    Route::delete('/admin/danh-gia/delete/{id}', [DanhGiaController::class, 'destroy']);

    //QUản lý nhân Viên
    Route::get('admin/nhan-vien/data', [App\Http\Controllers\QLNhanVienController::class, 'getData']);
    Route::post('admin/nhan-vien/them', [App\Http\Controllers\QLNhanVienController::class, 'themNV']);
    Route::post('admin/nhan-vien/sua', [App\Http\Controllers\QLNhanVienController::class, 'suaNV']);
    Route::post('admin/nhan-vien/xoa', [App\Http\Controllers\QLNhanVienController::class, 'xoaNV']);

    Route::prefix('admin')->group(function () {


        Route::post('/logout', [NhanVienController::class, 'logout']);

        Route::get('/profile', [NhanVienController::class, 'profile']);
        Route::post('/update-avatar', [NhanVienController::class, 'updateAvatar']);
        Route::post('/update-profile', [NhanVienController::class, 'updateProfile']);
        Route::post('/change-password', [NhanVienController::class, 'changePassword']);

    });
});

Route::post('/admin/login', [NhanVienController::class, 'login']);
Route::get('/admin/kiem-tra-token', [NhanVienController::class, 'kiemTraToken']);





Route::get('/homestays/search', [BookingController::class, 'searchHomestays']);
Route::get('/homestays/{id}', [BookingController::class, 'getHomestayDetail']);
Route::get('/homestays/{homestayId}/rooms', [BookingController::class, 'getRoomsByHomestay']);
Route::post('/calculate-price', [BookingController::class, 'calculatePrice']);
Route::post('/bookings', [BookingController::class, 'createBooking']);

// Route::middleware('auth:sanctum')->group(function () {
Route::get('/admin/bookings', [QLBookingController::class, 'getAdminBookings']);
Route::put('/admin/bookings/{bookingId}/payment-status', [QLBookingController::class, 'updatePaymentStatus']);
Route::put('/admin/booking-details/{detailId}/status', [QLBookingController::class, 'updateBookingDetailStatus']);
Route::post('/admin/bookings', [QLBookingController::class, 'createBooking']);
Route::put('/admin/bookings/{bookingId}', [QLBookingController::class, 'updateBooking']);
Route::delete('/admin/bookings/{bookingId}', [QLBookingController::class, 'deleteBooking']);
Route::get('/admin/homestays', [QLBookingController::class, 'getHomestays']);
Route::get('/admin/customers', [QLBookingController::class, 'getCustomers']);
Route::get('/admin/homestays/{homestayId}/rooms', [QLBookingController::class, 'getRoomsByHomestay']);
Route::post('/admin/check-available-rooms', [QLBookingController::class, 'checkAvailableRooms']);
// });






Route::get('admin/chuc-vu/data', [ChucVuController::class, 'getChucVu']);
Route::post('admin/chuc-vu/them', [ChucVuController::class, 'store']);
Route::post('admin/chuc-vu/sua', [ChucVuController::class, 'update']);
Route::delete('admin/chuc-vu/xoa', [ChucVuController::class, 'destroy']);

Route::get('admin/chuc-nang/data', [App\Http\Controllers\ChucNangController::class, 'getData']);
Route::post('admin/chuc-nang/them', [App\Http\Controllers\ChucNangController::class, 'store']);
Route::post('admin/chuc-nang/sua/{id}', [App\Http\Controllers\ChucNangController::class, 'update']);
Route::delete('admin/chuc-nang/xoa/{id}', [App\Http\Controllers\ChucNangController::class, 'destroy']);

Route::get('/phan-quyen/data', [PhanQuyenController::class, 'getData']);
Route::post('/phan-quyen/create', [PhanQuyenController::class, 'createData']);
Route::delete('/phan-quyen/delete/{id}', [PhanQuyenController::class, 'deleteData']);
Route::put('/phan-quyen/update', [PhanQuyenController::class, 'UpateData']);
Route::post('/phan-quyen/tim-kiem', [PhanQuyenController::class, 'timKiem']);


Route::post('/create-payment', [PaymentController::class, 'createPayment']);
Route::post('/webhook', [PaymentController::class, 'webhook']);