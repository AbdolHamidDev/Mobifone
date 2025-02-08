<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class OTPLoginController extends Controller
{
    // Hiển thị form nhập số điện thoại
    public function showPhoneForm()
    {
        return view('auth.phone-login');
    }

    // Gửi OTP qua SMS
    public function sendOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10',
            'email' => 'required|email'
        ]);
    
        $otp = rand(100000, 999999); // Tạo mã OTP ngẫu nhiên
        Session::put('otp', $otp); // Lưu OTP vào session
        Session::put('phone', $request->phone); // Lưu số điện thoại
    
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

    // Xác thực OTP
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        if ($request->otp == Session::get('otp')) {
            Session::put('authenticated', true); // Đánh dấu đăng nhập thành công
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['otp' => 'Mã OTP không đúng!']);
    }

    // Đăng xuất
    public function logout()
    {
        Session::forget('authenticated');
        return redirect('/login-otp')->with('success', 'Bạn đã đăng xuất.');
    }
}
