<?php

use App\Http\Controllers\ProfileController;
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

// Google OAuth 
Route::get('/login/google', [HomeController::class, 'getGoogleLogin'])->name('google.login'); 
Route::get('/login/google/callback', [HomeController::class, 'getGoogleCallback'])->name('google.callback');







// Phần khách hàng chưa đăng nhập
Route::name('frontend.')->group(function () {
    // Trang chủ
    Route::get('/', [HomeController::class, 'index'])->name('home'); 
    
    Route::get('/hop-tac', function () {
        return view('frontend.gioithieu.hoptac');
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
    
    Route::get('/dich-vu-di-dong/goi-cuoc/{id}', [GoicuocDetailController::class, 'show'])->name('dichvudidong.chitiet');
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
    Route::post('/dich-vu-di-dong/so-thue-bao/search', [SoThueBaoController::class, 'search'])->name('dichvudidong.search');
   
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

    
   

});















// Phần Admin
Route::prefix('admin')->middleware('auth')->group(function () {

    // Trang chủ admin
    Route::get('/home', [AdminController::class, 'getHome'])->name('admin.home');

    // quản lý gói cước
    Route::resource('goicuocs', QuanLyGoicuocController::class);
    Route::post('/goicuocs/{id}/change-status', [QuanLyGoicuocController::class, 'changeStatus'])->name('goicuocs.changeStatus');
    Route::get('/api', [QuanLyGoicuocController::class, 'api'])->name('goicuocs.api');


   
    // quản lý gói data
    Route::resource('Goidatas', QuanlyDataController::class);
    Route::post('/goidatas/{id}/change-status', [QuanlyDataController::class, 'changeStatus'])->name('goidatas.changeStatus');
    Route::get('/api/datas', [QuanlyDataController::class, 'api'])->name('Goidatas.api');


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

    // chi tiết loại thuê bao
    Route::prefix('subscription-types/{subscriptionTypeId}/loaithuebao')->group(function () {
        Route::get('/', [LoaiThueBaoController::class, 'index'])->name('loaithuebao.index');
        Route::post('/', [LoaiThueBaoController::class, 'store'])->name('loaithuebao.store');
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
   

    // oder
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/toggle-payment', [OrderController::class, 'togglePaymentStatus']);
    Route::post('/orders/{id}/toggle-delivery', [OrderController::class, 'toggleDeliveryStatus']);



});




// trang mặc định hệ thống
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';