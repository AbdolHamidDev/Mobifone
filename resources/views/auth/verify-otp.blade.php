<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-700">Nhập mã OTP</h2>

        @if(session('success'))
            <p class="text-green-600 text-center">{{ session('success') }}</p>
        @endif

        <form action="{{ route('otp.check') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Mã OTP</label>
                <input type="text" name="otp" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                Xác nhận OTP
            </button>
        </form>
    </div>
    
</body>
</html>
