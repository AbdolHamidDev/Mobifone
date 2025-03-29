// Khai báo biến toàn cục
let cuocPhiTable;

// Hàm định dạng tiền tệ
function formatCurrency(num) {
    if (!num) return '0';
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

// Hàm hiển thị toast lỗi
function showErrorToast(message) {
    const toast = `<div class="toast-error animate__animated animate__fadeInDown">
        <div class="toast-icon"><i class="fas fa-exclamation-circle"></i></div>
        <div class="toast-message">${message}</div>
    </div>`;
    
    $('.modal-body').prepend(toast);
    
    setTimeout(() => {
        $('.toast-error').addClass('animate__fadeOutUp');
        setTimeout(() => $('.toast-error').remove(), 500);
    }, 3000);
}

// Hàm khởi tạo DataTable
function initializeDataTable() {
    cuocPhiTable = $('#cuocPhiTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#cuocPhiTable").data('url') || "/admin/goi-voip-cuoc-phi",
            dataSrc: function(json) {
                $('.table-info').html(`Hiển thị ${json.start} đến ${json.end} của ${json.recordsTotal} bản ghi`);
                return json.data;
            }
        },
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Tìm kiếm...",
            lengthMenu: "Hiển thị _MENU_ bản ghi",
            info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            infoEmpty: "Không có bản ghi nào",
            infoFiltered: "(lọc từ _MAX_ bản ghi)",
            paginate: {
                first: "Đầu",
                last: "Cuối",
                next: "Tiếp",
                previous: "Trước"
            }
        },
        columns: [
            { 
                data: 'id', 
                name: 'id',
                className: 'text-center'
            },
            { 
                data: 'quoc_gia.ten_quoc_gia', 
                name: 'quoc_gia_id',
                render: function(data, type, row) {
                    return data ? `<span class="badge badge-light border">${data}</span>` : '-';
                }
            },
            { 
                data: 'nhom_cuoc', 
                name: 'nhom_cuoc',
                render: function(data) {
                    return `<span class="font-weight-bold">${data}</span>`;
                }
            },
            { 
                data: 'ma_vung', 
                name: 'ma_vung',
                render: function(data) {
                    return data ? `<code>${data}</code>` : '-';
                }
            },
            { 
                data: 'block_6s_dau', 
                name: 'block_6s_dau',
                className: 'text-right',
                render: function(data) {
                    return data ? formatCurrency(data) + ' VNĐ' : '-';
                }
            },
            { 
                data: 'gia_moi_giay', 
                name: 'gia_moi_giay',
                className: 'text-right',
                render: function(data) {
                    return data ? formatCurrency(data) + ' VNĐ' : '-';
                }
            },
            { 
                data: 'gia_1_phut_dau', 
                name: 'gia_1_phut_dau',
                className: 'text-right',
                render: function(data) {
                    return data ? formatCurrency(data) + ' VNĐ' : '-';
                }
            },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-sm btn-outline-primary btn-action edit-btn" data-id="${row.id}" title="Sửa">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger btn-action delete-btn" data-id="${row.id}" title="Xóa">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    `;
                }
            }
        ],
        initComplete: function() {
            $('table tbody tr').addClass('animate__animated animate__fadeIn');
        },
        drawCallback: function() {
            $('table tbody tr').each(function(i) {
                $(this).css('animation-delay', (i * 0.05) + 's');
            });
        }
    });
}

// Hàm khởi tạo Select2 với flag
function initializeSelect2() {
    function formatState(state) {
        if (!state.id) return state.text;
        const flagCode = $(state.element).data('flag') || 'vn';
        return $(
            `<div class="d-flex align-items-center">
                <span class="flag-icon flag-icon-${flagCode.toLowerCase()} mr-2"></span>
                <span>${state.text}</span>
            </div>`
        );
    }

    $('.select2-with-flag').select2({
        templateResult: formatState,
        templateSelection: formatState,
        placeholder: "Chọn quốc gia",
        width: '100%',
        dropdownParent: $('#modal-cuoc-voip'),
        language: {
            noResults: function() {
                return "Không tìm thấy quốc gia";
            }
        }
    });
}

// Hàm tính toán xem trước giá cước
function calculatePricePreview() {
    const block6s = parseFloat($('#block_6s_dau').val()) || 0;
    const perSecond = parseFloat($('#gia_moi_giay').val()) || 0;
    const firstMinute = parseFloat($('#gia_1_phut_dau').val()) || 0;
    const nextMinute = parseFloat($('#gia_1_phut_tiep_theo').val()) || 0;
    
    const call30s = block6s + (perSecond * 24);
    const call1m = firstMinute;
    const call5m = firstMinute + (nextMinute * 4);
    
    $('#preview-30s').text(formatCurrency(call30s) + ' VNĐ');
    $('#preview-1m').text(formatCurrency(call1m) + ' VNĐ');
    $('#preview-5m').text(formatCurrency(call5m) + ' VNĐ');
}

// Hàm xử lý sự kiện modal
function setupModalEvents() {
    $('#modal-cuoc-voip').on('shown.bs.modal', function() {
        $('.form-step').removeClass('active').hide();
        $('.form-step[data-step="1"]').addClass('active').show();
        
        $('.step').removeClass('active completed');
        $('.step[data-step="1"]').addClass('active');
        
        $('#btn-next-step').show();
        $('#btn-save').addClass('d-none');
        
        // Fix Select2 trong modal
        $(this).find('.select2-with-flag').select2('open');
        $(this).find('.select2-with-flag').select2('close');
    });
    
    $('#modal-cuoc-voip').on('hidden.bs.modal', function() {
        $('#form-cuoc-voip')[0].reset();
    });
}

// Hàm xử lý form steps
function setupFormSteps() {
    $('#btn-next-step').click(function() {
        const currentStep = $('.form-step.active').data('step');
        const nextStep = currentStep + 1;
        
        if (currentStep === 1) {
            if (!$('#nhom_cuoc').val()) {
                $('#nhom_cuoc').focus();
                showErrorToast('Vui lòng nhập nhóm cước');
                return;
            }
        }
        
        $('.form-step[data-step="' + currentStep + '"]').removeClass('active').hide();
        $('.form-step[data-step="' + nextStep + '"]').addClass('active').show();
        
        $('.step').removeClass('active');
        $('.step[data-step="' + currentStep + '"]').addClass('completed');
        $('.step[data-step="' + nextStep + '"]').addClass('active');
        
        if (nextStep === 2) {
            $(this).hide();
            $('#btn-save').removeClass('d-none');
        }
    });
}

// Hàm xử lý sự kiện nút thêm/sửa/xóa
function setupButtonEvents() {
    // Nút thêm mới
    $('#btn-add').click(function() {
        $('#modal-title').text('Thêm Cước VoIP');
        $('#modal-cuoc-voip').modal('show');
        $('#cuoc_voip_id').val('');
        $('#form-cuoc-voip')[0].reset();
    });

    // Nút sửa
    $(document).on('click', '.edit-btn', function() {
        const id = $(this).data('id');
        $('.loading-overlay').show();
        
        $.get("/admin/goi-voip-cuoc-phi/" + id + "/edit", function(data) {
            $('#modal-title').text('Sửa Cước VoIP');
            $('#modal-cuoc-voip').modal('show');
            $('#cuoc_voip_id').val(data.id);
            $('#select-quoc-gia').val(data.quoc_gia_id).trigger('change');
            $('#nhom_cuoc').val(data.nhom_cuoc);
            $('#ma_vung').val(data.ma_vung);
            $('#block_6s_dau').val(data.block_6s_dau);
            $('#gia_moi_giay').val(data.gia_moi_giay);
            $('#gia_1_phut_dau').val(data.gia_1_phut_dau);
            $('#gia_1_phut_tiep_theo').val(data.gia_1_phut_tiep_theo);
            
            $('.loading-overlay').hide();
        }).fail(function() {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Không thể tải dữ liệu để chỉnh sửa',
                timer: 2000,
                showConfirmButton: false
            });
            $('.loading-overlay').hide();
        });
    });

    // Submit form
    $('#form-cuoc-voip').submit(function(e) {
        e.preventDefault();
        const id = $('#cuoc_voip_id').val();
        const url = id ? "/admin/goi-voip-cuoc-phi/" + id : "/admin/goi-voip-cuoc-phi";
        const method = id ? "PUT" : "POST";
        
        $('#btn-save').html('<i class="fas fa-spinner fa-spin mr-1"></i> Đang lưu...').prop('disabled', true);
        
        $.ajax({
            url: url,
            type: method,
            data: $(this).serialize(),
            success: function(response) {
                $('#modal-cuoc-voip').modal('hide');
                cuocPhiTable.ajax.reload(null, false);
                
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                    background: '#f8f9fa',
                    animation: true
                });
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                let errorMessages = 'Có lỗi xảy ra khi lưu dữ liệu';
                
                if (errors) {
                    errorMessages = Object.values(errors).join('<br>');
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi nhập liệu',
                    html: errorMessages,
                    confirmButtonText: 'Đóng'
                });
            },
            complete: function() {
                $('#btn-save').html('<i class="fas fa-save mr-1"></i> Lưu').prop('disabled', false);
            }
        });
    });

    // Nút xóa
    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Xác nhận xóa?',
            text: "Bạn có chắc chắn muốn xóa gói cước này?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy',
            customClass: {
                popup: 'animate__animated animate__zoomIn'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('.loading-overlay').show();
                
                $.ajax({
                    url: "/admin/goi-voip-cuoc-phi/" + id,
                    type: "DELETE",
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        cuocPhiTable.ajax.reload(null, false);
                        
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                            background: '#f8f9fa',
                            animation: true
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Không thể xóa gói cước này',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    complete: function() {
                        $('.loading-overlay').hide();
                    }
                });
            }
        });
    });
}

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




document.addEventListener('DOMContentLoaded', function () {
    // Load data from APIs
    loadDashboardData();
    loadPricingData();
    
    // Set up event listeners
    setupEventListeners();
});

function loadDashboardData() {
    fetch(urlDashboard)
        .then(response => response.json())
        .then(data => {
            // Update overview cards
            document.getElementById('totalCountries').textContent = data.totalCountries;
            document.getElementById('totalGroups').textContent = data.totalGroups;
            document.getElementById('totalPackages').textContent = data.totalPackages;
            
            // Initialize charts
            initCountryChart(data.countryLabels, data.countryData);
            initGroupChart(data.groupLabels, data.groupData);
        })
        .catch(error => console.error('Error loading dashboard data:', error));
}

function loadPricingData() {
    fetch(urlDashboard1)
        .then(response => response.json())
        .then(data => {
            // Update pricing cards
            document.getElementById('totalRegions').textContent = data.totalRegions;
            document.getElementById('avgBlock6s').textContent = data.avgBlock6s + ' VNĐ';
            document.getElementById('avgPricePerSecond').textContent = data.avgPricePerSecond + ' VNĐ';
            document.getElementById('avgPriceFirstMinute').textContent = data.avgPriceFirstMinute + ' VNĐ';
            
            // Initialize pricing charts
            initBlock6sChart(data.regionLabels, data.block6sData);
            initPricePerSecondChart(data.regionLabels, data.pricePerSecondData);
        })
        .catch(error => console.error('Error loading pricing data:', error));
}

function setupEventListeners() {
    // Refresh button
    document.querySelector('.btn-refresh').addEventListener('click', function() {
        loadDashboardData();
        loadPricingData();
        
        // Show loading state
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
        }, 1000);
    });
    
    // Chart period buttons
    document.querySelectorAll('.btn-chart-action').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons in this group
            this.parentElement.querySelectorAll('.btn-chart-action').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Here you would typically reload chart data for the selected period
            // For now we'll just simulate it with a console log
            console.log('Selected period:', this.textContent);
        });
    });
}





//                          KHU VỰC CHART


// Biến lưu trữ các chart instance
const chartInstances = {};

function destroyChart(chartId) {
    if (chartInstances[chartId]) {
        try {
            chartInstances[chartId].destroy();
            // Xóa tham chiếu đến chart cũ
            delete chartInstances[chartId];
            
            // Đặt lại canvas (quan trọng)
            const canvas = document.getElementById(chartId);
            if (canvas) {
                // Xóa tất cả các thuộc tính và sự kiện
                canvas.width = canvas.width;
                canvas.height = canvas.height;
            }
        } catch (error) {
            console.error(`Error destroying chart ${chartId}:`, error);
        }
    }
}

// Hàm kiểm tra dữ liệu trước khi vẽ biểu đồ
function validateChartData(labels, data) {
    // Kiểm tra cả labels và data phải là mảng
    if (!Array.isArray(labels) || !Array.isArray(data)) {
        console.error('Cả labels và data phải là mảng');
        return false;
    }
    
    // Kiểm tra độ dài mảng
    if (labels.length !== data.length) {
        console.error('Labels và data phải có cùng độ dài');
        return false;
    }
    
    // Kiểm tra dữ liệu có hợp lệ không
    const isValid = data.every(item => {
        // Cho phép số, chuỗi số, hoặc null/undefined (sẽ chuyển thành 0)
        return !isNaN(parseFloat(item)) || item === null || item === undefined;
    });
    
    if (!isValid) {
        console.error('Dữ liệu chứa giá trị không phải số');
        return false;
    }
    
    return true;
}

function cleanChartData(data) {
    return data.map(item => {
        // Chuyển đổi thành số, nếu không được thì thành 0
        const num = parseFloat(item);
        return isNaN(num) ? 0 : num;
    });
}

function initCountryChart(labels, data) {
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
        
        // Tạo palette màu chuyên nghiệp hơn
        const generateColors = (count) => {
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
        };
        
        const config = {
            type: 'doughnut', // Thay pie bằng doughnut để đẹp hơn
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
                cutout: '65%', // Giảm cutout để trông chắc chắn hơn
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
                // Hiệu ứng hover đẹp hơn
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                // Animation mượt mà hơn
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
function initGroupChart(labels, data) {
    const chartId = 'groupChart';
    const canvas = document.getElementById(chartId);
    
    if (!canvas) {
        console.error(`Canvas element with ID ${chartId} not found`);
        return;
    }
    
    if (!validateChartData(labels, data)) {
        return;
    }
    
    try {
        destroyChart(chartId);
        
        const ctx = canvas.getContext('2d');
        chartInstances[chartId] = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Số lượng',
                    data: data,
                    backgroundColor: '#4cc9f0',
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
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
                        cornerRadius: 8
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
            }
        });
    } catch (error) {
        console.error('Error initializing group chart:', error);
    }
}

function initBlock6sChart(labels, data) {
    const chartId = 'block6sChart';
    const canvas = document.getElementById(chartId);
    
    if (!canvas) {
        console.error(`Canvas element with ID ${chartId} not found`);
        return;
    }
    
    if (!validateChartData(labels, data)) {
        return;
    }
    
    try {
        destroyChart(chartId);
        
        const ctx = canvas.getContext('2d');
        chartInstances[chartId] = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Block 6s đầu (VNĐ)',
                    data: data,
                    backgroundColor: '#4361ee',
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
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
                        cornerRadius: 8
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
                                return value + ' VNĐ';
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
    } catch (error) {
        console.error('Error initializing block6s chart:', error);
    }
}

function initPricePerSecondChart(labels, data) {
    const chartId = 'pricePerSecondChart';
    const canvas = document.getElementById(chartId);
    
    if (!canvas) {
        console.error(`Canvas element with ID ${chartId} not found`);
        return;
    }
    
    if (!validateChartData(labels, data)) {
        return;
    }
    
    try {
        destroyChart(chartId);
        
        const ctx = canvas.getContext('2d');
        chartInstances[chartId] = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Giá mỗi giây (VNĐ)',
                    data: data,
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
                    legend: {
                        display: false
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
                        cornerRadius: 8
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
                                return value + ' VNĐ';
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
    } catch (error) {
        console.error('Error initializing price per second chart:', error);
    }
}

// Hàm xử lý lỗi timeout khi load dữ liệu
function handleDataLoadError(error) {
    console.error('Error loading data:', error);
    
    // Kiểm tra xem thông báo lỗi đã tồn tại chưa
    if (document.querySelector('.error-message')) return;
    
    const errorMessage = document.createElement('div');
    errorMessage.className = 'error-message';
    errorMessage.innerHTML = `
        <i class="fas fa-exclamation-triangle"></i>
        <span>Không thể tải dữ liệu. Vui lòng thử lại sau.</span>
        <button class="btn-retry">Thử lại</button>
    `;
    
    const dashboardContent = document.querySelector('.dashboard-content');
    if (dashboardContent) {
        dashboardContent.prepend(errorMessage);
        
        // Thêm sự kiện click cho nút thử lại
        document.querySelector('.btn-retry').addEventListener('click', function() {
            errorMessage.remove();
            // Gọi lại các hàm load dữ liệu
            if (typeof loadDashboardData === 'function') loadDashboardData();
            if (typeof loadPricingData === 'function') loadPricingData();
        });
    }
}

// Thêm kiểm tra và cấu hình mặc định cho options
function getDefaultOptions() {
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


