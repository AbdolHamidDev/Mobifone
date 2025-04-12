import { showErrorToast } from '../helpers/toast.js';
import { cuocPhiTable } from '../datatable/datatable.js';

/**
 * Thiết lập sự kiện cho modal
 */
export function setupModalEvents() {
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

/**
 * Thiết lập các bước cho form
 */
export function setupFormSteps() {
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

/**
 * Thiết lập sự kiện cho nút thêm/sửa/xóa
 */
export function setupButtonEvents() {
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