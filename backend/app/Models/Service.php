<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'ten_dich_vu',
        'icon',
        'mo_ta',
        'gia',
        'don_vi',
        'tinh_trang',
    ];

   
}
