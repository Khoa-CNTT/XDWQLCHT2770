<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CapNhatRequest;
use App\Http\Requests\DangKyRequest;
use App\Http\Requests\DangNhapRequest;
use App\Http\Requests\DatLaiMatKhauRequest;
use App\Http\Requests\QuenMKRequest;
use App\Mail\ActivateEmail;
use App\Mail\ResetPassword;

use App\Models\KhachHang;
use App\Jobs\MailQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Log;

class KhachHangController extends Controller
{
    // Đăng ký
    public function register(Request $request)
    {
        $check_mail = KhachHang::where('email', $request->email)->first();
        if ($check_mail) {
            return response()->json([
                'message' => 'Email đã tồn tại'
            ], 400);
        } else {
            $khachhang = $request->all();
            $khachhang['mat_khau'] = Hash::make($request->mat_khau);
            $khachhang['hash_active'] = Str::uuid();
            KhachHang::create($khachhang);

            $data['email'] = $request->email;
            $data['name'] = $khachhang['ho_ten'] = $request->ho_ten;
            $data['link'] = 'http://localhost:5173/kich-hoat-email/' . $khachhang['hash_active'];
            MailQueue::dispatch($data);

            return response()->json([
                'message' => 'Tạo tài khoản thành công. Vui lòng kiểm tra email để kích hoạt tài khoản.',
                'khachhang' => $khachhang
            ], 201);
        }
    }
    public function getLichSu(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user && $user instanceof KhachHang) {
            $lichsu = DB::table('bookings')
                ->select(
                    'bookings.id',
                    'bookings.id_homestay',
                    'homestays.ten_homestay',
                    'homestays.anh_chinh',
                    'bookings.ngay_dat',
                    'bookings.tong_tien',
                    'bookings.is_thanh_toan',
                    'bookings.ghi_chu',
                    'chi_tiet_dat_phongs.ngay_nhan_phong',
                    'chi_tiet_dat_phongs.ngay_tra_phong',
                )
                ->leftJoin('homestays', 'bookings.id_homestay', '=', 'homestays.id')
                    ->leftJoin('chi_tiet_dat_phongs', 'bookings.id', '=', 'chi_tiet_dat_phongs.id_dat_phong')
                ->where('bookings.id_khach_hang', $user->id)
                ->get();

            return response()->json([
                'status' => true,
                'data' => $lichsu
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
        }
    }
    public function updateProfile(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'nullable|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'ngay_sinh' => 'nullable|date|before:today',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Get authenticated customer
            $customer = Auth::guard('sanctum')->user();

            if (!$customer) {
                return response()->json([
                    'message' => 'Không tìm thấy người dùng'
                ], 404);
            }

            // Update customer information
            $customer->ho_ten = $request->input('ho_ten');
            $customer->so_dien_thoai = $request->input('so_dien_thoai');
            $customer->ngay_sinh = $request->input('ngay_sinh');
            $customer->save();

            return response()->json([
                'message' => 'Cập nhật thông tin thành công',
                'data' => [
                    'id' => $customer->id,
                    'ho_ten' => $customer->ho_ten,
                    'email' => $customer->email,
                    'so_dien_thoai' => $customer->so_dien_thoai,
                    'ngay_sinh' => $customer->ngay_sinh,
                    'avatar' => $customer->avatar
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Cập nhật thông tin thất bại',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Kích hoạt tài khoản
    public function activateAccount($hash)
    {
        $customer = KhachHang::where('hash_active', $hash)->first();

        if ($customer) {
            $customer->is_active = 1;
            $customer->hash_active = null;
            $customer->save();

            return response()->json(['message' => 'Account activated successfully.']);
        } else {
            return response()->json(['message' => 'Invalid activation link.'], 400);
        }
    }

    public function kichHoatTK(Request $request)
    {
        // Gửi lên 1 thằng duy nhất $request->email
        $khach_hang = KhachHang::where('email', $request->email)->first();
        if ($khach_hang) {
            // Tạo 1 mã hash_kich_hoat
            $hash_active = Str::uuid();
            $khach_hang->hash_active = $hash_active;
            $khach_hang->save();
            // Gửi Email
            $data['email'] = $request->email;
            $data['name'] = $khach_hang->ho_va_ten;
            $data['link'] = 'http://localhost:5173/kich-hoat-email/' . $hash_active;
            MailQueue::dispatch($data);

            return response()->json([
                'status' => true,
                'message' => 'Vui lòng kiểm tra email của bạn để kích hoạt!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản của bạn không tồn tại!',
            ]);
        }
    }

    public function quenMatKhau(request $request){
        $hash_reset = Str::uuid();
        KhachHang::where('email', $request->email)->update([
            'hash_reset'   =>   $hash_reset
        ]);

        $kh = KhachHang::where('email', $request->email)->first();
        if($kh) {
            $data['email'] = $request->email;
            $data['link'] = 'http://localhost:5173/dat-lai-mat-khau/' . $hash_reset;
            MailQueue::dispatch($data);

            // Gửi email tới tài khoản $request->email + $hash_reset


            return response()->json([
                'status'    =>  true,
                'message'   =>  "Vui lòng kiểm tra email!",
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  "Email không tồn tại!",
            ]);
        }
    }
    public function datLaiMatKhau(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'hash_reset_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $khach_hang = KhachHang::where('hash_reset', $request->hash_reset_password)->first();
        if ($khach_hang) {
            // Cập nhật mật khẩu
            $khach_hang->mat_khau = Hash::make($request->password);
            $khach_hang->hash_reset = null; // Xóa mã hash sau khi sử dụng
            $khach_hang->save();

            return response()->json([
                'status' => true,
                'message' => 'Đặt lại mật khẩu thành công!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Link đặt lại mật khẩu không hợp lệ hoặc đã hết hạn!',
            ], 404);
        }
    }
    public function updateAvatar(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Tối đa 2MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra file: ' . $validator->errors()->first()
            ], 400);
        }

        // Lấy thông tin khách hàng đã đăng nhập
        $khachhang = Auth::guard('sanctum')->user();
        if (!$khachhang || !($khachhang instanceof \App\Models\KhachHang)) {
            return response()->json([
                'status' => false,
                'message' => 'Không xác thực được. Vui lòng kiểm tra token.'
            ], 401);
        }

        // Xử lý file tải lên
        if ($request->hasFile('avatar')) {
            try {
                // Xóa ảnh đại diện cũ nếu có
                if ($khachhang->avatar) {
                    Storage::disk('public')->delete($khachhang->avatar);
                }

                // Lưu ảnh mới
                $path = $request->file('avatar')->store('avatars', 'public');

                // Cập nhật ảnh đại diện trong cơ sở dữ liệu
                $khachhang->avatar = $path;
                $khachhang->save();

                // Tạo URL cho ảnh
                $avatarUrl = Storage::url($path);

                return response()->json([
                    'status' => true,
                    'avatar' => $avatarUrl
                ], 200);
            } catch (\Exception $e) {
                // Ghi log lỗi để gỡ lỗi
                Log::error('Lỗi khi cập nhật ảnh đại diện: ' . $e->getMessage());
                return response()->json([
                    'status' => false,
                    'message' => 'Không thể cập nhật ảnh đại diện: ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Không có file ảnh được tải lên'
        ], 400);
    }

    // Kiểm tra đăng nhập
    public function kiemTraToken()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user && $user instanceof \App\Models\KhachHang) {
            return response()->json([
                'status'    =>  true,
                'message'   =>  "Oke, bạn có thể đi qua",
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  "Bạn cần đăng nhập hệ thống trước",
            ]);
        }
    }

    // Đăng nhập
    public function login(DangNhapRequest $request)
    {
        $customer = KhachHang::where('email', $request->email)->first();

        if (!$customer || !Hash::check($request->mat_khau, $customer->mat_khau)) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        if (!$customer->is_active) {
            return response()->json(['message' => 'Account not activated. Please check your email.'], 403);
        }

        if ($customer->is_block) {
            return response()->json(['message' => 'Account is blocked.'], 403);
        }

        $token = $customer->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'customer' => $customer,
            'token' => $token
        ]);
    }

