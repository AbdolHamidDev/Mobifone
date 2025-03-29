// dashboard/filter.js
import table from '../charts/updateTable.js';
import toast from '../helpers/toast.js';

const filter = {};

// Lọc top quốc gia với giao diện đẹp hơn
filter.initTopRateFilter = function() {
    $(document).on('click', '#topRateFilter .dropdown-item', function(e) {
        e.preventDefault();
        const type = $(this).data('type');
        const iconClass = {
            'call': 'fa-phone',
            'data': 'fa-database',
            'sms': 'fa-comment',
            'total': 'fa-star'
        }[type] || 'fa-filter';
        
        $('#topRateFilter .dropdown-item').removeClass('active');
        $(this).addClass('active');
        $('#topRateFilter').html(`
            <i class="fas ${iconClass} me-1"></i> 
            ${$(this).text()} 
            <i class="fas fa-caret-down ms-2"></i>
        `);
        
        // Thêm hiệu ứng loading
        const originalText = $('#topCountriesTable .card-title').text();
        $('#topCountriesTable .card-title').html(`
            ${originalText} 
            <span class="spinner-border spinner-border-sm ms-2" role="status"></span>
        `);
        
        $.get(`/admin/cuoc-quoc-te/top-countries?type=${type}`, function(data) {
            if (data.status === 'success') {
                table.updateTopCountriesTable(data.data || data);
            } else {
                toast.showErrorToast(data.message || 'Lỗi khi lọc dữ liệu');
            }
        }).fail(function() {
            toast.showErrorToast('Lỗi kết nối khi lọc dữ liệu');
        }).always(function() {
            $('#topCountriesTable .card-title').text(originalText);
        });
    });
};

export default filter;