// ========================= Cập nhật giá gói cước =========================
function updateGiaGoiCuoc(tenGoiCuoc, giaGoiCuoc, goiCuocId) {
    document.getElementById('ten-goi-cuoc').innerText = tenGoiCuoc;
    document.getElementById('gia-goi-cuoc').innerText = `${giaGoiCuoc}đ`;
    document.getElementById('selected-goi-cuoc-id').value = goiCuocId;
}

// ========================= Đồng hồ đếm ngược =========================
document.addEventListener('DOMContentLoaded', function () {
    const endTimeKey = 'countdownEndTime';
    const lastPageKey = 'lastVisitedPage';
    const currentPath = window.location.pathname;
    const timerElement = document.getElementById('countdown-timer');

    function resetTimer() {
        const currentTime = new Date().getTime();
        const newEndTime = currentTime + 15 * 60 * 1000; // 15 phút
        localStorage.setItem(endTimeKey, newEndTime);
    }

    function updateCountdown() {
        const now = new Date().getTime();
        let endTime = localStorage.getItem(endTimeKey);

        if (!endTime || now >= endTime) {
            resetTimer();
            endTime = localStorage.getItem(endTimeKey);
        }

        const remainingTime = endTime - now;

        if (remainingTime > 0) {
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
            timerElement.innerHTML = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        } else {
            localStorage.removeItem(endTimeKey);
            resetTimer();
            timerElement.innerHTML = '15:00';

            Swal.fire({
                title: 'Hết thời gian hiệu lực!',
                text: 'Phiên đặt số của bạn đã hết hiệu lực. Bạn sẽ được quay lại.',
                icon: 'warning',
                confirmButtonText: 'Đóng',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
        }
    }

    // ✅ Kiểm tra xem trang có bị thay đổi không
    const lastPage = sessionStorage.getItem(lastPageKey);
    if (lastPage !== currentPath) {
        // Nếu không phải cùng trang → Reset
        resetTimer();
    }
    // Lưu lại trang hiện tại vào sessionStorage
    sessionStorage.setItem(lastPageKey, currentPath);

    // ✅ Chạy cập nhật đồng hồ mỗi giây
    setInterval(updateCountdown, 1000);
    updateCountdown();

    // ✅ Xử lý nút "Quay lại" để reset thời gian
    const backButton = document.querySelector('.btn-outline-secondary');
    if (backButton) {
        backButton.addEventListener('click', function (e) {
            e.preventDefault(); // Ngăn hành vi mặc định
            resetTimer(); // Reset lại thời gian đếm ngược
            window.history.back(); // Quay lại trang trước đó
        });
    }
});


// ========================= Cập nhật giá trị gói cước khi load lại trang =========================
document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
        let selectedGoiCuocId = localStorage.getItem('selectedGoiCuocId');

        // Nếu đã có gói cước trước đó, chọn lại radio button tương ứng
        if (selectedGoiCuocId) {
            const savedGoiCuoc = document.querySelector(`input[name="goi_cuoc"][value="${selectedGoiCuocId}"]`);
            if (savedGoiCuoc) {
                savedGoiCuoc.checked = true;
                const tenGoiCuoc = savedGoiCuoc.closest('label').querySelector('h6').innerText;
                const gia = savedGoiCuoc.closest('label').querySelector('h5').innerText;
                updateGiaGoiCuoc(tenGoiCuoc, gia, selectedGoiCuocId);
                return;
            }
        }

        // Nếu không tìm thấy trong localStorage, lấy gói đầu tiên làm mặc định
        const firstGoiCuoc = document.querySelector('input[name="goi_cuoc"]');
        if (firstGoiCuoc) {
            firstGoiCuoc.checked = true;
            const tenGoiCuoc = firstGoiCuoc.closest('label').querySelector('h6').innerText;
            const gia = firstGoiCuoc.closest('label').querySelector('h5').innerText;
            updateGiaGoiCuoc(tenGoiCuoc, gia, firstGoiCuoc.value);
        }
    }, 300); // Chờ 300ms để đảm bảo DOM đã tải hoàn tất
});

// ========================= Hàm cập nhật giá trị gói cước và lưu vào localStorage =========================
function updateGiaGoiCuoc(tenGoiCuoc, giaGoiCuoc, goiCuocId) {
    document.getElementById('ten-goi-cuoc').innerText = tenGoiCuoc;
    document.getElementById('gia-goi-cuoc').innerText = `${giaGoiCuoc}đ`;
    document.getElementById('selected-goi-cuoc-id').value = goiCuocId; // Cập nhật giá trị cho input hidden

    // Lưu vào localStorage để giữ lựa chọn sau khi load lại trang
    localStorage.setItem('selectedGoiCuocId', goiCuocId);
    localStorage.setItem('selectedGoiCuocName', tenGoiCuoc);
    localStorage.setItem('selectedGoiCuocPrice', giaGoiCuoc);
}

// ========================= Lắng nghe sự kiện thay đổi gói cước =========================
document.addEventListener('change', function (event) {
    if (event.target.name === 'goi_cuoc') {
        const tenGoiCuoc = event.target.closest('label').querySelector('h6').innerText;
        const gia = event.target.closest('label').querySelector('h5').innerText;
        updateGiaGoiCuoc(tenGoiCuoc, gia, event.target.value);
    }
});

