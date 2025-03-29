/**
 * Hàm xử lý dropdown quốc gia
 */
import { fetchAllCountries } from '../helpers/api.js';
import { updateMap } from '../map/map.js';

// Khởi tạo dropdown chọn quốc gia
async function initCountryDropdowns() {
    try {
        const data = await fetchAllCountries();
        
        // Các selector dropdown
        const selectMap = document.getElementById("select-map");
        const selectModal = document.getElementById("select-quoc-gia");
        
        // Xóa options cũ và thêm option mặc định
        selectMap.innerHTML = '<option value="">-- Chọn quốc gia --</option>';
        selectModal.innerHTML = '<option value="">-- Chọn quốc gia --</option>';

        // Thêm các options mới
        data.forEach((country) => {
            if (!country.latlng || country.latlng.length < 2) return;
            
            let option1 = document.createElement("option");
            let option2 = document.createElement("option");

            option1.value = option2.value = country.cca2;
            option1.textContent = option2.textContent = country.name.common;
            option1.dataset.lat = option2.dataset.lat = country.latlng[0];
            option1.dataset.lng = option2.dataset.lng = country.latlng[1];
            option1.dataset.flag = option2.dataset.flag = country.flags.svg;
            option1.dataset.name = option2.dataset.name = country.name.common;

            selectMap.appendChild(option1);
            selectModal.appendChild(option2);
        });
        
        // Khởi tạo sự kiện
        initDropdownEvents();
        
        return data;
    } catch (error) {
        console.error("Lỗi khi tải danh sách quốc gia:", error);
    }
}

// Khởi tạo sự kiện cho các dropdown
function initDropdownEvents() {
    // Sự kiện cho dropdown bản đồ
    document.getElementById("select-map").addEventListener("change", function () {
        let selected = this.options[this.selectedIndex];
        if (!selected.dataset.lat) return;
        
        updateMap(
            selected.dataset.lat,
            selected.dataset.lng,
            selected.dataset.flag,
            selected.textContent,
            selected.value
        );
    });
    
    // Sự kiện cho dropdown trong modal
    document.getElementById("select-quoc-gia").addEventListener("change", function () {
        let selected = this.options[this.selectedIndex];
        if (!selected.dataset.lat) return;
        
        // Cập nhật bản đồ
        updateMap(
            selected.dataset.lat,
            selected.dataset.lng,
            selected.dataset.flag,
            selected.textContent,
            selected.value
        );
        
        // Cập nhật các trường input
        $("#ten_quoc_gia").val(selected.dataset.name);
        $("#ma_quoc_gia").val(selected.value);
        
        // Hiển thị lá cờ
        if (selected.dataset.flag) {
            $("#flag-display").removeClass("hidden");
            $("#flag-img").attr("src", selected.dataset.flag);
            $("#flag-name").text(selected.dataset.name);
        } else {
            $("#flag-display").addClass("hidden");
        }
        
        // Kiểm tra quốc gia đã tồn tại
        checkExistingCountry(selected.value);
    });
}

// Kiểm tra quốc gia đã tồn tại
function checkExistingCountry(countryCode) {
    if (!window.table) {
        console.error("Lỗi: table chưa được khởi tạo!");
        return;
    }

    let existingCountries = new Set();
    window.table
        .rows()
        .data()
        .each((row) => {
            existingCountries.add(row.ma_quoc_gia);
        });

    if (existingCountries.has(countryCode)) {
        $("#btn-save").hide();
        $("#duplicate-warning").show();
    } else {
        $("#btn-save").show();
        $("#duplicate-warning").hide();
    }
}

// Xuất các hàm
export { initCountryDropdowns, checkExistingCountry };