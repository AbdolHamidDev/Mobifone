<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;


class OTPLoginController extends Controller
{
    // Hiển thị form nhập số điện thoại
    public function showPhoneForm()
    {
        return view('auth.phone-login');
    }

    // Gửi OTP qua Email
    public function sendOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10',
            'email' => 'required|email'
        ]);
    
        $otp = rand(100000, 999999); // Tạo mã OTP ngẫu nhiên
        Session::put('otp', $otp); // Lưu OTP vào session
        Session::put('phone', $request->phone); // Lưu số điện thoại
        Session::put('email', $request->email); // Lưu email

        // Gửi OTP qua email
        Mail::raw("Mã OTP của bạn là: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject("Mã OTP xác thực đăng nhập");
        });
    
        return redirect()->route('otp.verify')->with('success', 'OTP đã được gửi đến email của bạn.');
    }
    // Hiển thị form nhập OTP
    public function showOTPForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);
    
        if ($request->otp == Session::get('otp')) {
            Session::put('authenticated', true);
            
            // Lấy danh sách người dùng OTP từ cache
            $otpUsers = Cache::get('otp_users', []);
            $phone = Session::get('phone');
            $email = Session::get('email');
    
            if ($phone) {
                $otpUsers[$phone] = [
                    'phone' => $phone,
                    'email' => $email,
                    'logged_in_at' => now()->format('d/m/Y H:i:s')
                ];
                Cache::put('otp_users', $otpUsers, now()->addHours(6)); // Giữ thông tin trong 6 giờ
            }
    
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }
    
        return back()->withErrors(['otp' => 'Mã OTP không đúng!']);
    }

     // Đăng xuất toàn bộ
     public function logout()
     {
         Session::forget('authenticated');
         Session::forget('phone');
         Session::forget('email');
 
         return redirect('/login-otp')->with('success', 'Bạn đã đăng xuất.');
     }

    
     
}
