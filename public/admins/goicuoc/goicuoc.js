document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTable with essential features only
    const table = $('#goicuocsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: routes.api,
            type: 'GET',
            data: function (d) {
                d.extra_search = $('#extraSearchField').val();
            }
        },
        order: [[0, 'desc']],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
        pageLength: 10,
        columns: [
            { 
                data: 'id', 
                name: 'id',
                className: 'text-center'
            },
            { 
                data: 'ten_goicuoc', 
                name: 'ten_goicuoc'
            },
            { 
                data: 'gia', 
                name: 'gia', 
                className: 'text-end',
                render: $.fn.dataTable.render.number(',', '.', 0, '', ' VNĐ') 
            },
            { 
                data: 'thoi_gian', 
                name: 'thoi_gian', 
                className: 'text-center',
                render: (data) => data ? `${data} ngày` : 'N/A'
            },
            {
                data: 'dung_luong',
                name: 'dung_luong',
                className: 'text-center',
                render: function(data, type, row) {
                    if (!data) return 'N/A';
                    return `${data} ${row.don_vi_dung_luong || 'GB'}`;
                }
            },
            { 
                data: 'loai_goicuoc', 
                name: 'loai_goicuoc',
                render: function(data) {
                    const types = {
                        'data': 'Gói data',
                        'call': 'Gói thoại',
                        'combo': 'Gói combo'
                    };
                    return types[data] || data;
                }
            },
            {
                data: 'status',
                name: 'status',
                className: 'text-center',
                render: function (data, type, row) {
                    let statusText = data === 'active' ? 'Kích hoạt' : 'Tạm dừng';
                    return `
                        <span class="status-toggle" 
                              data-id="${row.id}" 
                              data-status="${data}">
                            ${statusText}
                        </span>
                    `;
                }
            },
            {
                data: 'id',
                name: 'actions',
                className: 'text-center',
                orderable: false,
                searchable: false,
                render: (data, type, row) => `
                <div class="action-buttons d-flex justify-content-center gap-2">
                    <a href="/admin/goicuocs/${data}/details" class="btn btn-sm btn-outline-secondary" title="Xem chi tiết">
                        <i class="bi bi-eye"></i> Xem
                    </a>
                    <a href="/admin/goicuocs/${data}/edit" class="btn btn-sm btn-outline-primary" title="Chỉnh sửa">
                        <i class="bi bi-pencil-square"></i> Sửa
                    </a>
                    <button onclick="confirmDelete(${data})" class="btn btn-sm btn-outline-danger" title="Xóa">
                        <i class="bi bi-trash3"></i> Xóa
                    </button>
                </div>
            `
            
            }
        ],
        language: {
            sProcessing: 'Đang xử lý...',
            sLengthMenu: "Hiển thị _MENU_ bản ghi",
            sZeroRecords: "Không tìm thấy dữ liệu phù hợp",
            sInfo: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            sInfoEmpty: "Hiển thị 0 đến 0 của 0 bản ghi",
            sInfoFiltered: "(lọc từ _MAX_ bản ghi)",
            sSearch: 'Tìm kiếm:',
            oPaginate: {
                sFirst: 'Đầu',
                sLast: 'Cuối',
                sNext: 'Tiếp',
                sPrevious: 'Trước',
            },
        },
        initComplete: function() {
            // Add status filter
            $('.dataTables_filter').prepend(`
                <select id="filterByStatus">
                    <option value="">Tất cả</option>
                    <option value="active">Kích hoạt</option>
                    <option value="inactive">Tạm dừng</option>
                </select>
            `);

            $('#filterByStatus').change(function() {
                table.column(6).search($(this).val()).draw();
            });
        }
    });

    // Change status
    $('#goicuocsTable').on('click', '.status-toggle', function () {
        const $statusBadge = $(this);
        const id = $statusBadge.data('id');
        const currentStatus = $statusBadge.data('status');
        const newStatus = currentStatus === 'active' ? 'inactive' : 'active';

        if (confirm(`Bạn muốn chuyển trạng thái gói cước thành "${newStatus === 'active' ? 'Kích hoạt' : 'Tạm dừng'}"?`)) {
            fetch(routes.changeStatus(id), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $statusBadge
                        .data('status', newStatus)
                        .text(newStatus === 'active' ? 'Kích hoạt' : 'Tạm dừng');
                }
            });
        }
    });

    // Delete confirmation
    window.confirmDelete = function(id) {
        if (confirm('Bạn chắc chắn muốn xóa? Bạn sẽ không thể hoàn tác lại hành động này!')) {
            fetch(`/admin/goicuocs/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    table.ajax.reload(null, false);
                }
            });
        }
    };
    
    // Form submission
    document.getElementById('goicuocForm').addEventListener('submit', function (e) {
        e.preventDefault();
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
                document.getElementById('goicuocForm').reset();
                table.ajax.reload();
            }
            alert(data.message || (data.success ? 'Thành công!' : 'Có lỗi xảy ra.'));
        });
    });
});

// Import/export functions
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
                $('#goicuocsTable').DataTable().ajax.reload();
            }
            alert(data.message || (data.success ? 'Import thành công!' : 'Import thất bại!'));
        });
    }
}

function exportGoiCuocs() {
    window.location.href = routes.export;
}