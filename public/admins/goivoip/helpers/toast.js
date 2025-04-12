/**
 * Hiển thị thông báo lỗi
 * @param {string} message - Nội dung thông báo
 */
export function showErrorToast(message) {
    const toast = `<div class="toast-error animate__animated animate__fadeInDown">
        <div class="toast-icon"><i class="fas fa-exclamation-circle"></i></div>
        <div class="toast-message">${message}</div>
    </div>`;
    
    $('.modal-body').prepend(toast);
    
    setTimeout(() => {
        $('.toast-error').addClass('animate__fadeOutUp');
        setTimeout(() => $('.toast-error').remove(), 500);
    }, 3000);
}

/**
 * Hiển thị thông báo lỗi khi tải dữ liệu
 * @param {Error} error - Đối tượng lỗi
 */
export function handleDataLoadError(error) {
    console.error('Error loading data:', error);
    
    // Kiểm tra xem thông báo lỗi đã tồn tại chưa
    if (document.querySelector('.error-message')) return;
    
    const errorMessage = document.createElement('div');
    errorMessage.className = 'error-message';
    errorMessage.innerHTML = `
        <i class="fas fa-exclamation-triangle"></i>
        <span>Không thể tải dữ liệu. Vui lòng thử lại sau.</span>
        <button class="btn-retry">Thử lại</button>
    `;
    
    const dashboardContent = document.querySelector('.dashboard-content');
    if (dashboardContent) {
        dashboardContent.prepend(errorMessage);
        
        // Thêm sự kiện click cho nút thử lại
        document.querySelector('.btn-retry').addEventListener('click', function() {
            errorMessage.remove();
            // Gọi lại các hàm load dữ liệu từ dashboard
            if (window.loadDashboardData) window.loadDashboardData();
            if (window.loadPricingData) window.loadPricingData();
        });
    }
}