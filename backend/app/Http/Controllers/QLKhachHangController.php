<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class QLKhachHangController extends Controller
{
    /**
     * Lấy danh sách khách hàng
     */
    public function getData()
    {
        try {
            $khachHangs = KhachHang::all()->map(function ($khachHang) {
                return [
                    'id' => $khachHang->id,
                    'ho_ten' => $khachHang->ho_ten,
                    'email' => $khachHang->email,
                    'so_dien_thoai' => $khachHang->so_dien_thoai,
                    'ngay_sinh' => $khachHang->ngay_sinh,
                    'gioi_tinh' => $khachHang->gioi_tinh,
                    'avatar' => $khachHang->avatar ? Storage::url($khachHang->avatar) : null,
                    'is_block' => $khachHang->is_block,
                    'is_active' => $khachHang->is_active,
                    'created_at' => $khachHang->created_at,
                    'updated_at' => $khachHang->updated_at
                ];
            });

            return response()->json([
                'thong_bao' => 'Lấy danh sách khách hàng thành công',
                'du_lieu' => $khachHangs
            ], 200);
        } catch (Exception $e) {
            Log::error('Lỗi khi lấy danh sách khách hàng', ['loi' => $e->getMessage()]);
            return response()->json([
                'thong_bao' => 'Lỗi khi lấy danh sách khách hàng',
                'loi' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Thêm khách hàng mới
     */
    public function themMoi(Request $request)
    {
        try {
            Log::info('Thêm Khách Hàng Request Payload', $request->all());

            $validated = $request->validate([
                'ho_ten' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:khach_hangs,email',
                'so_dien_thoai' => 'required|string|max:15|unique:khach_hangs,so_dien_thoai',
                'ngay_sinh' => 'required|date|before:today',
                'gioi_tinh' => 'required|integer|in:0,1,2',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'mat_khau' => 'required|string|min:6',
                'is_block' => 'nullable|integer|in:0,1',
                'is_active' => ''
            ]);

            // Mã hóa mật khẩu
            $validated['mat_khau'] = Hash::make($validated['mat_khau']);

            // Xử lý upload avatar nếu có
            if ($request->hasFile('avatar')) {
                $duongDanAvatar = $request->file('avatar')->store('avatars', 'public');
                $validated['avatar'] = $duongDanAvatar;
            } else {
                // Nếu không có avatar, gán giá trị null
                $validated['avatar'] = 'avatars/avatar.jpg';
            }

            Log::info('Dữ Liệu Đã Xác Thực', $validated);

            $khachHang = KhachHang::create($validated);

            Log::info('Khách Hàng Đã Tạo', $khachHang->toArray());

            return response()->json([
                'thong_bao' => 'Thêm khách hàng thành công',
                'du_lieu' => [
                    'id' => $khachHang->id,
                    'ho_ten' => $khachHang->ho_ten,
                    'email' => $khachHang->email,
                    'so_dien_thoai' => $khachHang->so_dien_thoai,
                    'ngay_sinh' => $khachHang->ngay_sinh,
                    'gioi_tinh' => $khachHang->gioi_tinh,
                    'avatar' => $khachHang->avatar ? Storage::url($khachHang->avatar) : null,
                    'is_block' => $khachHang->is_block,
                    'is_active' => $khachHang->is_active,
                    'created_at' => $khachHang->created_at,
                    'updated_at' => $khachHang->updated_at
                ]
            ], 201);
        } catch (ValidationException $e) {
            Log::error('Lỗi Xác Thực', $e->errors());
            return response()->json([
                'thong_bao' => 'Dữ liệu không hợp lệ',
                'loi' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Lỗi Thêm Khách Hàng', ['loi' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'thong_bao' => 'Lỗi khi thêm khách hàng',
                'loi' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cập nhật thông tin khách hàng
     */
    public function capNhat(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:khach_hangs,id',
                'ho_ten' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:khach_hangs,email,' . $request->id,
                'so_dien_thoai' => 'required|string|max:15|unique:khach_hangs,so_dien_thoai,' . $request->id,
                'ngay_sinh' => 'required|date|before:today',
                'gioi_tinh' => 'required|integer|in:0,1,2',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'mat_khau' => 'nullable|string|min:6',
                'is_block' => 'nullable|integer|in:0,1',
                'is_active' => 'nullable|integer|in:0,1'
            ]);

            $khachHang = KhachHang::findOrFail($validated['id']);

            // Xử lý upload avatar nếu có
            if ($request->hasFile('avatar')) {
                // Xóa avatar cũ nếu có
                if ($khachHang->avatar) {
                    Storage::disk('public')->delete($khachHang->avatar);
                }
                $duongDanAvatar = $request->file('avatar')->store('avatars', 'public');
                $validated['avatar'] = $duongDanAvatar;
            } else {
                // Giữ nguyên avatar cũ nếu không upload mới
                $validated['avatar'] = $khachHang->avatar;
            }

            // Mã hóa mật khẩu nếu được cung cấp
            if (!empty($validated['mat_khau'])) {
                $validated['mat_khau'] = Hash::make($validated['mat_khau']);
            } else {
                // Không cập nhật mật khẩu nếu không cung cấp
                unset($validated['mat_khau']);
            }

            $khachHang->update($validated);

            return response()->json([
                'thong_bao' => 'Cập nhật khách hàng thành công',
                'du_lieu' => [
                    'id' => $khachHang->id,
                    'ho_ten' => $khachHang->ho_ten,
                    'email' => $khachHang->email,
                    'so_dien_thoai' => $khachHang->so_dien_thoai,
                    'ngay_sinh' => $khachHang->ngay_sinh,
                    'gioi_tinh' => $khachHang->gioi_tinh,
                    'avatar' => $khachHang->avatar ? Storage::url($khachHang->avatar) : null,
                    'is_block' => $khachHang->is_block,
                    'is_active' => $khachHang->is_active,
                    'created_at' => $khachHang->created_at,
                    'updated_at' => $khachHang->updated_at
                ]
            ], 200);
        } catch (ValidationException $e) {
            Log::error('Lỗi Xác Thực', $e->errors());
            return response()->json([
                'thong_bao' => 'Dữ liệu không hợp lệ',
                'loi' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Lỗi Cập Nhật Khách Hàng', ['loi' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'thong_bao' => 'Lỗi khi cập nhật khách hàng',
                'loi' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xóa khách hàng
     */
    public function xoa(Request $request)
    {

        try {
            $id = $request->id;
            $khachHang = KhachHang::findOrFail($id);

            // Xóa avatar nếu có
            if ($khachHang->avatar) {
                Storage::disk('public')->delete($khachHang->avatar);
            }

            $khachHang->delete();

            return response()->json([
                'thong_bao' => 'Xóa khách hàng thành công'
            ], 200);
        } catch (Exception $e) {
            Log::error('Lỗi Xóa Khách Hàng', ['loi' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'thong_bao' => 'Lỗi khi xóa khách hàng',
                'loi' => $e->getMessage()
            ], 500);
        }
    }
}
