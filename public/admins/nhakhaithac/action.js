$(document).ready(function() {
    // Khởi tạo DataTable với các tùy chỉnh
    var table = $('#nhaKhaiThacTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: nhaKhaiThacUrl, // Nhận URL từ Blade
            type: "GET",
            data: function(d) {
                // Có thể thêm các tham số tùy chỉnh nếu cần
            }
        },
        language: {
             url: '/vendor/datatables/vi.json'
        },
        dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>><"clear">',
        columns: [
            { 
                data: 'id', 
                name: 'id',
                className: 'text-center'
            },
            { 
                data: 'ten_nha_khai_thac', 
                name: 'ten_nha_khai_thac',
                render: function(data, type, row) {
                    return `<span class="fw-semibold">${data}</span>`;
                }
            },
            { 
                data: 'ma_nha_khai_thac', 
                name: 'ma_nha_khai_thac',
                className: 'text-uppercase'
            },
            { 
                data: 'quoc_gia', 
    name: 'quoc_gia.ten_quoc_gia', // Đảm bảo khớp với tên trong query
    render: function(data, type, row) {
        // Kiểm tra nếu data là object
        if (data && typeof data === 'object') {
            return `<span class="badge bg-primary bg-opacity-10 text-primary">${data.ten_quoc_gia}</span>`;
        }
        // Hoặc nếu data là string
        else if (data) {
            return `<span class="badge bg-primary bg-opacity-10 text-primary">${data}</span>`;
        }
        return '-';
    }
            },
            { 
                data: 'updated_at', 
                name: 'updated_at',
                render: function(data) {
                    return data ? moment(data).format('DD/MM/YYYY HH:mm') : '-';
                }
            },
            { 
                data: 'actions', 
                name: 'actions', 
                orderable: false, 
                searchable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return `
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-sm btn-outline-primary btn-edit" data-id="${row.id}" title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger btn-delete" data-id="${row.id}" title="Xóa">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    
                    </div>`;
                }
            }
        ],
        order: [[0, 'desc']],
        responsive: true,
        drawCallback: function(settings) {
            // Thêm tooltip cho các nút hành động
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

    // Lấy danh sách quốc gia từ database
    function fetchQuocGia() {
        return $.ajax({
            url: "/admin/get-quoc-gia",
            type: "GET",
            dataType: "json"
        });
    }

    // Mở modal thêm nhà khai thác
    $('#btn-add').click(async function() {
        try {
            const response = await fetchQuocGia();
            let select = $('#select-quoc-gia');
            
            select.empty().append('<option value="" selected disabled>-- Chọn quốc gia --</option>');
            response.forEach(quocgia => {
                select.append(`<option value="${quocgia.id}">${quocgia.ten_quoc_gia}</option>`);
            });
            
            $('#modal-nha-khai-thac').modal('show');
            $('#nha_khai_thac_id').val('');
            $('#form-nha-khai-thac').trigger('reset');
            $('#form-nha-khai-thac').removeClass('was-validated');
            $('#modal-title-text').text('Thêm Nhà Khai Thác');
        } catch (error) {
            console.error('Error fetching countries:', error);
            Swal.fire('Lỗi!', 'Không thể tải danh sách quốc gia', 'error');
        }
    });

    // Gửi dữ liệu Thêm/Sửa
    $('#form-nha-khai-thac').submit(async function(e) {
        e.preventDefault();
        
        if (!this.checkValidity()) {
            e.stopPropagation();
            $(this).addClass('was-validated');
            return;
        }
        
        let formData = {
            _token: "{{ csrf_token() }}",
            ten_nha_khai_thac: $('#ten_nha_khai_thac').val(),
            ma_nha_khai_thac: $('#ma_nha_khai_thac').val(),
            quoc_gia_id: $('#select-quoc-gia').val()
        };
        
        let id = $('#nha_khai_thac_id').val();
        let url = id ? `/admin/nha-khai-thac/${id}` : "/admin/nha-khai-thac";
        let method = id ? "PUT" : "POST";
        
        try {
            const response = await $.ajax({
                url: url,
                type: method,
                data: formData,
                dataType: 'json'
            });
            
            Swal.fire({
                title: 'Thành công!',
                text: response.message,
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
            
            $('#modal-nha-khai-thac').modal('hide');
            table.ajax.reload(null, false);
        } catch (error) {
            let errorMessage = error.responseJSON?.message || 'Có lỗi xảy ra';
            Swal.fire('Lỗi!', errorMessage, 'error');
        }
    });

    // Sửa nhà khai thác
    $('#nhaKhaiThacTable').on('click', '.btn-edit', async function() {
        let id = $(this).data('id');
        
        try {
            const [data, countries] = await Promise.all([
                $.get(`/admin/nha-khai-thac/${id}/edit`),
                fetchQuocGia()
            ]);
            
            let select = $('#select-quoc-gia');
            select.empty().append('<option value="" disabled>-- Chọn quốc gia --</option>');
            
            countries.forEach(quocgia => {
                let selected = quocgia.id == data.quoc_gia_id ? 'selected' : '';
                select.append(`<option value="${quocgia.id}" ${selected}>${quocgia.ten_quoc_gia}</option>`);
            });
            
            $('#nha_khai_thac_id').val(data.id);
            $('#ten_nha_khai_thac').val(data.ten_nha_khai_thac);
            $('#ma_nha_khai_thac').val(data.ma_nha_khai_thac);
            $('#modal-title-text').text('Chỉnh Sửa Nhà Khai Thác');
            $('#modal-nha-khai-thac').modal('show');
        } catch (error) {
            console.error('Error:', error);
            Swal.fire('Lỗi!', 'Không thể tải dữ liệu chỉnh sửa', 'error');
        }
    });

    // Xóa nhà khai thác
    $('#nhaKhaiThacTable').on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        
        Swal.fire({
            title: 'Bạn chắc chắn muốn xóa?',
            text: "Dữ liệu xóa không thể khôi phục!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xác nhận xóa',
            cancelButtonText: 'Hủy bỏ',
            confirmButtonColor: '#d33',
            reverseButtons: true
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await $.ajax({
                        url: `/admin/nha-khai-thac/${id}`,
                        type: 'DELETE',
                        data: { _token: "{{ csrf_token() }}" },
                        dataType: 'json'
                    });
                    
                    Swal.fire({
                        title: 'Đã xóa!',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    
                    table.ajax.reload(null, false);
                } catch (error) {
                    Swal.fire('Lỗi!', error.responseJSON?.message || 'Xóa không thành công', 'error');
                }
            }
        });
    });

    // Xem chi tiết nhà khai thác
    $('#nhaKhaiThacTable').on('click', '.btn-detail', function() {
        let id = $(this).data('id');
        // Thêm logic xem chi tiết ở đây
        console.log('Xem chi tiết nhà khai thác ID:', id);
    });
});

// Load dữ liệu dashboard khi trang được tải
$(document).ready(function() {
    loadDashboardData();
});

