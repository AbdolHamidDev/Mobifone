<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuanLyGoicuocController;
use App\Http\Controllers\GoicuocDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TuyenDungController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DangKyChuyenDoiMangController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\SubscriptionTypeController;
use App\Http\Controllers\LoaiThueBaoController;
use App\Http\Controllers\CustomPackageController;
use App\Http\Controllers\QuanlyDataController;
use App\Http\Controllers\GoiDataDetailController;
use App\Http\Controllers\DichVuController;
use App\Http\Controllers\DichvuChitietController;
use App\Http\Controllers\SoThueBaoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuocGiaController;
use App\Http\Controllers\NhaKhaiThacController;
use App\Http\Controllers\GiaCuocQuocTeController;
use App\Http\Controllers\GoiVoipCuocPhiController;
use App\Models\Goicuoc;
use App\Models\Goidata;
use App\Http\Controllers\Auth\CustomLoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\OTPLoginController;
use App\Http\Controllers\CancellationController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Cache;






// KHU VỰC ADMIN ĐĂNG NHẬP ĐĂNG XUẤT & GỬI MAIL QUÊN MẬT KHẨU

    // Hiển thị form quên mật khẩu
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware('guest')
        ->name('password.request');

    // Xử lý gửi email đặt lại mật khẩu
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest')
        ->name('password.email');

    // Hiển thị form đặt lại mật khẩu
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware('guest')
        ->name('password.reset');

    // Xử lý đặt lại mật khẩu
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('password.update');

        Route::post('/forgot-password', function (Request $request) {
            $request->validate(['email' => 'required|email']);
        
            // Gửi email đặt lại mật khẩu
            $status = Password::sendResetLink($request->only('email'));
        
            return $status === Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);
        })->middleware('guest')->name('password.email');
    
    // xử lý đăng nhập & đăng xuất
    Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CustomLoginController::class, 'login']);
    Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');




  
   
    
    // Hiển thị form nhập số điện thoại
    Route::get('/login-otp', [OTPLoginController::class, 'showPhoneForm'])->name('otp.login');
    
    // Xử lý gửi OTP
    Route::post('/send-otp', [OTPLoginController::class, 'sendOTP'])->name('otp.send');
    
    // Hiển thị form nhập OTP
    Route::get('/verify-otp', [OTPLoginController::class, 'showOTPForm'])->name('otp.verify');
    
    // Xác thực OTP
    Route::post('/verify-otp', [OTPLoginController::class, 'verifyOTP'])->name('otp.check');
    
    // Đăng xuất
    Route::post('/logout-otp', [OTPLoginController::class, 'logout'])->name('otp.logout');
    
    Route::post('/logout-otp', function () {
        Session::forget('authenticated');
        Session::forget('phone');
        return redirect('/')->with('success', 'Bạn đã đăng xuất thành công.');
    })->name('otp.logout');
    






