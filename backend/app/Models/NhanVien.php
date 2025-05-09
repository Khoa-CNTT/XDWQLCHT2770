<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class NhanVien extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory; // Hỗ trợ Sanctum

    protected $table = 'nhan_viens'; // Ánh xạ đến bảng nhan_viens

    protected $hidden = [
        'password',
        'remember_token',];


    protected $fillable = [
        'ho_ten',
        'so_dien_thoai',
        'ngay_sinh',
        'gioi_tinh',
        'email',
        'password',
        'is_block',
        'id_chuc_vu',
        'is_master',
        'id_homestay',
    ];

    public function chucVu()
    {
        return $this->belongsTo(ChucVu::class, 'id_chuc_vu');
    }
    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'id_homestay');
    }   
}
