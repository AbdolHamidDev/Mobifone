


document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.goi-cuoc-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'scale(1.05)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'scale(1)';
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.btn-register-package');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const packageId = this.getAttribute('data-package-id');
            const packageName = this.getAttribute('data-package-name');

            openRegisterModal(packageId, packageName);
        });
    });
});

function openRegisterModal(packageId, packageName) {
    // Gán giá trị gói cước vào input hidden và hiển thị thông tin
    document.getElementById('packageId').value = packageId;
    document.getElementById('selectedPackage').textContent = `Bạn đang đăng ký gói: ${packageName}`;

    // Hiển thị modal
    const modal = new bootstrap.Modal(document.getElementById('registerModal'));
    modal.show();
}


document.addEventListener('DOMContentLoaded', function () {
    const submitButton = document.getElementById('submitRegisterForm');

    if (submitButton) {
        submitButton.addEventListener('click', function () {
            const packageId = document.getElementById('packageId')?.value;
            const phoneNumber = document.getElementById('phoneNumber')?.value;

            if (!packageId || !phoneNumber) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Vui lòng nhập đầy đủ thông tin trước khi xác nhận.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            fetch(registerUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    package_id: packageId,
                    phoneNumber: phoneNumber
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });

                        const modal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
                        modal.hide();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thất bại!',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi hệ thống!',
                        text: 'Không thể hoàn thành yêu cầu. Vui lòng thử lại sau.',
                        confirmButtonText: 'OK'
                    });
                });
        });
    } else {
        console.error('#submitRegisterForm không tồn tại trong DOM.');
    }
});





document.addEventListener('DOMContentLoaded', function () {
    // Lắng nghe sự kiện click trên nút tạo gói cước
    document.querySelectorAll('.create-package-btn').forEach(button => {
        button.addEventListener('click', function () {
            const packageId = this.dataset.packageId; // Lấy ID gói cước từ data attribute
            const customPackageStoreUrl = this.dataset.url; // Lấy URL từ data attribute

            // Dữ liệu cần gửi (có thể tuỳ chỉnh theo yêu cầu)
            const formData = new FormData();
            formData.append('package_id', packageId);

            // Gửi yêu cầu qua AJAX
            fetch(customPackageStoreUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            html: `
                                <p>Mã gói cước: <strong>${data.ma_goi_cuoc}</strong></p>
                                <p>Giá: <strong>${data.gia_tien}</strong></p>
                            `,
                            confirmButtonText: 'OK',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thất bại!',
                            text: 'Không thể tạo gói cước. Vui lòng thử lại.',
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
});


