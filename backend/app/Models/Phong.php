<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    protected $table = 'phongs';
    protected $fillable = [
        'id_homestay',
        'ten_phong',
        'mo_ta',
        'dien_tich',
        'gia',
        'tien_ich',
        'suc_chua',
        'so_giuong',
        'trang_thai'
    ];

    public function hinhAnhs()
    {
        return $this->hasMany(AnhPhong::class, 'phong_id');
    }

    public function chiTietDatPhongs()
    {
        return $this->hasMany(ChiTietDatPhong::class, 'id_phong', 'id');
    }
}