<?php

namespace App\Imports;

use App\Models\GoiCuoc;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class GoiCuocsImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            GoiCuoc::updateOrCreate(
                ['id' => $row['id']], // Điều kiện xác định bản ghi đã tồn tại
                [
                    'ten_goicuoc' => $row['ten_goicuoc'],
                    'gia' => $row['gia'],
                    'thoi_gian' => $row['thoi_gian'],
                    'dung_luong' => $row['dung_luong'],
                    'don_vi_dung_luong' => $row['don_vi_dung_luong'],
                    'loai_goicuoc' => $row['loai_goicuoc'],
                    'status' => $row['status'],
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            '*.id' => 'required|integer',
            '*.ten_goicuoc' => 'required|string',
            '*.gia' => 'required|numeric',
            '*.thoi_gian' => 'required|integer',
            '*.dung_luong' => 'required|numeric',
            '*.don_vi_dung_luong' => 'required|string',
            '*.loai_goicuoc' => 'required|string',
            '*.status' => 'required|string',
        ];
    }
}