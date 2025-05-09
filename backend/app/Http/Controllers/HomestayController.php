<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Exception;

class HomestayController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'ten_homestay' => 'required|string|max:255',
                'dia_chi' => 'required|string|max:255',
                'mo_ta' => 'required|string',
                'tien_ich' => 'nullable|string',
                'tinh_trang' => 'required|integer|in:0,1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('homestays', 'public');
                $validated['anh_chinh'] = $imagePath;
            } else {
                $validated['anh_chinh'] = null;
            }

            $homestay = Homestay::create($validated);

            return response()->json([
                'message' => 'Homestay được tạo thành công',
                'data' => [
                    'id' => $homestay->id,
                    'ten_homestay' => $homestay->ten_homestay,
                    'dia_chi' => $homestay->dia_chi,
                    'mo_ta' => $homestay->mo_ta,
                    'tien_ich' => $homestay->tien_ich,
                    'tinh_trang' => $homestay->tinh_trang,
                    'image' => $homestay->anh_chinh ? Storage::url($homestay->anh_chinh) : null,
                ]
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi tạo homestay',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:homestays,id',
                'ten_homestay' => 'required|string|max:255',
                'dia_chi' => 'required|string|max:255',
                'mo_ta' => 'required|string',
                'tien_ich' => 'nullable|string',
                'tinh_trang' => 'required|integer|in:0,1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $homestay = Homestay::findOrFail($validated['id']);

            // Xử lý ảnh
            if ($request->hasFile('image')) {
                // Xóa ảnh cũ nếu có
                if ($homestay->anh_chinh) {
                    Storage::disk('public')->delete($homestay->anh_chinh);
                }
                $imagePath = $request->file('image')->store('homestays', 'public');
                $validated['anh_chinh'] = $imagePath;
            } else {
                // Giữ nguyên ảnh cũ
                $validated['anh_chinh'] = $homestay->anh_chinh;
            }

            $homestay->update($validated);

            return response()->json([
                'message' => 'Homestay được cập nhật thành công',
                'data' => [
                    'id' => $homestay->id,
                    'ten_homestay' => $homestay->ten_homestay,
                    'dia_chi' => $homestay->dia_chi,
                    'mo_ta' => $homestay->mo_ta,
                    'tien_ich' => $homestay->tien_ich,
                    'tinh_trang' => $homestay->tinh_trang,
                    'image' => $homestay->anh_chinh ? Storage::url($homestay->anh_chinh) : null,
                ]
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi cập nhật homestay',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function data()
    {
        try {
            $homestays = Homestay::all()->map(function ($homestay) {
                return [
                    'id' => $homestay->id,
                    'ten_homestay' => $homestay->ten_homestay,
                    'dia_chi' => $homestay->dia_chi,
                    'mo_ta' => $homestay->mo_ta,
                    'tien_ich' => $homestay->tien_ich,
                    'tinh_trang' => $homestay->tinh_trang,
                    'anh_chinh' => $homestay->anh_chinh ,
                ];
            });

            return response()->json($homestays, 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi lấy danh sách homestay',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $homestay = Homestay::findOrFail($id);
            if ($homestay->anh_chinh) {
                Storage::disk('public')->delete($homestay->anh_chinh);
            }
            $homestay->delete();

            return response()->json(['message' => 'Homestay được xóa thành công'], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi xóa homestay',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}