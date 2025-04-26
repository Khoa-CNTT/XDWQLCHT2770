<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Service::create([
            'ten_dich_vu' => 'Thuê xe máy',
            'icon' => 'fa-solid fa-motorcycle',
            'mo_ta' => 'Bạn sẽ được thuê xe máy với giá tốt nhất',
            'gia' => 100000,
            'don_vi' => "Ngày",
            'tinh_trang' => 1,
        ]);

        \App\Models\Service::create([
            'ten_dich_vu' => 'Xe dạp',
            'icon' => 'fa-solid fa-bicycle',
            'mo_ta' => 'Bạn sẽ được thuê xe dạp với giá tốt nhất',
            'gia' => 50000,
            'don_vi' => "Ngày",
            'tinh_trang' => 1,
        ]);
    }
}
