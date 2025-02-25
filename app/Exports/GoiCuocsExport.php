<?php

namespace App\Exports;

use App\Models\GoiCuoc;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class GoiCuocsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
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
            'Giá (VND)',
            'Thời gian (ngày)',
            'Dung lượng',
            'Loại gói',
            'Trạng thái',
            'Ngày tạo',
            'Ngày cập nhật',
        ];
    }

    public function map($goicuoc): array
    {
        return [
            $goicuoc->id,
            $goicuoc->ten_goicuoc,
            $goicuoc->gia,
            $goicuoc->thoi_gian,
            $goicuoc->dung_luong . ' ' . $goicuoc->don_vi_dung_luong, // Kết hợp dung lượng và đơn vị dung lượng
            $goicuoc->loai_goicuoc,
            $goicuoc->status, // Đảm bảo cột trạng thái được bao gồm
            $goicuoc->created_at,
            $goicuoc->updated_at,
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $sheet = $event->sheet;

                // Thêm tiêu đề và thông tin mô tả
                $sheet->setCellValue('A1', 'Danh sách Gói Cước');
                $sheet->mergeCells('A1:I1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Thêm tiêu đề thời gian xuất file
                $currentDateTime = now()->format('Y-m-d H:i:s');
                $sheet->setCellValue('A2', 'Thời gian xuất file: ' . $currentDateTime);
                $sheet->mergeCells('A2:I2');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);
            },
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;

                // Định dạng tiêu đề
                $sheet->getStyle('A3:I3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFFFF0']
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Định dạng dữ liệu
                $sheet->getStyle('A4:I' . $sheet->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Định dạng cột giá và thời gian
                $sheet->getStyle('C4:C' . $sheet->getHighestRow())->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $sheet->getStyle('H4:I' . $sheet->getHighestRow())->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DATETIME);

                // Tự động điều chỉnh kích thước cột
                foreach (range('A', $sheet->getHighestColumn()) as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Thêm bộ lọc cho các cột ở hàng tiêu đề
                $sheet->setAutoFilter('A3:I3');
            },
        ];
    }
}