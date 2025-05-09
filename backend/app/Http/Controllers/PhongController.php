<?php

namespace App\Http\Controllers;

use App\Models\Phong;
use App\Models\AnhPhong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PhongController extends Controller
{
    public function index()
    {
        try {
            $phongs = Phong::with('hinhAnhs')->get()->map(function ($phong) {
                $phong->hinh_anhs = $phong->hinhAnhs->map(function ($image) {
                    return ['id' => $image->id, 'url' => $image->url];
                });
                unset($phong->hinhAnhs);
                return $phong;
            });
            return response()->json($phongs, 200);
        } catch (\Exception $e) {
            \Log::error('Lỗi khi lấy danh sách phòng: ' . $e->getMessage());
            return response()->json([
                'message' => 'Lỗi khi lấy danh sách phòng',
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_homestay' => 'required|exists:homestays,id',
            'ten_phong' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'dien_tich' => 'required|numeric|min:0',
            'gia' => 'required|numeric|min:0',
            'tien_ich' => 'required|string',
            'suc_chua' => 'required|integer|min:1',
            'so_giuong' => 'required|integer|min:1',
            'trang_thai' => 'required|in:0,1',
            'hinh_anhs' => 'required|array|min:1',
            'hinh_anhs.*' => 'string'
        ]);

        try {
            $data = $request->only([
                'id_homestay',
                'ten_phong',
                'mo_ta',
                'dien_tich',
                'gia',
                'tien_ich',
                'suc_chua',
                'so_giuong',
                'trang_thai'
            ]);
            $phong = Phong::create($data);

            foreach ($request->hinh_anhs as $url) {
                AnhPhong::create([
                    'phong_id' => $phong->id,
                    'url' => $url
                ]);
            }

            $phong->hinh_anhs = $phong->hinhAnhs->map(function ($image) {
                return ['id' => $image->id, 'url' => $image->url];
            });
            return response()->json($phong, 201);
        } catch (\Exception $e) {
            \Log::error('Lỗi khi thêm phòng: ' . $e->getMessage());
            return response()->json(['message' => 'Lỗi khi thêm phòng', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $phong = Phong::findOrFail($id);
        $request->validate([
            'id_homestay' => 'required|exists:homestays,id',
            'ten_phong' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'dien_tich' => 'required|numeric|min:0',
            'gia' => 'required|numeric|min:0',
            'tien_ich' => 'required|string',
            'suc_chua' => 'required|integer|min:1',
            'so_giuong' => 'required|integer|min:1',
            'trang_thai' => 'required|in:0,1'
        ]);

        try {
            $data = $request->only([
                'id_homestay',
                'ten_phong',
                'mo_ta',
                'dien_tich',
                'gia',
                'tien_ich',
                'suc_chua',
                'so_giuong',
                'trang_thai'
            ]);
            $phong->update($data);

            $phong->hinh_anhs = $phong->hinhAnhs->map(function ($image) {
                return ['id' => $image->id, 'url' => $image->url];
            });
            return response()->json($phong, 200);
        } catch (\Exception $e) {
            \Log::error('Lỗi khi cập nhật phòng: ' . $e->getMessage());
            return response()->json(['message' => 'Lỗi khi cập nhật phòng', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $phong = Phong::findOrFail($id);
            foreach ($phong->hinhAnhs as $image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $image->url));
                $image->delete();
            }
            $phong->delete();
            return response()->json(['message' => 'Xóa phòng thành công'], 200);
        } catch (\Exception $e) {
            \Log::error('Lỗi khi xóa phòng: ' . $e->getMessage());
            return response()->json(['message' => 'Lỗi khi xóa phòng', 'error' => $e->getMessage()], 500);
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
        } catch (\Exception $e) {
            \Log::error('Lỗi khi tải ảnh lên: ' . $e->getMessage());
            return response()->json([
                'thong_bao' => 'Lỗi khi tải ảnh lên',
                'loi' => $e->getMessage()
            ], 500);
        }
    }

    public function addImage(Request $request, $phongId)
    {
        $request->validate([
            'hinh_anh' => 'required|string'
        ]);

        try {
            $phong = Phong::findOrFail($phongId);
            $image = AnhPhong::create([
                'phong_id' => $phong->id,
                'url' => $request->hinh_anh
            ]);
            return response()->json([
                'message' => 'Thêm ảnh thành công',
                'url' => $image->url,
                'id' => $image->id
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Lỗi khi thêm ảnh: ' . $e->getMessage());
            return response()->json(['message' => 'Lỗi khi thêm ảnh', 'error' => $e->getMessage()], 500);
        }
    }

    public function deleteImage($phongId, $imageId)
    {
        try {
            $image = AnhPhong::where('phong_id', $phongId)->where('id', $imageId)->firstOrFail();
            Storage::disk('public')->delete(str_replace('/storage/', '', $image->url));
            $image->delete();
            return response()->json(['message' => 'Xóa ảnh thành công'], 200);
        } catch (\Exception $e) {
            \Log::error('Lỗi khi xóa ảnh: ' . $e->getMessage());
            return response()->json(['message' => 'Lỗi khi xóa ảnh', 'error' => $e->getMessage()], 500);
        }
    }
}