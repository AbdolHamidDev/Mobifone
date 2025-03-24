document.addEventListener('DOMContentLoaded', function () {
    // Khởi tạo DataTable với nhiều tính năng nâng cao hơn
    const table = $('#goicuocsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: routes.api,
            type: 'GET',
            data: function (d) {
                // Thêm các tham số tùy chỉnh nếu cần
                d.extra_search = $('#extraSearchField').val();
            }
        },
        responsive: true,  // Hỗ trợ responsive
        scrollX: true,
        autoWidth: false,   // Tắt tự động điều chỉnh width
        order: [[0, 'desc']], // Mặc định sắp xếp theo ID giảm dần
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
        pageLength: 10,
        dom: '<"top"<"row"<"col-md-6"B><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>><"clear">',
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn btn-danger',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> In',
                className: 'btn btn-info',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: '<i class="fas fa-columns"></i> Cột',
                className: 'btn btn-secondary'
            }
        ],
        columns: [
            { 
                data: 'id', 
                name: 'id',
                width: '5%',
                className: 'text-center'
            },
            { 
                data: 'ten_goicuoc', 
                name: 'ten_goicuoc',
                width: '15%'
            },
            { 
                data: 'gia', 
                name: 'gia', 
                width: '10%',
                className: 'text-end',
                render: $.fn.dataTable.render.number(',', '.', 0, '', ' VNĐ') 
            },
            { 
                data: 'thoi_gian', 
                name: 'thoi_gian', 
                width: '8%',
                className: 'text-center',
                render: (data) => data ? `${data} ngày` : 'N/A'
            },
            {
                data: 'dung_luong',
                name: 'dung_luong',
                width: '10%',
                className: 'text-center',
                render: function(data, type, row) {
                    if (!data) return 'N/A';
                    return `${data} ${row.don_vi_dung_luong || 'GB'}`;
                }
            },
            { 
                data: 'loai_goicuoc', 
                name: 'loai_goicuoc',
                width: '12%',
                render: function(data) {
                    const types = {
                        'data': '<span class="badge bg-primary">Gói data</span>',
                        'call': '<span class="badge bg-info">Gói thoại</span>',
                        'combo': '<span class="badge bg-warning text-dark">Gói combo</span>'
                    };
                    return types[data] || data;
                }
            },
            {
                data: 'status',
                name: 'status',
                width: '10%',
                className: 'text-center',
                render: function (data, type, row) {
                    let badgeClass = data === 'active' ? 'bg-success' : 'bg-danger';
                    let statusText = data === 'active' ? 'Kích hoạt' : 'Tạm dừng';
                    return `
                        <span class="badge ${badgeClass} status-toggle" 
                              data-id="${row.id}" 
                              data-status="${data}" 
                              style="cursor: pointer; min-width: 80px; display: inline-block;">
                            <i class="fas ${data === 'active' ? 'fa-check-circle' : 'fa-times-circle'} me-1"></i>
                            ${statusText}
                        </span>
                    `;
                }
            },
            {
                data: 'id',
                name: 'actions',
                width: '20%',
                className: 'text-center',
                orderable: false,
                searchable: false,
                render: (data, type, row) => `
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="/admin/goicuocs/${data}/details" 
                            class="btn btn-outline-info btn-sm d-flex align-items-center me-2"
                            data-bs-toggle="tooltip" 
                            title="Xem chi tiết">
                            <i class="fas fa-eye me-1"></i>
                            <span class="d-none d-md-inline">Xem</span>
                        </a>
                        <a href="/admin/goicuocs/${data}/edit" 
                            class="btn btn-outline-primary btn-sm d-flex align-items-center me-2"
                            data-bs-toggle="tooltip" 
                            title="Chỉnh sửa">
                            <i class="fas fa-edit me-1"></i>
                            <span class="d-none d-md-inline">Sửa</span>
                        </a>
                        <button onclick="confirmDelete(${data})" 
                            class="btn btn-outline-danger btn-sm d-flex align-items-center"
                            data-bs-toggle="tooltip" 
                            title="Xóa gói cước">
                            <i class="fas fa-trash-alt me-1"></i>
                            <span class="d-none d-md-inline">Xóa</span>
                        </button>
                    </div>
                `
            }
        ],
        language: {
            sProcessing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Đang xử lý...</span></div>',
            sLengthMenu: "Hiển thị _MENU_ bản ghi",
            sZeroRecords: "Không tìm thấy dữ liệu phù hợp",
            sInfo: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            sInfoEmpty: "Hiển thị 0 đến 0 của 0 bản ghi",
            sInfoFiltered: "(lọc từ _MAX_ bản ghi)",
            sSearch: '<i class="fas fa-search"></i> Tìm kiếm:',
            oPaginate: {
                sFirst: '<i class="fas fa-angle-double-left"></i>',
                sLast: '<i class="fas fa-angle-double-right"></i>',
                sNext: '<i class="fas fa-angle-right"></i>',
                sPrevious: '<i class="fas fa-angle-left"></i>',
            },
        },
        initComplete: function() {
            // Khởi tạo tooltip
            $('[data-bs-toggle="tooltip"]').tooltip();
            
          // Thêm ô tìm kiếm tùy chỉnh với giao diện đẹp hơn
$('.dataTables_filter').prepend(`
    <div class="flex items-center space-x-4 mb-4">
        <label for="filterByStatus" class="text-sm font-medium text-gray-700">Trạng thái:</label>
        <select id="filterByStatus" class="form-select form-select-sm bg-white border border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="">Tất cả</option>
            <option value="active">Kích hoạt</option>
            <option value="inactive">Tạm dừng</option>
        </select>
        <span id="loadingText" class="text-sm text-gray-500 hidden">Đang tải...</span>
    </div>
`);

// Xử lý sự kiện thay đổi của select box
$('#filterByStatus').change(function() {
    // Hiển thị thông báo "Đang tải..."
    $('#loadingText').removeClass('hidden').addClass('text-indigo-600');
    
    // Thực hiện tìm kiếm và cập nhật bảng
    table.column(6).search($(this).val()).draw();

    // Ẩn thông báo "Đang tải..." sau khi tìm kiếm xong
    setTimeout(function() {
        $('#loadingText').addClass('hidden');
    }, 500); // Giả lập thời gian tải
});

        }
    });

    // Thay đổi trạng thái với hiệu ứng loading
    $('#goicuocsTable').on('click', '.status-toggle', function () {
        const $statusBadge = $(this);
        const id = $statusBadge.data('id');
        const currentStatus = $statusBadge.data('status');
        const newStatus = currentStatus === 'active' ? 'inactive' : 'active';

        Swal.fire({
            title: 'Xác nhận thay đổi trạng thái',
            text: `Bạn muốn chuyển trạng thái gói cước thành "${newStatus === 'active' ? 'Kích hoạt' : 'Tạm dừng'}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(routes.changeStatus(id), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
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
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Thành công!',
                    text: result.value.message,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
                
                // Cập nhật ngay trạng thái trên giao diện mà không cần reload
                $statusBadge
                    .removeClass(currentStatus === 'active' ? 'bg-success' : 'bg-danger')
                    .addClass(newStatus === 'active' ? 'bg-success' : 'bg-danger')
                    .data('status', newStatus)
                    .html(`
                        <i class="fas ${newStatus === 'active' ? 'fa-check-circle' : 'fa-times-circle'} me-1"></i>
                        ${newStatus === 'active' ? 'Kích hoạt' : 'Tạm dừng'}
                    `);
            }
        });
    });

    // Hàm xác nhận xóa với sweetalert2
    window.confirmDelete = function(id) {
        Swal.fire({
            title: 'Bạn chắc chắn muốn xóa?',
            text: "Bạn sẽ không thể hoàn tác lại hành động này!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(`/admin/goicuocs/${id}`, {
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
                    Swal.showValidationMessage(`Xóa thất bại: ${error}`);
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Đã xóa!',
                    'Gói cước đã được xóa thành công.',
                    'success'
                );
                table.ajax.reload(null, false); // Reload dữ liệu không reset paging
            }
        });
    };
    
    // Tối ưu hiệu năng - Debounce cho tìm kiếm
    let searchTimeout;
    $('.dataTables_filter input').unbind().bind('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            table.search(this.value).draw();
        }, 500);
    });


    // Xử lý thêm gói cước
    document.getElementById('goicuocForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Ngăn hành vi submit mặc định

        const formData = new FormData(this);

        fetch(routes.store, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: data.message,
                        confirmButtonText: 'OK',
                    });
                    document.getElementById('goicuocForm').reset();
                    $('#goicuocsTable').DataTable().ajax.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Thất bại!',
                        text: data.message || 'Có lỗi xảy ra.',
                        confirmButtonText: 'OK',
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi hệ thống!',
                    text: 'Không thể hoàn thành yêu cầu. Vui lòng thử lại sau.',
                    confirmButtonText: 'OK',
                });
            });
    });
});


// JavaScript để xử lý multi-step form
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('goicuocForm');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    let currentStep = 1;
    const totalSteps = 3;
    
    // Xử lý next button
    nextBtn.addEventListener('click', function() {
        if (validateStep(currentStep)) {
            currentStep++;
            updateForm();
        }
    });
    
    // Xử lý prev button
    prevBtn.addEventListener('click', function() {
        currentStep--;
        updateForm();
    });
    
    // Validate từng step
    function validateStep(step) {
        let isValid = true;
        
        if (step === 1) {
            const requiredFields = ['ten_goicuoc', 'loai_goicuoc', 'gia', 'thoi_gian'];
            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                if (!element.value.trim()) {
                    element.classList.add('is-invalid');
                    isValid = false;
                } else {
                    element.classList.remove('is-invalid');
                }
            });
        }
        
        return isValid;
    }
    
    // Cập nhật trạng thái form
    function updateForm() {
        // Ẩn tất cả step content
        document.querySelectorAll('[data-step-content]').forEach(content => {
            content.classList.add('d-none');
        });
        
        // Hiển thị step hiện tại
        document.querySelector(`[data-step-content="${currentStep}"]`).classList.remove('d-none');
        
        // Cập nhật progress steps
        document.querySelectorAll('.progress-steps .step').forEach((step, index) => {
            if (index + 1 === currentStep) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
        
        // Cập nhật nút điều hướng
        if (currentStep === 1) {
            prevBtn.disabled = true;
            nextBtn.classList.remove('d-none');
            submitBtn.classList.add('d-none');
            nextBtn.textContent = 'Tiếp tục';
        } else if (currentStep === totalSteps) {
            prevBtn.disabled = false;
            nextBtn.classList.add('d-none');
            submitBtn.classList.remove('d-none');
            updateConfirmation();
        } else {
            prevBtn.disabled = false;
            nextBtn.classList.remove('d-none');
            submitBtn.classList.add('d-none');
            nextBtn.textContent = 'Tiếp tục';
        }
    }
    
    // Cập nhật thông tin xác nhận
    function updateConfirmation() {
        document.getElementById('confirm_ten').textContent = document.getElementById('ten_goicuoc').value || '-';
        document.getElementById('confirm_loai').textContent = document.getElementById('loai_goicuoc').options[document.getElementById('loai_goicuoc').selectedIndex].text || '-';
        document.getElementById('confirm_gia').textContent = formatCurrency(document.getElementById('gia').value) || '-';
        document.getElementById('confirm_thoigian').textContent = document.getElementById('thoi_gian').value + ' ngày' || '-';
        document.getElementById('confirm_dungluong').textContent = document.getElementById('dung_luong').value + ' ' + document.getElementById('don_vi_dung_luong').value || '-';
        document.getElementById('confirm_phutgoi').textContent = document.getElementById('phut_goi').value + ' phút' || '-';
    }
    
    // Định dạng tiền tệ
    function formatCurrency(value) {
        return value ? new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value) : '-';
    }
    
    // Xử lý thay đổi loại thời hạn
    document.querySelectorAll('input[name="thoi_han_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const container = document.getElementById('thoiGianContainer');
            const input = document.getElementById('thoi_gian');
            
            if (this.value === 'ngay') {
                input.placeholder = "Nhập số ngày";
                input.value = "";
            } else if (this.value === 'thang') {
                input.placeholder = "Nhập số tháng";
                input.value = "";
            } else {
                input.placeholder = "Nhập số ngày/tuần/tháng";
                input.value = "";
            }
        });
    });
});



function importGoiCuocs(event) {
    const file = event.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('file', file);
        formData.append('_token', csrfToken);

        fetch(routes.import, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: data.message,
                    confirmButtonText: 'OK'
                });
                // Cập nhật bảng dữ liệu
                $('#goicuocsTable').DataTable().ajax.reload();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại!',
                    text: data.message,
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi hệ thống!',
                text: 'Không thể import gói cước. Vui lòng thử lại sau.',
                confirmButtonText: 'OK'
            });
        });
    }
}

function exportGoiCuocs() {
    window.location.href = routes.export;
}

// Xác nhận xóa
function confirmDelete(goicuocId) {
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Hành động này không thể hoàn tác!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/goicuocs/${goicuocId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                    // Cập nhật bảng dữ liệu
                    $('#goicuocsTable').DataTable().ajax.reload();
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi hệ thống!',
                    text: 'Không thể xóa gói cước. Vui lòng thử lại sau.',
                    confirmButtonText: 'OK'
                });
            });
        }
    });
}

document.addEventListener("DOMContentLoaded", async function () {
try {
    const response = await fetch('/admin/api/goicuocs-stats');
    const data = await response.json();

    const ctx = document.getElementById('goicuocChart');
    if (!ctx) {
        console.error("Canvas không tồn tại!");
        return;
    }

    // Tạo gradient màu sắc
    const ctxCanvas = ctx.getContext('2d');
    const gradient = ctxCanvas.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(54, 162, 235, 0.8)');
    gradient.addColorStop(1, 'rgba(54, 162, 235, 0.2)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Số lượng gói cước',
                data: data.counts,
                backgroundColor: gradient,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 10, // Bo góc thanh bar
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Thống kê số lượng gói cước', // 🎯 Tiêu đề biểu đồ
                    font: {
                        size: 20, // Kích thước chữ
                        weight: 'bold',
                    },
                    padding: {
                        top: 10,
                        bottom: 20
                    },
                    color: '#333' // Màu chữ
                },
                legend: {
                    display: false, // Ẩn legend để giao diện gọn hơn
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let value = context.raw || 0;
                            return `Số lượng: ${value}`;
                        }
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: { size: 14 },
                    bodyFont: { size: 12 },
                    padding: 10,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: {
                    grid: { display: false }, // Ẩn grid dọc
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)' // Màu grid nhẹ hơn
                    }
                }
            },
            animation: {
                duration: 1500, // Tăng thời gian animation
                easing: 'easeOutBounce', // Hiệu ứng nhảy nhẹ khi load
            }
        }
    });

} catch (error) {
    console.error("Lỗi khi gọi API:", error);
}
});


document.addEventListener('DOMContentLoaded', function () {
    const statusCtx = document.getElementById('statusChart').getContext('2d');

    fetch(routes.api, {
        headers: { 'X-CSRF-TOKEN': csrfToken }
    })
    .then(response => response.json())
    .then(result => {
        console.log('Dữ liệu trạng thái:', result);

        const data = result.data;
        if (!Array.isArray(data)) throw new Error('Dữ liệu không hợp lệ');

        // Đếm số lượng trạng thái active & inactive
        const activeCount = data.filter(item => item.status === 'active').length;
        const inactiveCount = data.filter(item => item.status === 'inactive').length;
        const total = activeCount + inactiveCount;

        // Tạo gradient màu sắc cho biểu đồ
        const greenGradient = statusCtx.createLinearGradient(0, 0, 0, 300);
        greenGradient.addColorStop(0, '#2ecc71');
        greenGradient.addColorStop(1, '#27ae60');

        const redGradient = statusCtx.createLinearGradient(0, 0, 0, 300);
        redGradient.addColorStop(0, '#e74c3c');
        redGradient.addColorStop(1, '#c0392b');

        // Cấu hình dữ liệu biểu đồ tròn
        const statusChartData = {
            labels: ['Kích hoạt', 'Tạm dừng'],
            datasets: [{
                data: [activeCount, inactiveCount],
                backgroundColor: [greenGradient, redGradient], // Gradient màu sắc
                borderColor: ['#27ae60', '#c0392b'],
                borderWidth: 2,
                hoverOffset: 8 // Hiệu ứng hover
            }]
        };

        // Hiển thị biểu đồ tròn (Pie Chart)
        new Chart(statusCtx, {
            type: 'doughnut', // Thay 'pie' thành 'doughnut' để có vòng tròn đẹp hơn
            data: statusChartData,
            options: {
                responsive: true,
                cutout: '50%', // Độ rỗng của biểu đồ Doughnut
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            },
                            color: '#333'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Tỷ lệ trạng thái Gói cước',
                        font: { size: 18, weight: 'bold' },
                        color: '#2c3e50'
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: {
                            label: function (tooltipItem) {
                                const value = tooltipItem.raw;
                                const percentage = ((value / total) * 100).toFixed(2);
                                return `${tooltipItem.label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Lỗi tải dữ liệu trạng thái:', error));
});



