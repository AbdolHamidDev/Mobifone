<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\DichVu;
use App\Models\Goicuoc;
use App\Models\Goidata;
use App\Models\LoaiThueBao;
use App\Models\News;
use App\Models\Store;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
  
     
  

    public function index()
{
    // Lấy danh sách goicuoc (giữ nguyên)
    $goicuocs = Goicuoc::all();

    // Lấy danh sách goidatas
    $goidatas = Goidata::all();

    // Lấy danh sách dichvus
    $dichvus = DichVu::all();

    // Lấy danh sách loaithuebaos
    $loaithuebaos = LoaiThueBao::all();

    // Lấy 2 bài viết mới nhất cho mỗi danh mục và kiểm tra điều kiện kiemduyet và kichhoat
    $newsPromotion = News::where('category', 'tin-khuyen-mai')
                          ->where('kiemduyet', 1)    // Chỉ lấy bài viết đã được phê duyệt
                          ->where('kichhoat', 1)     // Chỉ lấy bài viết đã được kích hoạt
                          ->orderBy('created_at', 'desc')
                          ->take(2)
                          ->get();

    $newsEvent = News::where('category', 'tin-tuc-su-kien')
                     ->where('kiemduyet', 1)
                     ->where('kichhoat', 1)
                     ->orderBy('created_at', 'desc')
                     ->take(2)
                     ->get();

    $newsPress = News::where('category', 'thong-cao-bao-chi')
                     ->where('kiemduyet', 1)
                     ->where('kichhoat', 1)
                     ->orderBy('created_at', 'desc')
                     ->take(2)
                     ->get();
    
    $store = Store::find(1);

    // Trả về view cùng với dữ liệu
    return view('frontend.home', compact('goicuocs', 'goidatas', 'dichvus', 'loaithuebaos', 'newsPromotion', 'newsEvent', 'newsPress', 'store'));
}



    

 // Hiển thị danh sách cuộc hội thoại dựa vào số điện thoại (dành cho người dùng)
 public function chat()
 {
     $phone = session('phone'); // Lấy số điện thoại từ session OTP
     $conversations = Conversation::where('phone', $phone)->with('messages')->get();

     return view('chat.index', compact('conversations', 'phone'));
 }



}
