<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'id_khach_hang',
        'id_homestay',
        'ngay_dat',
        'tong_tien',
        'is_thanh_toan',
        'ghi_chu'
    ];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'id_khach_hang');
    }

    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'id_homestay');
    }
    public function chiTietDatPhongs()
    {
        return $this->hasMany(ChiTietDatPhong::class, 'id_dat_phong');
    }
}
