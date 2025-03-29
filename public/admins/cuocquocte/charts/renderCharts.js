// charts/renderCharts.js
import helpers from '../helpers/format.js';

const charts = {};

// Hàm vẽ biểu đồ
charts.renderCharts = function(chartData) {
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
    if (window.countryRateChart && typeof window.countryRateChart.destroy === 'function') {
        window.countryRateChart.destroy();
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
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return helpers.formatCurrency(value);
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
                            label += helpers.formatCurrency(context.raw);
                            return label;
                        }
                    }
                }
            }
        }
    });

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

    // Kiểm tra và chuyển đổi dữ liệu
    let subscriptionData;
    if (Array.isArray(chartData.subscription_types)) {
        subscriptionData = chartData.subscription_types.map(Number);
    } else if (typeof chartData.subscription_types === 'object') {
        subscriptionData = Object.values(chartData.subscription_types).map(Number);
    } else {
        console.error('Invalid subscription types data: Unexpected format.');
        return;
    }

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
};

export default charts;