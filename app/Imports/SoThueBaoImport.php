<?php

namespace App\Imports;

use App\Models\SoThueBao;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoThueBaoImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new SoThueBao([
            'so_thue_bao' => $row['so_thue_bao'],
            'loai_thue_bao' => $this->formatLoaiThueBao($row['loai_thue_bao']),
            'khu_vuc' => $row['khu_vuc'],
            'loai_so' => $this->formatLoaiSo($row['loai_so']),
            'phi_giu_so' => $this->formatCurrency($row['phi_giu_so']),
            'phi_hoa_mang' => $this->formatCurrency($row['phi_hoa_mang']),
            'trang_thai' => $this->formatTrangThai($row['trang_thai']),
        ]);
    }

    private function formatCurrency($amount)
    {
        return str_replace(['.', ' VND'], '', $amount);
    }

    private function formatLoaiThueBao($loaiThueBao)
    {
        return $loaiThueBao === 'Trả trước' ? 'tra_truoc' : 'tra_sau';
    }

    private function formatLoaiSo($loaiSo)
    {
        return $loaiSo === 'Số VIP' ? 'so_vip' : 'so_thuong';
    }

    private function formatTrangThai($trangThai)
    {
        switch ($trangThai) {
            case 'Giữ số':
                return 'giu_so';
            case 'Chưa sử dụng':
                return 'chua_su_dung';
            case 'Hòa mạng':
                return 'hoa_mang';
            default:
                return 'khong_xac_dinh';
        }
    }
}