<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Mobifone Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .login-container {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center min-h-screen">
    <div class="login-container w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <!-- Logo Mobifone -->
        <div class="text-center mb-6">
            <img src="{{ asset('assets/images/logo_MobiFone.jpg') }}" alt="Mobifone Logo" class="mx-auto w-32">
        </div>
        
        <h2 class="text-2xl font-bold text-center text-gray-700">Đăng Nhập Quản Trị</h2>

        <!-- Hiển thị lỗi -->
        @if ($errors->any())
            <div class="mb-4 text-red-500 bg-red-100 p-3 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Đăng Nhập -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Nhập email">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Mật khẩu</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Nhập mật khẩu">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Đăng Nhập
            </button>
        </form>

       <!-- Quên mật khẩu -->
<div class="text-center mt-4">
    <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline text-sm">Quên mật khẩu?</a>
</div>

    </div>
</body>
</html>
