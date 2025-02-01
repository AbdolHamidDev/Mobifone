<section class="map">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="mb-4">{{ $store->name }}</h2>
                <p class="mb-4">{{ $store->address }}</p>
            </div>
            <div class="col-md-12">
                <div id="map" class="w-100" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</section>

<!-- Cài đặt Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Vị trí cửa hàng
    let lat = {{ $store->latitude }};
    let lng = {{ $store->longitude }};

    // Khởi tạo bản đồ Leaflet
    let map = L.map('map').setView([lat, lng], 16);

    // Thêm tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap contributors',
    }).addTo(map);

    // Thêm marker cho vị trí cửa hàng
    L.marker([lat, lng])
        .addTo(map)
        .bindPopup("<strong>{{ $store->name }}</strong><br>{{ $store->address }}")
        .openPopup();
</script>
