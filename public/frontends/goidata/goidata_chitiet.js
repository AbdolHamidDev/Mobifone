// Hiệu ứng hover cho các thẻ gói data
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.goi-data-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'scale(1.05)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'scale(1)';
        });
    });
});

// Xử lý khi nhấn nút đăng ký gói data
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.btn-register-package');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const packageId = this.getAttribute('data-package-id'); // Lấy package_id từ nút
            const packageName = this.getAttribute('data-package-name'); // Lấy tên gói data từ nút

            openRegisterModal(packageId, packageName); // Gọi hàm mở modal
        });
    });
});

// Hàm mở modal đăng ký
function openRegisterModal(packageId, packageName) {
    // Gán giá trị gói Data vào input hidden
    document.getElementById('packageId').value = packageId;
    document.getElementById('selectedPackage').textContent = `Bạn đang đăng ký gói: ${packageName}`;

    // Hiển thị modal
    const modal = new bootstrap.Modal(document.getElementById('registerModal'));
    modal.show();
}


// Xử lý gửi form đăng ký

