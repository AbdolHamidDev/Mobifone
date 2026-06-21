<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GoiCuoc;

class GoiCuocSeeder extends Seeder
{
    public function run()
    {
        $goiCuocData = [
            // ==================== GÓI CƯỚC THOẠI QUỐC TẾ ====================
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
            [
                'ten_goicuoc' => 'Gói Roaming Châu Á',
                'gia' => 150000,
                'thoi_gian' => 7,
                'dung_luong' => 3,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'thoai_quoc_te'
            ],
            [
                'ten_goicuoc' => 'Gói Roaming Châu Âu',
                'gia' => 450000,
                'thoi_gian' => 15,
                'dung_luong' => 8,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'thoai_quoc_te'
            ],

            // ==================== GÓI CƯỚC CHUYỂN VÙNG QUỐC TẾ ====================
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
            [
                'ten_goicuoc' => 'Combo Nhật Bản',
                'gia' => 650000,
                'thoi_gian' => 10,
                'dung_luong' => 6,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'chuyen_vung_quoc_te'
            ],
            [
                'ten_goicuoc' => 'Combo Mỹ - Canada',
                'gia' => 750000,
                'thoi_gian' => 15,
                'dung_luong' => 10,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'chuyen_vung_quoc_te'
            ],
            [
                'ten_goicuoc' => 'Combo Châu Âu',
                'gia' => 850000,
                'thoi_gian' => 15,
                'dung_luong' => 12,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'chuyen_vung_quoc_te'
            ],

            // ==================== GÓI CƯỚC COMBO TRONG NƯỚC ====================
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
            [
                'ten_goicuoc' => 'Gói MobiF MF49QT',
                'gia' => 49000,
                'thoi_gian' => 30,
                'dung_luong' => 1,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'combo_trong_nuoc'
            ],
            [
                'ten_goicuoc' => 'Gói MobiF MF299QT',
                'gia' => 299000,
                'thoi_gian' => 30,
                'dung_luong' => 6,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'combo_trong_nuoc'
            ],

            // ==================== GÓI CƯỚC DOANH NGHIỆP ====================
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
            [
                'ten_goicuoc' => 'Gói Enterprise E129QT',
                'gia' => 129000,
                'thoi_gian' => 30,
                'dung_luong' => 2,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'doanh_nghiep'
            ],

            // ==================== GÓI CƯỚC TIẾT KIỆM ====================
            [
                'ten_goicuoc' => 'Gói QTTK15',
                'gia' => 15000,
                'thoi_gian' => 15,
                'dung_luong' => 0.5,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'tiet_kiem'
            ],
            [
                'ten_goicuoc' => 'Gói QTTK30',
                'gia' => 25000,
                'thoi_gian' => 30,
                'dung_luong' => 1,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'tiet_kiem'
            ],
            [
                'ten_goicuoc' => 'Gói QTTK90',
                'gia' => 60000,
                'thoi_gian' => 90,
                'dung_luong' => 2,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'tiet_kiem'
            ],

            // ==================== GÓI CƯỚC HOT ====================
            [
                'ten_goicuoc' => 'Gói HOT DATA 10GB',
                'gia' => 99000,
                'thoi_gian' => 30,
                'dung_luong' => 10,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'hot'
            ],
            [
                'ten_goicuoc' => 'Gói HOT DATA 20GB',
                'gia' => 159000,
                'thoi_gian' => 30,
                'dung_luong' => 20,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'hot'
            ],
            [
                'ten_goicuoc' => 'Gói HOT VOICE 500P',
                'gia' => 79000,
                'thoi_gian' => 30,
                'dung_luong' => 0,
                'don_vi_dung_luong' => 'phut_goi_quoc_te',
                'status' => 1,
                'loai_goicuoc' => 'hot'
            ],

            // ==================== GÓI CƯỚC SIÊU DATA ====================
            [
                'ten_goicuoc' => 'Gói Siêu Data 50GB',
                'gia' => 249000,
                'thoi_gian' => 30,
                'dung_luong' => 50,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'sieu_data'
            ],
            [
                'ten_goicuoc' => 'Gói Siêu Data 100GB',
                'gia' => 399000,
                'thoi_gian' => 30,
                'dung_luong' => 100,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'sieu_data'
            ],
            [
                'ten_goicuoc' => 'Gói Siêu Data 200GB',
                'gia' => 599000,
                'thoi_gian' => 30,
                'dung_luong' => 200,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'sieu_data'
            ],

            // ==================== GÓI CƯỚC GIA ĐÌNH ====================
            [
                'ten_goicuoc' => 'Gói Gia Đình 3 SIM',
                'gia' => 450000,
                'thoi_gian' => 30,
                'dung_luong' => 30,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'gia_dinh'
            ],
            [
                'ten_goicuoc' => 'Gói Gia Đình 5 SIM',
                'gia' => 699000,
                'thoi_gian' => 30,
                'dung_luong' => 50,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'gia_dinh'
            ],

            // ==================== GÓI CƯỚC MOBIF ====================
            [
                'ten_goicuoc' => 'MobiF D10',
                'gia' => 90000,
                'thoi_gian' => 30,
                'dung_luong' => 10,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'mobif'
            ],
            [
                'ten_goicuoc' => 'MobiF D20',
                'gia' => 159000,
                'thoi_gian' => 30,
                'dung_luong' => 20,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'mobif'
            ],
            [
                'ten_goicuoc' => 'MobiF D50',
                'gia' => 299000,
                'thoi_gian' => 30,
                'dung_luong' => 50,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'mobif'
            ],

            // ==================== GÓI CƯỚC TÍCH ĐIỂM ====================
            [
                'ten_goicuoc' => 'Gói Tích Điểm Vàng',
                'gia' => 50000,
                'thoi_gian' => 30,
                'dung_luong' => 2,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'tich_diem'
            ],
            [
                'ten_goicuoc' => 'Gói Tích Điểm Bạc',
                'gia' => 30000,
                'thoi_gian' => 30,
                'dung_luong' => 1,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'tich_diem'
            ],

            // ==================== GÓI CƯỚC MOBISAFE ====================
            [
                'ten_goicuoc' => 'MobiSafe Cơ bản',
                'gia' => 29000,
                'thoi_gian' => 30,
                'dung_luong' => 0,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'mobisafe'
            ],
            [
                'ten_goicuoc' => 'MobiSafe Nâng cao',
                'gia' => 59000,
                'thoi_gian' => 30,
                'dung_luong' => 0,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'mobisafe'
            ],

            // ==================== GÓI CƯỚC QUỐC TẾ LINH HOẠT ====================
            [
                'ten_goicuoc' => 'Gói Quốc Tế Linh Hoạt 1GB',
                'gia' => 199000,
                'thoi_gian' => 30,
                'dung_luong' => 1,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'quoc_te_linh_hoat'
            ],
            [
                'ten_goicuoc' => 'Gói Quốc Tế Linh Hoạt 5GB',
                'gia' => 599000,
                'thoi_gian' => 30,
                'dung_luong' => 5,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'quoc_te_linh_hoat'
            ],
            [
                'ten_goicuoc' => 'Gói Quốc Tế Linh Hoạt 10GB',
                'gia' => 999000,
                'thoi_gian' => 30,
                'dung_luong' => 10,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'quoc_te_linh_hoat'
            ],

            // ==================== GÓI CƯỚC COMBO ====================
            [
                'ten_goicuoc' => 'Combo Văn Phòng',
                'gia' => 350000,
                'thoi_gian' => 30,
                'dung_luong' => 15,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'combo'
            ],
            [
                'ten_goicuoc' => 'Combo Gia Đình',
                'gia' => 450000,
                'thoi_gian' => 30,
                'dung_luong' => 25,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'combo'
            ],
            [
                'ten_goicuoc' => 'Combo Doanh Nghiệp',
                'gia' => 899000,
                'thoi_gian' => 30,
                'dung_luong' => 50,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'combo'
            ],

            // ==================== GÓI CƯỚC CHỊ ĐẸP ====================
            [
                'ten_goicuoc' => 'Gói Chị Đẹp 5GB',
                'gia' => 79000,
                'thoi_gian' => 30,
                'dung_luong' => 5,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'chi_dep'
            ],
            [
                'ten_goicuoc' => 'Gói Chị Đẹp 10GB',
                'gia' => 129000,
                'thoi_gian' => 30,
                'dung_luong' => 10,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'chi_dep'
            ],
            [
                'ten_goicuoc' => 'Gói Chị Đẹp 20GB',
                'gia' => 199000,
                'thoi_gian' => 30,
                'dung_luong' => 20,
                'don_vi_dung_luong' => 'GB',
                'status' => 1,
                'loai_goicuoc' => 'chi_dep'
            ],
        ];

        foreach ($goiCuocData as $data) {
            GoiCuoc::create($data);
        }
    }
}