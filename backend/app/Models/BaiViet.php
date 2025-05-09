<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table = 'bai_viets';
    protected $fillable=[
        'tieu_de',
        'image',
        'noi_dung',
        'tinh_trang',
    ];
}
