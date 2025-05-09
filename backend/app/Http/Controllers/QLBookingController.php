<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DatPhong;
use App\Models\ChiTietDatPhong;
use App\Models\Homestay;
use App\Models\Phong;
use Illuminate\Http\Request;
use Carbon\Carbon;

class QLBookingController extends Controller
{
    /**
     * Lấy danh sách đặt phòng cho admin
     */
    public function getAdminBookings(Request $request)
    {
        try {
            $query = Booking::with(['khachHang', 'homestay', 'chiTietDatPhongs.phong'])
                ->orderBy('ngay_dat', 'desc');

            // Tìm kiếm theo mã đặt phòng hoặc tên khách hàng
            if ($request->has('search') && !empty($request->query('search'))) {
                $search = $request->query('search');
                $query->where('id', 'like', "%$search%")
                    ->orWhereHas('khachHang', function ($q) use ($search) {
                        $q->where('ho_ten', 'like', "%$search%");
                    });
            }

            // Lọc theo trạng thái thanh toán
            if ($request->has('is_thanh_toan') && $request->query('is_thanh_toan') !== '') {
                $isThanhToan = $request->query('is_thanh_toan') === 'true' ? 1 : 0;
                $query->where('is_thanh_toan', $isThanhToan);
            }

            // Lọc theo trạng thái chi tiết đặt phòng
            if ($request->has('tinh_trang') && !empty($request->query('tinh_trang'))) {
                $tinhTrang = $request->query('tinh_trang');
                $query->whereHas('chiTietDatPhongs', function ($q) use ($tinhTrang) {
                    $q->where('tinh_trang', $tinhTrang);
                });
            }

            // Lọc theo khoảng thời gian đặt
            if ($request->has('start_date') && !empty($request->query('start_date'))) {
                $query->whereDate('ngay_dat', '>=', $request->query('start_date'));
            }
            if ($request->has('end_date') && !empty($request->query('end_date'))) {
                $query->whereDate('ngay_dat', '<=', $request->query('end_date'));
            }

            $bookings = $query->get()->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'ten_khach_hang' => $booking->khachHang->ho_ten ?? 'N/A',
                    'email_khach_hang' => $booking->khachHang->email ?? 'N/A',
                    'ten_homestay' => $booking->homestay->ten_homestay ?? 'N/A',
                    'ngay_dat' => $booking->ngay_dat,
                    'tong_tien' => $booking->tong_tien,
                    'is_thanh_toan' => $booking->is_thanh_toan,
                    'ghi_chu' => $booking->ghi_chu,
                    'chi_tiet_dat_phongs' => $booking->chiTietDatPhongs->map(function ($chiTiet) {
                        return [
                            'id' => $chiTiet->id,
                            'id_phong' => $chiTiet->id_phong,
                            'ten_phong' => $chiTiet->phong->ten_phong ?? 'N/A',
                            'ngay_nhan_phong' => $chiTiet->ngay_nhan_phong,
                            'ngay_tra_phong' => $chiTiet->ngay_tra_phong,
                            'gia' => $chiTiet->gia,
                            'ghi_chu' => $chiTiet->ghi_chu,
                            'check_out_thuc_te' => $chiTiet->check_out_thuc_te,
                            'tinh_trang' => $chiTiet->tinh_trang,
                        ];
                    }),
                ];
            });

            return response()->json($bookings, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi lấy danh sách đặt phòng',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Cập nhật trạng thái thanh toán của đặt phòng
     */
    public function updatePaymentStatus(Request $request, $bookingId)
    {
        try {
            $data = $request->validate([
                'is_thanh_toan' => 'required|boolean',
            ]);

            $booking = Booking::findOrFail($bookingId);
            $booking->update([
                'is_thanh_toan' => $data['is_thanh_toan'],
            ]);

            return response()->json([
                'message' => 'Cập nhật trạng thái thanh toán thành công',
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi cập nhật trạng thái thanh toán',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Cập nhật trạng thái chi tiết đặt phòng
     */
    public function updateBookingDetailStatus(Request $request, $detailId)
    {
        try {
            $data = $request->validate([
                'tinh_trang' => 'required|in:pending,confirmed,cancelled,completed',
            ]);

            $chiTiet = ChiTietDatPhong::findOrFail($detailId);
            $chiTiet->update([
                'tinh_trang' => $data['tinh_trang'],
            ]);

            return response()->json([
                'message' => 'Cập nhật trạng thái chi tiết đặt phòng thành công',
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi cập nhật trạng thái chi tiết đặt phòng',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Kiểm tra phòng trống dựa trên ngày check-in, check-out và số người
     */
    public function checkAvailableRooms(Request $request)
    {
        try {
            $data = $request->validate([
                'check_in' => 'required|date',
                'check_out' => 'required|date|after:check_in',
                'suc_chua' => 'required|integer|min:1',
            ]);

            $checkIn = $data['check_in'];
            $checkOut = $data['check_out'];
            $sucChua = $data['suc_chua'];

            $homestays = Homestay::where('tinh_trang', 1)->get();

            $availableHomestays = $homestays->map(function ($homestay) use ($checkIn, $checkOut, $sucChua) {
                $availableRooms = $homestay->phongs()
                    ->where('trang_thai', 1)
                    ->whereDoesntHave('chiTietDatPhongs', function ($q) use ($checkIn, $checkOut) {
                        $q->where(function ($subQuery) use ($checkIn, $checkOut) {
                            $subQuery->whereBetween('ngay_nhan_phong', [$checkIn, $checkOut])
                                     ->orWhereBetween('ngay_tra_phong', [$checkIn, $checkOut])
                                     ->orWhereRaw('? BETWEEN ngay_nhan_phong AND ngay_tra_phong', [$checkIn])
                                     ->orWhereRaw('? BETWEEN ngay_nhan_phong AND ngay_tra_phong', [$checkOut]);
                        });
                    })
                    ->get()
                    ->map(function ($phong) {
                        return [
                            'id' => $phong->id,
                            'ten_phong' => $phong->ten_phong,
                            'suc_chua' => $phong->suc_chua,
                            'gia' => $phong->gia,
                        ];
                    });

                $totalCapacity = $availableRooms->sum('suc_chua');

                if ($totalCapacity >= $sucChua) {
                    return [
                        'id' => $homestay->id,
                        'ten_homestay' => $homestay->ten_homestay,
                        'available_rooms' => $availableRooms,
                    ];
                }
                return null;
            })->filter()->values();

            if ($availableHomestays->isEmpty()) {
                return response()->json([
                    'message' => 'Không tìm thấy homestay có phòng trống phù hợp',
                ], 404, [], JSON_UNESCAPED_UNICODE);
            }

            return response()->json($availableHomestays, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi kiểm tra phòng trống',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Thêm mới đặt phòng
     */
    public function createBooking(Request $request)
    {
        try {
            $data = $request->validate([
                'id_khach_hang' => 'required|integer|exists:khach_hangs,id',
                'homestay_id' => 'required|integer|exists:homestays,id',
                'ngay_dat' => 'required|date',
                'tong_tien' => 'required|numeric|min:0',
                'ghi_chu' => 'nullable|string',
                'rooms' => 'required|array|min:1',
                'rooms.*.roomId' => 'required|integer|exists:phongs,id',
                'rooms.*.quantity' => 'required|integer|min:1',
                'rooms.*.checkIn' => 'required|date',
                'rooms.*.checkOut' => 'required|date|after:rooms.*.checkIn',
                'rooms.*.ghi_chu' => 'nullable|string',
            ]);

            // Kiểm tra phòng có sẵn
            foreach ($data['rooms'] as $room) {
                $checkIn = Carbon::parse($room['checkIn']);
                $checkOut = Carbon::parse($room['checkOut']);

                $conflictingBookings = ChiTietDatPhong::where('id_phong', $room['roomId'])
                    ->where(function ($query) use ($checkIn, $checkOut) {
                        $query->whereBetween('ngay_nhan_phong', [$checkIn, $checkOut])
                              ->orWhereBetween('ngay_tra_phong', [$checkIn, $checkOut])
                              ->orWhereRaw('? BETWEEN ngay_nhan_phong AND ngay_tra_phong', [$checkIn])
                              ->orWhereRaw('? BETWEEN ngay_nhan_phong AND ngay_tra_phong', [$checkOut]);
                    })
                    ->count();

                if ($conflictingBookings > 0) {
                    return response()->json([
                        'message' => 'Phòng không khả dụng trong khoảng thời gian đã chọn',
                        'roomId' => $room['roomId'],
                    ], 400, [], JSON_UNESCAPED_UNICODE);
                }
            }

            // Tạo bản ghi trong bảng dat_phongs
            $datPhong = Booking::create([
                'id_khach_hang' => $data['id_khach_hang'],
                'id_homestay' => $data['homestay_id'],
                'ngay_dat' => $data['ngay_dat'],
                'tong_tien' => $data['tong_tien'],
                'is_thanh_toan' => false,
                'ghi_chu' => $data['ghi_chu'] ?? null,
            ]);

            // Tạo các bản ghi trong bảng chi_tiet_dat_phong
            foreach ($data['rooms'] as $room) {
                $phong = Phong::findOrFail($room['roomId']);
                $checkIn = Carbon::parse($room['checkIn']);
                $checkOut = Carbon::parse($room['checkOut']);
                $numberOfDays = $checkIn->diffInDays($checkOut);
                $roomPrice = $phong->gia * $room['quantity'] * $numberOfDays;

                if ($roomPrice <= 0) {
                    return response()->json([
                        'message' => 'Giá phòng không hợp lệ',
                        'error' => 'Giá phòng phải lớn hơn 0'
                    ], 400, [], JSON_UNESCAPED_UNICODE);
                }

                ChiTietDatPhong::create([
                    'id_dat_phong' => $datPhong->id,
                    'id_phong' => $room['roomId'],
                    'ngay_nhan_phong' => $room['checkIn'],
                    'ngay_tra_phong' => $room['checkOut'],
                    'gia' => $roomPrice,
                    'ghi_chu' => $room['ghi_chu'] ?? null,
                    'check_out_thuc_te' => $room['checkOut'],
                    'tinh_trang' => 'pending',
                ]);
            }

            return response()->json([
                'message' => 'Thêm mới đặt phòng thành công',
                'booking_id' => $datPhong->id,
            ], 201, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi thêm mới đặt phòng',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Cập nhật thông tin đặt phòng
     */
    public function updateBooking(Request $request, $bookingId)
    {
        try {
            $data = $request->validate([
                'id_khach_hang' => 'required|integer|exists:khach_hangs,id',
                'homestay_id' => 'required|integer|exists:homestays,id',
                'ngay_dat' => 'required|date',
                'tong_tien' => 'required|numeric|min:0',
                'ghi_chu' => 'nullable|string',
                'rooms' => 'required|array|min:1',
                'rooms.*.id' => 'nullable|integer|exists:chi_tiet_dat_phongs,id',
                'rooms.*.roomId' => 'required|integer|exists:phongs,id',
                'rooms.*.quantity' => 'required|integer|min:1',
                'rooms.*.checkIn' => 'required|date',
                'rooms.*.checkOut' => 'required|date|after:rooms.*.checkIn',
                'rooms.*.ghi_chu' => 'nullable|string',
            ]);

            $booking = Booking::findOrFail($bookingId);

            // Cập nhật thông tin đặt phòng
            $booking->update([
                'id_khach_hang' => $data['id_khach_hang'],
                'id_homestay' => $data['homestay_id'],
                'ngay_dat' => $data['ngay_dat'],
                'tong_tien' => $data['tong_tien'],
                'ghi_chu' => $data['ghi_chu'] ?? null,
            ]);

            // Xóa các chi tiết đặt phòng cũ không còn trong danh sách gửi lên
            $existingDetailIds = $booking->chiTietDatPhongs->pluck('id')->toArray();
            $updatedDetailIds = array_filter(array_column($data['rooms'], 'id'), function ($id) {
                return !is_null($id);
            });
            $detailsToDelete = array_diff($existingDetailIds, $updatedDetailIds);
            ChiTietDatPhong::whereIn('id', $detailsToDelete)->delete();

            // Kiểm tra và cập nhật hoặc thêm mới chi tiết đặt phòng
            foreach ($data['rooms'] as $room) {
                $checkIn = Carbon::parse($room['checkIn']);
                $checkOut = Carbon::parse($room['checkOut']);

                // Kiểm tra phòng có sẵn (bỏ qua các chi tiết thuộc booking hiện tại)
                $conflictingBookings = ChiTietDatPhong::where('id_phong', $room['roomId'])
                    ->where('id_dat_phong', '!=', $bookingId)
                    ->where(function ($query) use ($checkIn, $checkOut) {
                        $query->whereBetween('ngay_nhan_phong', [$checkIn, $checkOut])
                              ->orWhereBetween('ngay_tra_phong', [$checkIn, $checkOut])
                              ->orWhereRaw('? BETWEEN ngay_nhan_phong AND ngay_tra_phong', [$checkIn])
                              ->orWhereRaw('? BETWEEN ngay_nhan_phong AND ngay_tra_phong', [$checkOut]);
                    })
                    ->count();

                if ($conflictingBookings > 0) {
                    return response()->json([
                        'message' => 'Phòng không khả dụng trong khoảng thời gian đã chọn',
                        'roomId' => $room['roomId'],
                    ], 400, [], JSON_UNESCAPED_UNICODE);
                }

                $phong = Phong::findOrFail($room['roomId']);
                $numberOfDays = $checkOut->diffInDays($checkIn);
                $roomPrice = $phong->gia * $room['quantity'] * $numberOfDays;

                if ($roomPrice <= 0) {
                    return response()->json([
                        'message' => 'Giá phòng không hợp lệ',
                        'error' => 'Giá phòng phải lớn hơn 0'
                    ], 400, [], JSON_UNESCAPED_UNICODE);
                }

                if (isset($room['id'])) {
                    // Cập nhật chi tiết đặt phòng hiện có
                    $chiTiet = ChiTietDatPhong::findOrFail($room['id']);
                    $chiTiet->update([
                        'id_phong' => $room['roomId'],
                        'ngay_nhan_phong' => $room['checkIn'],
                        'ngay_tra_phong' => $room['checkOut'],
                        'gia' => $roomPrice,
                        'ghi_chu' => $room['ghi_chu'] ?? null,
                        'check_out_thuc_te' => $room['checkOut'],
                    ]);
                } else {
                    // Thêm mới chi tiết đặt phòng
                    ChiTietDatPhong::create([
                        'id_dat_phong' => $booking->id,
                        'id_phong' => $room['roomId'],
                        'ngay_nhan_phong' => $room['checkIn'],
                        'ngay_tra_phong' => $room['checkOut'],
                        'gia' => $roomPrice,
                        'ghi_chu' => $room['ghi_chu'] ?? null,
                        'check_out_thuc_te' => $room['checkOut'],
                        'tinh_trang' => 'pending',
                    ]);
                }
            }

            return response()->json([
                'message' => 'Cập nhật đặt phòng thành công',
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi cập nhật đặt phòng',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Xóa đặt phòng
     */
    public function deleteBooking($bookingId)
    {
        try {
            $booking = Booking::findOrFail($bookingId);

            // Xóa các chi tiết đặt phòng liên quan
            $booking->chiTietDatPhongs()->delete();

            // Xóa đặt phòng
            $booking->delete();

            return response()->json([
                'message' => 'Xóa đặt phòng thành công',
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi xóa đặt phòng',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Lấy danh sách homestays (dùng cho form thêm/sửa)
     */
    public function getHomestays()
    {
        try {
            $homestays = Homestay::select('id', 'ten_homestay')->get();
            return response()->json($homestays, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi lấy danh sách homestay',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Lấy danh sách khách hàng (dùng cho form thêm/sửa)
     */
    public function getCustomers()
    {
        try {
            $customers = \App\Models\KhachHang::select('id', 'ho_ten', 'email')->get();
            return response()->json($customers, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi lấy danh sách khách hàng',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Lấy danh sách phòng theo homestay (dùng cho form thêm/sửa)
     */
    public function getRoomsByHomestay($homestayId)
    {
        try {
            $rooms = Phong::where('id_homestay', $homestayId)
                ->select('id', 'ten_phong', 'gia')
                ->get();
            return response()->json($rooms, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi lấy danh sách phòng',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }
}