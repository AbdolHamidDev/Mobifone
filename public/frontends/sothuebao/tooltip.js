document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const tooltip = document.getElementById('tooltip');

    searchInput.addEventListener('mouseenter', function () {
        const inputRect = searchInput.getBoundingClientRect();
        const scrollY = window.scrollY || document.documentElement.scrollTop;

        tooltip.style.left = `${inputRect.left}px`;
        tooltip.style.top = `${inputRect.bottom + scrollY + 10}px`;
        tooltip.style.opacity = '1';
        tooltip.style.visibility = 'visible';
    });

    searchInput.addEventListener('mouseleave', function () {
        tooltip.style.opacity = '0';
        tooltip.style.visibility = 'hidden';
    });
});
