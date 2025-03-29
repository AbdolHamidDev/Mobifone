// action.js
import dashboard from './dashboard/loadDashboard.js';
import filter from './dashboard/filter.js';
import helpers from './helpers/format.js';
import toast from './helpers/toast.js';
import easing from './helpers/easing.js';

// Khởi tạo easing functions
easing.initEasingFunctions();

$(document).ready(function() {
    // Kiểm tra xem các thư viện cần thiết đã được load chưa
    if (typeof $ === 'undefined' || typeof Chart === 'undefined') {
        toast.showErrorToast('Các thư viện cần thiết chưa được tải!');
        return;
    }
    
    // Khởi tạo bộ lọc
    filter.initTopRateFilter();
    
    // Load dữ liệu dashboard
    dashboard.loadDashboardData();
    
    // Cập nhật dữ liệu mỗi 5 phút
    setInterval(dashboard.loadDashboardData, 300000);
});