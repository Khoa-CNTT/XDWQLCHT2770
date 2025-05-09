<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = 'danh_gias';

    protected $fillable = [
        'khach_hang_id',
        'phong_id',
        'sao',
        'noi_dung',
        'tinh_trang',
    ];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'khach_hang_id');
    }

    public function phong()
    {
        return $this->belongsTo(Phong::class, 'phong_id');
    }
}
