// Định dạng tiền tệ theo kiểu Việt Nam
function formatCurrency(value) {
    if (value === null || value === undefined || isNaN(value)) {
        return '0';
    }
    
    // Chuyển đổi sang number nếu là string
    const numberValue = typeof value === 'string' ? parseFloat(value) : value;
    
    return new Intl.NumberFormat('vi-VN').format(numberValue);
}

// Hàm hiển thị thông báo lỗi
// Hàm hiển thị thông báo lỗi với thiết kế đẹp hơn
function showErrorToast(message) {
    if ($('.toast-container').length === 0) {
        $('body').append(`
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
                <div id="loadingToast" class="toast" role="status" aria-live="polite" aria-atomic="true">
                    <div class="toast-header bg-primary text-white">
                        <strong class="me-auto">Hệ thống</strong>
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Đang tải dữ liệu...
                    </div>
                </div>
            </div>
        `);
    }
    
    const toastId = 'toast-' + Date.now();
    const toast = `
        <div id="${toastId}" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Thông báo lỗi</strong>
                <i class="fas fa-exclamation-circle me-2"></i>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-light">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle text-danger me-3 fs-4"></i>
                    <div class="flex-grow-1">${message}</div>
                </div>
            </div>
        </div>
    `;
    
    $('.toast-container').append(toast);
    
    // Tự động ẩn sau 5 giây với hiệu ứng mượt mà
    setTimeout(() => {
        $(`#${toastId}`).fadeOut(500, function() {
            $(this).remove();
        });
    }, 5000);
}

/**
 * Updates the top countries table with the provided data
 * @param {Array} data - Array of country data objects
 */
async function updateTopCountriesTable(data) {
    const tbody = $('#topCountriesTable tbody');
    
    // Show loading animation
    tbody.empty().append(`
        <tr class="text-center">
            <td colspan="6">
                <div class="d-flex flex-column align-items-center justify-content-center py-5">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span class="text-muted">Đang tải dữ liệu...</span>
                </div>
            </td>
        </tr>
    `);

    const loadingStartTime = Date.now();
    const minLoadingTime = 800; // Tăng thời gian loading tối thiểu lên 800ms

    try {
        // Xử lý dữ liệu trống hoặc không hợp lệ
        if (!data || !Array.isArray(data) || data.length === 0) {
            const elapsed = Date.now() - loadingStartTime;
            const remainingDelay = Math.max(0, minLoadingTime - elapsed);
            
            await new Promise(resolve => setTimeout(resolve, remainingDelay));
            
            tbody.empty().append(`
                <tr class="text-center">
                    <td colspan="6">
                        <div class="d-flex flex-column align-items-center justify-content-center py-5">
                            <i class="fas fa-database fs-1 text-muted mb-3"></i>
                            <span class="text-muted">Không có dữ liệu</span>
                        </div>
                    </td>
                </tr>
            `);
            return;
        }

        // Cache mã quốc gia
        const countryCodeCache = {};
        
        // Lấy mã quốc gia từ API
        try {
            const response = await fetch('https://restcountries.com/v3.1/all');
            const countries = await response.json();
            
            countries.forEach(country => {
                countryCodeCache[country.name.common.toLowerCase()] = country.cca2.toLowerCase();
            });
        } catch (error) {
            console.error('Lỗi khi lấy mã quốc gia:', error);
        }

        function getCountryCode(countryName) {
            if (!countryName) return '🌍';
            const normalized = countryName.toLowerCase();
            return countryCodeCache[normalized] || '🌍';
        }

        // Tính giá trị max cho các progress bar
        const maxValues = {
            call_rate: Math.max(...data.map(item => item.call_rate || 0)),
            data_rate: Math.max(...data.map(item => item.data_rate || 0)),
            sms_rate: Math.max(...data.map(item => item.sms_rate || 0)),
            total: Math.max(...data.map(item => item.total || 0))
        };

        // Tạo các hàng của bảng
        const rows = data.map((item, index) => {
            const countryCode = getCountryCode(item.country);
            const callRatePercent = maxValues.call_rate ? ((item.call_rate || 0) / maxValues.call_rate * 100) : 0;
            const dataRatePercent = maxValues.data_rate ? ((item.data_rate || 0) / maxValues.data_rate * 100) : 0;
            const smsRatePercent = maxValues.sms_rate ? ((item.sms_rate || 0) / maxValues.sms_rate * 100) : 0;
            const totalPercent = maxValues.total ? ((item.total || 0) / maxValues.total * 100) : 0;
            
            return `
            <tr class="align-middle" style="opacity: 0; transform: translateY(20px);">
                <td class="text-center fw-bold">${index + 1}</td>
                <td>
                    <div class="d-flex align-items-center">
                    <img src="https://flagcdn.com/16x12/${countryCode}.png" 
     alt="${item.country}" class="me-2" style="width: 16px; height: 12px;"
     onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/9/9a/Earth_symbol.png';">

                        <span>${item.country || 'N/A'}</span>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-primary" role="progressbar" 
                                 style="width: 0%" 
                                 data-percent="${callRatePercent}">
                            </div>
                        </div>
                        <small class="text-muted ms-2">${formatCurrency(item.call_rate || 0)}</small>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-info" role="progressbar" 
                                 style="width: 0%" 
                                 data-percent="${dataRatePercent}">
                            </div>
                        </div>
                        <small class="text-muted ms-2">${formatCurrency(item.data_rate || 0)}</small>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: 0%" 
                                 data-percent="${smsRatePercent}">
                            </div>
                        </div>
                        <small class="text-muted ms-2">${formatCurrency(item.sms_rate || 0)}</small>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" 
                                 style="width: 0%" 
                                 data-percent="${totalPercent}">
                            </div>
                        </div>
                        <small class="text-muted ms-2">${formatCurrency(item.total || 0)}</small>
                    </div>
                </td>
            </tr>`;
        });

        // Đảm bảo thời gian loading tối thiểu
        const elapsed = Date.now() - loadingStartTime;
        const remainingDelay = Math.max(0, minLoadingTime - elapsed);
        
        await new Promise(resolve => setTimeout(resolve, remainingDelay));

        // Thay thế loading bằng nội dung thực
        tbody.empty().append(rows.join(''));

        // Hiệu ứng xuất hiện từng hàng
        tbody.find('tr').each(function(index) {
            $(this).delay(50 * index).animate({
                opacity: 1,
                translateY: 0
            }, 300, function() {
                // Hiệu ứng cho progress bar sau khi hàng xuất hiện
                $(this).find('.progress-bar').each(function() {
                    const percent = $(this).data('percent');
                    $(this).animate({
                        width: percent + '%'
                    }, 600, 'easeOutQuad');
                });
            });
        });

    } catch (error) {
        console.error('Lỗi khi cập nhật bảng:', error);
        const elapsed = Date.now() - loadingStartTime;
        const remainingDelay = Math.max(0, minLoadingTime - elapsed);
        
        await new Promise(resolve => setTimeout(resolve, remainingDelay));

        tbody.empty().append(`
            <tr class="text-center">
                <td colspan="6">
                    <div class="d-flex flex-column align-items-center justify-content-center py-5">
                        <i class="fas fa-exclamation-triangle fs-1 text-danger mb-3"></i>
                        <span class="text-danger">Đã xảy ra lỗi khi tải dữ liệu</span>
                    </div>
                </td>
            </tr>
        `);
    }
}

