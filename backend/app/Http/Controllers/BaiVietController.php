<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;

class BaiVietController extends Controller
{
    public function layDanhSach()
    {
        try {
            $baiViets = BaiViet::all()->map(function ($baiViet) {
                return [
                    'id' => $baiViet->id,
                    'tieu_de' => $baiViet->tieu_de,
                    'noi_dung' => $baiViet->noi_dung,
                    'tinh_trang' => $baiViet->tinh_trang,
                    'id_nguoi_dang' => $baiViet->id_nguoi_dang,
                    'ngay_tao' => $baiViet->created_at,
                    'image' => $baiViet->image ? Storage::url($baiViet->image) : null // Thêm trường image
                ];
            });

            return response()->json($baiViets, 200);
        } catch (Exception $e) {
            return response()->json([
                'thong_bao' => 'Lỗi khi lấy danh sách bài viết',
                'loi' => $e->getMessage()
            ], 500);
        }
    }

    public function chiTiet($id)
    {
        try {
            $baiViet = BaiViet::findOrFail($id);

            return response()->json([
                'thong_bao' => 'Lấy chi tiết bài viết thành công',
                'du_lieu' => [
                    'id' => $baiViet->id,
                    'tieu_de' => $baiViet->tieu_de,
                    'noi_dung' => $baiViet->noi_dung,
                    'tinh_trang' => $baiViet->tinh_trang,
                    'id_nguoi_dang' => $baiViet->id_nguoi_dang,
                    'ngay_tao' => $baiViet->created_at,
                    'image' => $baiViet->image ? Storage::url($baiViet->image) : null
                ]
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'thong_bao' => 'Lỗi khi lấy chi tiết bài viết',
                'loi' => $e->getMessage()
            ], 404);
        }
    }

    public function themMoi(Request $request)
    {
        try {
            Log::info('Thêm Bài Viết Request Payload', $request->all());

            $validated = $request->validate([
                'tieu_de' => 'required|string|max:255',
                'noi_dung' => 'required|string',
                'tinh_trang' => 'required|integer|in:0,1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Thêm xác thực cho ảnh
            ]);



            // Xử lý upload ảnh nếu có
            if ($request->hasFile('image')) {
                $duongDanAnh = $request->file('image')->store('bai_viets', 'public');
                $validated['image'] = $duongDanAnh;
            }

            Log::info('Dữ Liệu Đã Xác Thực', $validated);

            $baiViet = BaiViet::create($validated);

            Log::info('Bài Viết Đã Tạo', $baiViet->toArray());

            return response()->json([
                'thong_bao' => 'Bài viết được tạo thành công',
                'du_lieu' => [
                    'id' => $baiViet->id,
                    'tieu_de' => $baiViet->tieu_de,
                    'noi_dung' => $baiViet->noi_dung,
                    'tinh_trang' => $baiViet->tinh_trang,
                    'id_nguoi_dang' => $baiViet->id_nguoi_dang,
                    'ngay_tao' => $baiViet->created_at,
                    'image' => $baiViet->image ? Storage::url($baiViet->image) : null // Trả về URL ảnh
                ]
            ], 201);
        } catch (ValidationException $e) {
            Log::error('Lỗi Xác Thực', $e->errors());
            return response()->json([
                'thong_bao' => 'Dữ liệu không hợp lệ',
                'loi' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Lỗi Thêm Bài Viết', ['loi' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'thong_bao' => 'Lỗi khi tạo bài viết',
                'loi' => $e->getMessage()
            ], 500);
        }
    }

    public function capNhat(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:bai_viets,id',
                'tieu_de' => 'required|string|max:255',
                'noi_dung' => 'required|string',
                'tinh_trang' => 'required|integer|in:0,1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Thêm xác thực cho ảnh
            ]);

            $baiViet = BaiViet::findOrFail($validated['id']);

            // Xử lý upload ảnh mới nếu có
            if ($request->hasFile('image')) {
                // Xóa ảnh cũ nếu có
                if ($baiViet->image) {
                    Storage::disk('public')->delete($baiViet->image);
                }
                $duongDanAnh = $request->file('image')->store('bai_viets', 'public');
                $validated['image'] = $duongDanAnh;
            } else {
                // Giữ nguyên ảnh cũ nếu không upload ảnh mới
                $validated['image'] = $baiViet->image;
            }

            $baiViet->update($validated);

            return response()->json([
                'thong_bao' => 'Bài viết được cập nhật thành công',
                'du_lieu' => [
                    'id' => $baiViet->id,
                    'tieu_de' => $baiViet->tieu_de,
                    'noi_dung' => $baiViet->noi_dung,
                    'tinh_trang' => $baiViet->tinh_trang,
                    'id_nguoi_dang' => $baiViet->id_nguoi_dang,
                    'ngay_tao' => $baiViet->created_at,
                    'image' => $baiViet->image ? Storage::url($baiViet->image) : null // Trả về URL ảnh
                ]
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'thong_bao' => 'Dữ liệu không hợp lệ',
                'loi' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'thong_bao' => 'Lỗi khi cập nhật bài viết',
                'loi' => $e->getMessage()
            ], 500);
        }
    }

    public function xoa(Request $request)
    {
        try {
            $id = $request->id;
            $baiViet = BaiViet::findOrFail($id);

            // Xóa ảnh nếu có
            if ($baiViet->image) {
                Storage::disk('public')->delete($baiViet->image);
            }

            $baiViet->delete();

            return response()->json(['thong_bao' => 'Bài viết được xóa thành công'], 200);
        } catch (Exception $e) {
            return response()->json([
                'thong_bao' => 'Lỗi khi xóa bài viết',
                'loi' => $e->getMessage()
            ], 500);
        }
    }

    public function taiAnhLen(Request $request)
    {
        try {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $duongDanAnh = $request->file('image')->store('bai_viets', 'public');
            $urlAnh = Storage::url($duongDanAnh);

            return response()->json([
                'thong_bao' => 'Tải ảnh lên thành công',
                'url' => $urlAnh
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'thong_bao' => 'Dữ liệu không hợp lệ',
                'loi' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'thong_bao' => 'Lỗi khi tải ảnh lên',
                'loi' => $e->getMessage()
            ], 500);
        }
    }
}