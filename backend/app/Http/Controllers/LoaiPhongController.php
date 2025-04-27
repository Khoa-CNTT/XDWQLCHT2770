<?php

namespace App\Http\Controllers;

use App\Models\LoaiPhong;
use Illuminate\Http\Request;

class LoaiPhongController extends Controller
{
    public function getLoaiPhong()
    {
        $data = LoaiPhong::all();
        return response()->json($data);
    }

    public function addLoaiPhong(Request $request)
    {
        LoaiPhong::create([
            'ten_loai_phong' => $request->ten_loai_phong,
            'suc_chua' => $request->suc_chua,
            'so_giuong' => $request->so_giuong,
            'mo_ta' => $request->mo_ta,
            'tien_ich' => $request->tien_ich,
        ]);
        return response()->json([
            'message' => 'Thêm dịch vụ thành công',
            'status' => 200,
        ]);

    }
    public function updateLoaiPhong(Request $request)
    {
       LoaiPhong::where('id', $request->id)->update([
        'ten_loai_phong' => $request->ten_loai_phong,
        'suc_chua' => $request->suc_chua,
        'so_giuong' => $request->so_giuong,
        'mo_ta' => $request->mo_ta,
        'tien_ich' => $request->tien_ich,
        ]);
        return response()->json([
            'message' => 'Cập nhật loại phòng thành công',
            'status' => 200,
        ]);
    }
    public function deleteLoaiPhong(Request $request)
    {
        LoaiPhong::where('id', $request->id)->delete();
        return response()->json([
            'message' => 'Xóa dịch vụ thành công',
            'status' => 200,
        ]);
    }
}
