<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GoiCuoc;

class GoiCuocSeeder extends Seeder
{
    public function run()
    {
        $goiCuocData = [
            // Gói cước Thoại Quốc Tế
            [
                'ten_goicuoc' => 'VoIP 1313 - TQT9',
                'gia' => 90000,
                'thoi_gian' => 30,
                'dung_luong' => 1,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'thoai_quoc_te'
            ],
            [
                'ten_goicuoc' => 'VoIP 1313 - TQT19',
                'gia' => 190000,
                'thoi_gian' => 30,
                'dung_luong' => 2,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'thoai_quoc_te'
            ],
            [
                'ten_goicuoc' => 'VoIP 1313 - TQT49',
                'gia' => 490000,
                'thoi_gian' => 30,
                'dung_luong' => 5,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'thoai_quoc_te'
            ],
            [
                'ten_goicuoc' => 'VoIP 1313 - TQT99',
                'gia' => 990000,
                'thoi_gian' => 30,
                'dung_luong' => 10,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'thoai_quoc_te'
            ],
            [
                'ten_goicuoc' => 'VoIP 1313 - TQT199',
                'gia' => 1990000,
                'thoi_gian' => 30,
                'dung_luong' => 20,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'thoai_quoc_te'
            ],
            [
                'ten_goicuoc' => 'VoIP 1313 - TQT299',
                'gia' => 2990000,
                'thoi_gian' => 30,
                'dung_luong' => 30,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'thoai_quoc_te'
            ],

            // Gói cước Chuyển Vùng Quốc Tế
            [
                'ten_goicuoc' => 'Combo Hàn Quốc 1',
                'gia' => 350000,
                'thoi_gian' => 7,
                'dung_luong' => 2,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'chuyen_vung_quoc_te'
            ],
            [
                'ten_goicuoc' => 'Combo Hàn Quốc 2',
                'gia' => 550000,
                'thoi_gian' => 14,
                'dung_luong' => 5,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'chuyen_vung_quoc_te'
            ],

            // Gói cước Combo trong nước
            [
                'ten_goicuoc' => 'Gói MobiF MF199QT',
                'gia' => 199000,
                'thoi_gian' => 30,
                'dung_luong' => 4,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'combo_trong_nuoc'
            ],
            [
                'ten_goicuoc' => 'Gói MobiF MF149QT',
                'gia' => 149000,
                'thoi_gian' => 30,
                'dung_luong' => 3,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'combo_trong_nuoc'
            ],
            [
                'ten_goicuoc' => 'Gói MobiF MF99QT',
                'gia' => 99000,
                'thoi_gian' => 30,
                'dung_luong' => 2,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'combo_trong_nuoc'
            ],

            // Gói cước Doanh nghiệp
            [
                'ten_goicuoc' => 'Gói FClass',
                'gia' => 500000,
                'thoi_gian' => 30,
                'dung_luong' => 10,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'doanh_nghiep'
            ],
            [
                'ten_goicuoc' => 'Gói BClass',
                'gia' => 800000,
                'thoi_gian' => 30,
                'dung_luong' => 20,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'doanh_nghiep'
            ],
            [
                'ten_goicuoc' => 'Gói EClass_1',
                'gia' => 1200000,
                'thoi_gian' => 30,
                'dung_luong' => 30,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'doanh_nghiep'
            ],
            [
                'ten_goicuoc' => 'Gói NClass',
                'gia' => 1500000,
                'thoi_gian' => 30,
                'dung_luong' => 50,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'doanh_nghiep'
            ],
            [
                'ten_goicuoc' => 'Gói Enterprise E329QT',
                'gia' => 329000,
                'thoi_gian' => 30,
                'dung_luong' => 5,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'doanh_nghiep'
            ],
            [
                'ten_goicuoc' => 'Gói Enterprise E229QT',
                'gia' => 229000,
                'thoi_gian' => 30,
                'dung_luong' => 3,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'doanh_nghiep'
            ],

            // Gói cước duy trì tiết kiệm
            [
                'ten_goicuoc' => 'Gói QTTK15',
                'gia' => 15000,
                'thoi_gian' => 15,
                'dung_luong' => 0.5,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'tiet_kiem'
            ]
        ];

        foreach ($goiCuocData as $data) {
            GoiCuoc::create($data);
        }
    }
}