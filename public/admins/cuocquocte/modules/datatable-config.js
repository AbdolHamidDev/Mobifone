import { formatCurrency, showErrorToast } from './helpers.js';

export function initializeDataTable() {
    return $('#cuoc-quoc-te-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.routeCuocQuocTeIndex,
            beforeSend: function() {
                $('#loadingToast').toast('show');
            },
            complete: function() {
                $('#loadingToast').toast('hide');
            },
            error: function() {
                $('#loadingToast').toast('hide');
                showErrorToast('Lỗi khi tải dữ liệu');
            }
        },
        columns: [
            {data: 'id', name: 'id', className: 'fw-semibold'},
            {data: 'quoc_gia', name: 'quoc_gia', className: 'text-nowrap'},
            {data: 'nha_khai_thac', name: 'nha_khai_thac', className: 'text-nowrap'},
            {
                data: 'loai_thue_bao', 
                name: 'loai_thue_bao',
                render: function(data) {
                    const badgeClass = data === 'Trả trước' ? 'bg-success' : 'bg-primary';
                    return `<span class="badge ${badgeClass}">${data}</span>`;
                }
            },
            {
                data: 'cuoc_goi_trong_mang', 
                name: 'cuoc_goi_trong_mang',
                className: 'price-cell',
                render: function(data) {
                    return data ? formatCurrency(data) + '/ph' : '-';
                }
            },
            {
                data: 'cuoc_goi_ve_vn', 
                name: 'cuoc_goi_ve_vn',
                className: 'price-cell',
                render: function(data) {
                    return data ? formatCurrency(data) + '/ph' : '-';
                }
            },
            {
                data: 'cuoc_quoc_te', 
                name: 'cuoc_quoc_te',
                className: 'price-cell',
                render: function(data) {
                    return data ? formatCurrency(data) + '/ph' : '-';
                }
            },
            {
                data: 'cuoc_nhan_goi', 
                name: 'cuoc_nhan_goi',
                className: 'price-cell',
                render: function(data) {
                    return data ? formatCurrency(data) + '/ph' : '-';
                }
            },
            {
                data: 'cuoc_sms', 
                name: 'cuoc_sms',
                className: 'price-cell',
                render: function(data) {
                    return data ? formatCurrency(data) + '/sms' : '-';
                }
            },
            {
                data: 'cuoc_data', 
                name: 'cuoc_data',
                className: 'price-cell',
                render: function(data) {
                    return data ? formatCurrency(data) + '/MB' : '-';
                }
            },
            {
                data: 'actions', 
                name: 'actions', 
                orderable: false, 
                searchable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return `
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-sm btn-outline-primary btn-action btn-edit" data-id="${row.id}" title="Chỉnh sửa">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger btn-action btn-delete" data-id="${row.id}" title="Xóa">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        language: {
            url: '/vendor/datatables/vi.json'
        }
    });
}

