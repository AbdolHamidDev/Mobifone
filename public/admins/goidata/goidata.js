document.addEventListener('DOMContentLoaded', function () {
    // Khởi tạo DataTable với cấu hình nâng cao
    const dataTable = $('#goidatasTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: routes.api,
            type: 'GET',
            dataSrc: function (json) {
                // Xử lý dữ liệu trả về nếu cần
                console.debug('Dữ liệu từ API:', json);
                return json.data || [];
            },
            error: function (xhr, error, thrown) {
                console.error('Lỗi khi tải dữ liệu:', error);
                showDataTableError();
            }
        },
        responsive: true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
        pageLength: 25,
        order: [[0, 'desc']], // Sắp xếp mặc định theo ID giảm dần
        columns: [
            { 
                data: 'id', 
                name: 'id',
                className: 'text-center',
                width: '5%'
            },
            { 
                data: 'ten_data', 
                name: 'ten_data',
                render: function(data, type, row) {
                    return `<span class="fw-semibold">${data}</span>`;
                }
            },
            { 
                data: 'gia', 
                name: 'gia', 
                className: 'text-end',
                render: $.fn.dataTable.render.number(',', '.', 0, '', ' ₫'),
                type: 'num' // Để sắp xếp số đúng cách
            },
            { 
                data: 'thoi_gian', 
                name: 'thoi_gian', 
                className: 'text-center',
                render: (data) => `<span class="badge bg-light text-dark">${data} ngày</span>`
            },
            {
                data: 'dung_luong',
                name: 'dung_luong',
                className: 'text-center',
                render: function(data, type, row) {
                    const unit = row.don_vi_dung_luong || 'MB'; // Gán 'MB' nếu không có đơn vị
                    
                    // Kiểm tra dữ liệu dung lượng
                    let converted = data !== undefined ? data : 0; // Gán 0 nếu không có giá trị dung lượng
            
                    // Kiểm tra đơn vị dung lượng
                    if (unit === 'GB') {
                        converted = data.toFixed(2); // Chuyển đổi khi là GB
                    } else if (unit === 'MB') {
                        // Không cần chuyển đổi nếu là MB
                        converted = data;
                    }
            
                    return `
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="data-capacity-badge">
                                ${converted} ${unit}
                            </span>
                        </div>
                    `;
                }
            }
            ,
            { 
                data: 'loai_data', 
                name: 'loai_data',
                className: 'text-center',
                render: function(data) {
                    const typeMap = {
                        'mien_phi_mxh': { text: 'MXH Miễn phí', class: 'bg-info' },
                        'dai_ky': { text: 'Dài kỳ', class: 'bg-primary' },
                        'data_bo_sung': { text: 'Bổ sung', class: 'bg-warning text-dark' },
                        'thang': { text: 'Theo tháng', class: 'bg-secondary' },
                        'data_thuong': { text: 'Thông thường', class: 'bg-light text-dark' },
                        'ngay': { text: 'Theo ngày', class: 'bg-dark' },
                        'data_fastconnect': { text: 'Fastconnect', class: 'bg-purple' }
                    };
                    const typeInfo = typeMap[data] || { text: data, class: 'bg-light text-dark' };
                    return `<span class="badge ${typeInfo.class}">${typeInfo.text}</span>`;
                }
            },
            {
                data: 'status',
                name: 'status',
                className: 'text-center',
                render: function (data, type, row) {
                    const badgeClass = data === 'active' ? 'bg-success' : 'bg-danger';
                    const statusText = data === 'active' ? 'Kích hoạt' : 'Tạm dừng';
                    const icon = data === 'active' ? 'fa-toggle-on' : 'fa-toggle-off';
                    return `
                        <button type="button" class="btn btn-status ${badgeClass} btn-sm" 
                            data-id="${row.id}" 
                            data-status="${data}"
                            title="Nhấn để thay đổi trạng thái">
                            <i class="fas ${icon} me-1"></i> ${statusText}
                        </button>
                    `;
                }
            },
            {
                data: 'id',
                name: 'actions',
                className: 'text-center',
                orderable: false,
                searchable: false,
                width: '20%',
                render: (data, type, row) => `
                    <div class="d-flex justify-content-center btn-action-group">
                        <button type="button" class="btn btn-action btn-view" 
                            data-id="${data}"
                            title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-action btn-edit" 
                            data-id="${data}"
                            title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-action btn-delete" 
                            data-id="${data}"
                            title="Xóa">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                `
            }
        ],
        language: {
            processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
            lengthMenu: "Hiển thị _MENU_ bản ghi",
            zeroRecords: "<div class='text-center py-4'>Không tìm thấy dữ liệu phù hợp</div>",
            info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            infoEmpty: "Hiển thị 0 đến 0 của 0 bản ghi",
            infoFiltered: "(đã lọc từ _MAX_ bản ghi)",
            search: "",
            searchPlaceholder: "Tìm kiếm...",
            paginate: {
                first: "<i class='fas fa-angle-double-left'></i>",
                last: "<i class='fas fa-angle-double-right'></i>",
                next: "<i class='fas fa-angle-right'></i>",
                previous: "<i class='fas fa-angle-left'></i>"
            }
        },
        initComplete: function() {
            // Thêm class cho ô search
            $('.dataTables_filter input').addClass('form-control form-control-sm');
            $('.dataTables_length select').addClass('form-select form-select-sm');
        },
        drawCallback: function() {
            // Thêm tooltip cho các button
            $('[title]').tooltip({
                placement: 'top',
                trigger: 'hover'
            });
        }
    });

    // Xử lý thay đổi trạng thái với hiệu ứng mượt mà
    $('#goidatasTable').on('click', '.btn-status', function () {
        const $btn = $(this);
        const id = $btn.data('id');
        const currentStatus = $btn.data('status');
        const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
        const statusText = newStatus === 'active' ? 'Kích hoạt' : 'Tạm dừng';

        Swal.fire({
            title: 'Xác nhận thay đổi trạng thái',
            html: `Bạn đang chuyển trạng thái gói data sang <strong>${statusText}</strong>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy bỏ',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(routes.changeStatus(id), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    );
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                // Cập nhật giao diện ngay lập tức
                $btn
                    .toggleClass('bg-success bg-danger')
                    .data('status', newStatus)
                    .find('i')
                    .toggleClass('fa-toggle-on fa-toggle-off');
                
                $btn.html(
                    `<i class="fas ${newStatus === 'active' ? 'fa-toggle-on' : 'fa-toggle-off'} me-1"></i> ${statusText}`
                );
                
                // Hiệu ứng feedback
                $btn.addClass('animate__animated animate__pulse');
                setTimeout(() => {
                    $btn.removeClass('animate__animated animate__pulse');
                }, 1000);
                
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: result.value.message || 'Trạng thái đã được cập nhật',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    });

    // Xử lý các action buttons
    $('#goidatasTable').on('click', '.btn-view', function() {
        const id = $(this).data('id');
        window.location.href = `/admin/goidatas/${id}/details`;
    });

    $('#goidatasTable').on('click', '.btn-edit', function() {
        const id = $(this).data('id');
        window.location.href = `/admin/goidatas/${id}/edit`;
    });

    $('#goidatasTable').on('click', '.btn-delete', function() {
        const id = $(this).data('id');
        confirmDelete(id);
    });

    // Xử lý submit form thêm gói data
    const goidataForm = document.getElementById('goidataForm');
    if (goidataForm) {
        goidataForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            
            const $submitBtn = $(this).find('button[type="submit"]');
            const originalBtnText = $submitBtn.html();
            
            // Hiển thị loading state
            $submitBtn.prop('disabled', true);
            $submitBtn.html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Đang xử lý...
            `);
            
            try {
                const formData = new FormData(this);
                const response = await fetch(routes.store, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.message || 'Có lỗi xảy ra');
                }
                
                // Hiển thị thông báo thành công
                await Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                
                // Reset form và reload DataTable
                this.reset();
                dataTable.ajax.reload(null, false);
                
                // Đóng modal nếu có
                const modal = bootstrap.Modal.getInstance(document.getElementById('addGoidataModal'));
                if (modal) modal.hide();
                
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    html: `<div class="text-danger">${error.message}</div>`,
                    confirmButtonText: 'Đóng'
                });
            } finally {
                // Khôi phục button
                $submitBtn.prop('disabled', false);
                $submitBtn.html(originalBtnText);
            }
        });
    }

    // Hiển thị lỗi khi tải DataTable thất bại
    function showDataTableError() {
        const $table = $('#goidatasTable');
        $table.parent().html(`
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <div>
                    Không thể tải dữ liệu. Vui lòng 
                    <a href="javascript:location.reload()" class="alert-link">tải lại trang</a>
                    hoặc liên hệ quản trị hệ thống.
                </div>
            </div>
        `);
    }
});

