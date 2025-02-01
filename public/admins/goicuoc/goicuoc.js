document.addEventListener('DOMContentLoaded', function () {
    // Khởi tạo DataTable
    $('#goicuocsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: routes.api, // Sử dụng biến JavaScript
        columns: [
            { data: 'id', name: 'id' },
            { data: 'ten_goicuoc', name: 'ten_goicuoc' },
            { data: 'gia', name: 'gia', render: $.fn.dataTable.render.number(',', '.', 0, '', ' VNĐ') },
            { data: 'thoi_gian', name: 'thoi_gian', render: (data) => `${data} ngày` },
            { data: 'dung_luong', name: 'dung_luong', render: (data) => `${data} GB` },
            { data: 'loai_goicuoc', name: 'loai_goicuoc' },
            {
                data: 'status',
                name: 'status',
                render: function (data, type, row) {
                    let badgeClass = data === 'active' ? 'bg-success' : 'bg-danger';
                    let statusText = data === 'active' ? 'Kích hoạt' : 'Tạm dừng';
                    return `
                        <span class="badge ${badgeClass} status-toggle" 
                              data-id="${row.id}" 
                              data-status="${data}" 
                              style="cursor: pointer;">
                            ${statusText}
                        </span>
                    `;
                }
            },
            
            {
                data: 'id',
                name: 'actions',
                render: (data) => `
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="/admin/goicuocs/${data}/details" 
                            class="btn btn-outline-info btn-sm d-flex align-items-center me-2">
                            <i class="fas fa-eye me-1"></i> Xem chi tiết
                        </a>
                        <a href="/admin/goicuocs/${data}/edit" 
                            class="btn btn-outline-primary btn-sm d-flex align-items-center me-2">
                            <i class="fas fa-edit me-1"></i> Sửa
                        </a>
                        <button onclick="confirmDelete(${data})" 
                            class="btn btn-outline-danger btn-sm d-flex align-items-center">
                            <i class="fas fa-trash-alt me-1"></i> Xóa
                        </button>
                    </div>
                `
            },
            
        ],

        language: {
            sProcessing: "Đang xử lý...",
            sLengthMenu: "Hiển thị _MENU_ bản ghi",
            sZeroRecords: "Không tìm thấy dữ liệu phù hợp",
            sInfo: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            sInfoEmpty: "Hiển thị 0 đến 0 của 0 bản ghi",
            sInfoFiltered: "(lọc từ _MAX_ bản ghi)",
            sSearch: "Tìm kiếm:",
            oPaginate: {
                sFirst: "Đầu",
                sLast: "Cuối",
                sNext: "Sau",
                sPrevious: "Trước",
            },
        },
    });

    // Thay đổi trạng thái
    $('#goicuocsTable').on('click', '.status-toggle', function () {
        const id = $(this).data('id');
        const currentStatus = $(this).data('status');
        const newStatus = currentStatus === 'active' ? 'inactive' : 'active';

        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: `Bạn muốn chuyển trạng thái thành "${newStatus === 'active' ? 'Kích hoạt' : 'Tạm dừng'}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(routes.changeStatus(id), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire('Thành công!', data.message, 'success');
                        $('#goicuocsTable').DataTable().ajax.reload();
                    })
                    .catch(() => {
                        Swal.fire('Lỗi!', 'Không thể thay đổi trạng thái. Vui lòng thử lại sau.', 'error');
                    });
            }
        });
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
