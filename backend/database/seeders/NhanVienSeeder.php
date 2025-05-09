<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nhan_viens')->delete();
        DB::table('nhan_viens')->truncate();
        DB::table('nhan_viens')->insert([
            [
                'ho_ten' => 'Trần Viết Đức',
                'so_dien_thoai' => '0901234567',
                'ngay_sinh' => '1995-05-15',
                'gioi_tinh' => 1,
                'email' => 'vietducwork29@gmail.com',
                'password' => bcrypt('123456'),
                'is_block' => 0,
                'id_chuc_vu' => 4, // Nhân viên lễ tân
                'is_master' => 0,
                'id_homestay' => 1, // Bơ Yang homestay
                'avatar' => 'https://via.placeholder.com/100?text=An',
            ],


        ]);
    }
}
