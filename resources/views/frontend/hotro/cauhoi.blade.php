@extends('layouts.frontend')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@section('content')
<div class="container" style="padding-top: 20vh;">

        <h1 class="text-4xl font-extrabold text-center text-indigo-600 mb-10">Câu Hỏi Thường Gặp</h1>

        <!-- Gói cước -->
        <div class="flex justify-center space-x-4">
            
            <button class="py-2 px-4 bg-blue-200 text-gray-800 text-base font-medium rounded-md hover:bg-gray-300 transition-all duration-200 mb-3"
            onclick="toggleDropdown('gói-cước')">Gói cước</button>
            <div id="gói-cước" class="dropdown-content hidden bg-white rounded-lg shadow-sm p-3 border border-gray-300">

                <ul class="space-y-4">
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">1. Khách hàng cá nhân sử dụng CMND có thể đăng ký bao nhiêu thuê bao trả trước?</div>
                        <div class="text-gray-700">Trả lời: 3 thuê bao</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">2. Thuê bao trả trước đăng ký thông tin cần phải kích hoạt sử dụng trong vòng bao nhiêu lâu?</div>
                        <div class="text-gray-700">Trả lời: 72 giờ</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">3. Thuê bao Fast Connect trả trước có ngày sử dụng tối đa là bao nhiêu ngày?</div>
                        <div class="text-gray-700">Trả lời: 60 ngày sử dụng</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">4. Thời hạn giữ số của thuê bao khi bị khóa 2 chiều là bao nhiêu ngày?</div>
                        <div class="text-gray-700">Trả lời: 30 ngày</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">5. Chuyển đổi giữa các hình thức thuê bao trả trước được miễn phí phải không?</div>
                        <div class="text-gray-700">Trả lời: Nếu tài khoản chính của thuê bao dưới 50.000đ thì phí chuyển đổi là 5.000đ/ lần. Nếu tài khoản chính của thuê bao từ 50.000đ trở lên thì phí chuyển đổi là 10% tài khoản chính/ lần</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">6. Mỗi KH cá nhân có thể đứng tên bao nhiêu thuê bao trả sau?</div>
                        <div class="text-gray-700">Trả lời: Tối đa 5TB</div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Dịch vụ -->
        <div class="flex justify-center space-x-4">
            <button class="py-2 px-4 bg-blue-200 text-gray-800 text-base font-medium rounded-md hover:bg-gray-300 transition-all duration-200 mb-3"
            onclick="toggleDropdown('dịch-vụ')">Dịch vụ</button>
            <div id="dịch-vụ" class="dropdown-content hidden bg-white rounded-lg shadow-sm p-3 border border-gray-300">

                <ul class="space-y-4">
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">1. Tôi đi nước ngoài và đã trả tiền cước dịch vụ CVQT của tháng đó trong hóa đơn cuối tháng, tại sao tôi lại tiếp tục nhận được hóa đơn có phần cước dịch vụ CVQT vào tháng sau đó?</div>
                        <div class="text-gray-700">Trả lời: Việc tính cước CVQT MobiFone phải dựa trên dữ liệu cước mà nhà mạng nước ngoài gửi cho MobiFone sau khi khách hàng phát sinh dịch vụ...</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">2. Sau khi trở về Việt Nam, các gói cước Data mà tôi đăng ký trước khi ra nước ngoài có còn hiệu lực không?</div>
                        <div class="text-gray-700">Trả lời: Dịch vụ CVQT độc lập với các gói cước trong nước mà khách hàng đã đăng ký...</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">3. Tại sao máy điện thoại của tôi không hiển thị tên người gọi khi có cuộc gọi đến trong lúc tôi đang roaming tại nước ngoài?</div>
                        <div class="text-gray-700">Trả lời: Tùy vào sự tương thích về mặt kỹ thuật giữa mạng MobiFone và mạng khác...</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">4. Tôi đã đăng ký sử dụng dịch vụ CVQT của MobiFone. Tại sao tôi vẫn không thể thực hiện được cuộc gọi khi ở nước ngoài?</div>
                        <div class="text-gray-700">Trả lời: Bạn cần kiểm tra lại đã bấm số điện thoại cần gọi theo đúng cú pháp hay chưa...</div>
                    </li>
                </ul>
            </div>
        </div>



         <!-- Thanh toán cước -->
         <div class="flex justify-center space-x-4">
            <button class="py-2 px-4 bg-blue-200 text-gray-800 text-base font-medium rounded-md hover:bg-gray-300 transition-all duration-200 mb-3"
            onclick="toggleDropdown('thanh-toan-cuoc')">Thanh toán cước</button>
            <div id="thanh-toan-cuoc" class="dropdown-content hidden bg-white rounded-lg shadow-sm p-3 border border-gray-300">

                <ul class="space-y-4">
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">1. Tôi đi nước ngoài và đã trả tiền cước dịch vụ CVQT của tháng đó trong hóa đơn cuối tháng, tại sao tôi lại tiếp tục nhận được hóa đơn có phần cước dịch vụ CVQT vào tháng sau đó?</div>
                        <div class="text-gray-700">Trả lời: Việc tính cước CVQT MobiFone phải dựa trên dữ liệu cước mà nhà mạng nước ngoài gửi cho MobiFone sau khi khách hàng phát sinh dịch vụ...</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">2. Sau khi trở về Việt Nam, các gói cước Data mà tôi đăng ký trước khi ra nước ngoài có còn hiệu lực không?</div>
                        <div class="text-gray-700">Trả lời: Dịch vụ CVQT độc lập với các gói cước trong nước mà khách hàng đã đăng ký...</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">3. Tại sao máy điện thoại của tôi không hiển thị tên người gọi khi có cuộc gọi đến trong lúc tôi đang roaming tại nước ngoài?</div>
                        <div class="text-gray-700">Trả lời: Tùy vào sự tương thích về mặt kỹ thuật giữa mạng MobiFone và mạng khác...</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">4. Tôi đã đăng ký sử dụng dịch vụ CVQT của MobiFone. Tại sao tôi vẫn không thể thực hiện được cuộc gọi khi ở nước ngoài?</div>
                        <div class="text-gray-700">Trả lời: Bạn cần kiểm tra lại đã bấm số điện thoại cần gọi theo đúng cú pháp hay chưa...</div>
                    </li>
                </ul>
            </div>
        </div>


        <!-- Nạp tiền -->
        <div class="flex justify-center space-x-4">
            <button class="py-2 px-4 bg-blue-200 text-gray-800 text-base font-medium rounded-md hover:bg-gray-300 transition-all duration-200 mb-3"
            onclick="toggleDropdown('nap-tien')">Nạp tiền</button>
            <div id="nap-tien" class="dropdown-content hidden bg-white rounded-lg shadow-sm p-3 border border-gray-300">

                <ul class="space-y-4">
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">1. Khách hàng nạp tiền sai nhiều lần nên bị khóa quyền nạp tiền, làm thế nào để mở, nạp tiền được?</div>
                        <div class="text-gray-700">Trả lời: Khách hàng có thể sử dụng dịch vụ Customer Selfcare để tự mở quyền nạp tiền: soạn tin nhắn QUYENNAPTHE_Mã serial thẻ nạp gửi 901. Dịch vụ được cung cấp miễn phí.</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">2. Sau khi trở về Việt Nam, các gói cước Data mà tôi đăng ký trước khi ra nước ngoài có còn hiệu lực không?</div>
                        <div class="text-gray-700">Trả lời: Dịch vụ CVQT độc lập với các gói cước trong nước mà khách hàng đã đăng ký...</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">3. Tại sao máy điện thoại của tôi không hiển thị tên người gọi khi có cuộc gọi đến trong lúc tôi đang roaming tại nước ngoài?</div>
                        <div class="text-gray-700">Trả lời: Tùy vào sự tương thích về mặt kỹ thuật giữa mạng MobiFone và mạng khác...</div>
                    </li>
                    <li class="transition-all hover:bg-indigo-50 p-3 rounded-md">
                        <div class="font-semibold text-blue-600">4. Tôi đã đăng ký sử dụng dịch vụ CVQT của MobiFone. Tại sao tôi vẫn không thể thực hiện được cuộc gọi khi ở nước ngoài?</div>
                        <div class="text-gray-700">Trả lời: Bạn cần kiểm tra lại đã bấm số điện thoại cần gọi theo đúng cú pháp hay chưa...</div>
                    </li>
                </ul>
            </div>
        </div>


    </div>

    <script>
        // Function to toggle dropdown visibility
        function toggleDropdown(id) {
            const element = document.getElementById(id);
            element.classList.toggle('hidden');
        }
    </script>
@endsection
