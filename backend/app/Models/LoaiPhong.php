<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiPhong extends Model
{
    protected $table = 'loai_phongs';

    protected $fillable = [
        'ten_loai_phong',
        'suc_chua',
        'so_giuong',
        'mo_ta',
        'tien_ich',
        'tinh_trang',
    ];
}
