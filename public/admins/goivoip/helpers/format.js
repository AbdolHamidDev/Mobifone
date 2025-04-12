/**
 * Định dạng số thành chuỗi có dấu phân cách hàng nghìn
 * @param {number} num - Số cần định dạng
 * @returns {string} Chuỗi đã định dạng
 */
export function formatCurrency(num) {
    if (!num) return '0';
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}