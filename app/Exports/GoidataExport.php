<?php

namespace App\Exports;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Goidata;
use Maatwebsite\Excel\Concerns\{
    FromQuery,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithEvents,
    WithColumnFormatting,
    ShouldAutoSize
};
use PhpOffice\PhpSpreadsheet\{
    Worksheet\Worksheet,
    Style\NumberFormat,
    Shared\Date
};
use PhpOffice\PhpSpreadsheet\Style\{
    Border,
    Fill,
    Font,
    Alignment
};

class GoidataExport implements 
    FromQuery, 
    WithHeadings, 
    WithMapping, 
    WithStyles, 
    WithEvents,
    WithColumnFormatting,
    ShouldAutoSize
{
    /**
     * Query tối ưu với eager loading nếu có relationship
     */
    public function query()
    {
        return Goidata::query()
            ->select([
                'id',
                'ten_data',
                'gia',
                'thoi_gian',
                'dung_luong',
                'don_vi_dung_luong',
                'loai_data',
                'status',
                'created_at',
                'updated_at'
            ])
            ->orderBy('id', 'desc');
    }

    /**
     * Tiêu đề chuyên nghiệp với multi-line
     */
    public function headings(): array
    {
        return [
            ['BÁO CÁO DANH SÁCH GÓI DATA'],
            ['', 'Xuất ngày: ' . now()->format('d/m/Y H:i')],
            [],
            [
                'ID',
                'TÊN GÓI',
                'GIÁ (VND)',
                'THỜI HẠN',
                'DUNG LƯỢNG',
                'ĐƠN VỊ',
                'LOẠI GÓI',
                'TRẠNG THÁI',
                'NGÀY TẠO',
                'NGÀY CẬP NHẬT'
            ]
        ];
    }

    /**
     * Định dạng từng dòng dữ liệu
     */
    public function map($goidata): array
    {
        return [
            $goidata->id,
            $this->formatTenData($goidata->ten_data),
            $goidata->gia, // Giữ nguyên giá trị số để định dạng sau
            $this->formatThoiGian($goidata->thoi_gian),
            $this->formatDungLuong($goidata->dung_luong, $goidata->don_vi_dung_luong),
            strtoupper($goidata->don_vi_dung_luong),
            $this->formatLoaiData($goidata->loai_data),
            $this->formatStatus($goidata->status),
            Date::dateTimeToExcel($goidata->created_at),
            Date::dateTimeToExcel($goidata->updated_at)
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'C' => '#,##0" ₫"', // Định dạng tiền tệ VND
            'D' => '0" ngày"',  // Định dạng thời gian
            'E' => '#,##0.00" "##', // Định dạng dung lượng
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }

    protected function formatGia($gia)
{
    return [
        'value' => $gia, // Giữ nguyên giá trị số
        'format' => '#,##0" ₫"' // Định dạng hiển thị
    ];
}

    /**
     * Style chuyên nghiệp
     */
    public function styles(Worksheet $sheet)
    {
        // Merge cells cho tiêu đề báo cáo
        $sheet->mergeCells('A1:J1');
        $sheet->mergeCells('A2:J2');
        
        // Style tổng thể cho toàn bộ dữ liệu
        $sheet->getStyle('A4:J'.$sheet->getHighestRow())->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);
    
        // Style cho tiêu đề chính
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '2F75B5']
            ]
        ]);
    
        // Style cho ngày xuất
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'italic' => true,
                'color' => ['rgb' => '7F7F7F']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
            ]
        ]);
    
        // Style cho header
        $sheet->getStyle('A4:J4')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '5B9BD5']
            ],
            'alignment' => [
                'wrapText' => true
            ]
        ]);
    
        // Highlight dòng theo trạng thái (sửa lại phần này)
        $highestRow = $sheet->getHighestRow();
        for ($row = 5; $row <= $highestRow; $row++) {
            $status = $sheet->getCell('H'.$row)->getValue();
            $fillColor = ($status === 'Kích hoạt') ? 'E2EFDA' : 'FCE4D6';
            
            $sheet->getStyle('A'.$row.':J'.$row)->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['rgb' => $fillColor]
                ]
            ]);
        }
    
        return [];
    }

    /**
     * Sự kiện bổ sung
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Freeze pane
                $event->sheet->freezePane('A5');
                
                // Auto filter
                $event->sheet->setAutoFilter('A4:J4');
                
                // Set print settings
                $event->sheet->getPageSetup()
                    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4)
                    ->setFitToWidth(1)
                    ->setFitToHeight(0);
                
                // Header/footer
                $event->sheet->getHeaderFooter()
                    ->setOddHeader('&C&B' . config('app.name'))
                    ->setOddFooter('&L&B' . now()->format('d/m/Y H:i') . '&RPage &P of &N');
            }
        ];
    }

    /**
     * Các hàm định dạng dữ liệu
     */
    protected function formatTenData($tenData)
    {
        return mb_strtoupper(mb_substr($tenData, 0, 1)) . mb_substr($tenData, 1);
    }
    
    protected function formatThoiGian($thoiGian)
    {
        return $thoiGian . ' ngày';
    }
    
    protected function formatDungLuong($dungLuong, $donVi)
    {
        return number_format($dungLuong, $donVi === 'GB' ? 2 : 0) . ' ' . strtoupper($donVi);
    }
    
    protected function formatLoaiData($loaiData)
    {
        $mapping = [
            'mien_phi_mxh' => 'MXH Miễn phí',
            'dai_ky' => 'Dài kỳ',
            'data_bo_sung' => 'Data bổ sung',
            'thang' => 'Theo tháng',
            'data_thuong' => 'Data thường',
            'ngay' => 'Theo ngày',
            'data_fastconnect' => 'Fastconnect'
        ];
        return $mapping[$loaiData] ?? $loaiData;
    }
    
    protected function formatStatus($status)
    {
        return $status === 'active' ? 'Kích hoạt' : 'Tạm dừng';
    }
}