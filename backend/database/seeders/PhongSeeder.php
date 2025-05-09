<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Homestay;
use App\Models\Phong;

class PhongSeeder extends Seeder
{
    public function run()
    {
        // Seed homestays
        $homestays = [
            ['ten_homestay' => 'Bơ Yang Homestay'],
            ['ten_homestay' => 'Healing Homestay'],
            ['ten_homestay' => 'Rosie Homestay'],
        ];

        foreach ($homestays as $homestay) {
            Homestay::create($homestay);
        }

        // Seed phongs
        $phongs = [
            [
                'ten_phong' => 'Phòng Deluxe Hướng Núi',
                'id_homestay' => 1,
                'mo_ta' => 'Phòng rộng rãi với view núi, nội thất hiện đại, thích hợp cho cặp đôi.',
                'hinh_anhs' => json_encode([
                    'https://placehold.co/600x400?text=Deluxe+Mountain+1',
                    'https://placehold.co/600x400?text=Deluxe+Mountain+2'
                ]),
                'dien_tich' => 30,
                'gia' => 1200000,
                'tien_ich' => 'Wi-Fi, Điều hòa, TV, Tủ lạnh, Máy sấy tóc',
                'suc_chua' => 2,
                'so_giuong' => 1,
                'trang_thai' => 1,
            ],
            [
                'ten_phong' => 'Phòng Gia Đình Hướng Vườn',
                'id_homestay' => 1,
                'mo_ta' => 'Phòng lớn cho gia đình, có ban công nhìn ra vườn hoa.',
                'hinh_anhs' => json_encode([
                    'https://placehold.co/600x400?text=Family+Garden+1',
                    'https://placehold.co/600x400?text=Family+Garden+2'
                ]),
                'dien_tich' => 45,
                'gia' => 1800000,
                'tien_ich' => 'Wi-Fi, Điều hòa, TV, Tủ lạnh, Bếp nhỏ',
                'suc_chua' => 4,
                'so_giuong' => 2,
                'trang_thai' => 1,
            ],
            [
                'ten_phong' => 'Phòng Tiêu Chuẩn',
                'id_homestay' => 1,
                'mo_ta' => 'Phòng đơn giản, phù hợp cho khách du lịch tiết kiệm.',
                'hinh_anhs' => json_encode([
                    'https://placehold.co/600x400?text=Standard+Room+1',
                    'https://placehold.co/600x400?text=Standard+Room+2'
                ]),
                'dien_tich' => 20,
                'gia' => 800000,
                'tien_ich' => 'Wi-Fi, Điều hòa, TV',
                'suc_chua' => 2,
                'so_giuong' => 1,
                'trang_thai' => 0,
            ],
            [
                'ten_phong' => 'Phòng Suite Cổ Điển',
                'id_homestay' => 2,
                'mo_ta' => 'Phòng sang trọng với nội thất cổ điển, có bồn tắm.',
                'hinh_anhs' => json_encode([
                    'https://placehold.co/600x400?text=Classic+Suite+1',
                    'https://placehold.co/600x400?text=Classic+Suite+2'
                ]),
                'dien_tich' => 50,
                'gia' => 2500000,
                'tien_ich' => 'Wi-Fi, Điều hòa, TV, Tủ lạnh, Bồn tắm, Máy sấy tóc',
                'suc_chua' => 2,
                'so_giuong' => 1,
                'trang_thai' => 1,
            ],
            [
                'ten_phong' => 'Phòng Đôi Hướng Hồ',
                'id_homestay' => 2,
                'mo_ta' => 'Phòng đôi với view hồ thơ mộng, không gian yên tĩnh.',
                'hinh_anhs' => json_encode([
                    'https://placehold.co/600x400?text=Double+Lake+1',
                    'https://placehold.co/600x400?text=Double+Lake+2'
                ]),
                'dien_tich' => 35,
                'gia' => 1500000,
                'tien_ich' => 'Wi-Fi, Điều hòa, TV, Tủ lạnh',
                'suc_chua' => 2,
                'so_giuong' => 1,
                'trang_thai' => 1,
            ],
            [
                'ten_phong' => 'Phòng Dorm Tập Thể',
                'id_homestay' => 2,
                'mo_ta' => 'Phòng dorm cho nhóm bạn, có giường tầng tiện lợi.',
                'hinh_anhs' => json_encode([
                    'https://placehold.co/600x400?text=Dorm+Room+1',
                    'https://placehold.co/600x400?text=Dorm+Room+2'
                ]),
                'dien_tich' => 60,
                'gia' => 500000,
                'tien_ich' => 'Wi-Fi, Điều hòa, Tủ khóa',
                'suc_chua' => 8,
                'so_giuong' => 4,
                'trang_thai' => 0,
            ],
            [
                'ten_phong' => 'Phòng Premium Hướng Biển',
                'id_homestay' => 3,
                'mo_ta' => 'Phòng cao cấp với view biển, ban công rộng rãi.',
                'hinh_anhs' => json_encode([
                    'https://placehold.co/600x400?text=Premium+Sea+1',
                    'https://placehold.co/600x400?text=Premium+Sea+2'
                ]),
                'dien_tich' => 40,
                'gia' => 2000000,
                'tien_ich' => 'Wi-Fi, Điều hòa, TV, Tủ lạnh, Máy pha cà phê',
                'suc_chua' => 2,
                'so_giuong' => 1,
                'trang_thai' => 1,
            ],
            [
                'ten_phong' => 'Phòng Studio Nhỏ',
                'id_homestay' => 3,
                'mo_ta' => 'Phòng nhỏ gọn với đầy đủ tiện nghi, phù hợp cho khách lẻ.',
                'hinh_anhs' => json_encode([
                    'https://placehold.co/600x400?text=Small+Studio+1',
                    'https://placehold.co/600x400?text=Small+Studio+2'
                ]),
                'dien_tich' => 25,
                'gia' => 900000,
                'tien_ich' => 'Wi-Fi, Điều hòa, TV, Tủ lạnh',
                'suc_chua' => 1,
                'so_giuong' => 1,
                'trang_thai' => 1,
            ],
            [
                'ten_phong' => 'Phòng Gia Đình Lớn',
                'id_homestay' => 3,
                'mo_ta' => 'Phòng lớn cho gia đình, có khu vực sinh hoạt chung.',
                'hinh_anhs' => json_encode([
                    'https://placehold.co/600x400?text=Large+Family+1',
                    'https://placehold.co/600x400?text=Large+Family+2'
                ]),
                'dien_tich' => 55,
                'gia' => 2200000,
                'tien_ich' => 'Wi-Fi, Điều hòa, TV, Tủ lạnh, Bếp nhỏ, Máy giặt',
                'suc_chua' => 6,
                'so_giuong' => 3,
                'trang_thai' => 1,
            ],
            [
                'ten_phong' => 'Phòng Budget',
                'id_homestay' => 3,
                'mo_ta' => 'Phòng giá rẻ, tiện nghi cơ bản cho khách backpacker.',
                'hinh_anhs' => json_encode([
                    'https://placehold.co/600x400?text=Budget+Room+1',
                    'https://placehold.co/600x400?text=Budget+Room+2'
                ]),
                'dien_tich' => 18,
                'gia' => 600000,
                'tien_ich' => 'Wi-Fi, Quạt, Tủ khóa',
                'suc_chua' => 2,
                'so_giuong' => 1,
                'trang_thai' => 0,
            ],
        ];

        foreach ($phongs as $phong) {
            Phong::create($phong);
        }
    }
}