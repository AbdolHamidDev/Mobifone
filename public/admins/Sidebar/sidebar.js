function confirmLogout() {
    Swal.fire({
        title: "Bạn có chắc muốn đăng xuất?",
        text: "Bạn sẽ cần đăng nhập lại để tiếp tục.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Đăng xuất",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("logout-form").submit();
        }
    });
}
