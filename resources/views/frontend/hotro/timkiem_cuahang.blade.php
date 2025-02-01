@extends('layouts.frontend')

<!-- Import Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

@section('content')
<div class="container" style="padding-top: 20vh;">
    <!-- Tiêu đề -->
    <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-800">Tìm kiếm cửa hàng MobiFone</h1>

    <!-- Form Tìm kiếm -->
    <div class="flex justify-center mb-10">
        <form action="{{ route('frontend.store.search') }}" method="GET" class="w-full md:w-2/3 lg:w-1/2 flex items-center bg-white shadow-md rounded-lg">
            <input 
                type="text" 
                name="query" 
                class="flex-grow py-3 px-4 border-none rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                placeholder="Nhập địa chỉ hoặc tên cửa hàng">
            <button 
                type="submit" 
                class="py-3 px-6 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-r-lg hover:from-blue-600 hover:to-blue-700 transition">
                Tìm kiếm
            </button>
        </form>
    </div>

    <!-- Bố cục Flexbox cho bản đồ và kết quả tìm kiếm -->
    <div class="flex gab-6">
        <!-- Bản đồ -->
        <div id="map" class="w-2/3 h-[800px] shadow-lg rounded-lg"></div>



        <!-- Kết quả tìm kiếm -->
        <div class="w-full md:w-1/3">
            @if(request()->has('query') && $stores->isNotEmpty())
                <div class="mt-10 bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-700 mb-4">Kết quả tìm kiếm</h2>
                    <ul>
                        @foreach($stores as $store)
                            <li class="mt-6 border-b border-gray-200 pb-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $store->name }}</h3>
                                <p class="text-sm text-gray-600">Địa chỉ: {{ $store->address }}</p>
                                <p class="text-sm text-gray-600">Vị trí: Lat: {{ $store->latitude }}, Lng: {{ $store->longitude }}</p>
                                <button 
                                    class="mt-3 py-2 px-4 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition"
                                    onclick="moveToLocation({{ $store->latitude }}, {{ $store->longitude }})">
                                    Chuyển đến vị trí
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @elseif(request()->has('query'))
                <p class="mt-10 text-red-500 text-center text-lg font-medium">Không tìm thấy cửa hàng nào phù hợp.</p>
            @endif
        </div>
    </div>
</div>

<!-- Cài đặt Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Danh sách các cửa hàng
    let stores = @json($stores);

    // Khởi tạo bản đồ Leaflet
    let map = L.map('map').setView([stores[0]?.latitude || 10.0, stores[0]?.longitude || 105.0], 13);

    // Thêm tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap contributors',
    }).addTo(map);

    // Thêm marker cho từng cửa hàng
    stores.forEach(store => {
        L.marker([store.latitude, store.longitude])
            .addTo(map)
            .bindPopup(`<strong>${store.name}</strong><br>${store.address}`);
    });

    // Hàm di chuyển đến vị trí
    function moveToLocation(lat, lng) {
        map.setView([lat, lng], 16); // Di chuyển đến vị trí với zoom level 16
    }
</script>
@endsection
