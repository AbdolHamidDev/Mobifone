<?php

namespace App\Http\Controllers;

use App\Models\DichVu;
use App\Models\User;
use App\Models\Goicuoc;
use App\Models\Goidata;
use App\Models\LoaiThueBao;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\PackageRegistration;
use App\Models\Store;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str; 
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    public function getGoogleLogin() 
    { 
        return Socialite::driver('google')->redirect(); 
    } 
     
    public function getGoogleCallback() 
    { 
        try 
        { 
            $user = Socialite::driver('google') 
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false])) 
                ->stateless() 
                ->user(); 
        } 
        catch(Exception $e) 
        { 
            return redirect()->route('user.dangnhap')->with('warning', 'Lỗi xác thực. Xin vui lòng thử lại!'); 
        } 
         
        $existingUser = User::where('email', $user->email)->first(); 
        if($existingUser) 
        { 
            // Nếu người dùng đã tồn tại thì đăng nhập 
            Auth::login($existingUser, true); 
            return redirect()->route('user.home'); 
        } 
        else 
        { 
            // Nếu chưa tồn tại người dùng thì thêm mới 
            $newUser = User::create([ 
                'name' => $user->name, 
                'email' => $user->email, 
                'username' => Str::before($user->email, '@'), 
                'password' => Hash::make('mobifone@2025'), // Gán mật khẩu tự do 
            ]); 
             
            // Sau đó đăng nhập 
            Auth::login($newUser, true); 
            return redirect()->route('user.home'); 
        } 
    } 


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



    





}