// Hàm xác nhận xóa
function confirmDelete(id) {
    Swal.fire({
        title: 'Bạn chắc chắn muốn xóa?',
        text: "Dữ liệu đã xóa không thể khôi phục!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(`/admin/goidatas/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                return response.json();
            })
            .catch(error => {
                Swal.showValidationMessage(
                    `Request failed: ${error}`
                );
            });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Đã xóa!',
                text: result.value.message || 'Dữ liệu đã được xóa thành công',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                $('#goidatasTable').DataTable().ajax.reload();
            });
        }
    });
}





document.addEventListener('DOMContentLoaded', function () {
    // Khởi tạo biểu đồ thống kê loại gói data
    initPackageTypeChart();
    
    // Khởi tạo biểu đồ trạng thái gói data
    initPackageStatusChart();
});

async function initPackageTypeChart() {
    const ctx = document.getElementById('goidataChart');
    if (!ctx) return;

    try {
        // Hiển thị loading state
        ctx.innerHTML = '<div class="chart-loading"><div class="spinner-border text-primary"></div><p>Đang tải dữ liệu...</p></div>';
        
        const response = await fetch(routes.api, {
            headers: { 'X-CSRF-TOKEN': csrfToken }
        });
        
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        
        const result = await response.json();
        console.debug('Dữ liệu gói data:', result);

        if (!Array.isArray(result?.data)) throw new Error('Dữ liệu không hợp lệ');

        // Xử lý dữ liệu
        const packageData = processPackageTypeData(result.data);
        
        // Tạo biểu đồ
        createPackageTypeChart(ctx, packageData);
        
    } catch (error) {
        console.error('Lỗi khi tải dữ liệu:', error);
        showChartError(ctx, 'Không thể tải dữ liệu thống kê');
    }
}

