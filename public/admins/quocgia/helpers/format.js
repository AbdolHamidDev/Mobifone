/**
 * Các hàm định dạng số và chuỗi
 */

// Hàm định dạng số
function formatNumber(num) {
    return new Intl.NumberFormat("vi-VN").format(num);
}

// Xuất các hàm
export { formatNumber };