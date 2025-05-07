document.addEventListener('DOMContentLoaded', function () {
    // Efficient DataTable configuration
    const dataTable = $('#goidatasTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: routes.api,
            type: 'GET',
            error: function (xhr) {
                console.error('Lỗi tải dữ liệu:', xhr.statusText);
                showDataTableError();
            }
        },
        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        lengthMenu: [[10, 25, 50], [10, 25, 50]],
        pageLength: 25,
        order: [[0, 'desc']],
        columns: [
            { 
                data: 'id', 
                className: 'text-center',
                width: '5%'
            },
            { 
                data: 'ten_data',
                render: data => data
            },
            { 
                data: 'gia', 
                className: 'text-end',
                render: $.fn.dataTable.render.number(',', '.', 0, '', ' ₫')
            },
            { 
                data: 'thoi_gian', 
                className: 'text-center',
                render: data => `${data} ngày`
            },
            {
                data: 'dung_luong',
                className: 'text-center',
                render: function(data, type, row) {
                    const rawValue = parseFloat(data) || 0;
                    const unit = (row.don_vi_dung_luong || 'MB').toUpperCase();
                    return unit === 'GB' || rawValue >= 1024 
                        ? `${(rawValue/(unit === 'GB' ? 1 : 1024)).toFixed(2)} GB` 
                        : `${rawValue} MB`;
                }
            },
            { 
                data: 'loai_data', 
                className: 'text-center',
                render: function(data) {
                    const types = {
                        'mien_phi_mxh': 'MXH Free',
                        'dai_ky': 'Dài kỳ',
                        'data_bo_sung': 'Bổ sung',
                        'thang': 'Theo tháng',
                        'data_thuong': 'Thông thường',
                        'ngay': 'Theo ngày',
                        'data_fastconnect': 'Fastconnect'
                    };
                    return types[data] || data;
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: function (data, type, row) {
                    const isActive = data === 'active';
                    return `
                        <button class="btn btn-sm" data-id="${row.id}" data-status="${data}">
                            <i class="fas ${isActive ? 'fa-toggle-on text-success' : 'fa-toggle-off text-danger'}"></i>
                        </button>
                    `;
                }
            },
            {
                data: 'id',
                className: 'text-center',
                orderable: false,
                width: '15%',
                render: (data) => `
                    <button class="btn btn-sm" data-id="${data}" title="Xem">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-sm" data-id="${data}" title="Sửa">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm" data-id="${data}" title="Xóa">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                `
            }
        ],
        language: {
            processing: '<i class="fas fa-spinner fa-spin"></i> Đang tải...',
            paginate: {
                first: '<i class="fas fa-angle-double-left"></i>',
                last: '<i class="fas fa-angle-double-right"></i>',
                next: '<i class="fas fa-angle-right"></i>',
                previous: '<i class="fas fa-angle-left"></i>'
            }
        },
        initComplete: function() {
            $('.dataTables_filter input').addClass('form-control-sm');
            $('.dataTables_length select').addClass('form-select-sm');
        }
    });

    // Status toggle handler
    $('#goidatasTable').on('click', '[data-status]', function() {
        const $btn = $(this);
        const id = $btn.data('id');
        const newStatus = $btn.data('status') === 'active' ? 'inactive' : 'active';

        if (confirm(`Đổi trạng thái sang ${newStatus === 'active' ? 'kích hoạt' : 'tạm dừng'}?`)) {
            fetch(routes.changeStatus(id), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => {
                if (response.ok) {
                    $btn
                        .data('status', newStatus)
                        .find('i')
                        .toggleClass('fa-toggle-on fa-toggle-off text-success text-danger');
                    dataTable.ajax.reload(null, false);
                }
            });
        }
    });

    // Action buttons
    $('#goidatasTable').on('click', '[title="Xem"]', function() {
        window.location.href = `/admin/goidatas/${$(this).data('id')}/details`;
    });

    $('#goidatasTable').on('click', '[title="Sửa"]', function() {
        window.location.href = `/admin/Goidatas/${$(this).data('id')}/edit`;
    });

    $('#goidatasTable').on('click', '[title="Xóa"]', function() {
        if (confirm('Xóa bản ghi này?')) {
            fetch(`/admin/goidatas/${$(this).data('id')}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (response.ok) {
                    dataTable.ajax.reload();
                }
            });
        }
    });

    // Form submission
    const goidataForm = document.getElementById('goidataForm');
    if (goidataForm) {
        goidataForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = this.querySelector('[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xử lý';
            
            fetch(routes.store, {
                method: 'POST',
                body: new FormData(this)
            })
            .then(response => {
                if (response.ok) {
                    this.reset();
                    dataTable.ajax.reload();
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addGoidataModal'));
                    if (modal) modal.hide();
                }
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }

    function showDataTableError() {
        $('#goidatasTable').parent().html(`
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> Lỗi tải dữ liệu
            </div>
        `);
    }
});