function processPackageTypeData(data) {
    // Nhóm dữ liệu theo loại gói data và tính tổng dung lượng
    const packageStats = data.reduce((acc, item) => {
        if (!acc[item.loai_data]) {
            acc[item.loai_data] = {
                count: 0,
                totalCapacity: 0
            };
        }
        acc[item.loai_data].count++;
        
        // Tính tổng dung lượng (chuyển đổi tất cả về MB)
        const capacity = item.don_vi_dung_luong === 'GB' 
            ? item.dung_luong * 1024 
            : item.dung_luong;
        acc[item.loai_data].totalCapacity += capacity;
        
        return acc;
    }, {});

    // Sắp xếp theo số lượng giảm dần
    const sortedLabels = Object.keys(packageStats).sort(
        (a, b) => packageStats[b].count - packageStats[a].count
    );

    return {
        labels: sortedLabels,
        counts: sortedLabels.map(label => packageStats[label].count),
        capacities: sortedLabels.map(label => 
            (packageStats[label].totalCapacity / 1024).toFixed(2) // Chuyển về GB
        )
    };
}

function createPackageTypeChart(ctx, {labels, counts, capacities}) {
    // Màu sắc theo chủ đề
    const colors = [
        'rgba(52, 152, 219, 0.8)', 'rgba(155, 89, 182, 0.8)',
        'rgba(26, 188, 156, 0.8)', 'rgba(241, 196, 15, 0.8)',
        'rgba(230, 126, 34, 0.8)', 'rgba(231, 76, 60, 0.8)'
    ];

    // Hiệu ứng hover
    const hoverColors = colors.map(c => c.replace('0.8', '1'));

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Số lượng gói',
                data: counts,
                backgroundColor: colors,
                borderColor: '#fff',
                borderWidth: 2,
                hoverBackgroundColor: hoverColors
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
                        font: { 
                            size: 14,
                            family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                        },
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                title: {
                    display: true,
                    text: 'Phân bố Gói Data theo Loại',
                    font: { 
                        size: 16,
                        weight: '600'
                    },
                    padding: { bottom: 20 }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const capacity = capacities[context.dataIndex];
                            return [
                                `${label}: ${value} gói`,
                                `Dung lượng TB: ${capacity} GB`
                            ];
                        }
                    }
                },
                // Hiển thị tổng số gói ở giữa biểu đồ
                doughnutCenterText: {
                    text: counts.reduce((a, b) => a + b, 0).toString(),
                    color: '#2c3e50',
                    fontStyle: 'bold',
                    fontSize: 24
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true,
                duration: 1000
            }
        },
        plugins: [{
            id: 'doughnutCenterText',
            beforeDraw(chart) {
                const { ctx, chartArea: { width, height } } = chart;
                const centerX = width / 2;
                const centerY = height / 2;
                
                const text = chart.options.plugins.doughnutCenterText.text;
                const fontSize = chart.options.plugins.doughnutCenterText.fontSize || 20;
                
                ctx.save();
                ctx.font = `bold ${fontSize}px sans-serif`;
                ctx.fillStyle = chart.options.plugins.doughnutCenterText.color || '#000';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(text, centerX, centerY);
                ctx.restore();
            }
        }]
    });
}

