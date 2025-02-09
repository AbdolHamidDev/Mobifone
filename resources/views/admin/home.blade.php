@extends('layouts.admin')

@section('content')

@include('partials.content-header', ['name' => 'Dashboard', 'key' => '🎯'])

 <!-- Khu vực Người Dùng Đăng Nhập OTP (Ticker) -->
 <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
    <h3 class="text-lg font-bold text-gray-700 text-center">Người Dùng Đăng Nhập OTP 🚀</h3>
    <div class="relative overflow-hidden h-24">
        <ul id="otpTicker" class="absolute w-full space-y-2"></ul>
    </div>

<div class="container mx-auto p-6">
  

<!-- Thống kê tổng quan -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <!-- Tổng đơn hàng -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-center mb-2">
            <i class="fa-solid fa-box text-yellow-600 text-3xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700">Tổng Đơn Hàng</h3>
        <span class="text-3xl font-bold text-yellow-600">{{ $totalOrders }}</span>
    </div>

    <!-- Doanh thu hôm nay -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-center mb-2">
            <i class="fa-solid fa-coins text-red-600 text-3xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700">Doanh Thu Hôm Nay</h3>
        <span class="text-3xl font-bold text-red-600">{{ number_format($todayRevenue, 0, ',', '.') }} VNĐ</span>
    </div>

    <!-- Khách hàng mới -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-center mb-2">
            <i class="fa-solid fa-user-plus text-purple-600 text-3xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700">Khách Hàng Mới</h3>
        <span class="text-3xl font-bold text-purple-600">{{ $newCustomers }}</span>
    </div>

    <!-- Gói cước đã bán -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-center mb-2">
            <i class="fa-solid fa-file-invoice-dollar text-orange text-3xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700">Gói Cước Đã Bán</h3>
        <span class="text-3xl font-bold text-orange">{{ $packagesSold }}</span>
    </div>
</div>


<!-- Thống kê doanh thu gói cước -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Doanh thu gói cước -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition duration-300 transform hover:scale-105">
        <div class="flex items-center justify-center mb-3">
            <i class="fa-solid fa-money-bill-wave text-blue-600 text-4xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700">Tổng Doanh Thu Gói Cước</h3>
        <span id="totalRevenueGoiCuoc" class="text-3xl font-bold text-blue-600">0 VNĐ</span>
    </div>

    <!-- Doanh thu gói data -->
    <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition duration-300 transform hover:scale-105">
        <div class="flex items-center justify-center mb-3">
            <i class="fa-solid fa-chart-line text-green-600 text-4xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700">Tổng Doanh Thu Gói Data</h3>
        <span id="totalRevenueGoiData" class="text-3xl font-bold text-green-600">0 VNĐ</span>
    </div>
</div>



