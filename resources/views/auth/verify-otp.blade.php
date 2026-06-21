@extends('layouts.frontend')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Xác thực OTP</h2>
        
        <form method="POST" action="{{ route('otp.check') }}">
            @csrf
            
            <div class="mb-4">
                <label for="otp" class="block text-gray-700 text-sm font-bold mb-2">Mã OTP</label>
                <input id="otp" type="text" name="otp" required autofocus
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('otp') border-red-500 @enderror"
                    placeholder="Nhập mã OTP">
                @error('otp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                Xác thực
            </button>
        </form>
    </div>
</div>
@endsection