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
        <label for="country" class="block text-lg font-semibold text-gray-700 mb-2">
            <i class="fas fa-globe-americas text-blue-500"></i> Chọn quốc gia:
        </label>

        <div class="grid grid-cols-3 gap-4 items-center">
            <!-- Dropdown Quốc Gia -->
            <div class="relative">
                <button @click="dropdownOpen = !dropdownOpen"
                    class="w-full flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300">
                    <span v-if="selectedCountry" class="flex items-center">
                        <img :src="selectedCountry.flag" class="w-6 h-4 rounded-sm mr-2"> @{{ selectedCountry.name }}
                    </span>
                    <span v-else class="text-gray-500">-- Chọn quốc gia --</span>
                </button>

                <ul v-show="dropdownOpen"
                    class="absolute w-full bg-white border rounded-lg shadow-lg max-h-60 overflow-y-auto z-50">
                    <li v-for="country in countries" :key="country.code"
                        @click="selectCountry(country)"
                        class="px-4 py-2 hover:bg-blue-100 cursor-pointer flex items-center">
                        <img :src="country.flag" class="w-6 h-4 rounded-sm mr-2"> @{{ country.name }}
                    </li>
                </ul>
            </div>

            <!-- Dropdown Loại Thuê Bao -->
            <div class="relative">
                <select v-model="selectedSubscription"
                    class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300">
                    <option value="">Chọn loại thuê bao</option>
                    <option value="prepaid">Trả trước</option>
                    <option value="postpaid">Trả sau</option>
                </select>
            </div>

            <!-- Nút Tìm Kiếm -->
            <button @click="searchPackages"
                class="w-full flex items-center justify-center px-6 py-2 text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 transition transform hover:scale-105">
                🔍 TÌM KIẾM
            </button>
        </div>
    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/vue@3.2.37/dist/vue.global.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('frontends/dichvuquocte/ranuocngoai.js') }}"></script>


@endsection
