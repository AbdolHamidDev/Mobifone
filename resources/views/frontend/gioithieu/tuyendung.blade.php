@extends('layouts.frontend')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@section('content')
<div class="container" style="padding-top: 10vh;">

    <img src="assets/images/banner.jpg" alt="banner Mobifone">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <p class="text-lg text-gray-600">
                Dưới đây là các công việc tuyển dụng hiện tại. Chọn vị trí bạn quan tâm để xem chi tiết:
            </p>
            <a href="{{ url('/cv/create') }}"  class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-all duration-300">
                Gửi CV ngay
            </a>
        </div>
        
        
        <ul class="space-y-4">
            @foreach ($tuyen_dungs as $tuyendung)
                <li class="bg-gray-50 p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 ease-in-out">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">{{ $tuyendung->vi_tri }}</span>
                        <span class="text-sm text-gray-500">
                            @if($tuyendung->thoi_gian_ung_tuyen == '9999-12-31') 
                                <!-- Kiểm tra nếu là tuyển gấp -->
                                <span class="text-red-500 font-semibold">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                                        Tuyển gấp
                                    </button>
                                </span>
                            @else
                                {{ \Carbon\Carbon::parse($tuyendung->thoi_gian_ung_tuyen)->format('d/m/Y') }}
                            @endif
                        </span>
                    </div>
                    <p class="text-sm text-gray-700 mt-2">Thông tin về công việc tuyển dụng tại đây.</p>
                    
                    <!-- Nút ứng tuyển -->
                    <a href="{{ route('frontend.tuyendung.chitiet', $tuyendung->id) }}" class="inline-block mt-3 bg-blue-600 text-white px-6 py-2 rounded-lg text-center hover:bg-blue-700 transition duration-300">
                        Ứng tuyển
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
