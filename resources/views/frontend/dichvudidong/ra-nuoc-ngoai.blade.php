@extends('layouts.frontend')

<link rel="stylesheet" href="{{ asset('frontends/dichvuquocte/ranuocngoai.css') }}">

@section('content')
<div class="container" style="padding-top: 15vh;">

        <div class="service-detail-card">
            <img src="{{ asset('assets/images/ranuocngoai.jpg') }}" alt="Dịch vụ Chuyển vùng quốc tế" class="service-image">
            <div class="service-info">
                <h4 class="service-title">Dịch vụ Chuyển vùng quốc tế</h4>
                <p class="service-description">
                    Dịch vụ giúp các thuê bao giữ liên lạc khi ra nước ngoài bằng số MobiFone đang sử dụng của mình.
                    MobiFone đã phủ sóng dịch vụ roaming với hơn 500 nhà mạng thuộc gần 200 quốc gia/vùng lãnh thổ.
                    Giá cước dịch vụ cạnh tranh và có nhiều gói cước ưu đãi cho bạn lựa chọn.
                </p>
            </div>
        </div>

        <!-- Chọn Quốc Gia 🌍 -->
        <h3 class="text-2xl font-bold text-gray-700 text-center mt-6">Bạn muốn đi đâu?</h3>

        <div id="app" class="max-w-9xl mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
            <div class="grid grid-cols-5 gap-4 items-center">
                <div class="relative w-64">
                    <!-- Hiển thị quốc gia đã chọn -->
                    <div class="flex items-center space-x-2 p-2 border border-gray-300 rounded-lg cursor-pointer" @click="dropdownOpen = !dropdownOpen">
                        <img v-if="selectedCountry" :src="'https://flagcdn.com/w40/' + selectedCountry.code + '.png'" class="w-6 h-4 rounded border border-gray-300">
                        <span v-if="selectedCountry">@{{ selectedCountry.name }}</span>
                        <span v-else class="text-gray-500">-- Chọn quốc gia --</span>
                    </div>
            
                    <!-- Dropdown danh sách quốc gia -->
                    <ul v-if="dropdownOpen" class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 shadow-md max-h-60 overflow-y-auto">
                        <li v-for="country in countries" :key="country.id"
                            @click="selectCountry(country)"
                            class="flex items-center space-x-2 p-2 hover:bg-gray-100 cursor-pointer">
                            <img :src="'https://flagcdn.com/w40/' + country.code + '.png'" class="w-6 h-4 rounded border border-gray-300">
                            <span>@{{ country.name }}</span>
                        </li>
                    </ul>
                </div>
                <!-- Dropdown Loại Thuê Bao -->
                <div class="relative">
                    <select v-model="selectedSubscription" class="form-control">
                        <option value="">Chọn loại thuê bao</option>
                        <option value="Trả trước">Trả trước</option>
                        <option value="Trả sau">Trả sau</option>
                    </select>
                </div>

                <!-- Nút Tìm Kiếm -->
                <button @click="searchPackages" class="btn btn-primary">
                    🔍 TÌM KIẾM
                </button>
            </div>

            <!-- Chỉ hiển thị bảng khi có dữ liệu -->
            <div v-if="tableData.length > 0" class="max-w-9xl mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
                <!-- Bảng 1: Thông tin cơ bản -->
                <table class="table-auto border border-gray-300 shadow-lg rounded-lg w-full mb-9">
                    <thead class="bg-gray-100 border border-gray-300">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">STT</th>
                            <th class="px-4 py-2 border border-gray-300">Loại Thuê Bao</th>
                            <th class="px-4 py-2 border border-gray-300">Nhà Khai Thác</th>
                            <th class="px-4 py-2 border border-gray-300">Handset Display</th>
                            <th class="px-4 py-2 border border-gray-300">Đầu số thực hiện cuộc gọi</th>
                            <th class="px-4 py-2 border border-gray-300">Thực hiện cuộc gọi</th>
                            <th class="px-4 py-2 border border-gray-300">Nhận cuộc gọi</th>
                            <th class="px-4 py-2 border border-gray-300">Dịch vụ SMS</th>
                            <th class="px-4 py-2 border border-gray-300">3G</th>
                            <th class="px-4 py-2 border border-gray-300">4G</th>
                            <th class="px-4 py-2 border border-gray-300">5G</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in tableData" :key="row.id" class="hover:bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300" v-text="row.stt"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.loai_thue_bao"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.nha_khai_thac"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.ma_nha_khai_thac"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.dau_so_thuc_hien_cuoc_goi"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.thuc_hien_cuoc_goi"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.nhan_cuoc_goi"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.dich_vu_sms"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.data_3g"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.data_4g"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.data_5g"></td>
                        </tr>
                    </tbody>
                </table>
                

                <!-- Bảng 2: Giá cước -->
                <table class="table-auto border border-gray-300 shadow-lg rounded-lg w-full">
                    <thead class="bg-gray-100 border border-gray-300">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">Gọi Trong Mạng(VNĐ/phút)</th>
                            <th class="px-4 py-2 border border-gray-300">Gọi về VN(VNĐ/phút)</th>
                            <th class="px-4 py-2 border border-gray-300">Gọi Quốc Tế(VNĐ/phút)</th>
                            <th class="px-4 py-2 border border-gray-300">Gọi Vệ Tinh(VNĐ/phút)</th>
                            <th class="px-4 py-2 border border-gray-300">Nhận Cuộc Gọi(VNĐ/phút)</th>
                            <th class="px-4 py-2 border border-gray-300">Gửi SMS(VNĐ/bản tin)</th>
                            <th class="px-4 py-2 border border-gray-300">Data(VNĐ/MB)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in tableData" :key="row.id" class="hover:bg-gray-200">
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_goi_trong_mang"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_goi_ve_vn"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_quoc_te"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_ve_tinh"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_nhan_goi"></td>
                            <td class="px-4 py-2 border border-gray-300" v-text="row.cuoc_sms"></td>
                            <td class="px-4 py-2 border border-gray-300 font-semibold text-blue-500" v-text="row.cuoc_data">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="p-4 ">
                    <p class="font-semibold">Giá cước đã bao gồm thuế VAT</p>
                    <p class="mt-2">Phương thức tính thoại: <span class="font-semibold">block 1 phút + 1 phút</span></p>
                    <p class="mt-2">Phương thức tính data: <span class="font-semibold">10KB + 10KB</span></p>
                </div>
            </div>         
        </div>  
    </div>

    <!-- CÁC GÓI GƯỚC ƯU ĐÃI --> 
       
        <div class="w-full max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
            <h2 class="text-2xl font-bold text-blue-900 mb-4 text-center">Các gói cước ưu đãi</h2>
            
            <!-- Dùng flex-col thay vì grid để tránh bị che -->
            <div class="flex flex-col gap-6"> 
                
                <!-- Item 1 -->
                <div class="block">
                    <button onclick="toggleDropdown('dropdown1')" class="flex justify-between items-center w-full p-4 text-blue-700 font-medium text-lg">
                        <span class="flex items-center">
                            📄 <span class="ml-2">Đăng ký dịch vụ Chuyển vùng quốc tế</span>
                        </span>
                        <span id="icon1">🔽</span>
                    </button>
                    <div id="dropdown1" class="hidden p-4">
                        <div class="flex gap-4">
                            @php
                                $cvqt = \App\Models\GoiCuoc::where('ten_goicuoc', 'CVQT')->first();
                            @endphp
                            @if($cvqt)
                                <a href="{{ url('/dich-vu-di-dong/goi-cuoc/' . $cvqt->id) }}" 
                                class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                                    <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                                    <span class="ml-2 text-gray-700 font-medium">DK {{ $cvqt->ten_goicuoc }} ({{ $cvqt->mo_ta }})</span>
                                </a>
                            @endif
        
                            @php
                                $cvqtAll = \App\Models\GoiCuoc::where('ten_goicuoc', 'CVQT ALL')->first();
                            @endphp
                            @if($cvqtAll)
                                <a href="{{ url('/dich-vu-di-dong/goi-cuoc/' . $cvqtAll->id) }}" 
                                class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                                    <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                                    <span class="ml-2 text-gray-700 font-medium">DK {{ $cvqtAll->ten_goicuoc }} ({{ $cvqtAll->mo_ta }})</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
        
                <!-- Item 2 -->
                <div class="block">
                    <button onclick="toggleDropdown('dropdown2')" class="flex justify-between items-center w-full p-4 text-blue-700 font-medium text-lg">
                        <span class="flex items-center">
                            📄 <span class="ml-2">Gói cước Thoại, SMS, Data</span>
                        </span>
                        <span id="icon2">🔽</span>
                    </button>
                    <div id="dropdown2" class="hidden p-4">
                        <div class="flex flex-wrap gap-4">
                            @php
                                $selectedGoiData = ['RH2', 'RUD1', 'RC2', 'RH', 'RUD7', 'RS', 'RC1', 'RSD'];
                                $goidatas = \App\Models\GoiData::whereIn('ten_data', $selectedGoiData)
                                    ->orderByRaw("FIELD(ten_data, '".implode("','", $selectedGoiData)."')")
                                    ->get();
                            @endphp
                            @foreach($goidatas as $goidata)
                                <a href="{{ url('/dich-vu-di-dong/goi-data/' . $goidata->id) }}" 
                                class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                                    <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                                    <span class="ml-2 text-gray-700 font-medium">{{ $goidata->ten_data }} ({{ $goidata->thoi_gian }} ngày)</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
        
                <!-- Item 3 -->
                <div class="block">
                    <button onclick="toggleDropdown('dropdown3')" class="flex justify-between items-center w-full p-4 text-blue-700 font-medium text-lg">
                        <span class="flex items-center">
                            📄 <span class="ml-2">Gói cước theo khu vực</span>
                        </span>
                        <span id="icon3">🔽</span>
                    </button>
                    <div id="dropdown3" class="hidden p-4">
                        <div class="flex flex-wrap gap-4">
                            @php
                                $selectedRegionGoiData = ['Go Malaysia', 'Go HongKong', 'Go USA', 'EU1', 'Asean RAS','Border1 RB1', 'Border2 RB2', 'Border3 RB3', 'EU2', 'Go Korea', 'Go Japan', 'Go China'];
                                $goidatasRegion = \App\Models\GoiData::whereIn('ten_data', $selectedRegionGoiData)
                                    ->orderByRaw("FIELD(ten_data, '".implode("','", $selectedRegionGoiData)."')")
                                    ->get();
                            @endphp
                            @foreach($goidatasRegion as $goidata)
                                <a href="{{ url('/dich-vu-di-dong/goi-data/' . $goidata->id) }}" 
                                class="flex items-center p-4 bg-white border rounded-lg shadow-md w-64 cursor-pointer hover:bg-gray-100 transition">
                                    <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call Icon" class="w-8 h-8">
                                    <span class="ml-2 text-gray-700 font-medium">{{ $goidata->ten_data }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
        
      
    
    

        <div class="w-full max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
            <h2 class="text-2xl font-bold text-blue-900 mb-4 text-center">Hướng dẫn sử dụng dịch vụ</h2>
        
            <!-- Hướng dẫn đăng ký -->
            <div class="border-t border-gray-300" data-index="1">
                <button class="flex justify-between items-center w-full p-4 text-blue-700 font-medium text-lg dropdown-btn">
                    <span class="flex items-center">
                        📄 <span class="ml-2 font-bold">Hướng dẫn đăng ký</span>
                    </span>
                    <span class="dropdown-icon">🔽</span>
                </button>
                <div class="hidden p-4 dropdown-content">
                    <!-- Điều kiện đăng ký -->
                <h3 class="text-lg font-bold text-blue-700">Điều kiện đăng ký:</h3>
                <p class="mb-2">Thuê bao trả trước đang hoạt động hai chiều trên mạng MobiFone được mở mặc định dịch vụ CVQT Thoại và SMS.</p>
                <p class="mb-4">Thuê bao trả sau chưa hoàn thành chu kỳ cước đầu tiên sẽ không được hỗ trợ đăng ký dịch vụ CVQT qua SMS. Vui lòng tới cửa hàng MobiFone để được hướng dẫn thêm.</p>

                <!-- Hướng dẫn đăng ký / hủy dịch vụ -->
                <h3 class="text-lg font-bold text-blue-700">Hướng dẫn đăng ký/ hủy dịch vụ:</h3>
                
                <!-- Đăng ký dịch vụ -->
                <p class="font-bold mt-2">Đăng ký dịch vụ:</p>
                <ul class="list-disc list-inside">
                    <li>Đăng ký dịch vụ CVQT Thoại, SMS: Soạn <span class="font-bold text-black">DK CVQT</span> gửi <span class="font-bold text-black">999</span> hoặc bấm <span class="font-bold text-black">*093*1*1#OK</span></li>
                    <li>Đăng ký dịch vụ CVQT Thoại, SMS & Data: Soạn <span class="font-bold text-black">DK CVQT ALL</span> gửi <span class="font-bold text-black">999</span> hoặc bấm <span class="font-bold text-black">*093*2*1#OK</span></li>
                </ul>

                <!-- Hủy dịch vụ -->
                <p class="font-bold mt-4">Hủy dịch vụ:</p>
                <ul class="list-disc list-inside">
                    <li>Hủy CVQT Data: Soạn <span class="font-bold text-black">HUY CVQT DATA</span> gửi <span class="font-bold text-black">999</span></li>
                    <li>Hủy CVQT Thoại, SMS, Data: Soạn <span class="font-bold text-black">HUY CVQT ALL</span> gửi <span class="font-bold text-black">999</span> hoặc bấm <span class="font-bold text-black">*093*2*2#OK</span></li>
                </ul>
                </div>
            </div>
        
             <!-- Hướng dẫn sử dụng Data, Thoại, SMS -->
             <div class="border-t border-gray-300" data-index="2">
                <button class="flex justify-between items-center w-full p-4 text-blue-700 font-medium text-lg dropdown-btn">
                    <span class="flex items-center">
                        ⚙️ <span class="ml-2">Hướng dẫn sử dụng Data, Thoại, SMS</span>
                    </span>
                    <span class="dropdown-icon">🔽</span>
                </button>
                <div class="hidden p-4 dropdown-content">
                    <p class="text-blue-700 font-bold">Hướng dẫn chọn mạng thủ công</p>
            
                    <!-- Bọc trong flex + items-center để căn giữa hai ảnh -->
                    <div class="flex justify-center items-center gap-6 mt-4">
                        <!-- Ảnh iOS -->
                        <div class="text-center flex flex-col items-center">
                            <img src="https://api.mobifone.vn/images/service/cvqt/clip_01_VN.gif" 
                                 alt="Hướng dẫn chọn mạng iOS" 
                                 class="w-68 h-auto rounded-lg shadow-md object-contain">
                            <p class="mt-2 font-semibold">Trình duyệt iOS</p>
                        </div>
            
                        <!-- Ảnh Android -->
                        <div class="text-center flex flex-col items-center">
                            <img src="https://api.mobifone.vn/images/service/cvqt/clip_02_VN.gif" 
                                 alt="Hướng dẫn chọn mạng Android" 
                                 class="w-81 h-auto rounded-lg shadow-md object-contain">
                            <p class="mt-2 font-semibold">Trình duyệt Android</p>
                        </div>
                    </div>
                    <!-- Hướng dẫn cài đặt GPRS -->
                    <h3 class="text-lg font-bold text-blue-700">Hướng dẫn cài đặt truy cập GPRS</h3>

                    <!-- Cài đặt cấu hình APN -->
                    <p class="mt-2 font-bold">Cài đặt cấu hình APN trên điện thoại:</p>
                    <ul class="list-disc list-inside">
                        <li>Đối với HĐH <strong>iOS</strong>: Settings → Cellular → Cellular Data Network → APN → Cài đặt APN: <strong>m-wap</strong>.</li>
                        <li>Đối với HĐH <strong>Android</strong>: Settings → Mobile Network → Access Point Names → APNs → Cài đặt APN: <strong>m-wap</strong>.</li>
                    </ul>

                    <!-- Bật chế độ DATA Roaming -->
                    <p class="mt-2 font-bold">Bật chế độ DATA Roaming ON trên điện thoại:</p>
                    <ul class="list-disc list-inside">
                        <li>Đối với HĐH <strong>iOS</strong>: Settings → Cellular Data Option → Roaming ON → DATA ROAMING ON.</li>
                        <li>Đối với HĐH <strong>Android</strong>: Settings → Connections → Mobile Networks → Roaming ON → DATA ROAMING ON.</li>
                    </ul>

                    <!-- Hướng dẫn gọi điện & nhắn tin -->
                    <h3 class="text-lg font-bold text-blue-700 mt-4">Hướng dẫn cách gọi điện và nhắn tin</h3>
                    <p>Gọi/ nhắn tin tới thuê bao của nước đang chuyển vùng: Bấm đầy đủ số theo quy định của mạng khách.</p>
                    <ul class="list-disc list-inside">
                        <li>Gọi/ nhắn tin tới số thuê bao Việt Nam: +84 + số điện thoại cần gọi (VD: <strong>+8490123456</strong>).</li>
                        <li>Gọi/ nhắn tin tới Thuê bao quốc tế: "+" (hoặc đầu số gọi ra quốc tế của nước cần gọi), Mã nước cần gọi, Số điện thoại.</li>
                    </ul>

                    <!-- Hướng dẫn chung về dịch vụ CVQT -->
                    <h3 class="text-lg font-bold text-blue-700 mt-6">Hướng dẫn chung sử dụng dịch vụ CVQT</h3>
                    <p class="text-gray-700 mb-4">Mời quý khách xem video hướng dẫn</p>

                    <!-- Video hướng dẫn -->
                    <video controls class="w-full mt-4 rounded-lg shadow-md">
                        <source src="https://www.mobifone.vn/assets/source/video/Intruction_CVQT.mp4" type="video/mp4">
                        Trình duyệt của bạn không hỗ trợ video.
                    </video>
                    <p>Lưu ý: chọn chế độ 4G trong thiết bị vì nhiều quốc gia chưa hỗ trợ 5G.</p>
                </div>
                
            </div>
            
            
           <!-- Bước 2 -->
        <div class="bg-blue-50 p-4 rounded-lg mt-4">
            <p class="flex items-center text-blue-900 font-bold">
                🔵 Bước 2
            </p>
            <p class="mt-2 text-gray-700">
                Bật chế độ Thoại trên nền 4G (VoLTE) trên máy điện thoại theo hướng dẫn.
            </p>
        </div>

        <!-- Hướng dẫn iOS & Android -->
        <div class="flex justify-center items-center gap-6 mt-4">
            <!-- Hướng dẫn iOS -->
            <div class="text-center flex flex-col items-center border p-4 rounded-lg shadow-md">
                <p class="bg-blue-100 px-4 py-2 rounded-full font-bold text-blue-700">HỆ ĐIỀU HÀNH IOS</p>
                <div class="w-full overflow-x-auto mt-2">
                    <ul class="flex space-x-2">
                        <li><img src="https://www.mobifone.vn/images/volte/ios/step1.png" alt="Bước 1" class="w-40 h-auto rounded-lg"></li>
                        <li><img src="https://www.mobifone.vn/images/volte/ios/step2.png" alt="Bước 2" class="w-40 h-auto rounded-lg"></li>
                        <li><img src="https://www.mobifone.vn/images/volte/ios/step3.png" alt="Bước 3" class="w-40 h-auto rounded-lg"></li>
                        <li><img src="https://www.mobifone.vn/images/volte/ios/step4.png" alt="Bước 4" class="w-40 h-auto rounded-lg"></li>
                        <li><img src="https://www.mobifone.vn/images/volte/ios/step5.png" alt="Bước 5" class="w-40 h-auto rounded-lg"></li>
                        <li><img src="https://www.mobifone.vn/images/volte/ios/step6.png" alt="Bước 6" class="w-40 h-auto rounded-lg"></li>
                    </ul>
                </div>
            </div>

            <!-- Hướng dẫn Android -->
            <div class="text-center flex flex-col items-center border p-4 rounded-lg shadow-md">
                <p class="bg-blue-100 px-4 py-2 rounded-full font-bold text-blue-700">HỆ ĐIỀU HÀNH ANDROID</p>
                <div class="w-full overflow-x-auto mt-2">
                    <ul class="flex space-x-2">
                        <li><img src="https://www.mobifone.vn/images/volte/android/step1.png" alt="Bước 1" class="w-40 h-auto rounded-lg"></li>
                        <li><img src="https://www.mobifone.vn/images/volte/android/step2.png" alt="Bước 2" class="w-40 h-auto rounded-lg"></li>
                        <li><img src="https://www.mobifone.vn/images/volte/android/step3.png" alt="Bước 3" class="w-40 h-auto rounded-lg"></li>
                        <li><img src="https://www.mobifone.vn/images/volte/android/step4.png" alt="Bước 4" class="w-40 h-auto rounded-lg"></li>
                        <li><img src="https://www.mobifone.vn/images/volte/android/step5.png" alt="Bước 5" class="w-40 h-auto rounded-lg"></li>
                    </ul>
                </div>
            </div>

        </div>
        </div>
        
            <div class="border-t border-gray-300 border-b" data-index="4">
                <button class="flex justify-between items-center w-full p-4 text-blue-700 font-medium text-lg dropdown-btn">
                    <span class="flex items-center">
                        ℹ️ <span class="ml-2">Lưu ý</span>
                    </span>
                    <span class="dropdown-icon">🔽</span>
                </button>
                <div class="hidden p-4 dropdown-content">
                    <p>Những lưu ý quan trọng khi sử dụng dịch vụ...</p>
                </div>
            </div>
        </div>
        
   
    


</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".dropdown-btn").forEach((button) => {
        button.addEventListener("click", function () {
            const parent = this.parentElement;
            const content = parent.querySelector(".dropdown-content");
            const icon = this.querySelector(".dropdown-icon");

            content.classList.toggle("hidden");
            icon.textContent = content.classList.contains("hidden") ? "🔽" : "🔼";
        });
    });
});
</script>
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        dropdown.classList.toggle("hidden");
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.37/dist/vue.global.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('frontends/dichvuquocte/ranuocngoai.js') }}"></script>
@endsection
