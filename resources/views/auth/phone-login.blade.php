@extends('layouts.frontend')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Đăng nhập bằng OTP</h2>
        
        <form method="POST" action="{{ route('otp.send') }}">
            @csrf
            
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Số điện thoại</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autofocus
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('phone') border-red-500 @enderror"
                    placeholder="Nhập số điện thoại">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                Gửi mã OTP
            </button>
        </form>
    </div>
</div>
@endsection