async function initPackageStatusChart() {
    const ctx = document.getElementById('statusChart');
    if (!ctx) return;

    try {
        // Hiển thị loading state
        ctx.innerHTML = '<div class="chart-loading"><div class="spinner-border text-primary"></div><p>Đang tải dữ liệu...</p></div>';
        
        const response = await fetch(routes.api, {
            headers: { 'X-CSRF-TOKEN': csrfToken }
        });
        
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        
        const result = await response.json();
        console.debug('Dữ liệu trạng thái:', result);

        if (!Array.isArray(result?.data)) throw new Error('Dữ liệu không hợp lệ');

        // Xử lý dữ liệu
        const statusData = processStatusData(result.data);
        
        // Tạo biểu đồ
        createStatusChart(ctx, statusData);
        
    } catch (error) {
        console.error('Lỗi khi tải dữ liệu trạng thái:', error);
        showChartError(ctx, 'Không thể tải dữ liệu trạng thái');
    }
}

function processStatusData(data) {
    const statusCounts = {
        "Đang hoạt động": data.filter(item => item.status === 'active').length,
        "Tạm dừng": data.filter(item => item.status === 'inactive').length
    };
    
    // Tính tỷ lệ phần trăm
    const total = data.length;
    const percentages = {
        "Đang hoạt động": total > 0 ? (statusCounts["Đang hoạt động"] / total * 100).toFixed(1) : 0,
        "Tạm dừng": total > 0 ? (statusCounts["Tạm dừng"] / total * 100).toFixed(1) : 0
    };
    
    return {
        labels: Object.keys(statusCounts),
        counts: Object.values(statusCounts),
        percentages: Object.values(percentages)
    };
}

function createStatusChart(ctx, {labels, counts, percentages}) {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Số lượng gói',
                data: counts,
                backgroundColor: [
                    'rgba(46, 204, 113, 0.7)',
                    'rgba(149, 165, 166, 0.7)'
                ],
                borderColor: [
                    'rgba(39, 174, 96, 1)',
                    'rgba(127, 140, 141, 1)'
                ],
                borderWidth: 1,
                borderRadius: 6,
                hoverBackgroundColor: [
                    'rgba(46, 204, 113, 1)',
                    'rgba(149, 165, 166, 1)'
                ]
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Trạng thái Gói Data',
                    font: { 
                        size: 16,
                        weight: '600'
                    },
                    padding: { bottom: 20 }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = labels[context.dataIndex] || '';
                            const count = counts[context.dataIndex] || 0;
                            const percent = percentages[context.dataIndex] || 0;
                            return `${label}: ${count} gói (${percent}%)`;
                        }
                    }
                }
            },
            animation: {
                duration: 800
            }
        }
    });
}

function showChartError(ctx, message) {
    ctx.innerHTML = `
        <div class="chart-error">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <p>${message}</p>
            <button class="btn btn-sm btn-outline-primary mt-2" onclick="location.reload()">
                <i class="bi bi-arrow-repeat"></i> Thử lại
            </button>
        </div>
    `;
}

// Thêm CSS inline cho các trạng thái (có thể chuyển vào file CSS riêng)
const style = document.createElement('style');
style.textContent = `
    .chart-loading, .chart-error {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #6c757d;
        text-align: center;
    }
    .chart-loading .spinner-border {
        width: 3rem;
        height: 3rem;
        margin-bottom: 1rem;
    }
    .chart-error i {
        font-size: 2.5rem;
        color: #dc3545;
        margin-bottom: 1rem;
    }
    canvas {
        transition: opacity 0.3s ease;
    }
`;
document.head.appendChild(style);