<?php

namespace App\Imports;

use App\Models\Goidata;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class GoidataImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Goidata::updateOrCreate(
                ['id' => $row['id']], // Điều kiện xác định bản ghi đã tồn tại
                [
                    'ten_data' => $row['ten_data'],
                    'gia' => $row['gia'],
                    'thoi_gian' => $row['thoi_gian'],
                    'dung_luong' => $row['dung_luong'],
                    'don_vi_dung_luong' => $row['don_vi_dung_luong'],
                    'loai_data' => $row['loai_data'],
                    'status' => $row['status'],
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            '*.id' => 'required|integer',
            '*.ten_data' => 'required|string',
            '*.gia' => 'required|numeric',
            '*.thoi_gian' => 'required|integer',
            '*.dung_luong' => 'required|numeric',
            '*.don_vi_dung_luong' => 'required|string',
            '*.loai_data' => 'required|string',
            '*.status' => 'required|string',
        ];
    }
}