<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Booking;
use App\Models\ChiTietDatPhong;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $client = new Client();
        $payosConfig = config('services.payos');

        $orderCode = time(); // Mã đơn hàng duy nhất
        $amount = $request->input('amount');
        $description = $request->input('description', 'Thanh toán đặt phòng #' . $orderCode);
        $bookingData = $request->input('booking_data'); // Dữ liệu đặt phòng tạm thời

        $data = [
            'orderCode' => $orderCode,
            'amount' => (int) $amount,
            'description' => $description,
            'returnUrl' => $payosConfig['return_url'],
            'cancelUrl' => $payosConfig['cancel_url'],
        ];

        try {
            $response = $client->post('https://api-payos.vnpay.vn/v1/invoice', [
                'headers' => [
                    'x-client-id' => $payosConfig['client_id'],
                    'x-api-key' => $payosConfig['api_key'],
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);

            $result = json_decode($response->getBody(), true);

            // Lưu tạm dữ liệu đặt phòng vào session
            session(['pending_booking_' . $orderCode => $bookingData]);

            return response()->json([
                'orderCode' => $orderCode,
                'checkoutUrl' => $result['data']['checkoutUrl'],
                'qrCode' => $result['data']['qrCode'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function webhook(Request $request)
    {
        $data = $request->all();
        \Log::info('PayOS Webhook:', $data);

        $orderCode = $data['orderCode'];
        $status = $data['status'];

        if ($status === 'PAID') {
            // Lấy dữ liệu đặt phòng từ session
            $bookingData = session('pending_booking_' . $orderCode);

            if ($bookingData) {
                // Tạo bản ghi booking
                $datPhong = Booking::create([
                    'id_khach_hang' => $bookingData['id_khach_hang'],
                    'id_homestay' => $bookingData['homestay_id'],
                    'ngay_dat' => $bookingData['ngay_dat'],
                    'tong_tien' => $bookingData['tong_tien'],
                    'ghi_chu' => $bookingData['ghi_chu'],
                    'is_thanh_toan' => 1, // Thanh toán thành công
                ]);

                // Tạo chi tiết đặt phòng
                foreach ($bookingData['rooms'] as $room) {
                    $phong = \App\Models\Phong::findOrFail($room['roomId']);
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

                // Xóa dữ liệu tạm
                session()->forget('pending_booking_' . $orderCode);
            }
        }

        return response()->json(['message' => 'Webhook received'], 200);
    }
}