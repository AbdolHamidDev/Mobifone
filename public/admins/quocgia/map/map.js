/**
 * Hàm khởi tạo và cập nhật bản đồ
 */
import { fetchCountryDetails } from '../gdp/gdp.js';
import { fetchWikiInfo } from './wiki.js';

// Biến lưu bản đồ và marker
let map;
let mapMarker = null;

// Khởi tạo bản đồ
function initMap(elementId = "map") {
    map = L.map(elementId).setView([20, 0], 2);

    // Thêm layer bản đồ nền từ OpenStreetMap
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap contributors",
    }).addTo(map);

    return map;
}

// Cập nhật marker và thông tin quốc gia
async function updateMap(lat, lng, flagUrl, countryName, countryCode) {
    if (!map) {
        console.error("Bản đồ chưa được khởi tạo");
        return;
    }

    // Xóa marker cũ nếu có
    if (mapMarker) {
        map.removeLayer(mapMarker);
    }

    // Thêm marker mới
    mapMarker = L.marker([lat, lng])
        .addTo(map)
        .bindPopup(
            `<img src="${flagUrl}" width="50"> <br> <b>${countryName}</b>`
        )
        .openPopup();

    // Cập nhật tầm nhìn
    map.setView([lat, lng], 5);

    // Hiển thị loading
    document.getElementById("country-stats").classList.add("hidden");
    document.getElementById("wiki-info").innerHTML = `
        <div class="animate-pulse space-y-3">
            <div class="h-6 bg-gray-200 rounded w-1/2"></div>
            <div class="h-4 bg-gray-200 rounded w-full"></div>
            <div class="h-4 bg-gray-200 rounded w-5/6"></div>
        </div>`;

    // Gọi cả Wikipedia và RestCountries API song song
    await Promise.all([
        fetchWikiInfo(countryName),
        fetchCountryDetails(countryCode)
    ]);
}

// Xuất các hàm
export { initMap, updateMap };