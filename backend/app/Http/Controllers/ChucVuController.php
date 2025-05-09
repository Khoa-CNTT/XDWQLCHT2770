<?php

namespace App\Http\Controllers;
use App\Models\ChucVu;
use Illuminate\Http\Request;

class ChucVuController extends Controller
{
    public function getChucVu(Request $request)
    {
        $chucVus = ChucVu::all();
        return response()->json($chucVus);
    }

    public function store(Request $request)
    {
        $chucVu = new ChucVu();
        $chucVu->ten_chuc_vu = $request->ten_chuc_vu;
        $chucVu->tinh_trang = $request->tinh_trang;
        $chucVu->save();

        return response()->json(['message' => 'Chức vụ đã được lưu thành công.']);
    }

    public function update(Request $request, $id)
    {
        $chucVu = ChucVu::findOrFail($id);
        $chucVu->ten_chuc_vu = $request->ten_chuc_vu;
        $chucVu->tinh_trang = $request->tinh_trang;
        $chucVu->save();

        return response()->json(['message' => 'Chức vụ đã được cập nhật thành công.']);
    }

    public function destroy($id)
    {
        ChucVu::destroy($id);
        return response()->json(['message' => 'Chức vụ đã được xóa thành công.']);
    }
}
