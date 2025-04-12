import { initializeDataTable, calculatePricePreview, initializeSelect2 } from './datatable/datatable.js';
import { setupModalEvents, setupFormSteps, setupButtonEvents } from './modal/modal.js';
import { loadDashboardData, loadPricingData, setupDashboardEvents } from './dashboard/dashboard.js';


// Khởi tạo khi DOM ready
$(document).ready(function() {
    initializeDataTable();
    initializeSelect2();
    setupModalEvents();
    setupFormSteps();
    setupButtonEvents();
    
    // Tính toán xem trước giá cước
    $('#block_6s_dau, #gia_moi_giay, #gia_1_phut_dau, #gia_1_phut_tiep_theo').on('input', calculatePricePreview);
});

// Khởi tạo dashboard
document.addEventListener('DOMContentLoaded', function() {
    loadDashboardData();
    loadPricingData();
    setupDashboardEvents();
});

// Expose các hàm cần thiết ra global scope (nếu cần)
window.loadDashboardData = loadDashboardData;
window.loadPricingData = loadPricingData;