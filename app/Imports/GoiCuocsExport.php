<?php

namespace App\Exports;

use App\Models\GoiCuoc;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GoiCuocsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return GoiCuoc::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tên gói cước',
            'Giá',
            'Thời gian',
            'Dung lượng',
            'Loại gói',
            'Trạng thái',
            'Ngày tạo',
            'Ngày cập nhật',
        ];
    }
}