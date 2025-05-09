<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    
    private function generatePaymentLink($hoaDon)
    {

        return 'https://img.vietqr.io/image/mb-110409012024-compact2.jpg?amount='
            . $hoaDon->tong_tien
            . '&addInfo=' . $hoaDon->ma_hoa_don
            . '&accountName=VO_VAN_VIET';
    }
}