<!-- Khu vực Biểu đồ & Danh Sách Gói Cước & Gói Data -->
<div class="bg-white shadow-lg rounded-lg p-6 mt-6">
    <h3 class="text-lg font-bold text-gray-700 text-center">Thống Kê Đăng Ký Gói Cước & Gói Data 🔥</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
        <!-- Biểu đồ -->
        <div class="flex justify-center">
            <canvas id="packageChart" style="max-width: 350px;"></canvas>
        </div>

        <!-- Bảng Chi Tiết -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">Số Điện Thoại</th>
                        <th class="border px-4 py-2">Tên Gói</th>
                        <th class="border px-4 py-2">Loại</th>
                        <th class="border px-4 py-2">Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packageRegistrations as $registration)
                    <tr>
                        <td class="border px-4 py-2">{{ $registration->phone_number }}</td>
                        <td class="border px-4 py-2">
                            {{ $registration->type === 'goicuoc' ? $registration->goicuoc->ten_goicuoc ?? 'N/A' : $registration->goiData->ten_data ?? 'N/A' }}
                        </td>
                        <td class="border px-4 py-2">
                            <span class="px-2 py-1 text-sm rounded-lg 
                                {{ $registration->type === 'goicuoc' ? 'bg-blue-500 text-white' : 'bg-green-500 text-white' }}">
                                {{ $registration->type === 'goicuoc' ? 'Gói Cước' : 'Gói Data' }}
                            </span>
                        </td>
                        <td class="border px-4 py-2">{{ number_format($registration->type === 'goicuoc' ? $registration->goicuoc->gia ?? 0 : $registration->goiData->gia ?? 0, 0, ',', '.') }} VNĐ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


    <!-- Biểu đồ -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Biểu đồ doanh thu -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-lg font-bold text-gray-700 text-center">Doanh Thu Theo Tháng 📈</h3>
            <canvas id="revenueChart"></canvas>
        </div>

        <!-- Biểu đồ trạng thái đơn hàng -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-lg font-bold text-gray-700 text-center">Trạng Thái Đơn Hàng ⚡</h3>
            <div class="flex justify-center">
                <canvas id="orderStatusChart" style="max-width: 250px; max-height: 250px;"></canvas>
            </div>
        </div>
        
    </div>

    <!-- Bảng đơn hàng gần đây -->
    <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
        <h3 class="text-lg font-bold text-gray-700 mb-4">Đơn hàng gần đây 📝</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Mã Đơn</th>
                        <th class="border px-4 py-2">Khách hàng</th>
                        <th class="border px-4 py-2">Tổng tiền</th>
                        <th class="border px-4 py-2">Ngày đặt</th>
                        <th class="border px-4 py-2">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentOrders as $order)
                    <tr>
                        <td class="border px-4 py-2">{{ $order->order_code }}</td>
                        <td class="border px-4 py-2">{{ $order->customer_name }}</td>
                        <td class="border px-4 py-2">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                        <td class="border px-4 py-2">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="border px-4 py-2">
                            <span class="px-2 py-1 text-sm rounded-lg 
                                {{ $order->trang_thai == 'Hoàn thành' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                                {{ $order->trang_thai }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


   

 

        




    
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!} || [],
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: {!! json_encode($data) !!} || [],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
        const orderStatusChart = new Chart(orderStatusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($statusLabels) !!} || [],
                datasets: [{
                    data: {!! json_encode($statusData) !!} || [],
                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4CAF50']
                }]
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('/api/package-summary')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalRevenueGoiCuoc').textContent = new Intl.NumberFormat('vi-VN').format(data.totalRevenueGoiCuoc) + ' VNĐ';
                document.getElementById('totalRevenueGoiData').textContent = new Intl.NumberFormat('vi-VN').format(data.totalRevenueGoiData) + ' VNĐ';
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu từ API:', error));
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('/api/package-summary')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('packageChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Gói Cước', 'Gói Data'],
                        datasets: [{
                            data: [data.totalGoiCuoc, data.totalGoiData],
                            backgroundColor: ['#36A2EB', '#4CAF50']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        aspectRatio: 2,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu từ API:', error));
    });
</script>


<!-- CSS Animation -->
<style>
    @keyframes scroll {
        0% { transform: translateY(100%); opacity: 0; }
        50% { opacity: 1; }
        100% { transform: translateY(0%); opacity: 1; }
    }
    .otp-item {
        animation: scroll 1s ease-in-out;
        list-style: none;
        padding: 8px;
        background: #f8f9fa;
        border-left: 5px solid #007bff;
        border-radius: 5px;
        text-align: center;
        font-size: 14px;
        font-weight: bold;
    }
    
</style>

<!-- JavaScript để tải dữ liệu từ API -->
<script>
    function fetchOtpUsers() {
    fetch('/api/otp-users')
        .then(response => response.json())
        .then(data => {
            if (!Array.isArray(data)) {
                data = [];
            }
            let ticker = document.getElementById('otpTicker');
            ticker.innerHTML = '';

            if (data.length === 0) {
                let li = document.createElement('li');
                li.textContent = "Không có ai đăng nhập OTP";
                li.classList.add('otp-item', 'text-gray-500');
                ticker.appendChild(li);
            } else {
                data.slice(0, 2).forEach(user => { // Giới hạn tối đa 2 user
                    let li = document.createElement('li');
                    li.textContent = `${user.phone} - ${user.email ?? 'Không có email'} - ${user.logged_in_at}`;
                    li.classList.add('otp-item');
                    ticker.appendChild(li);
                });
            }
        })
        .catch(error => console.error('Lỗi tải dữ liệu:', error));
}

// Gọi API ngay khi tải trang và cập nhật mỗi 10 giây
fetchOtpUsers();
setInterval(fetchOtpUsers, 10000);

</script>


@endsection
