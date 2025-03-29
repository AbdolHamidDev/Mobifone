// helpers/easing.js
const easing = {};

easing.initEasingFunctions = function() {
    $.extend($.easing, {
        easeOutQuad: function(x, t, b, c, d) {
            return -c * (t /= d) * (t - 2) + b;
        }
    });
};

export default easing;