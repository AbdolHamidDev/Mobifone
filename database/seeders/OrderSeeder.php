<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\SoThueBao;
use App\Models\GoiCuoc;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Lấy danh sách số thuê bao và gói cước
        $soThueBaos = SoThueBao::all();
        $goiCuocs = GoiCuoc::all();

        if ($soThueBaos->isEmpty() || $goiCuocs->isEmpty()) {
            return; // Không có dữ liệu để seed
        }

        $orders = [];
        $customerNames = [
            'Nguyễn Văn An', 'Trần Thị Bình', 'Lê Văn Cường', 'Phạm Thị Dung', 
            'Hoàng Văn Em', 'Vũ Thị Hoa', 'Đặng Văn Ích', 'Bùi Thị Kim',
            'Nguyễn Minh Tuấn', 'Trần Thị Hương', 'Lê Văn Nam', 'Phạm Thị Lan'
        ];

        // Tạo 50 đơn hàng trong 30 ngày gần đây
        for ($i = 0; $i < 50; $i++) {
            $soThueBao = $soThueBaos->random();
            $goiCuoc = $goiCuocs->random();
            $customerName = $customerNames[array_rand($customerNames)];
            
            // Random ngày trong 30 ngày gần đây
            $daysAgo = rand(0, 30);
            $createdAt = Carbon::now()->subDays($daysAgo);
            
            // Random trạng thái
            $statuses = ['hoà mạng', 'giữ số', 'hoàn thành'];
            $trangThai = $statuses[array_rand($statuses)];

            $orders[] = [
                'so_thue_bao_id' => $soThueBao->id,
                'goi_cuoc_id' => $goiCuoc->id,
                'sim_type' => rand(0, 1) ? 'eSIM' : 'SIM Vật lý',
                'customer_name' => $customerName,
                'phone' => '09' . rand(10000000, 99999999),
                'email' => strtolower(str_replace(' ', '', $customerName)) . '@gmail.com',
                'province' => 'Hà Nội',
                'district' => 'Cầu Giấy',
                'ward' => 'Phường Dịch Vọng',
                'address' => 'Số ' . rand(1, 100) . ' đường Nguyễn Trãi',
                'delivery_method' => rand(0, 1) ? 'giao hàng' : 'tự đến lấy',
                'payment_method' => rand(0, 1) ? 'chuyển khoản' : 'tiền mặt',
                'activation_fee' => $soThueBao->phi_hoa_mang,
                'package_price' => $goiCuoc->gia,
                'shipping_fee' => rand(0, 1) ? 25000 : 0,
                'total_amount' => $soThueBao->phi_hoa_mang + $goiCuoc->gia + (rand(0, 1) ? 25000 : 0),
                'trang_thai' => $trangThai,
                'da_nhan_hang' => $trangThai === 'hoàn thành' ? 1 : 0,
                'qr_code' => 'NO_QR_CODE',
                'order_code' => 'ORD-' . strtoupper(uniqid()),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}