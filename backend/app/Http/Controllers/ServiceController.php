<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getDichVu()
    {
        $data = Service::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        Service::create([
            'ten_dich_vu' => $request->ten_dich_vu,
            'icon' => $request->icon,
            'mo_ta' => $request->mo_ta,
            'gia' => $request->gia,
            'don_vi' => $request->don_vi,
        ]);
        return response()->json([
            'message' => 'Thêm dịch vụ thành công',
            'status' => 200,
        ]);

    }
    public function update(Request $request)
    {
       Service::where('id', $request->id)->update([
            'ten_dich_vu' => $request->ten_dich_vu,
            'icon' => $request->icon,
            'mo_ta' => $request->mo_ta,
            'gia' => $request->gia,
            'don_vi' => $request->don_vi,
        ]);
        return response()->json([
            'message' => 'Cập nhật dịch vụ thành công',
            'status' => 200,
        ]);
    }
    public function destroy(Request $request)
    {
        Service::where('id', $request->id)->delete();
        return response()->json([
            'message' => 'Xóa dịch vụ thành công',
            'status' => 200,
        ]);
    }
}
