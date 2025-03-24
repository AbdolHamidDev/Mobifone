// public/js/datatable-config.js
const datatableLanguage = {
    search: "🔍 Tìm kiếm:",
    lengthMenu: "📄 Hiển thị _MENU_ bản ghi",
    info: "📊 Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
    infoEmpty: "❌ Không có dữ liệu để hiển thị",
    infoFiltered: "(Lọc từ _MAX_ bản ghi)",
    zeroRecords: "😢 Không tìm thấy kết quả phù hợp",
    emptyTable: "🚫 Bảng này chưa có dữ liệu",
    loadingRecords: "⏳ Đang tải dữ liệu...",
    processing: "⚙️ Đang xử lý...",
    paginate: {
        first: "🏠 Đầu",
        last: "📌 Cuối",
        next: "➡️",
        previous: "⬅️"
    },
    aria: {
        sortAscending: "🔼 Sắp xếp tăng dần",
        sortDescending: "🔽 Sắp xếp giảm dần"
    }
};

// Hàm khởi tạo DataTable chuyên nghiệp
function initDataTable(selector, ajaxUrl, columns) {
    return $(selector).DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: columns,
        language: datatableLanguage,
        responsive: true, // ⚡ Bảng tự co giãn trên mobile
        autoWidth: false, // ⚡ Giúp bảng hiển thị chuẩn hơn
        lengthMenu: [10, 25, 50, 100], // ⚡ Tùy chỉnh số bản ghi hiển thị
        columnDefs: [
            { className: "text-center", targets: "_all" } // ⚡ Canh giữa tất cả các cột
        ]
    });
}
