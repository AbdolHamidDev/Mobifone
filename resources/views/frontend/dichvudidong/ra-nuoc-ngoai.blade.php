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

    <div id="app" class="max-w-3xl mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-3 gap-4 items-center">
            <!-- Dropdown Quốc Gia -->
            <div class="relative">
                <select v-model="selectedCountry" class="form-control">
                    <option value="">-- Chọn quốc gia --</option>
                    <option v-for="country in countries" :value="country.code" :key="country.id">
                        @{{ country.name }}
                    </option>
                </select>
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
    
        <div class="max-w-5xl mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Nhà Khai Thác</th>
                        <th class="border border-gray-300 px-4 py-2">Gọi Trong Mạng</th>
                        <th class="border border-gray-300 px-4 py-2">Gọi về VN</th>
                        <th class="border border-gray-300 px-4 py-2">Gọi Quốc Tế</th>
                        <th class="border border-gray-300 px-4 py-2">Gọi Vệ Tinh</th>
                        <th class="border border-gray-300 px-4 py-2">Nhận Cuộc Gọi</th>
                        <th class="border border-gray-300 px-4 py-2">Gửi SMS</th>
                        <th class="border border-gray-300 px-4 py-2">Data (MB)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in tableData" :key="row.id" class="text-center">
                        <td class="border border-gray-300 px-4 py-2" v-text="row.nha_khai_thac"></td>
                        <td class="border border-gray-300 px-4 py-2" v-text="row.cuoc_goi_trong_mang"></td>
                        <td class="border border-gray-300 px-4 py-2" v-text="row.cuoc_goi_ve_vn"></td>
                        <td class="border border-gray-300 px-4 py-2" v-text="row.cuoc_quoc_te"></td>
                        <td class="border border-gray-300 px-4 py-2" v-text="row.cuoc_ve_tinh"></td>
                        <td class="border border-gray-300 px-4 py-2" v-text="row.cuoc_nhan_goi"></td>
                        <td class="border border-gray-300 px-4 py-2" v-text="row.cuoc_sms"></td>
                        <td class="border border-gray-300 px-4 py-2" v-text="row.cuoc_data"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    


    

</div>

<script src="https://cdn.jsdelivr.net/npm/vue@3.2.37/dist/vue.global.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('frontends/dichvuquocte/ranuocngoai.js') }}"></script>


@endsection