// Thêm easing function nếu chưa có
$.extend($.easing, {
    easeOutQuad: function(x, t, b, c, d) {
        return -c * (t /= d) * (t - 2) + b;
    }
});




// Hàm vẽ biểu đồ
function renderCharts(chartData) {
    
    // Kiểm tra dữ liệu đầu vào
    console.log('Chart data received:', chartData);
    
    // Xử lý trường hợp dữ liệu null/undefined
    if (!chartData || !chartData.countries || !chartData.call_rates || !chartData.data_rates) {
        console.error('Invalid chart data format');
        return;
    }

    // Biểu đồ cột - Phân bố cước theo quốc gia
    const countryCanvas = document.getElementById('countryRateChart');
    if (!countryCanvas) {
        console.error('Canvas element #countryRateChart not found');
        return;
    }
    
    const countryCtx = countryCanvas.getContext('2d');
    
    // Hủy biểu đồ cũ nếu tồn tại
    if (!window.countryRateChart) {
    const ctx = document.getElementById('countryRateChart').getContext('2d');
    window.countryRateChart = new Chart(ctx, {
        type: 'bar',
     
    });
}

    // Tạo biểu đồ mới
    window.countryRateChart = new Chart(countryCtx, {
        type: 'bar',
        data: {
            labels: chartData.countries,
            datasets: [
                {
                    label: 'Gọi về VN (VNĐ/phút)',
                    data: chartData.call_rates,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Data (VNĐ/MB)',
                    data: chartData.data_rates,
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Thêm dòng này để biểu đồ co giãn theo container
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return formatCurrency(value);
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += formatCurrency(context.raw);
                            return label;
                        }
                    }
                }
            }
        }
    });

   // Kiểm tra dữ liệu đầu vào
console.log('Full API Response:', chartData);
console.log('Subscription Types Data:', chartData.subscription_types);

