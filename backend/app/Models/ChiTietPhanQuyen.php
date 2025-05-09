<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhanQuyen extends Model
{
    protected $table = 'chi_tiet_phan_quyens';
    protected $fillable = [
        'id_chuc_nang',
        'id_phan_quyen',
    ];
}
