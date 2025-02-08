<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OtpAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('phone')) {
            return redirect('/login-otp')->with('error', 'Bạn cần xác thực OTP trước.');
        }
        return $next($request);
    }
}
