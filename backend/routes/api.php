<?php


use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Facades;


// routes/api.php


Route::post('register', [KhachHangController::class, 'register']);
Route::get('kiem-tra-token-khach-hang', [KhachHangController::class, 'kiemTraToken']);
Route::post('/gui-mail-kich-hoat', [KhachHangController::class, 'kichHoatTK']);
Route::post('/login', [KhachHangController::class, 'login']);
Route::post('forgot-password', [KhachHangController::class, 'forgotPassword']);
Route::post('reset-password', [KhachHangController::class, 'resetPassword']);
Route::get('/activate/{hash}', [KhachHangController::class, 'activateAccount']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [KhachHangController::class, 'profile']);
    Route::post('logout', [KhachHangController::class, 'logout']);
    Route::post('profile', [KhachHangController::class, 'updateProfile']);
    Route::post('change-password', [KhachHangController::class, 'changePassword']);
});


Route::get('/admin/dichvu/data', [ServiceController::class, 'getDichVu']);
Route::post('/admin/dichvu/store', [ServiceController::class, 'store']);
Route::post('/admin/dichvu/update', [ServiceController::class, 'update']);
Route::post('/admin/dichvu/delete', [ServiceController::class, 'destroy']);

Route::post("/khach-hang/kich-hoat", [KhachHangController::class, 'kichHoat']);
Route::post("/khach-hang/dang-ky", [KhachHangController::class, 'dangKy']);
