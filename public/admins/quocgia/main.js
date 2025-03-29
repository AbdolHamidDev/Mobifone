/**
 * File chính để khởi tạo toàn bộ chức năng
 */
import { initMap } from './map/map.js';
import { initCountryDropdowns } from './dropdown/dropdown.js';
import { initDataTable, initCountryColumns } from './datatable/datatable.js';
import { initModal, initDeleteEvent } from './modal/modal.js';

// Hằng số API
const QUOC_GIA_API = '/admin/quoc-gia';

// Hàm khởi tạo tất cả các chức năng
function init() {
    document.addEventListener("DOMContentLoaded", function () {
        // Khởi tạo bản đồ
        initMap();
        
        // Khởi tạo dropdown quốc gia
        initCountryDropdowns();
        
        // Khởi tạo DataTable
        const columns = initCountryColumns();
        initDataTable("#quocgia", QUOC_GIA_API, columns);
        
        // Khởi tạo modal và sự kiện xóa
        initModal();
        initDeleteEvent();
    });
}

// Bắt đầu khởi tạo
init();

// Xuất các hàm nếu cần thiết
export { init };