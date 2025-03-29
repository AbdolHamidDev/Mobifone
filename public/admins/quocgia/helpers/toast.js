/**
 * Các hàm hiển thị thông báo
 */

// Hiển thị thông báo thành công
function showSuccessToast(message) {
    Swal.fire("Thành công!", message, "success");
}

// Hiển thị xác nhận xóa
function showDeleteConfirm(callback) {
    Swal.fire({
        title: "Bạn có chắc muốn xóa?",
        text: "Hành động này không thể hoàn tác!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa ngay!",
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
}

// Xuất các hàm
export { showSuccessToast, showDeleteConfirm };