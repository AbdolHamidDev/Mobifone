@extends('layouts.frontend')
<!-- Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">



@section('content')
<div class="container mx-auto" style="padding-top: 10vh;">
    <div class="bg-white shadow-lg rounded-lg p-8">
        <div class="mb-6">
            <div class="mb-6">
                <!-- Logo và Tiêu đề -->
                <div class="flex items-center mb-4">
                    <!-- Logo -->
                    <img src="{{ asset('assets/images/logo_MobiFone.jpg') }}" alt="logo Mobifone" class="w-28 h-28 rounded-lg mr-6">
            
                    <!-- Tiêu đề -->
                    <h1 class="text-4xl font text-blue-900 border-b-2 border-gray-200 pb-4">{{ $tuyendung->vi_tri }}</h1>

                </div>
            
                <!-- Mức lương -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Mức lương</h2>
                    <p class="text-gray-600 mt-2">
                        @if(is_numeric($tuyendung->luong))
                            {{ number_format($tuyendung->luong) }} VND
                        @else
                            {{ $tuyendung->luong ?? 'Liên hệ để biết thêm' }}
                        @endif
                    </p>
                </div>
            
                <!-- Thời gian ứng tuyển -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Ngày hết hạn</h2>
                    <p class="text-gray-600 mt-2">
                        @if (trim($tuyendung->thoi_gian_ung_tuyen) === '9999-12-31')
                            <span class="text-red-600 font-bold">Tuyển gấp</span>
                        @elseif (!empty($tuyendung->thoi_gian_ung_tuyen))
                            {{ \Carbon\Carbon::parse($tuyendung->thoi_gian_ung_tuyen)->format('d/m/Y') }}
                        @else
                            <span class="text-gray-500">Chưa xác định</span>
                        @endif
                    </p>
                </div>
            </div>
            
       
        
        </div>
        
        <!-- Phúc lợi -->
        <div class="mb-12"> <!-- Tăng khoảng cách -->
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Phúc lợi</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6"> <!-- Khoảng cách giữa các mục -->
                <div class="flex items-center space-x-4">
                    <i class="fas fa-shield-alt text-blue-500 text-3xl"></i>
                    <span class="text-gray-700 font-medium">Bảo hiểm</span>
                </div>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-plane text-green-500 text-3xl"></i>
                    <span class="text-gray-700 font-medium">Du lịch</span>
                </div>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-chalkboard-teacher text-yellow-500 text-3xl"></i>
                    <span class="text-gray-700 font-medium">Đào tạo</span>
                </div>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-gift text-red-500 text-3xl"></i>
                    <span class="text-gray-700 font-medium">Thưởng</span>
                </div>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-arrow-up text-purple-500 text-3xl"></i>
                    <span class="text-gray-700 font-medium">Tăng lương</span>
                </div>
            </div>
        </div>
        <br><br> <!-- Tăng khoảng cách thủ công -->
        <!-- Thông tin chi tiết -->
        <div class="space-y-10"> <!-- Tăng khoảng cách giữa các phần -->
            <!-- Mô tả công việc -->
            <div>
                <h2 class="text-xl font-semibold text-gray-700">Mô tả công việc</h2>
                <p class="text-gray-600 mt-2">{!! $tuyendung->mo_ta !!}</p>
            </div>

            <!-- Yêu cầu -->
            <div>
                <h2 class="text-xl font-semibold text-gray-700">Yêu cầu</h2>
                <p class="text-gray-600 mt-2">{!! $tuyendung->yeu_cau !!}</p>
            </div>
<div class="sharethis-inline-share-buttons"></div>

        </div>
        <!-- Nút gửi CV -->
        <div class="mt-8 text-center">
            <a href="{{ url('/cv/create') }}" 
               class="inline-block bg-blue-600 text-white font-medium text-lg px-8 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition-all duration-300">
                Gửi CV ngay
            </a>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=678a9f9cca22b50013931912&product=inline-share-buttons&source=platform" async="async"></script>