    // Lấy thông tin cá nhân
    public function profile()
    {
        $user = Auth::guard('sanctum')->user();

        if ($user && $user instanceof KhachHang) {
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
        }
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        // Xóa token của người dùng hiện tại
        $request->user()->currentAccessToken()->delete();

        // Trả về phản hồi thành công
        return response()->json(['message' => 'Đăng xuất thành công.'], 200);
    }

    // Quên mật khẩu
    public function forgotPassword(QuenMKRequest $request)
    {
        $customer = KhachHang::where('email', $request->email)->first();
        $hash = Str::random(40);

        $customer->update(['hash_reset' => $hash]);

        Mail::to($customer->email)->send(new ResetPassword($customer, $hash));

        return response()->json(['message' => 'Password reset link sent to your email.']);
    }

    // Đặt lại mật khẩu
    public function resetPassword(DatLaiMatKhauRequest $request)
    {
        $customer = KhachHang::where('email', $request->email)
            ->where('hash_reset', $request->hash_reset)
            ->first();

        if (!$customer) {
            return response()->json(['message' => 'Invalid reset link.'], 400);
        }

        $customer->update([
            'mat_khau' => $request->mat_khau,
            'hash_reset' => null
        ]);

        return response()->json(['message' => 'Password reset successfully.']);
    }

    // Thay đổi mật khẩu
    public function changePassword(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // Lấy user đã xác thực qua guard 'sanctum'
        $customer = Auth::guard('sanctum')->user();

        // Kiểm tra xem user có tồn tại và là instance của model KhachHang không
        if (!$customer || !($customer instanceof \App\Models\KhachHang)) {
            return response()->json([
                'message' => 'Unauthenticated or invalid user'
            ], 401);
        }

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($validated['current_password'], $customer->mat_khau)) {
            return response()->json([
                'message' => 'Current password is incorrect.'
            ], 400);
        }

        // Cập nhật mật khẩu mới
        $newPassword = Hash::make($validated['new_password']);
        $customer->update(['mat_khau' => $newPassword]);

        return response()->json([
            'message' => 'Password changed successfully.'
        ], 200);
    }
    public function getBookingHistory(Request $request)
{
    $user = Auth::guard('sanctum')->user();
    if ($user && $user instanceof KhachHang) {
        $bookingHistory = DB::table('bookings')
            ->join('homestays', 'bookings.id_homestay', '=', 'homestays.id')
            ->where('bookings.id_khach_hang', $user->id)
            ->select('bookings.*', 'homestays.anh_chinh')
            ->orderBy('bookings.ngay_dat', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $bookingHistory
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Chưa đăng nhập'
        ], 401);
    }
}
}