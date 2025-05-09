<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Homestay;
use App\Models\Booking;
use App\Models\ChiTietDatPhong;
use Illuminate\Http\Request;
use App\Models\Phong;
use App\Models\AnhPhong;
use App\Models\DanhGia;
use App\Models\KhachHang;
use App\Models\Review;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function searchHomestays(Request $request)
    {
        try {
            $checkIn = $request->query('check_in');
            $checkOut = $request->query('check_out');
            $sucChua = (int) $request->query('suc_chua');

            if (!$checkIn || !$checkOut || !$sucChua) {
                return response()->json([
                    'message' => 'Vui lòng cung cấp đầy đủ thông tin: check_in, check_out, suc_chua'
                ], 400);
            }

            $homestays = Homestay::where('tinh_trang', 1)->get();

            $filteredHomestays = $homestays->filter(function ($homestay) use ($checkIn, $checkOut, $sucChua) {
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
                    ->get();

                $totalCapacity = $availableRooms->sum('suc_chua');

                return $totalCapacity >= $sucChua;
            })->map(function ($homestay) {
                return [
                    'id' => $homestay->id,
                    'ten_homestay' => $homestay->ten_homestay,
                    'dia_chi' => $homestay->dia_chi,
                    'mo_ta' => $homestay->mo_ta,
                    'tien_ich' => $homestay->tien_ich,
                    'tinh_trang' => $homestay->tinh_trang,
                    'anh_chinh' => $homestay->anh_chinh,
                ];
            })->values();

            return response()->json($filteredHomestays, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi lấy danh sách homestay',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getHomestayDetail(Request $request, $id)
    {
        try {
            $checkIn = $request->query('check_in');
            $checkOut = $request->query('check_out');
            $sucChua = (int) $request->query('suc_chua');

            if (!$checkIn || !$checkOut || !$sucChua) {
                return response()->json([
                    'message' => 'Vui lòng cung cấp đầy đủ thông tin: check_in, check_out, suc_chua'
                ], 400);
            }

            $homestay = Homestay::findOrFail($id);

            $phongs = Phong::where('id_homestay', $id)->get();

            $images = AnhPhong::whereIn('phong_id', $phongs->pluck('id'))->get()->pluck('url')->toArray();

            if (empty($images) && $homestay->anh_chinh) {
                $images = [$homestay->anh_chinh];
            }

            $reviews = DanhGia::whereIn('phong_id', $phongs->pluck('id'))->get()->map(function ($review) {
                return [
                    'user' => $review->user_name,
                    'avatar' => $review->avatar ?? 'https://via.placeholder.com/40',
                    'rating' => $review->sao,
                    'comment' => $review->noi_dung,
                ];
            })->toArray();

            $averageRating = count($reviews) > 0
                ? round(array_sum(array_column($reviews, 'rating')) / count($reviews), 1)
                : 0;

            // Lấy danh sách phòng khả dụng
            $rooms = $homestay->phongs()
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
                    $images = AnhPhong::where('phong_id', $phong->id)
                        ->get()
                        ->pluck('url')
                        ->toArray();

                    if (empty($images)) {
                        $images = ['https://via.placeholder.com/300x200'];
                    }

                    $reviews = DanhGia::where('phong_id', $phong->id)->get()->map(function ($review) {
                        return [
                            'user' => $review->user_name,
                            'avatar' => $review->avatar ?? 'https://via.placeholder.com/40',
                            'rating' => $review->sao,
                            'comment' => $review->noi_dung,
                        ];
                    })->toArray();

                    $averageRating = count($reviews) > 0
                        ? round(array_sum(array_column($reviews, 'rating')) / count($reviews), 1)
                        : 0;

                    return [
                        'id' => $phong->id,
                        'ten_phong' => $phong->ten_phong,
                        'suc_chua' => $phong->suc_chua,
                        'so_giuong' => $phong->so_giuong,
                        'gia' => $phong->gia,
                        'dien_tich' => $phong->dien_tich ?? 15,
                        'images' => $images,
                        'tien_ich' => $phong->tien_ich,
                        'reviews' => $reviews,
                        'average_rating' => $averageRating,
                    ];
                });

            return response()->json([
                'id' => $homestay->id,
                'ten_homestay' => $homestay->ten_homestay,
                'dia_chi' => $homestay->dia_chi,
                'mo_ta' => $homestay->mo_ta,
                'tien_ich' => $homestay->tien_ich,
                'anh_chinh' => $homestay->anh_chinh,
                'images' => $images,
                'tien_ich_list' => [],
                'reviews' => $reviews,
                'average_rating' => $averageRating,
                'rooms' => $rooms, // Thêm danh sách phòng vào phản hồi
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi lấy thông tin homestay',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function calculatePrice(Request $request)
    {
        try {
            $data = $request->validate([
                'rooms' => 'required|array',
                'rooms.*.roomId' => 'required|integer|exists:phongs,id',
                'rooms.*.quantity' => 'required|integer|min:1',
                'checkIn' => 'required|date',
                'checkOut' => 'required|date|after:checkIn',
            ]);

            $checkIn = Carbon::parse($data['checkIn']);
            $checkOut = Carbon::parse($data['checkOut']);
            $numberOfDays = $checkIn->diffInDays($checkOut);

            // if ($numberOfDays ) {
            //     return response()->json([
            //         'message' => 'Ngày trả phòng phải sau ngày nhận phòng'
            //     ], 400, [], JSON_UNESCAPED_UNICODE);
            // }

            $totalPrice = 0;
            $roomDetails = [];

            foreach ($data['rooms'] as $room) {
                $phong = Phong::findOrFail($room['roomId']);
                $pricePerDay = $phong->gia;
                $roomTotal = $pricePerDay * $room['quantity'] * $numberOfDays;
                $totalPrice += $roomTotal;

                $roomDetails[] = [
                    'roomId' => $phong->id,
                    'ten_phong' => $phong->ten_phong,
                    'pricePerDay' => $pricePerDay,
                    'quantity' => $room['quantity'],
                    'total' => $roomTotal,
                ];
            }

            // Thêm 10% thuế
            $tax = $totalPrice * 0.1;
            $finalPrice = $totalPrice + $tax;

            return response()->json([
                'roomDetails' => $roomDetails,
                'totalPriceBeforeTax' => $totalPrice,
                'tax' => $tax,
                'finalPrice' => $finalPrice,
                'numberOfDays' => $numberOfDays,
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi tính giá',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }
    public function createBooking(Request $request)
    {
        try {
            $data = $request->validate([
                'id_khach_hang' => 'required|integer|exists:khach_hangs,id',
                'homestay_id' => 'required|integer|exists:homestays,id',
                'ngay_dat' => 'required|date',
                'tong_tien' => 'required|numeric',
                'ghi_chu' => 'nullable|string',
                'is_thanh_toan' => 'boolean', // Thêm is_thanh_toan
                'rooms' => 'required|array',
                'rooms.*.roomId' => 'required|integer|exists:phongs,id',
                'rooms.*.quantity' => 'required|integer|min:1',
                'rooms.*.checkIn' => 'required|date',
                'rooms.*.checkOut' => 'required|date|after:rooms.*.checkIn',
                'rooms.*.ghi_chu' => 'nullable|string',
            ]);

            // Tạo bản ghi trong bảng booking
            $datPhong = Booking::create([
                'id_khach_hang' => $data['id_khach_hang'],
                'id_homestay' => $data['homestay_id'],
                'ngay_dat' => $data['ngay_dat'],
                'tong_tien' => $data['tong_tien'],
                'is_thanh_toan' => 0,
                'ghi_chu' => $data['ghi_chu'] ?? null,
            ]);

            // Tạo các bản ghi trong bảng chi_tiet_dat_phong
            foreach ($data['rooms'] as $room) {
                $phong = Phong::findOrFail($room['roomId']);
                ChiTietDatPhong::create([
                    'id_dat_phong' => $datPhong->id,
                    'id_phong' => $phong->id,
                    'ngay_nhan_phong' => $room['checkIn'],
                    'ngay_tra_phong' => $room['checkOut'],
                    'gia' => $phong->gia,
                    'ghi_chu' => $room['ghi_chu'] ?? null,
                    'check_out_thuc_te' => null,
                    'tinh_trang' => '1',
                ]);
            }

            return response()->json([
                'message' => 'Đặt phòng thành công',
                'booking_id' => $datPhong->id,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi tạo đặt phòng',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getRoomsByHomestay($homestayId, Request $request)
    {
        try {
            $checkIn = $request->query('check_in');
            $checkOut = $request->query('check_out');
            $sucChua = (int) $request->query('suc_chua');

            if (!$checkIn || !$checkOut || !$sucChua) {
                return response()->json([
                    'message' => 'Vui lòng cung cấp đầy đủ thông tin: check_in, check_out, suc_chua'
                ], 400);
            }

            $homestay = Homestay::findOrFail($homestayId);

            $rooms = $homestay->phongs()
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
                    $images = AnhPhong::where('phong_id', $phong->id)
                        ->get()
                        ->pluck('url')
                        ->toArray();

                    if (empty($images)) {
                        $images = ['https://via.placeholder.com/300x200'];
                    }

                    $reviews = DanhGia::where('phong_id', $phong->id)->get()->map(function ($review) {
                        return [
                            'user' => $review->user_name,
                            'avatar' => $review->avatar ?? 'https://via.placeholder.com/40',
                            'rating' => $review->sao,
                            'comment' => $review->noi_dung,
                        ];
                    })->toArray();

                    $averageRating = count($reviews) > 0
                        ? round(array_sum(array_column($reviews, 'sao')) / count($reviews), 1)
                        : 0;

                    return [
                        'id' => $phong->id,
                        'ten_phong' => $phong->ten_phong,
                        'suc_chua' => $phong->suc_chua,
                        'so_giuong' => $phong->so_giuong,
                        'gia' => $phong->gia,
                        'dien_tich' => $phong->dien_tich ?? 15,
                        'images' => $images,
                        'tien_ich' => $phong->tien_ich,
                        'reviews' => $reviews,
                        'average_rating' => $averageRating,
                    ];
                });

            return response()->json($rooms, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi lấy danh sách phòng',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function checkThanhToan()
    {
        $payload = [
            "USERNAME" => "vietduc29",
            "PASSWORD" => "Mbvietduc@@2905",
            "DAY_BEGIN" => Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y'),
            "DAY_END" => Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y'),
            "NUMBER_MB" => "110409012024"
        ];

        try {
            // Gửi yêu cầu đến API
            $client = new Client();
            $response = $client->post("https://api-mb.dzmid.io.vn/api/transactions", ['json' => $payload]);
            $responseData = json_decode($response->getBody(), true);

            // Log dữ liệu trả về để debug
            Log::info('API Response:', $responseData);

            $data = $responseData['data']['transactionHistoryList'] ?? [];
            $updatedBookings = [];

            foreach ($data as $value) {
                // Bỏ qua nếu thiếu creditAmount hoặc creditAmount <= 0
                if (empty($value['creditAmount']) || $value['creditAmount'] <= 0) {
                    continue;
                }

                // Trích xuất id từ addDescription
                $ma_hoa_don = $this->extractBookingId($value['addDescription']);
                if (!$ma_hoa_don || !is_numeric($ma_hoa_don)) {
                    continue;
                }

                // Tìm booking tương ứng
                $booking = Booking::where('id', $ma_hoa_don)->first();
                if (!$booking) {
                    continue;
                }

                // Kiểm tra trạng thái thanh toán và số tiền
                if ($booking->is_thanh_toan == 1 || $booking->tong_tien != $value['creditAmount']) {
                    continue;
                }

                // Cập nhật trạng thái thanh toán
                $booking->is_thanh_toan = 1;
                $booking->save();

                // Lấy thông tin khách hàng và xử lý giao dịch
                $khachHang = KhachHang::find($booking->id_khach_hang);
                

                $updatedBookings[] = $ma_hoa_don;
            }

            return response()->json([
                'status' => true,
                'message' => 'Cập nhật giao dịch thành công.',
                'updated_bookings' => $updatedBookings,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Lỗi khi gọi API: ' . $e->getMessage(), [
                'payload' => $payload,
                'response' => $responseData ?? 'No response'
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Lỗi khi kiểm tra thanh toán: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Trích xuất id booking từ addDescription
     *
     * @param string $addDescription
     * @return string|null
     */
    public function extractBookingId($addDescription)
    {
        // Lấy phần số ở đầu chuỗi cho đến khi gặp ký tự không phải số
        preg_match('/^(\d+)/', trim($addDescription), $matches);
        return $matches[1] ?? null;
    }
}