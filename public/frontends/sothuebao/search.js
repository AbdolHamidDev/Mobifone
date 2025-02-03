$(document).ready(function () {
    $('#searchForm').on('submit', function (e) {
        e.preventDefault();

        let searchTerm = $('#search-input').val();

        $.ajax({
            url: searchUrl, // Dùng biến truyền từ Blade
            type: 'GET',
            data: { searchTerm: searchTerm },
            beforeSend: function () {
                $('#searchForm button').text('Đang tìm...').prop('disabled', true);
                $('#data-table-body').html('<tr><td colspan="5" class="text-center">Đang tải...</td></tr>');
            },
            success: function (response) {
                $('#data-table-body').html(response.table);
                $('#pagination-container').html(response.pagination);
            },
            complete: function () {
                $('#searchForm button').text('Tìm kiếm').prop('disabled', false);
            }
        });
    });
});
