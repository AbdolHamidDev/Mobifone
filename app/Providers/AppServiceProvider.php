<?php

namespace App\Providers;

use App\Models\DichVu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Order;
use App\Observers\OrderObserver;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        // Đăng ký Observer cho Model Order
         Order::observe(OrderObserver::class);

          // Áp dụng biến $dichvuKhac cho một số view cụ thể
          View::composer(['frontend.dichvudidong.dichvu', 'frontend.dichvudidong.nuoc-ngoai-den-vn'], function ($view) {
            // Chỉ lấy 2 dịch vụ khác thay vì lấy toàn bộ
            $dichvuKhac = DB::table('dichvus')
                            ->where('loai_dich_vu', '!=', 'dịch vụ chính')
                            ->limit(2) // Giới hạn lấy 2 dòng dữ liệu
                            ->get();
        
            // Chia sẻ dữ liệu cho view
            $view->with('dichvuKhac', $dichvuKhac);
        });

        View::composer(['frontend.dichvudidong.quoc-te-khac'], function ($view) {
            // Lấy danh sách dịch vụ có loai_dich_vu là 'Khác'
            $dichvusKhac = DichVu::where('loai_dich_vu', 'Khác')->get();
    
            // Truyền dữ liệu vào view
            $view->with('dichvusKhac', $dichvusKhac);
        });
        
    }
}
