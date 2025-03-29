/**
 * Hàm xử lý modal (thêm/sửa quốc gia)
 */
import { showSuccessToast, showDeleteConfirm } from '../helpers/toast.js';
import { initCountryDropdowns } from '../dropdown/dropdown.js';

// Khởi tạo sự kiện cho modal
function initModal() {
    // Khi modal hiển thị, khởi tạo lại dropdown quốc gia
    $("#modal-quoc-gia").on("shown.bs.modal", function () {
        initCountryDropdowns();
    });
    
    // Xử lý form gửi dữ liệu
    $("#form-quocgia").submit(function (e) {
        e.preventDefault();
        submitCountryForm();
    });
}

// Hàm gửi form quốc gia
function submitCountryForm() {
    let id = $("#quocgia_id").val();
    let url = id ? `/admin/quoc-gia/${id}` : "/admin/quoc-gia";
    let method = id ? "PUT" : "POST";

    $.ajax({
        url: url,
        type: method,
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            ten_quoc_gia: $("#ten_quoc_gia").val(),
            ma_quoc_gia: $("#ma_quoc_gia").val(),
        },
        success: function (response) {
            showSuccessToast(response.message);
            $("#modal-quocgia").modal("hide");
            window.table.ajax.reload();
        },
        error: function(xhr) {
            console.error("Lỗi khi gửi form:", xhr);
            Swal.fire("Lỗi!", "Đã xảy ra lỗi khi lưu dữ liệu", "error");
        }
    });
}

// Khởi tạo sự kiện xóa
function initDeleteEvent() {
    // Xử lý xóa quốc gia
    $("#quocgia").on("click", ".btn-delete", function () {
        let id = $(this).data("id");
        showDeleteConfirm(function() {
            deleteCountry(id);
        });
    });
}

// Hàm xóa quốc gia
function deleteCountry(id) {
    $.ajax({
        url: `/admin/quoc-gia/${id}`,
        type: "DELETE",
        data: { _token: $('meta[name="csrf-token"]').attr("content") },
        success: function (response) {
            showSuccessToast(response.message);
            window.table.ajax.reload();
        },
        error: function(xhr) {
            console.error("Lỗi khi xóa:", xhr);
            Swal.fire("Lỗi!", "Đã xảy ra lỗi khi xóa dữ liệu", "error");
        }
    });
}

// Xuất các hàm
export { initModal, initDeleteEvent };