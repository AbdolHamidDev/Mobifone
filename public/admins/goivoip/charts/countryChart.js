import { chartInstances, destroyChart, validateChartData, cleanChartData, generateColors } from './chartUtils.js';

/**
 * Khởi tạo biểu đồ quốc gia
 * @param {Array} labels - Mảng tên quốc gia
 * @param {Array} data - Mảng dữ liệu tương ứng
 * @returns {Object|null} Chart instance hoặc null nếu có lỗi
 */
export function initCountryChart(labels, data) {
    const chartId = 'countryChart';
    const canvas = document.getElementById(chartId);
    
    if (!canvas) {
        console.error(`Không tìm thấy canvas với ID ${chartId}`);
        return null;
    }
    
    // Làm sạch dữ liệu
    const cleanData = cleanChartData(data);
    const cleanLabels = Array.isArray(labels) ? labels.map(String) : [];
    
    if (!validateChartData(cleanLabels, cleanData)) {
        console.error('Dữ liệu biểu đồ không hợp lệ', {labels, data});
        return null;
    }
    
    try {
        // Hủy biểu đồ cũ nếu tồn tại
        destroyChart(chartId);
        
        // Tạo biểu đồ mới
        const ctx = canvas.getContext('2d');
        
        // Đảm bảo có ít nhất 1 giá trị dữ liệu
        if (cleanData.length === 0) {
            cleanData.push(1);
            cleanLabels.push('Không có dữ liệu');
        }
        
        const config = {
            type: 'doughnut',
            data: {
                labels: cleanLabels,
                datasets: [{
                    data: cleanData,
                    backgroundColor: generateColors(cleanData.length),
                    borderWidth: 1,
                    borderColor: '#fff',
                    hoverBorderWidth: 2,
                    hoverBorderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 16,
                            font: {
                                family: 'Inter',
                                size: 12,
                                weight: '500'
                            },
                            color: '#4a5568',
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map((label, i) => {
                                        const value = data.datasets[0].data[i];
                                        const percentage = Math.round((value / chart.getDatasetMeta(0).total) * 100);
                                        
                                        return {
                                            text: `${label} (${percentage}%)`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            strokeStyle: data.datasets[0].borderColor,
                                            lineWidth: data.datasets[0].borderWidth,
                                            hidden: isNaN(data.datasets[0].data[i]) || chart.getDatasetMeta(0).data[i].hidden,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        },
                        onHover: function(event, legendItem) {
                            document.getElementById(chartId).style.cursor = 'pointer';
                        },
                        onLeave: function(event, legendItem) {
                            document.getElementById(chartId).style.cursor = 'default';
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
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
                        cornerRadius: 6,
                        displayColors: true,
                        boxPadding: 6,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                    duration: 1000
                }
            }
        };
        
        // Thêm hiệu ứng khi hover
        canvas.onmouseover = function() {
            if (chartInstances[chartId]) {
                chartInstances[chartId].update();
            }
        };
        
        chartInstances[chartId] = new Chart(ctx, config);
        return chartInstances[chartId];
    } catch (error) {
        console.error('Lỗi khi khởi tạo biểu đồ quốc gia:', error);
        destroyChart(chartId);
        return null;
    }
}