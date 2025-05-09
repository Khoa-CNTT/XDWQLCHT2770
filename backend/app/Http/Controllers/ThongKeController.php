<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    public function getDashboardStats()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $stats = [
            'homestays' => [
                'soluong' => DB::table('homestays')->count(),
                'hd' => DB::table('homestays')->where('tinh_trang', 1)->count(),
                'nhd' => DB::table('homestays')->where('tinh_trang', 0)->count(),
            ],
            'khach_hangs' => [
                'soluong' => DB::table('khach_hangs')->count(),
                'new' =>  DB::table('khach_hangs')
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->count(),
            ],
            'datphong' => [
                'so_luong' => DB::table('bookings')->count()

            ],
            'doanhthu' => [
                'total' => DB::table('bookings')->where('is_thanh_toan', 1)
                ->sum ('tong_tien')]

        ];

        return response()->json($stats);
    }




    public function thongKeDoanhThuNam(Request $request)
    {
        // Đặt năm cố định là 2025
        $year = 2025;

        $thongKe = DB::table('bookings')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COALESCE(SUM(tong_tien), 0) as total'))
            ->whereYear('created_at', $year)
            ->where('is_thanh_toan', 1)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Đảm bảo trả về 12 tháng, điền 0 cho các tháng không có dữ liệu
        $monthlyRevenue = array_fill(1, 12, 0);
        foreach ($thongKe as $item) {
            $monthlyRevenue[$item->month] = (float)$item->total;
        }

        return response()->json(array_values($monthlyRevenue));
    }
}
