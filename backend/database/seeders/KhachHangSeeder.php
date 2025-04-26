<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('khach_hangs')->delete();
        DB::table('khach_hangs')->truncate();
        DB::table('khach_hangs')->insert([
            [
                'ho_ten' => 'Trần Đức Tài',
                'email' => 'tc091959@gmail.com',
                'so_dien_thoai' => '0762412044',
                "gioi_tinh" => 1,
                'mat_khau' => bcrypt('123456'),
                'ngay_sinh' => '2005-01-01',
                'is_active' => 1,
            ],
            [
                'ho_ten' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@gmail.com',
                'so_dien_thoai' => '0708585121',
                "gioi_tinh" => 1,
                'mat_khau' => bcrypt('123456'),
                'ngay_sinh' => '1980-02-15',
                'is_active' => 1,

            ],

        ]);
    }
}
