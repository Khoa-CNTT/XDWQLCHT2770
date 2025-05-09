<?php

namespace App\Http\Controllers;

use App\Models\Phong;
use App\Models\ChiTietDatPhong;
use App\Events\RoomStatusUpdated;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TinhTrangPhongController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'trang_thai' => 'required|in:available,booked,cleaning,maintenance',
        ]);

        $room = Phong::findOrFail($id);
        $room->trang_thai = $request->trang_thai;
        $room->save();

        // event(new RoomStatusUpdated($room->id, $room->trang_thai));

        return response()->json(['message' => 'Cập nhật trạng thái thành công', 'room' => $room]);
    }

    public function getRoomStatus(Request $request)
    {
        $request->validate([
            'homestay_id' => 'required|exists:homestays,id',
            'date' => 'required|date',
        ]);

        $date = Carbon::parse($request->date);
        $rooms = Phong::where('homestay_id', $request->homestay_id)->get();

        $roomStatus = $rooms->map(function ($room) use ($date) {
            $bookingDetail = ChiTietDatPhong::where('phong_id', $room->id)
                ->where('ngay_nhan', '<=', $date)
                ->where('ngay_tra', '>=', $date)
                ->first();

            $status = $room->tinh_trang == 0 ? 'inactive' : 'available';
            $displayStatus = $room->tinh_trang == 0 ? 'Ngưng hoạt động' : 'Hoạt động';

            if ($bookingDetail) {
                switch ($bookingDetail->trang_thai) {
                    case 0:
                        $status = 'booked';
                        break;
                    case 1:
                        $status = 'checked_in';
                        break;
                    case 2:
                        $status = 'checked_out';
                        break;
                    case 3:
                        $status = 'cleaned';
                        break;
                    case 4:
                        $status = 'completed';
                        break;
                }
            }

            return [
                'id' => $room->id,
                'ten_phong' => $room->ten_phong,
                'tinh_trang' => $room->tinh_trang,
                'display_tinh_trang' => $displayStatus,
                'status' => $status,
            ];
        });

        return response()->json($roomStatus);
    }

    public function updateBookingDetailStatus(Request $request, $id)
    {
        $request->validate([
            'trang_thai' => 'required|in:0,1,2,3,4',
        ]);

        $bookingDetail = ChiTietDatPhong::findOrFail($id);
        $bookingDetail->trang_thai = $request->trang_thai;
        $bookingDetail->save();

        // event(new RoomStatusUpdated($bookingDetail->phong_id, $bookingDetail->trang_thai));

        return response()->json(['message' => 'Cập nhật trạng thái đặt phòng thành công']);
    }
}