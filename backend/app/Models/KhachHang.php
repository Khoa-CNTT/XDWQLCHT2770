<?php

namespace App\Models;


use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KhachHang extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory; // Hỗ trợ Sanctum

    protected $table = 'khach_hangs'; // Ánh xạ đến bảng khach_hangs

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'ngay_sinh',
        'gioi_tinh',
        'avatar',
        'mat_khau',
        'hash_active',
        'hash_reset',
        'is_block',
        'is_active'
    ];

    protected $hidden = ['mat_khau', 'hash_active', 'hash_reset'];

    

    public function checkPassword($password)
    {
        return Hash::check($password, $this->mat_khau);
    }
}