// Phần khách hàng chưa đăng nhập
Route::name('frontend.')->group(function () {
    // Trang chủ
    Route::get('/', [HomeController::class, 'index'])->name('home'); 
    
    Route::get('/hop-tac', function () {
        return view('frontend.gioithieu.hoptac');
    });

    Route::get('/khuyen-mai', function () {
        return view('frontend.tintuc.tintuc');
    });

    Route::get('/gioi-thieu', function () {
        return view('frontend.gioithieu.gioithieu');
    });

    Route::get('/cauhoi-thuonggap', function () {
        return view('frontend.hotro.cauhoi');
    });

    Route::get('/chuyendoi-mang', function () {
        return view('frontend.chuyenmang.home');
    });

    Route::get('/tra-cuu-don-hang', [OrderController::class, 'tracuu'])->name('order.search');


    // dịch vụ quốc tế
    Route::get('/dich-vu-quoc-te', function () {
        return view('frontend.dichvudidong.dichvuquocte');
    });

    Route::get('/dich-vu/ra-nuoc-ngoai', function () {
        return view('frontend.dichvudidong.ra-nuoc-ngoai');
    })->name('dichvu.ra-nuoc-ngoai');
    
    Route::get('/dich-vu/nuoc-ngoai-den-vn', function () {
        return view('frontend.dichvudidong.nuoc-ngoai-den-vn');
    })->name('dichvu.nuoc-ngoai-den-vn');
    
    Route::get('/dich-vu/thoai-quoc-te', function () {
        return view('frontend.dichvudidong.thoai-quoc-te');
    })->name('dichvu.thoai-quoc-te');
    
    Route::get('/dich-vu/quoc-te-khac', function () {
        return view('frontend.dichvudidong.quoc-te-khac');
    })->name('dichvu.quoc-te-khac');
    





    Route::get('/dieu-khoan-su-dung', function () {
        return view('frontend.dieukhoan.terms-of-use');
    })->name('terms');
    
    Route::get('/privacy-policy', function () {
        return view('frontend.dieukhoan.privacy-policy');
    })->name('privacy.policy');
    
    Route::get('/dich-vu-di-dong/loai-thue-bao/{category?}', [SubscriptionTypeController::class, 'show'])
    ->name('dichvudidong.loaithuebao');

    Route::get('/dich-vu-di-dong/loai-thue-bao/{subscriptionTypeId}/chi-tiet', [LoaiThueBaoController::class, 'details'])
    ->name('dichvudidong.details');


    Route::get('/dich-vu-di-dong/goi-cuoc', [QuanLyGoicuocController::class, 'show'])
    ->name('dichvudidong.goicuoc');

    Route::get('/dich-vu-di-dong/goi-data', [QuanlyDataController::class, 'show'])
    ->name('dichvudidong.goidata');
    
    Route::get('/dich-vu-di-dong/goi-cuoc/{id}', [GoicuocDetailController::class, 'show'])->name('dichvudidong1.chitiet');
    Route::post('/dich-vu-di-dong/goi-cuoc/register', [QuanLyGoicuocController::class, 'register'])->name('goicuoc.register');

    Route::get('/dich-vu-di-dong/goi-data/{id}', [GoiDataDetailController::class, 'show'])->name('dichvudidong2.chitiet');
    Route::post('/dich-vu-di-dong/goi-data/register', [QuanlyDataController::class, 'register'])->name('goidata.register');

    
    // dịch vụ
    Route::get('/dich-vu-di-dong/dich-vu', [DichVuController::class, 'show'])
    ->name('dichvudidong.dichvu');
    Route::get('/dich-vu-di-dong/dich-vu/{id}', [DichvuChitietController::class, 'show'])->name('dichvu_chitiet.index');


    // số thuê bao
    Route::get('/dich-vu-di-dong/so-thue-bao', [SoThueBaoController::class, 'show'])
    ->name('dichvudidong.sothuebao');
    Route::get('/dich-vu-di-dong/so-thue-bao', [SoThueBaoController::class, 'loc'])->name('dichvudidong.sothuebao');
    Route::get('/dich-vu-di-dong/so-thue-bao/chi-tiet/{id}', [SoThueBaoController::class, 'showChiTietSoThueBao'])->name('dichvudidong.chitiet');
    // tìm kiếm
    Route::get('/tim-kiem', [SoThueBaoController::class, 'timKiem']);
   
    //oder
    // frontend
  // Route GET hiển thị bước 2
    Route::get('/orders/step2', [OrderController::class, 'showStep2'])->name('dichvudidong.step2.show');

    // Route POST xử lý dữ liệu bước 2
    Route::post('/orders/step2', [OrderController::class, 'step2'])->name('dichvudidong.step2.process');

    Route::get('/orders/success', [OrderController::class, 'success'])->name('orders.success');

     // API lấy thông tin đơn hàng
     Route::get('/dich-vu-di-dong/so-thue-bao/orders/{order_code}', [OrderController::class, 'getOrderByCode']);

    // tuyển dụng
    Route::get('/tuyen-dung', [TuyenDungController::class, 'tuyendung']);
    // chi tiết tuyển dụng
    Route::get('/tuyen-dung/{id}', [TuyenDungController::class, 'tuyendung_chitiet'])->name('tuyendung.chitiet');
    // gửi cv
    Route::get('/cv/create', [CvController::class, 'create'])->name('cv.create');

    // tìm kiếm cửa hàng
    Route::get('/store-search', [StoreController::class, 'search'])->name('store.search');
    Route::get('/get-coordinates', [StoreController::class, 'getCoordinates'])->name('get.coordinates');

    Route::get('/news/{id}', [NewsController::class, 'showchitiet'])->name('news.detail');
 


});



