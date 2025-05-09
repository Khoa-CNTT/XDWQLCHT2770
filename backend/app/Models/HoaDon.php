<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = 'hoa_dons';
    protected $fillable = [
        'ma_hoa_don',
        'id_khach_hang',
        'id_homestay',
        'ngay_tao',
        'ghi_chu',
        'trang_thai',
        'tong_tien'
    ];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'id_khach_hang');
    }

    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'id_homestay');
    }
}
