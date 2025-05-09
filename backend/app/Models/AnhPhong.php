<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnhPhong extends Model
{
    protected $table = 'anh_phongs';
    protected $fillable = ['phong_id', 'url'];

    public function phong()
    {
        return $this->belongsTo(Phong::class, 'deleteImage');
    }
}