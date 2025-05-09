<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NhanVienController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = NhanVien::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Tài khoản hoặc mật khẩu không đúng.'], 401);
        }

        if ($admin->is_block == 1) {
            return response()->json(['message' => 'Tài khoản đã bị khóa.'], 403);
        }

        $token = $admin->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Đăng nhập thành công.',
            'token' => $token,
            'admin' => $admin,
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user && $user instanceof NhanVien) {
            $user->tokens()->delete();
            return response()->json(['message' => 'Đăng xuất thành công.']);
        }

        return response()->json(['message' => 'Không tìm thấy người dùng hoặc token không hợp lệ.'], 401);
    }

    public function kiemTraToken(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user && $user instanceof NhanVien) {
            return response()->json([
                'message' => 'Token hợp lệ.',
                'status' => true,
            ]);
        }

        return response()->json(['message' => 'Token không hợp lệ.', 'status' => false], 401);
    }

    public function profile(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user && $user instanceof NhanVien) {
            return response()->json([
                'message' => 'Lấy thông tin thành công.',
                'data' => $user->load(['chucVu', 'homestay']),
            ]);
        }

        return response()->json(['message' => 'Không tìm thấy người dùng hoặc token không hợp lệ.'], 401);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::guard('sanctum')->user();

        if ($user && $user instanceof NhanVien) {
            if ($request->hasFile('avatar')) {
                // Xóa ảnh cũ nếu có
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }

                // Lưu ảnh mới
                $path = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $path;
                $user->save();

                return response()->json([
                    'message' => 'Cập nhật ảnh đại diện thành công.',
                    'avatar' => $path,
                ]);
            }

            return response()->json(['message' => 'Không có ảnh được tải lên.'], 400);
        }

        return response()->json(['message' => 'Không tìm thấy người dùng hoặc token không hợp lệ.'], 401);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'nullable|string|max:15',
            'ngay_sinh' => 'nullable|date',
        ]);

        $user = Auth::guard('sanctum')->user();

        if ($user && $user instanceof NhanVien) {
            $user->update([
                'ho_ten' => $request->ho_ten,
                'so_dien_thoai' => $request->so_dien_thoai,
                'ngay_sinh' => $request->ngay_sinh,
            ]);

            return response()->json([
                'message' => 'Cập nhật thông tin thành công.',
                'data' => $user->load(['chucVu', 'homestay']),
            ]);
        }

        return response()->json(['message' => 'Không tìm thấy người dùng hoặc token không hợp lệ.'], 401);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::guard('sanctum')->user();

        if ($user && $user instanceof NhanVien) {
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['message' => 'Mật khẩu hiện tại không đúng.'], 400);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json(['message' => 'Đổi mật khẩu thành công.']);
        }

        return response()->json(['message' => 'Không tìm thấy người dùng hoặc token không hợp lệ.'], 401);
    }
}