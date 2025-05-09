<?php

namespace App\Http\Controllers;
use App\Models\ChucNang;
use Illuminate\Http\Request;

class ChucNangController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ten_chuc_nang' => 'required|string|max:255',
            'mo_ta' => 'nullable|string|max:255',
            'tinh_trang'=>'required|integer|in:0,1',
        ]);
        $chucNang = new ChucNang();
        $chucNang->ten_chuc_nang = $request->ten_chuc_nang;
        $chucNang->mo_ta = $request->mo_ta;
        $chucNang->tinh_trang = $request->tinh_trang;
        $chucNang->save();
        return response()->json(['message' => 'Lấy thành công']);
    }
    public function getData(Request $request)
    {
        $data = ChucNang::all();
        return response()->json([
            'chuc_nang' => $data
        ]);
    }
    public function update(Request $request, $id)
    {
        $chucNang = ChucNang::findOrFail($id);
        $chucNang->ten_chuc_nang = $request->ten_chuc_nang;
        $chucNang->mo_ta = $request->mo_ta;
        $chucNang->tinh_trang = $request->tinh_trang;
        $chucNang->save();
        return response()->json(['message' => 'Cập nhật thành công']);
    }
    public function destroy($id)
    {
        ChucNang::destroy($id);
        return response()->json(['message' => 'Xóa thành công']);
    }
}