// API Tra cứu gói cước (dùng trong DataTable)
Route::get('/api/khachhang/goicuoc', [KhachhangController::class, 'apiSubscriptions'])
    ->name('khachhang.apiSubscriptions');

// API Tra cứu gói data (dùng trong DataTable)
Route::get('/api/khachhang/goidata', [KhachhangController::class, 'apiSubscriptions2'])
    ->name('khachhang.apiSubscriptions2');

// Tra cứu gói cước
Route::get('/hosokhachhang/tracuu-goicuoc', [KhachhangController::class, 'traCuuGoiCuoc'])
    ->name('khachhang.tracuuGoicuoc');

// Tra cứu gói data
Route::get('/hosokhachhang/tracuu-goidata', [KhachhangController::class, 'traCuuGoiData'])
    ->name('khachhang.tracuuGoidata');


// Route lưu lịch sử hủy bằng store()
Route::post('/khachhang/goicuoc/store', [CancellationController::class, 'store'])
    ->name('khachhang.storeCancellation');










// Người dùng (tra cứu theo số điện thoại từ session OTP)

Route::get('/chat', function () {
    if (!session()->has('phone')) {
        return redirect('/login-otp')->with('error', 'Bạn cần xác thực OTP trước.');
    }
    return app()->call('App\Http\Controllers\ChatController@index');
})->name('chat.index');

    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/messages', [ChatController::class, 'getUserMessages'])->name('chat.get');


// 🟢 Admin
Route::get('/admin/chat', [ChatController::class, 'adminIndex'])->name('chat.admin');
Route::get('/admin/chat/messages/{conversation_id}', [ChatController::class, 'getMessages'])->name('chat.admin.messages');
Route::post('/admin/chat/send', [ChatController::class, 'adminSendMessage'])->name('chat.admin.send');
Route::get('/admin/chat/load/{conversation_id}', [ChatController::class, 'getAdminMessages'])->name('chat.admin.load');


