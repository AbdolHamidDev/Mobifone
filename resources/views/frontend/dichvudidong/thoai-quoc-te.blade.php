@extends('layouts.frontend')

<link rel="stylesheet" href="{{ asset('frontends/dichvuquocte/ranuocngoai.css') }}">
<link rel="stylesheet" href="{{ asset('frontends/main_dieuhuong.css') }}">
<script src="https://cdn.tailwindcss.com"></script>
@section('content')
    <div class="container" style="padding-top: 15vh;">

            <!-- THANH ĐIỀU HƯỚNG -->
            <div class="breadcrumb">
                <a href="/"><i class="fas fa-home"></i> Trang chủ</a>
                <span class="divider">/</span>
                <a href="#">Dịch vụ di động</a>
                <span class="divider">/</span>
                <a href="/dich-vu-quoc-te">Quốc tế</a>
                <span class="divider">/</span>
                <span class="current">Chi tiết dịch vụ</span>
            </div>


          <!-- CARD NỘI DUNG -->
          <div class="service-detail-card">
            <img src="{{ asset('assets/images/thoaiquocte.jpg') }}" alt="Dịch Vụ Thoại Quốc Tế" class="service-image">
            <div class="service-info">
                <h4 class="service-title">Dịch Vụ Thoại Quốc Tế</h4>
                <p class="service-description">
                    Gọi quốc tế là dịch vụ giúp các thuê bao MobiFone gọi tới một số điện thoại nước ngoài từ máy điện thoại di động của mình.
                </p>
            </div>
        </div>

        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-2">Giới thiệu dịch vụ</h2>
                
                <div class="space-y-2">
                    <div class="border rounded-lg">
                        <button class="w-full flex items-center justify-between p-3 text-blue-600 font-medium" onclick="toggleDropdown('dropdown1')">
                            <span class="flex items-center"><span class="mr-2">📄</span> Đối tượng sử dụng</span>
                            <span>▼</span>
                        </button>
                        <div id="dropdown1" class="hidden p-3 bg-gray-50">
                            Dịch vụ Gọi quốc tế được mở tự động cho tất cả các thuê bao trả trước và trả sau trên mạng MobiFone
                        </div>
                    </div>
                    
                    <div class="border rounded-lg">
                        <button class="w-full flex items-center justify-between p-3 text-blue-600 font-medium" onclick="toggleDropdown('dropdown2')">
                            <span class="flex items-center"><span class="mr-2">⚙️</span> Đăng ký/Hủy dịch vụ</span>
                            <span>▼</span>
                        </button>
                        <div id="dropdown2" class="hidden p-3 bg-gray-50">
                            Dịch vụ Gọi quốc tế được mở tự động cho tất cả các thuê bao trả trước và trả sau trên mạng MobiFone</br>

                            Nếu muốn huỷ hoặc đăng ký lại dịch vụ. Quý khách vui lòng thực hiện qua tin nhắn SMS như sau:</br>

                            Soạn QT gửi 999 để đăng ký lại dịch vụ</br>

                            Soạn CHAN_QT gửi 999 để huỷ dịch vụ
                        </div>
                    </div>
                    
                    <div class="border rounded-lg">
                        <button class="w-full flex items-center justify-between p-3 text-blue-600 font-medium" onclick="toggleDropdown('dropdown3')">
                            <span class="flex items-center"><span class="mr-2">📶</span> Cách thực hiện cuộc gọi</span>
                            <span>▼</span>
                        </button>
                        <div id="dropdown3" class="hidden p-3 bg-gray-50">
                            Gọi trực tiếp IDD: Từ máy điện thoại, khách hàng quay số:</br>

                            Mã thoát + Mã nước + Mã vùng/Mã mạng + Số điện thoại cần gọi</br>

                            (Trong đó: Mã thoát là 00 hoặc dấu+)</br>

                            Gọi VoIP 131: Từ máy điện thoại, khách hàng quay số:</br>

                            131 + 00 + mã nước + mã vùng/mã mạng + Số điện thoại cần gọi
                        </div>
                    </div>
                    
                    <div class="border rounded-lg">
                        <button class="w-full flex items-center justify-between p-3 text-blue-600 font-medium" onclick="toggleDropdown('dropdown4')">
                            <span class="flex items-center"><span class="mr-2">📜</span> Quy định</span>
                            <span>▼</span>
                        </button>
                        <div id="dropdown4" class="hidden p-3 bg-gray-50">
                            Thuê bao đăng ký và sử dụng dịch vụ trong phạm vi lãnh thổ Việt Nam có phủ sóng của MobiFone</br>

                            Mức cước áp dụng cho các thuê bao trả trước, trả sau trên mạng MobiFone.</br>

                            Mức cước không phụ thuộc vào mức độ sử dụng dịch vụ trong tháng.</br>

                            Mức cước không phân biệt giờ cao điểm, giờ thấp điểm.</br>

                            Riêng đối với hướng Brazil:</br>
                            <img alt=""  class="w-full h-auto object-contain" src="data:image/png;base64,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" style="height:100%; width:100%">
                            Để biết thêm chi tiết, Quý khách vui lòng liên hệ Tổng đài hỗ trợ khách hàng 9090.
                        </div>
                    </div>
                </div>
            </div>



            <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-2">Các gói cước ưu đãi</h2>
                
                <div class="space-y-2">
                    <div class="border rounded-lg">
                        <button class="w-full flex items-center justify-between p-3 text-blue-600 font-medium" onclick="toggleDropdown('packageDropdown1')">
                            <span class="flex items-center"><span class="mr-2">🌍</span> Gói cước Global Saving</span>
                            <span>▼</span>
                        </button>
                        <div id="packageDropdown1" class="hidden p-4">
                            <div class="flex flex-wrap gap-4">
                                @php
                                    $selectedGoiCuoc = ['VoIP 1313 - TQT9', 'VoIP 1313 - TQT19', 'VoIP 1313 - TQT49', 'VoIP 1313 - TQT99', 'VoIP 1313 - TQT199', 'VoIP 1313 - TQT299'];
                                    $goiCuocs = \App\Models\GoiCuoc::whereIn('ten_goicuoc', $selectedGoiCuoc)
                                        ->orderByRaw("FIELD(ten_goicuoc, '".implode("','", $selectedGoiCuoc)."')")
                                        ->get();
                                @endphp
                                @foreach($goiCuocs as $goiCuoc)
                                    <a href="{{ url('/dich-vu-di-dong/goi-cuoc/' . $goiCuoc->id) }}" 
                                    class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                                        <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                                        <span class="ml-2 text-gray-700 font-medium">{{ $goiCuoc->ten_goicuoc }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                  
                    
                    <div class="border rounded-lg">
                        <button class="w-full flex items-center justify-between p-3 text-blue-600 font-medium" onclick="toggleDropdown('packageDropdown2')">
                            <span class="flex items-center"><span class="mr-2">🇰🇷</span> Gói cước Hàn Quốc</span>
                            <span>▼</span>
                        </button>
                        <div id="packageDropdown2" class="hidden p-4">
                        <div class="flex flex-wrap gap-4">
                            @php
                                $selectedGoiCuoc = ['Combo Hàn Quốc 1', 'Combo Hàn Quốc 2'];
                                $goiCuocs = \App\Models\GoiCuoc::whereIn('ten_goicuoc', $selectedGoiCuoc)
                                    ->orderByRaw("FIELD(ten_goicuoc, '".implode("','", $selectedGoiCuoc)."')")
                                    ->get();
                            @endphp
                            @foreach($goiCuocs as $goiCuoc)
                                <a href="{{ url('/dich-vu-di-dong/goi-cuoc/' . $goiCuoc->id) }}" 
                                class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                                    <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                                    <span class="ml-2 text-gray-700 font-medium">{{ $goiCuoc->ten_goicuoc }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="border rounded-lg">
                        <button class="w-full flex items-center justify-between p-3 text-blue-600 font-medium" onclick="toggleDropdown('packageDropdown3')">
                            <span class="flex items-center"><span class="mr-2">🌐</span> Gói cước Tích hợp trong nước & quốc tế</span>
                            <span>▼</span>
                        </button>
                        <div id="packageDropdown3" class="hidden p-4">
                            <div class="flex flex-wrap gap-4">
                                @php
                                    $selectedGoiCuoc = ['Gói MobiF MF199QT', 'Gói MobiF MF149QT', 'Gói MobiF MF99QT'];
                                    $goiCuocs = \App\Models\GoiCuoc::whereIn('ten_goicuoc', $selectedGoiCuoc)
                                        ->orderByRaw("FIELD(ten_goicuoc, '".implode("','", $selectedGoiCuoc)."')")
                                        ->get();
                                @endphp
                                @foreach($goiCuocs as $goiCuoc)
                                    <a href="{{ url('/dich-vu-di-dong/goi-cuoc/' . $goiCuoc->id) }}" 
                                    class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                                        <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                                        <span class="ml-2 text-gray-700 font-medium">{{ $goiCuoc->ten_goicuoc }}</span>
                                    </a>
                                @endforeach
                            </div>
                    </div>
                    
                    <div class="border rounded-lg">
                        <button class="w-full flex items-center justify-between p-3 text-blue-600 font-medium" onclick="toggleDropdown('packageDropdown4')">
                            <span class="flex items-center"><span class="mr-2">🏢</span> Gói cước Khách hàng doanh nghiệp</span>
                            <span>▼</span>
                        </button>
                        <div id="packageDropdown4" class="hidden p-4">
                            <div class="flex flex-wrap gap-4">
                                @php
                                   $selectedGoiCuoc = [
                                                        'Gói FClass',
                                                        'Gói BClass',
                                                        'Gói EClass_1',
                                                        'Gói NClass',
                                                        'Gói Enterprise E329QT',
                                                        'Gói Enterprise E229QT'
                                                    ];
                                    $goiCuocs = \App\Models\GoiCuoc::whereIn('ten_goicuoc', $selectedGoiCuoc)
                                        ->orderByRaw("FIELD(ten_goicuoc, '".implode("','", $selectedGoiCuoc)."')")
                                        ->get();
                                @endphp
                                @foreach($goiCuocs as $goiCuoc)
                                    <a href="{{ url('/dich-vu-di-dong/goi-cuoc/' . $goiCuoc->id) }}" 
                                    class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                                        <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                                        <span class="ml-2 text-gray-700 font-medium">{{ $goiCuoc->ten_goicuoc }}</span>
                                    </a>
                                @endforeach
                            </div>
                    
                    </div>
                    
                    <div class="border rounded-lg">
                        <button class="w-full flex items-center justify-between p-3 text-blue-600 font-medium" onclick="toggleDropdown('packageDropdown5')">
                            <span class="flex items-center"><span class="mr-2">💰</span> Gói cước duy trì tiết kiệm</span>
                            <span>▼</span>
                        </button>
                        <div id="packageDropdown5" class="hidden p-4">
                            <div class="flex flex-wrap gap-4">
                                @php
                                   $selectedGoiCuoc = [
                                                        'Gói QTTK15',
                                                      
                                                    ];
                                    $goiCuocs = \App\Models\GoiCuoc::whereIn('ten_goicuoc', $selectedGoiCuoc)
                                        ->orderByRaw("FIELD(ten_goicuoc, '".implode("','", $selectedGoiCuoc)."')")
                                        ->get();
                                @endphp
                                @foreach($goiCuocs as $goiCuoc)
                                    <a href="{{ url('/dich-vu-di-dong/goi-cuoc/' . $goiCuoc->id) }}" 
                                    class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                                        <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                                        <span class="ml-2 text-gray-700 font-medium">{{ $goiCuoc->ten_goicuoc }}</span>
                                    </a>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
            
            <script>
                function toggleDropdown(id) {
                    const element = document.getElementById(id);
                    element.classList.toggle('hidden');
                }
            </script>
   
    </div>
@endsection