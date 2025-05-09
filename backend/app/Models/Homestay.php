<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    protected $table = 'homestays';
    protected $fillable=[
        'ten_homestay',
        'dia_chi',
        'mo_ta',
        'tien_ich',
        'tinh_trang',
        'anh_chinh'
    ];
    public function phongs()
    {
        return $this->hasMany(Phong::class, 'id_homestay', 'id');
    }
}
