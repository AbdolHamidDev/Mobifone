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


document.addEventListener("DOMContentLoaded", function() {
    // Lấy đường dẫn URL hiện tại
    let currentUrl = window.location.href;

    // Lặp qua tất cả các mục menu để kiểm tra đường dẫn
    document.querySelectorAll(".nav-sidebar .nav-link").forEach(function(link) {
        if (link.href === currentUrl) {
            link.classList.add("active"); // Thêm class active

            // Nếu mục này thuộc dropdown, mở dropdown đó
            let parent = link.closest(".has-treeview");
            if (parent) {
                parent.classList.add("menu-open");
                parent.querySelector(".nav-link").classList.add("active");
            }
        }
    });
});