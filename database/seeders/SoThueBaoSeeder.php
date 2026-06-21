<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoThueBao;
use App\Models\GoiCuoc;

class SoThueBaoSeeder extends Seeder
{
    public function run()
    {
        // Lấy ID của một số gói cước để liên kết
        $goiCuocIds = GoiCuoc::pluck('id')->toArray();
        
        $soThueBaos = [
            // Số thuê bao đang sẵn sàng (chưa sử dụng)
            ['so_thue_bao' => '0912345678', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0912345679', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0912345680', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0912345681', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0912345682', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            
            ['so_thue_bao' => '0987654321', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền nam', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0987654322', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền nam', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0987654323', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền nam', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0987654324', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền nam', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0987654325', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền nam', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            
            ['so_thue_bao' => '0909123456', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền trung', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0909123457', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền trung', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0909123458', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền trung', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0909123459', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền trung', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0909123460', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền trung', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => null],

            // Số thuê bao đã giữ (đã sử dụng)
            ['so_thue_bao' => '0912345800', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'giữ số', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => !empty($goiCuocIds) ? $goiCuocIds[array_rand($goiCuocIds)] : null],
            ['so_thue_bao' => '0912345801', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'giữ số', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => !empty($goiCuocIds) ? $goiCuocIds[array_rand($goiCuocIds)] : null],
            ['so_thue_bao' => '0987654400', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền nam', 'trang_thai' => 'giữ số', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => !empty($goiCuocIds) ? $goiCuocIds[array_rand($goiCuocIds)] : null],
            ['so_thue_bao' => '0987654401', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền nam', 'trang_thai' => 'giữ số', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => !empty($goiCuocIds) ? $goiCuocIds[array_rand($goiCuocIds)] : null],
            ['so_thue_bao' => '0909123500', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền trung', 'trang_thai' => 'giữ số', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => !empty($goiCuocIds) ? $goiCuocIds[array_rand($goiCuocIds)] : null],

            // Số thuê bao đã hòa mạng
            ['so_thue_bao' => '0912346000', 'loai_thue_bao' => 'trả sau', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'hoà mạng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => !empty($goiCuocIds) ? $goiCuocIds[array_rand($goiCuocIds)] : null],
            ['so_thue_bao' => '0912346001', 'loai_thue_bao' => 'trả sau', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'hoà mạng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => !empty($goiCuocIds) ? $goiCuocIds[array_rand($goiCuocIds)] : null],
            ['so_thue_bao' => '0987654500', 'loai_thue_bao' => 'trả sau', 'khu_vuc' => 'miền nam', 'trang_thai' => 'hoà mạng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => !empty($goiCuocIds) ? $goiCuocIds[array_rand($goiCuocIds)] : null],
            ['so_thue_bao' => '0987654501', 'loai_thue_bao' => 'trả sau', 'khu_vuc' => 'miền nam', 'trang_thai' => 'hoà mạng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => !empty($goiCuocIds) ? $goiCuocIds[array_rand($goiCuocIds)] : null],
            ['so_thue_bao' => '0909123600', 'loai_thue_bao' => 'trả sau', 'khu_vuc' => 'miền trung', 'trang_thai' => 'hoà mạng', 'loai_so' => 'thường', 'phi_hoa_mang' => 50000, 'phi_giu_so' => 10000, 'goicuoc_id' => !empty($goiCuocIds) ? $goiCuocIds[array_rand($goiCuocIds)] : null],

            // Số thuê bao VIP
            ['so_thue_bao' => '0912347000', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'vip', 'phi_hoa_mang' => 100000, 'phi_giu_so' => 20000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0912347001', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền bắc', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'vip', 'phi_hoa_mang' => 100000, 'phi_giu_so' => 20000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0987655000', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền nam', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'vip', 'phi_hoa_mang' => 100000, 'phi_giu_so' => 20000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0987655001', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền nam', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'vip', 'phi_hoa_mang' => 100000, 'phi_giu_so' => 20000, 'goicuoc_id' => null],
            ['so_thue_bao' => '0909124000', 'loai_thue_bao' => 'trả trước', 'khu_vuc' => 'miền trung', 'trang_thai' => 'chưa sử dụng', 'loai_so' => 'vip', 'phi_hoa_mang' => 100000, 'phi_giu_so' => 20000, 'goicuoc_id' => null],
        ];

        foreach ($soThueBaos as $soThueBao) {
            SoThueBao::create($soThueBao);
        }
    }
}