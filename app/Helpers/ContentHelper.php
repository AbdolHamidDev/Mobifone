<?php

namespace App\Helpers;

use App\Models\SoThueBao;

class ContentHelper
{
    public static function formatContent($content)
    {
        // Kiểm tra nếu chứa '-' hoặc ':', thêm xuống dòng
        return preg_replace('/(-|:)/', "$1<br>", $content);
    }

    public static function formatLoaiSo($value)
    {
        $map = [
            'so_vip' => 'Số VIP',
            'so_thuong' => 'Số thường',
            'khong_xac_dinh' => 'Không xác định',
        ];
    
        // Chuẩn hóa giá trị đầu vào: Loại bỏ khoảng trắng, chuyển về chữ thường
        $value = strtolower(trim($value));
    
        return $map[$value] ?? ucfirst($value); // Trả về giá trị đã map hoặc chữ viết hoa đầu nếu không khớp
    }
    

    public static function formatLoaiThueBao($loaiThueBao)
    {
        $mapping = [
            'tra_truoc' => 'Thuê bao trả trước',
            'tra_sau' => 'Thuê bao trả sau',
        ];

        return $mapping[$loaiThueBao] ?? 'Không xác định';
    }



    public static function getSoThueBaoById($id)
    {
        // Tìm số thuê bao trong cơ sở dữ liệu theo ID
        $soThueBao = SoThueBao::find($id);

        if ($soThueBao) {
            return $soThueBao->so_thue_bao; // Trả về số thuê bao thực
        }

        return 'Không xác định'; // Trường hợp không tìm thấy
    }
}
