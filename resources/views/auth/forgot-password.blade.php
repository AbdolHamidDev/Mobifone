<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-700">Quên Mật Khẩu</h2>

        @if (session('status'))
            <div class="mb-4 text-green-500 bg-green-100 p-3 rounded-md">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 text-red-500 bg-red-100 p-3 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Nhập email của bạn</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Nhập email của bạn">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Gửi liên kết đặt lại mật khẩu
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline text-sm">Quay lại đăng nhập</a>
        </div>
    </div>
</body>
</html>
