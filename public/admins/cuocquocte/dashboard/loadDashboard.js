// dashboard/loadDashboard.js
import helpers from '../helpers/format.js';
import toast from '../helpers/toast.js';
import charts from '../charts/renderCharts.js';
import table from '../charts/updateTable.js';

const dashboard = {};

// Hàm load dữ liệu dashboard
dashboard.loadDashboardData = function() {
    // Hiển thị skeleton loading
    $('.card-stat .fs-5').addClass('placeholder-glow').html('<span class="placeholder col-6"></span>');
    $('.chart-container').addClass('loading');
    
    $.ajax({
        url: "/admin/cuoc-quoc-te/dashboard-data",
        method: "GET",
        beforeSend: function() {
            $('#loadingToast').toast('show');
        },
        success: function(response) {
            if (response.status === 'success') {
                // Ẩn skeleton loading
                $('.card-stat .fs-5').removeClass('placeholder-glow');
                $('.chart-container').removeClass('loading');
                
                // Cập nhật dữ liệu
                const data = response.data;
                
                // Cập nhật thông tin tổng quan
                $('#total-countries').html(`
                    <div class="d-flex align-items-center">
                        <i class="fas fa-globe me-3 fs-2 text-primary"></i>
                        <div>
                            <div class="fs-5 fw-semibold">${data.summary?.total_countries || 0}</div>
                            <div class="text-muted small">Quốc gia</div>
                        </div>
                    </div>
                `);

                $('#total-operators').html(`
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tower-cell me-3 fs-2 text-info"></i>
                        <div>
                            <div class="fs-5 fw-semibold">${data.summary?.total_operators || 0}</div>
                            <div class="text-muted small">Nhà mạng</div>
                        </div>
                    </div>
                `);

                $('#avg-call-rate').html(`
                    <div class="d-flex align-items-center">
                        <i class="fas fa-phone me-3 fs-2 text-success"></i>
                        <div>
                            <div class="fs-5 fw-semibold">${helpers.formatCurrency(data.average_rates?.call || 0)}/ph</div>
                            <div class="text-muted small">Cước gọi TB</div>
                        </div>
                    </div>
                `);

                $('#avg-data-rate').html(`
                    <div class="d-flex align-items-center">
                        <i class="fas fa-database me-3 fs-2 text-warning"></i>
                        <div>
                            <div class="fs-5 fw-semibold">${helpers.formatCurrency(data.average_rates?.data || 0)}/MB</div>
                            <div class="text-muted small">Cước data TB</div>
                        </div>
                    </div>
                `);
                
                $('#country-change').html(data.summary?.country_change > 0 ? 
                    `<i class="fas fa-caret-up me-1"></i> ${data.summary.country_change}%` : 
                    `<i class="fas fa-caret-down me-1"></i> ${Math.abs(data.summary?.country_change || 0)}%`);
                
                $('#operator-change').html(data.summary?.operator_change > 0 ? 
                    `<i class="fas fa-caret-up me-1"></i> ${data.summary.operator_change}%` : 
                    `<i class="fas fa-caret-down me-1"></i> ${Math.abs(data.summary?.operator_change || 0)}%`);
                
                // Vẽ biểu đồ
                if (data.chart_data) {
                    charts.renderCharts(data.chart_data);
                }
                
                // Cập nhật bảng top quốc gia
                if (data.top_countries) {
                    table.updateTopCountriesTable(data.top_countries);
                }
            } else {
                toast.showErrorToast(response.message || 'Lỗi không xác định');
            }
        },
        error: function(xhr) {
            console.error('Request failed:', xhr.responseText);
            toast.showErrorToast('Lỗi kết nối đến server');
        },
        complete: function() {
            $('#loadingToast').toast('hide');
        }
    });
};

export default dashboard;