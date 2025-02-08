<?php

namespace App\Providers;

use App\Models\DichVu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Order;
use App\Observers\OrderObserver;
use Illuminate\Support\Facades\DB;
use App\Models\News;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Session;

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



        // Lấy danh sách tin khuyến mãi, sự kiện, và thông cáo báo chí đã kiểm duyệt và kích hoạt
    $newsPromotion = News::where('category', 'tin-khuyen-mai')->where('kiemduyet', 1)->where('kichhoat', 1)->get();
    $newsEvent = News::where('category', 'tin-tuc-su-kien')->where('kiemduyet', 1)->where('kichhoat', 1)->get();
    $newsPress = News::where('category', 'thong-cao-bao-chi')->where('kiemduyet', 1)->where('kichhoat', 1)->get();

    // Chia sẻ các biến đến tất cả view
    View::share([
        'newsPromotion' => $newsPromotion,
        'newsEvent' => $newsEvent,
        'newsPress' => $newsPress,
    ]);


     // Lấy số điện thoại từ session OTP
     $phone = Session::get('phone');

     // Nếu người dùng đã đăng nhập bằng OTP, lấy cuộc trò chuyện của họ
     if ($phone) {
         $conversations = Conversation::where('phone', $phone)->with('messages')->get();
         View::share('conversations', $conversations);
         View::share('phone', $phone);
     } else {
         View::share('conversations', collect([])); // Trả về một collection rỗng nếu chưa có hội thoại
         View::share('phone', null);
     }


     View::composer('*', function ($view) {
        $conversations = Conversation::with(['messages' => function ($query) {
            $query->latest();
        }])->get();

        // Cập nhật số tin nhắn chưa đọc
        foreach ($conversations as $conversation) {
            $conversation->unread_count = Message::where('conversation_id', $conversation->id)
                                                 ->where('is_read', false)
                                                 ->count();
        }

        $view->with('conversations', $conversations);
    });
    
    }



    
}