// Phần Admin
Route::prefix('admin')->middleware('auth')->group(function () {

    // Trang chủ admin
    Route::get('/home', [AdminController::class, 'getHome'])->name('admin.home');

    // quản lý gói cước
    Route::resource('goicuocs', QuanLyGoicuocController::class);
    Route::post('/goicuocs/{id}/change-status', [QuanLyGoicuocController::class, 'changeStatus'])->name('goicuocs.changeStatus');
    Route::get('/api', [QuanLyGoicuocController::class, 'api'])->name('goicuocs.api');
    //file excel
    Route::get('/export', [QuanLyGoicuocController::class, 'export'])->name('goicuocs.export');
    Route::post('/import', [QuanLyGoicuocController::class, 'import'])->name('goicuocs.import');

     // gói cước chưa hoàn thiện
     Route::get('/incomplete-goicuocs', [QuanLyGoicuocController::class, 'incomplete'])->name('goicuocs.incomplete');
    
    // quản lý gói data
    Route::resource('Goidatas', QuanlyDataController::class);
    Route::post('/goidatas/{id}/change-status', [QuanlyDataController::class, 'changeStatus'])->name('goidatas.changeStatus');
    Route::get('/api/datas', [QuanlyDataController::class, 'api'])->name('Goidatas.api');
    //file excel
    Route::post('/admin/goidatas/import', [QuanlyDataController::class, 'import'])->name('Goidatas.import');
    Route::get('/admin/goidatas/export', [QuanlyDataController::class, 'export'])->name('Goidatas.export');

    // quản lý gói cước chi tiết
    Route::resource('goicuocs_detail', GoicuocDetailController::class);
    Route::get('/goicuocs/{id}/details', [GoicuocDetailController::class, 'showDetails'])->name('goicuocs.details');

    
    // quản lý data chi tiết
    Route::resource('goidatas_detail', GoiDataDetailController::class);
    Route::get('/goidatas/{id}/details', [GoiDataDetailController::class, 'showDetails'])->name('goidatas.details');


    // quản lý tin tức khuyến mãi
    Route::resource('news', NewsController::class);
    // Route kiểm duyệt bài viết
    Route::get('news/kiemduyet/{id}', [NewsController::class, 'kiemDuyet'])->name('news.kiemduyet');
    Route::get('news/kichhoat/{id}', [NewsController::class, 'kichHoat'])->name('news.kichhoat');

    // tuyển dụng
    Route::resource('tuyendung', TuyenDungController::class);
    // CV
    Route::get('/cv', [CVController::class, 'index'])->name('cv.index');
    Route::post('/cv/store', [CvController::class, 'store'])->name('cv.store');
    Route::post('/cv/{id}/mark-as-seen', [CVController::class, 'markAsSeen'])->name('cv.markAsSeen');
    Route::post('/cv/{id}/mark-as-approved', [CVController::class, 'markAsApproved'])->name('cv.markAsApproved');


    // tìm kiếm cửa hàng
    Route::resource('store', StoreController::class);

    // chuyển đổi mạng
    Route::resource('dang-ky-chuyen-doi-mang', DangKyChuyenDoiMangController::class);
   // Thêm route POST vào file routes/web.php

    Route::post('/dang-ky/{id}/toggle-lien-he', [DangKyChuyenDoiMangController::class, 'toggleLienHe']);
    Route::post('/dang-ky/{id}/toggle-ho-tro-thu-tuc', [DangKyChuyenDoiMangController::class, 'toggleHoTroThuTuc']);
    Route::post('/dang-ky/{id}/toggle-nhan-ket-qua', [DangKyChuyenDoiMangController::class, 'toggleNhanKetQua']);
    Route::get('/dangky/search', [DangKyChuyenDoiMangController::class, 'search'])->name('admin.dangky.search');

    // liên hệ

    Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::patch('/contact/{id}/status', [ContactController::class, 'updateStatus'])->name('contact.updateStatus');


    // loại thuê bao
    Route::resource('subscription-types', SubscriptionTypeController::class);
    
    Route::prefix('subscription-types/{subscriptionTypeId}/loaithuebao')->group(function () {
        Route::get('/', [LoaiThueBaoController::class, 'index'])->name('loaithuebao.index');
        Route::post('/', [LoaiThueBaoController::class, 'store'])->name('loaithuebao.store');
        Route::get('/{id}', [LoaiThueBaoController::class, 'show'])->name('loaithuebao.show');
        Route::get('/{id}/edit', [LoaiThueBaoController::class, 'edit'])->name('loaithuebao.edit');
        Route::put('/{id}', [LoaiThueBaoController::class, 'update'])->name('loaithuebao.update');
        Route::delete('/{id}', [LoaiThueBaoController::class, 'destroy'])->name('loaithuebao.destroy');
    });

    // thông tin khách hàng đăng ký
        //gói cước
        Route::get('/subscriptions', [KhachhangController::class, 'index'])->name('subscriptions.index');
        Route::get('/api/subscriptions', [KhachhangController::class, 'apiSubscriptions'])->name('subscriptions.api');
        
        
       // Gói data
        Route::get('/goidata', [KhachhangController::class, 'data'])->name('subscriptions.data');
        Route::get('/api/goidata', [KhachhangController::class, 'apiSubscriptions2'])->name('subscriptions2.api');

        // tự tạo gói cước
        Route::get('/custom-packages', [CustomPackageController::class, 'index'])->name('custom-packages.index');
        Route::post('/create-custom-package', [CustomPackageController::class, 'store'])->name('custom-package.store');
        Route::get('/api/custom-packages', [CustomPackageController::class, 'apiCustomPackages'])->name('custom-packages.api');


        // dịch vụ
        Route::resource('dichvus', DichVuController::class);
    
        Route::post('/dichvu_chitiet', [DichvuChitietController::class, 'store'])->name('dichvu_chitiet.store');
        Route::put('/dichvu_chitiet/{id}', [DichvuChitietController::class, 'update'])->name('dichvu_chitiet.update');


    // số thuê bao
    Route::resource('so-thue-bao', SoThueBaoController::class);
   //file excel số thuê bao
    Route::get('export-so-thue-bao', [SoThueBaoController::class, 'export'])->name('so-thue-bao.export');
    Route::post('import-so-thue-bao', [SoThueBaoController::class, 'import'])->name('so-thue-bao.import');

    // oder
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/toggle-payment', [OrderController::class, 'togglePaymentStatus']);
    Route::post('/orders/{id}/toggle-delivery', [OrderController::class, 'toggleDeliveryStatus']);


    // Dịch vụ quốc tế
    Route::resource('quoc-gia', QuocGiaController::class);
   

    Route::resource('nha-khai-thac', NhaKhaiThacController::class);
   // Đặt route custom trước route resource
Route::prefix('cuoc-quoc-te')->group(function() {
    Route::get('/dashboard-data', [GiaCuocQuocTeController::class, 'getDashboardData']);
    Route::get('/top-countries', [GiaCuocQuocTeController::class, 'getTopCountries']);
});

Route::resource('cuoc-quoc-te', GiaCuocQuocTeController::class);
    Route::get('/get-quoc-gia', [NhaKhaiThacController::class, 'getQuocGia']);
    Route::get('/get-quoc-gia-nha-khai-thac', [GiaCuocQuocTeController::class, 'getQuocGiaNhaKhaiThac']);

    // Gọi VoIP 131
    Route::resource('goi-voip-cuoc-phi', GoiVoipCuocPhiController::class);
    

      // Giao diện xem lịch sử hủy
Route::get('/lich-su-huy-goi', [CancellationController::class, 'index'])->name('cancellations.index');

// API DataTables lịch sử hủy
Route::get('/api/lich-su-huy-goi', [CancellationController::class, 'apiIndex'])->name('cancellations.apiIndex');
// hiệu lực thời gian gói cước
Route::get('/api/lich-su-huy-goi/subscriptions', [CancellationController::class, 'apiSubscriptions'])->name('khachhang.apiSubscriptions');





   

});




