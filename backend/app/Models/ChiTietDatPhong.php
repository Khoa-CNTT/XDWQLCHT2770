<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDatPhong extends Model
{
    protected $table = 'chi_tiet_dat_phongs';
    protected $fillable = [
        'id_dat_phong',
        'id_phong',
        'ngay_nhan_phong',
        'ngay_tra_phong',
        'gia',
        'ghi_chu',
        'check_out_thuc_te',
        'tinh_trang'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_dat_phong');
    }

    public function phong()
    {
        return $this->belongsTo(Phong::class, 'id_phong');
    }
}
