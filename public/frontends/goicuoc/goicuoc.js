document.addEventListener('DOMContentLoaded', function () {
    // Thanh trượt Thoại nội mạng
    const noiMangSlider = document.getElementById('noi-mang-slider');
    const noiMangValue = document.getElementById('noi-mang-value');

    noiMangSlider.addEventListener('input', function () {
        noiMangValue.textContent = this.value; // Cập nhật giá trị hiển thị
    });

    // Thanh trượt Thoại ngoại mạng
    const ngoaiMangSlider = document.getElementById('ngoai-mang-slider');
    const ngoaiMangValue = document.getElementById('ngoai-mang-value');

    ngoaiMangSlider.addEventListener('input', function () {
        ngoaiMangValue.textContent = this.value; // Cập nhật giá trị hiển thị
    });

    // Thanh trượt Dung lượng
    const dataSlider = document.getElementById('data-slider');
    const dataValue = document.getElementById('data-value');

    dataSlider.addEventListener('input', function () {
        dataValue.textContent = parseFloat(this.value).toFixed(1); // Cập nhật giá trị hiển thị (1 số thập phân)
    });
});


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
    // Update slider values
    const sliders = [
        { id: 'noi-mang-slider', display: 'noi-mang-value' },
        { id: 'ngoai-mang-slider', display: 'ngoai-mang-value' },
        { id: 'data-slider', display: 'data-value' },
    ];

    sliders.forEach(slider => {
        const input = document.getElementById(slider.id);
        const display = document.getElementById(slider.display);

        input.addEventListener('input', function () {
            display.textContent = this.value;
        });
    });

    // Handle form submission
    const form = document.getElementById('customPackageForm');
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);
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
                        title: 'Gói cước đã được tạo!',
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
