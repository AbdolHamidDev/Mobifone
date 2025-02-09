<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\GoiCuoc;
use App\Models\PackageRegistration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function getHome()
    {
        // 1️⃣ Tổng hợp dữ liệu thống kê
        $totalOrders = Order::count();
        $todayRevenue = Order::whereDate('created_at', Carbon::today())->sum('total_amount');
        $newCustomers = Order::distinct('customer_name')->whereDate('created_at', Carbon::today())->count();
        $packagesSold = Order::count();

        // 2️⃣ Doanh thu theo tháng
        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = "Tháng " . $i;
            $data[] = $monthlyRevenue->where('month', $i)->first()->revenue ?? 0;
        }

        // 3️⃣ Tỷ lệ gói cước được đăng ký nhiều nhất
        $packageData = Order::selectRaw('goi_cuoc_id, COUNT(*) as count')
            ->groupBy('goi_cuoc_id')
            ->pluck('count')
            ->toArray();

        $packageLabels = GoiCuoc::whereIn('id', array_keys($packageData))->pluck('ten_goicuoc')->toArray();

        // 4️⃣ Danh sách đơn hàng gần đây
        $recentOrders = Order::latest()->limit(5)->get();

        // 5️⃣ Trạng thái đơn hàng (Biểu đồ Doughnut)
        $statusData = Order::selectRaw('trang_thai, COUNT(*) as count')
            ->groupBy('trang_thai')
            ->pluck('count')
            ->toArray();

        $statusLabels = Order::selectRaw('trang_thai')
            ->groupBy('trang_thai')
            ->pluck('trang_thai')
            ->toArray();

         // Lấy danh sách người dùng đang đăng nhập qua OTP từ session
         $otpUsers = Cache::get('otp_users', []);

           // Lấy danh sách đăng ký gói cước & gói data
    $packageRegistrations = PackageRegistration::with(['goicuoc', 'goiData'])
    ->latest()
    ->limit(10) // Hiển thị 10 bản ghi mới nhất
    ->get();

    
    

        return view('admin.home', compact(
            'totalOrders', 'todayRevenue', 'newCustomers', 'packagesSold',
            'labels', 'data', 'packageLabels', 'packageData',
            'recentOrders', 'statusLabels', 'statusData','otpUsers','packageRegistrations'
        ));
    }
}
