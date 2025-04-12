import { chartInstances, destroyChart, validateChartData, cleanChartData } from './chartUtils.js';

/**
 * Khởi tạo biểu đồ giá mỗi giây
 * @param {Array} labels - Mảng nhãn vùng
 * @param {Array} data - Mảng dữ liệu tương ứng
 * @returns {Object|null} Chart instance hoặc null nếu có lỗi
 */
export function initPricePerSecondChart(labels, data) {
    const chartId = 'pricePerSecondChart';
    const canvas = document.getElementById(chartId);
    
    if (!canvas) {
        console.error(`Không tìm thấy canvas với ID ${chartId}`);
        return null;
    }
    
    const cleanData = cleanChartData(data);
    const cleanLabels = Array.isArray(labels) ? labels.map(String) : [];
    
    if (!validateChartData(cleanLabels, cleanData)) {
        console.error('Dữ liệu biểu đồ không hợp lệ', {labels, data});
        return null;
    }
    
    try {
        destroyChart(chartId);
        
        const ctx = canvas.getContext('2d');
        chartInstances[chartId] = new Chart(ctx, {
            type: 'line',
            data: {
                labels: cleanLabels,
                datasets: [{
                    label: 'Giá mỗi giây (VNĐ)',
                    data: cleanData,
                    borderColor: '#f72585',
                    backgroundColor: 'rgba(247, 37, 133, 0.05)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#f72585',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
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
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y} VNĐ`;
                            }
                        }
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
                            },
                            callback: function(value) {
                                return `${value} VNĐ`;
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
            }
        });
        
        return chartInstances[chartId];
    } catch (error) {
        console.error('Lỗi khi khởi tạo biểu đồ giá mỗi giây:', error);
        destroyChart(chartId);
        return null;
    }
}