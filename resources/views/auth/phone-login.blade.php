<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập bằng OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-700">Nhập số điện thoại</h2>

        <form action="{{ route('otp.send') }}" method="POST">
            @csrf
        
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Số điện thoại</label>
                <input type="text" name="phone" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>
        
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>
        
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                Gửi OTP
            </button>
        </form>
        
    </div>
</body>
</html>
