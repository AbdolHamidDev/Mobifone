<?php

namespace App\Imports;

use App\Models\GoiCuoc;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GoiCuocsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new GoiCuoc([
            'ten_goicuoc' => $row['ten_goicuoc'],
            'gia' => $row['gia'],
            'thoi_gian' => $row['thoi_gian'],
            'dung_luong' => $row['dung_luong'],
            'loai_goicuoc' => $row['loai_goicuoc'],
            'trang_thai' => $row['trang_thai'],
        ]);
    }
}