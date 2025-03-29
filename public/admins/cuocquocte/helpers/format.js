// helpers/format.js
const helpers = {};

// Định dạng tiền tệ theo kiểu Việt Nam
helpers.formatCurrency = function(value) {
    if (value === null || value === undefined || isNaN(value)) {
        return '0';
    }
    
    // Chuyển đổi sang number nếu là string
    const numberValue = typeof value === 'string' ? parseFloat(value) : value;
    
    return new Intl.NumberFormat('vi-VN').format(numberValue);
};

// Thêm easing function nếu chưa có
helpers.addEasingFunctions = function() {
    $.extend($.easing, {
        easeOutQuad: function(x, t, b, c, d) {
            return -c * (t /= d) * (t - 2) + b;
        }
    });
};

export default helpers;