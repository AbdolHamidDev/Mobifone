export function initializeSelect2() {
    $('.select2').select2({
        dropdownParent: $('#modal-cuoc-quoc-te'),
        width: '100%',
        placeholder: $(this).data('placeholder')
    });
}

export function setupFormValidation() {
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
}

export function setupModalTitle() {
    $('#modal-cuoc-quoc-te').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const isEdit = button.data('edit');
        if (isEdit) {
            $('#modal-title-text').text('Chỉnh Sửa Cước Quốc Tế');
            $('#save-button').html('<i class="fas fa-sync-alt me-2"></i>Cập nhật');
        } else {
            $('#modal-title-text').text('Thêm Mới Cước Quốc Tế');
            $('#save-button').html('<i class="fas fa-save me-2"></i>Lưu thông tin');
        }
    });
}