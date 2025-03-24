<?php

namespace App\Exports;

use App\Models\SoThueBao;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SoThueBaoExport implements FromCollection, WithHeadings, WithTitle, WithCustomStartCell, WithEvents
{
    public function collection()
    {
        return SoThueBao::all()->map(function($soThueBao) {
            return [
                'ID' => $soThueBao->id,
                'Số thuê bao' => $soThueBao->so_thue_bao,
                'Loại thuê bao' => $this->formatLoaiThueBao($soThueBao->loai_thue_bao),
                'Khu vực hòa mạng' => $soThueBao->khu_vuc,
                'Loại số' => $this->formatLoaiSo($soThueBao->loai_so),
                'Phí giữ số' => $this->formatCurrency($soThueBao->phi_giu_so),
                'Phí hòa mạng' => $this->formatCurrency($soThueBao->phi_hoa_mang),
                'Trạng thái' => $this->formatTrangThai($soThueBao->trang_thai),
                'Created At' => $soThueBao->created_at,
                'Updated At' => $soThueBao->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Số thuê bao',
            'Loại thuê bao',
            'Khu vực hòa mạng',
            'Loại số',
            'Phí giữ số',
            'Phí hòa mạng',
            'Trạng thái',
            'Created At',
            'Updated At',
        ];
    }

    public function title(): string
    {
        return 'Danh sách Số Thuê Bao';
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setAutoFilter('A2:J2');
                $event->sheet->setCellValue('A1', 'Danh sách Số Thuê Bao');
                $event->sheet->mergeCells('A1:J1');
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Tự động canh chỉnh kích thước các cột
                foreach (range('A', 'J') as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

    private function formatCurrency($amount)
    {
        return number_format($amount, 0, ',', '.') . ' VND';
    }

    private function formatLoaiThueBao($loaiThueBao)
    {
        return $loaiThueBao === 'tra_truoc' ? 'Trả trước' : 'Trả sau';
    }

    private function formatLoaiSo($loaiSo)
    {
        return $loaiSo === 'so_vip' ? 'Số VIP' : 'Số Thường';
    }

    private function formatTrangThai($trangThai)
    {
        switch ($trangThai) {
            case 'giu_so':
                return 'Giữ số';
            case 'chua_su_dung':
                return 'Chưa sử dụng';
            case 'hoa_mang':
                return 'Hòa mạng';
            default:
                return 'Không xác định';
        }
    }
}