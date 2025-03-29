// helpers/toast.js
const toast = {};

// Hàm hiển thị thông báo lỗi với thiết kế đẹp hơn
toast.showErrorToast = function(message) {
    if ($('.toast-container').length === 0) {
        $('body').append(`
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
                <div id="loadingToast" class="toast" role="status" aria-live="polite" aria-atomic="true">
                    <div class="toast-header bg-primary text-white">
                        <strong class="me-auto">Hệ thống</strong>
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Đang tải dữ liệu...
                    </div>
                </div>
            </div>
        `);
    }
    
    const toastId = 'toast-' + Date.now();
    const toastHTML = `
        <div id="${toastId}" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Thông báo lỗi</strong>
                <i class="fas fa-exclamation-circle me-2"></i>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-light">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle text-danger me-3 fs-4"></i>
                    <div class="flex-grow-1">${message}</div>
                </div>
            </div>
        </div>
    `;
    
    $('.toast-container').append(toastHTML);
    
    // Tự động ẩn sau 5 giây với hiệu ứng mượt mà
    setTimeout(() => {
        $(`#${toastId}`).fadeOut(500, function() {
            $(this).remove();
        });
    }, 5000);
};

export default toast;