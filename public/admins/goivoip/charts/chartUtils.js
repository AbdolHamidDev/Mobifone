// Lưu trữ chart instances
export const chartInstances = {};

/**
 * Hủy biểu đồ nếu đã tồn tại
 * @param {string} chartId - ID của canvas biểu đồ
 */
export function destroyChart(chartId) {
    if (chartInstances[chartId]) {
        try {
            chartInstances[chartId].destroy();
            delete chartInstances[chartId];
            
            const canvas = document.getElementById(chartId);
            if (canvas) {
                canvas.width = canvas.width;
                canvas.height = canvas.height;
            }
        } catch (error) {
            console.error(`Error destroying chart ${chartId}:`, error);
        }
    }
}

/**
 * Kiểm tra dữ liệu trước khi vẽ biểu đồ
 * @param {Array} labels - Mảng nhãn
 * @param {Array} data - Mảng dữ liệu
 * @returns {boolean} Kết quả kiểm tra
 */
export function validateChartData(labels, data) {
    if (!Array.isArray(labels) || !Array.isArray(data)) {
        console.error('Cả labels và data phải là mảng');
        return false;
    }
    
    if (labels.length !== data.length) {
        console.error('Labels và data phải có cùng độ dài');
        return false;
    }
    
    const isValid = data.every(item => {
        return !isNaN(parseFloat(item)) || item === null || item === undefined;
    });
    
    if (!isValid) {
        console.error('Dữ liệu chứa giá trị không phải số');
        return false;
    }
    
    return true;
}

/**
 * Làm sạch dữ liệu cho biểu đồ
 * @param {Array} data - Mảng dữ liệu cần làm sạch
 * @returns {Array} Mảng dữ liệu đã làm sạch
 */
export function cleanChartData(data) {
    return data.map(item => {
        const num = parseFloat(item);
        return isNaN(num) ? 0 : num;
    });
}

/**
 * Lấy tùy chọn mặc định cho biểu đồ
 * @returns {Object} Cấu hình mặc định
 */
export function getDefaultOptions() {
    return {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
                labels: {
                    usePointStyle: true,
                    padding: 20,
                    font: {
                        family: 'Inter',
                        size: 12
                    }
                }
            },
            tooltip: {
                backgroundColor: '#2d3748',
                titleFont: {
                    family: 'Inter',
                    size: 14,
                    weight: '600'
                },
                bodyFont: {
                    family: 'Inter',
                    size: 12
                },
                padding: 12,
                cornerRadius: 8,
                displayColors: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    drawBorder: false,
                    color: '#e2e8f0'
                },
                ticks: {
                    font: {
                        family: 'Inter'
                    }
                }
            },
            x: {
                grid: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    font: {
                        family: 'Inter'
                    }
                }
            }
        }
    };
}

/**
 * Tạo danh sách màu
 * @param {number} count - Số lượng màu cần tạo
 * @returns {Array} Mảng màu
 */
export function generateColors(count) {
    const palette = [
        '#4E79A7', // Xanh dương nhạt
        '#F28E2B', // Cam
        '#E15759', // Đỏ nhạt
        '#76B7B2', // Xanh ngọc
        '#59A14F', // Xanh lá
        '#EDC948', // Vàng
        '#B07AA1', // Tím
        '#FF9DA7', // Hồng
        '#9C755F', // Nâu
        '#BAB0AC'  // Xám
    ];
    
    // Nếu cần nhiều màu hơn palette, tự động generate
    if (count > palette.length) {
        for (let i = palette.length; i < count; i++) {
            const hue = Math.floor((i * 360 / count) % 360);
            palette.push(`hsl(${hue}, 65%, 65%)`);
        }
    }
    
    return palette.slice(0, count);
}