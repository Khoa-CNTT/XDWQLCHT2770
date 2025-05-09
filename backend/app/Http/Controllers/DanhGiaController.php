<?php

namespace App\Http\Controllers;
use App\Models\DanhGia;
use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    public function getDanhGia(Request $request)
    {
        $danhGias = DanhGia::with('khachHang', 'phong')->get();
        return response()->json($danhGias);
    }

    public function store(Request $request)
    {
        $danhGia = new DanhGia();
        $danhGia->khach_hang_id = $request->khach_hang_id;
        $danhGia->phong_id = $request->phong_id;
        $danhGia->sao = $request->sao;
        $danhGia->noi_dung = $request->noi_dung;
        $danhGia->tinh_trang = $request->tinh_trang;
        $danhGia->save();

        return response()->json(['message' => 'Đánh giá đã được lưu thành công.']);
    }

    public function update(Request $request, $id)
    {
        $danhGia = DanhGia::findOrFail($id);
        $danhGia->khach_hang_id = $request->khach_hang_id;
        $danhGia->phong_id = $request->phong_id;
        $danhGia->sao = $request->sao;
        $danhGia->noi_dung = $request->noi_dung;
        $danhGia->tinh_trang = $request->tinh_trang;
        $danhGia->save();

        return response()->json(['message' => 'Đánh giá đã được cập nhật thành công.']);
    }

    public function destroy($id)
    {
        DanhGia::destroy($id);
        return response()->json(['message' => 'Đánh giá đã được xóa thành công.']);
    }
}