// khu vực API
Route::get('/admin/api/goicuocs-stats', [QuanLyGoicuocController::class, 'getStats']);

Route::get('/api/quoc-gia', [GiaCuocQuocTeController::class, 'getQuocGia']);
Route::get('/api/cuoc-quoc-te', [GiaCuocQuocTeController::class, 'getCuocQuocTe']);

Route::get('/api/get-countries', [GoiVoipCuocPhiController::class, 'getCountries']);
Route::get('/api/get-rates', [GoiVoipCuocPhiController::class, 'getRatesByCountry']);

Route::get('/api/goicuoc', function () {
    return response()->json(Goicuoc::all());
});

Route::get('/api/goidata', function () {
    return response()->json(Goidata::all());
});

Route::get('/api/package-summary', [KhachhangController::class, 'apiSummary']);


Route::get('/api/otp-users', function () {
    $otpUsers = Cache::get('otp_users', []);

    // Đảo ngược danh sách để lấy người mới nhất lên trước
    $otpUsers = array_reverse($otpUsers);

    return response()->json(array_values($otpUsers)); // Chuyển thành mảng đúng định dạng
});

Route::get('/news', [NewsController::class, 'index']);

Route::get('/admin/goivoip/dashboard', [GoiVoipCuocPhiController::class, 'dashboard'])->name('goivoip.dashboard');
Route::get('/admin/goivoip1/dashboard', [GoiVoipCuocPhiController::class, 'dashboard1'])->name('goivoip.dashboard1');


Route::get('/admin/quocgia/dashboard', [QuocgiaController::class, 'dashboard'])->name('quocgia.dashboard');

//KHỞI TẠO DATATABLE TIẾNG VIỆT
Route::get('/vendor/datatables/{file}', function ($file) {
    return response()->file(public_path("vendor/datatables/$file"), [
        'Content-Type' => 'application/json',
        'Access-Control-Allow-Origin' => '*'
    ]);
});
