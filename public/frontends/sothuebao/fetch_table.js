document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('table-container');

    function fetchTable(url, params = {}) {
        const currentScrollPosition = container.scrollTop;
        container.innerHTML = `
            <div class="d-flex justify-content-center align-items-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;

        const queryString = new URLSearchParams(params).toString();
        const fetchUrl = `${url}?${queryString}`;

        fetch(fetchUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                container.innerHTML = data.html;
                container.scrollTop = currentScrollPosition;
            })
            .catch(error => {
                console.error('Lỗi Fetch API:', error);
                container.innerHTML = `<div class="text-center py-5 text-danger">Đã xảy ra lỗi khi tải dữ liệu!</div>`;
            });
    }

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const params = {
                dau_so: document.querySelector('input[name="dau_so"]:checked')?.value,
                loai_thue_bao: document.querySelector('input[name="loai_thue_bao"]:checked')?.value
            };
            fetchTable(fetchTableUrl, params);
        });
    });

    container.addEventListener('click', function (e) {
        if (e.target.tagName === 'A' && e.target.closest('.pagination')) {
            e.preventDefault();
            fetchTable(e.target.getAttribute('href'));
        }
    });
});