// Biểu đồ tròn - Tỷ lệ loại thuê bao
const subscriptionCanvas = document.getElementById('subscriptionTypeChart');
if (!subscriptionCanvas) {
    console.error('Canvas element #subscriptionTypeChart not found');
    return;
}

const subscriptionCtx = subscriptionCanvas.getContext('2d');

// Hủy biểu đồ cũ nếu có
if (window.subscriptionTypeChart instanceof Chart) {
    window.subscriptionTypeChart.destroy();
}

// Kiểm tra xem dữ liệu có phải object không, nếu có thì chuyển đổi thành array
let subscriptionData;
if (Array.isArray(chartData.subscription_types)) {
    subscriptionData = chartData.subscription_types.map(Number);
} else if (typeof chartData.subscription_types === 'object') {
    subscriptionData = Object.values(chartData.subscription_types).map(Number);
} else {
    console.error('Invalid subscription types data: Unexpected format.');
    return;
}

// Kiểm tra số lượng phần tử
if (subscriptionData.length !== 2) {
    console.error('Invalid subscription types data: Expected exactly 2 values.', subscriptionData);
    return;
}

// Tạo biểu đồ mới
window.subscriptionTypeChart = new Chart(subscriptionCtx, {
    type: 'pie',
    data: {
        labels: ['Trả trước', 'Trả sau'],
        datasets: [{
            data: subscriptionData,
            backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(153, 102, 255, 0.7)'],
            borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.raw || 0;
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = Math.round((value / total) * 100);
                        return `${label}: ${value} thuê bao (${percentage}%)`;
                    }
                }
            }
        }
    }
});

}

// Hàm load dữ liệu dashboard
function loadDashboardData() {
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
              // Trong hàm loadDashboardData, cập nhật phần hiển thị thống kê
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
            <div class="fs-5 fw-semibold">${formatCurrency(data.average_rates?.call || 0)}/ph</div>
            <div class="text-muted small">Cước gọi TB</div>
        </div>
    </div>
`);

$('#avg-data-rate').html(`
    <div class="d-flex align-items-center">
        <i class="fas fa-database me-3 fs-2 text-warning"></i>
        <div>
            <div class="fs-5 fw-semibold">${formatCurrency(data.average_rates?.data || 0)}/MB</div>
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
                    renderCharts(data.chart_data);
                }
                
                // Cập nhật bảng top quốc gia
                if (data.top_countries) {
                    updateTopCountriesTable(data.top_countries);
                }
            } else {
                showErrorToast(response.message || 'Lỗi không xác định');
            }
        },
        error: function(xhr) {
            console.error('Request failed:', xhr.responseText);
            showErrorToast('Lỗi kết nối đến server');
        },
        complete: function() {
            $('#loadingToast').toast('hide');
        }
    });
}

// Lọc top quốc gia theo loại cước
// Lọc top quốc gia với giao diện đẹp hơn
$(document).on('click', '#topRateFilter .dropdown-item', function(e) {
    e.preventDefault();
    const type = $(this).data('type');
    const iconClass = {
        'call': 'fa-phone',
        'data': 'fa-database',
        'sms': 'fa-comment',
        'total': 'fa-star'
    }[type] || 'fa-filter';
    
    $('#topRateFilter .dropdown-item').removeClass('active');
    $(this).addClass('active');
    $('#topRateFilter').html(`
        <i class="fas ${iconClass} me-1"></i> 
        ${$(this).text()} 
        <i class="fas fa-caret-down ms-2"></i>
    `);
    
    // Thêm hiệu ứng loading
    const originalText = $('#topCountriesTable .card-title').text();
    $('#topCountriesTable .card-title').html(`
        ${originalText} 
        <span class="spinner-border spinner-border-sm ms-2" role="status"></span>
    `);
    
    $.get(`/admin/cuoc-quoc-te/top-countries?type=${type}`, function(data) {
        if (data.status === 'success') {
            updateTopCountriesTable(data.data || data);
        } else {
            showErrorToast(data.message || 'Lỗi khi lọc dữ liệu');
        }
    }).fail(function() {
        showErrorToast('Lỗi kết nối khi lọc dữ liệu');
    }).always(function() {
        $('#topCountriesTable .card-title').text(originalText);
    });
});

// Khởi tạo dashboard khi trang được tải
$(document).ready(function() {
    // Kiểm tra xem các thư viện cần thiết đã được load chưa
    if (typeof $ === 'undefined' || typeof Chart === 'undefined') {
        showErrorToast('Các thư viện cần thiết chưa được tải!');
        return;
    }
    
    loadDashboardData();
    
    // Cập nhật dữ liệu mỗi 5 phút
    setInterval(loadDashboardData, 300000);
});

