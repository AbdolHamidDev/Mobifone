import { showErrorToast } from './helpers.js';

export function loadQuocGiaNhaKhaiThac() {
    return $.get("/admin/get-quoc-gia-nha-khai-thac");
}

export function setupFormHandlers(table) {
    // Xử lý nút thêm mới
    $('#btn-add').click(function () {
        $('#modal-cuoc-quoc-te').modal('show');
        $('#cuoc_quoc_te_id').val('');
        $('#form-cuoc-quoc-te')[0].reset();
    });

    // Xử lý submit form
    $('#form-cuoc-quoc-te').submit(function (e) {
        e.preventDefault();
        const formData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            quoc_gia_id: $('#select-quoc-gia').val(),
            nha_khai_thac_id: $('#select-nha-khai-thac').val(),
            loai_thue_bao: $('#loai_thue_bao').val(),
            cuoc_goi_trong_mang: $('#cuoc_goi_trong_mang').val() || null,
            cuoc_goi_ve_vn: $('#cuoc_goi_ve_vn').val() || null,
            cuoc_quoc_te: $('#cuoc_quoc_te').val() || null,
            cuoc_ve_tinh: $('#cuoc_ve_tinh').val() || null,
            cuoc_nhan_goi: $('#cuoc_nhan_goi').val() || null,
            cuoc_sms: $('#cuoc_sms').val() || null,
            cuoc_data: $('#cuoc_data').val() || null
        };

        const id = $('#cuoc_quoc_te_id').val();
        const url = id ? `/admin/cuoc-quoc-te/${id}` : '/admin/cuoc-quoc-te';
        const method = id ? 'PUT' : 'POST';
         // Thêm hiệu ứng loading
    const $submitBtn = $(this).find('[type="submit"]');
    const originalText = $submitBtn.html();
    $submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Đang xử lý...');


    $.ajax({
        url: url,
        type: method,
        data: formData,
        success: function (response) {
            // 1. Tắt modal đúng cách
            $('#modal-cuoc-quoc-te').modal('hide');
            
            // 2. Reset form
            $('#form-cuoc-quoc-te')[0].reset();
            
            // 3. Reload DataTable không reset phân trang
            table.ajax.reload(null, false);
            
            // 4. Hiển thị thông báo không block UI
            Swal.fire({
                title: 'Thành công!',
                text: response.message,
                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
                willClose: () => {
                    // 5. Khôi phục trạng thái nút submit
                    $submitBtn.prop('disabled', false).html(originalText);
                }
            });
        },
        error: function(xhr) {
            $submitBtn.prop('disabled', false).html(originalText);
            // Xử lý lỗi
        }
    });
    });

    // Xử lý sự kiện xóa
    $('body').on('click', '.btn-delete', function () {
        const id = $(this).data("id");
        Swal.fire({
            title: "Bạn có chắc muốn xóa?",
            text: "Hành động này không thể hoàn tác!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Xóa ngay!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/cuoc-quoc-te/${id}`,
                    type: "DELETE",
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        Swal.fire("Đã xóa!", response.message, "success");
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire("Lỗi!", xhr.responseJSON.message || "Có lỗi xảy ra khi xóa", "error");
                    }
                });
            }
        });
    });

    // Xử lý sự kiện sửa
    $('body').on('click', '.btn-edit', function () {
        const id = $(this).data("id");
        $.get(`/admin/cuoc-quoc-te/${id}/edit`, function (data) {
            $('#cuoc_quoc_te_id').val(data.id);
            $('#select-quoc-gia').val(data.quoc_gia_id);
            $('#select-nha-khai-thac').val(data.nha_khai_thac_id);
            $('#loai_thue_bao').val(data.loai_thue_bao);
            $('#cuoc_goi_trong_mang').val(data.cuoc_goi_trong_mang);
            $('#cuoc_goi_ve_vn').val(data.cuoc_goi_ve_vn);
            $('#cuoc_quoc_te').val(data.cuoc_quoc_te);
            $('#cuoc_ve_tinh').val(data.cuoc_ve_tinh);
            $('#cuoc_nhan_goi').val(data.cuoc_nhan_goi);
            $('#cuoc_sms').val(data.cuoc_sms);
            $('#cuoc_data').val(data.cuoc_data);
            
            // Load lại dropdown nếu cần
            loadQuocGiaNhaKhaiThac().then(function(response) {
                $('#select-quoc-gia').trigger('change');
                $('#select-nha-khai-thac').trigger('change');
                $('#modal-cuoc-quoc-te').modal('show');
            });
        }).fail(function() {
            Swal.fire("Lỗi!", "Không thể tải dữ liệu để chỉnh sửa", "error");
        });
    });
}