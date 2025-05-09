<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QLNhanVienController extends Controller
{
    public function getData()
    {
        $data = NhanVien::join('chuc_vus', 'nhan_viens.id_chuc_vu', '=', 'chuc_vus.id')
            ->join('homestays', 'nhan_viens.id_homestay', '=', 'homestays.id')
            ->select('nhan_viens.*', 'chuc_vus.ten_chuc_vu', 'homestays.ten_homestay')
            ->get();
        return response()->json([
            'nhan_vien' => $data
        ]);
    }

    public function themNV(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:15',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|in:0,1',
            'email' => 'required|email|unique:nhan_viens,email',
            'password' => 'required|string|min:6',
            'id_chuc_vu' => 'required|exists:chuc_vus,id',
            'id_homestay' => '',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $nhanVien = new NhanVien();
        $nhanVien->ho_ten = $request->ho_ten;
        $nhanVien->so_dien_thoai = $request->so_dien_thoai;
        $nhanVien->ngay_sinh = $request->ngay_sinh;
        $nhanVien->gioi_tinh = $request->gioi_tinh;
        $nhanVien->email = $request->email;
        $nhanVien->password = bcrypt($request->password);
        $nhanVien->is_block = 0;
        $nhanVien->id_chuc_vu = $request->id_chuc_vu;
        $nhanVien->is_master = 0;
        $nhanVien->id_homestay = $request->id_homestay;

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validate['avatar'] = $path;
        }

        $nhanVien->save();

        return response()->json([
            'message' => 'Thêm nhân viên thành công',
            'data' => $nhanVien
        ]);
    }

    public function suaNV(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:15',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|in:0,1',
            'email' => 'required|email|unique:nhan_viens,email,' . $request->id,
            'password' => 'nullable|string|min:6',
            'id_chuc_vu' => 'required|exists:chuc_vus,id',
            'id_homestay' => 'required|exists:homestays,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $nhanVien = NhanVien::find($request->id);
        if (!$nhanVien) {
            return response()->json([
                'message' => 'Nhân viên không tồn tại'
            ], 404);
        }

        $nhanVien->ho_ten = $request->ho_ten;
        $nhanVien->so_dien_thoai = $request->so_dien_thoai;
        $nhanVien->ngay_sinh = $request->ngay_sinh;
        $nhanVien->gioi_tinh = $request->gioi_tinh;
        $nhanVien->email = $request->email;
        if ($request->password) {
            $nhanVien->password = bcrypt($request->password);
        }
        $nhanVien->id_chuc_vu = $request->id_chuc_vu;
        $nhanVien->id_homestay = $request->id_homestay;

        if ($request->hasFile('avatar')) {
            if ($nhanVien->avatar) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $nhanVien->avatar));
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $nhanVien->avatar = $path;
        }

        $nhanVien->save();

        return response()->json([
            'message' => 'Cập nhật nhân viên thành công',
            'data' => $nhanVien
        ]);
    }

    public function xoaNV(Request $request)
    {


        $id = $request->id;

        $nhanVien = NhanVien::find($id);
        if (!$nhanVien) {
            return response()->json([
                'message' => 'Nhân viên không tồn tại'
            ], 404);
        }

        if ($nhanVien->avatar) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $nhanVien->avatar));
        }

        $nhanVien->delete();
        return response()->json([
            'message' => 'Xóa nhân viên thành công'
        ]);
    }
}