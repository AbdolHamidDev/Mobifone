import { formatCurrency } from '../helpers/format.js';

let cuocPhiTable;

/**
 * Khởi tạo DataTable
 */
export function initializeDataTable() {
    cuocPhiTable = $('#cuocPhiTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#cuocPhiTable").data('url') || "/admin/goi-voip-cuoc-phi",
            dataSrc: function(json) {
                $('.table-info').html(`Hiển thị ${json.start} đến ${json.end} của ${json.recordsTotal} bản ghi`);
                return json.data;
            }
        },
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Tìm kiếm...",
            lengthMenu: "Hiển thị _MENU_ bản ghi",
            info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            infoEmpty: "Không có bản ghi nào",
            infoFiltered: "(lọc từ _MAX_ bản ghi)",
            paginate: {
                first: "Đầu",
                last: "Cuối",
                next: "Tiếp",
                previous: "Trước"
            }
        },
        columns: [
            { 
                data: 'id', 
                name: 'id',
                className: 'text-center'
            },
            { 
                data: 'quoc_gia.ten_quoc_gia', 
                name: 'quoc_gia_id',
                render: function(data, type, row) {
                    return data ? `<span class="badge badge-light border">${data}</span>` : '-';
                }
            },
            { 
                data: 'nhom_cuoc', 
                name: 'nhom_cuoc',
                render: function(data) {
                    return `<span class="font-weight-bold">${data}</span>`;
                }
            },
            { 
                data: 'ma_vung', 
                name: 'ma_vung',
                render: function(data) {
                    return data ? `<code>${data}</code>` : '-';
                }
            },
            { 
                data: 'block_6s_dau', 
                name: 'block_6s_dau',
                className: 'text-right',
                render: function(data) {
                    return data ? formatCurrency(data) + ' VNĐ' : '-';
                }
            },
            { 
                data: 'gia_moi_giay', 
                name: 'gia_moi_giay',
                className: 'text-right',
                render: function(data) {
                    return data ? formatCurrency(data) + ' VNĐ' : '-';
                }
            },
            { 
                data: 'gia_1_phut_dau', 
                name: 'gia_1_phut_dau',
                className: 'text-right',
                render: function(data) {
                    return data ? formatCurrency(data) + ' VNĐ' : '-';
                }
            },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-sm btn-outline-primary btn-action edit-btn" data-id="${row.id}" title="Sửa">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger btn-action delete-btn" data-id="${row.id}" title="Xóa">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    `;
                }
            }
        ],
        initComplete: function() {
            $('table tbody tr').addClass('animate__animated animate__fadeIn');
        },
        drawCallback: function() {
            $('table tbody tr').each(function(i) {
                $(this).css('animation-delay', (i * 0.05) + 's');
            });
        }
    });
    
    return cuocPhiTable;
}

/**
 * Tính toán xem trước giá cước
 */
export function calculatePricePreview() {
    const block6s = parseFloat($('#block_6s_dau').val()) || 0;
    const perSecond = parseFloat($('#gia_moi_giay').val()) || 0;
    const firstMinute = parseFloat($('#gia_1_phut_dau').val()) || 0;
    const nextMinute = parseFloat($('#gia_1_phut_tiep_theo').val()) || 0;
    
    const call30s = block6s + (perSecond * 24);
    const call1m = firstMinute;
    const call5m = firstMinute + (nextMinute * 4);
    
    $('#preview-30s').text(formatCurrency(call30s) + ' VNĐ');
    $('#preview-1m').text(formatCurrency(call1m) + ' VNĐ');
    $('#preview-5m').text(formatCurrency(call5m) + ' VNĐ');
}

/**
 * Khởi tạo Select2 với flag
 */
export function initializeSelect2() {
    function formatState(state) {
        if (!state.id) return state.text;
        const flagCode = $(state.element).data('flag') || 'vn';
        return $(
            `<div class="d-flex align-items-center">
                <span class="flag-icon flag-icon-${flagCode.toLowerCase()} mr-2"></span>
                <span>${state.text}</span>
            </div>`
        );
    }

    $('.select2-with-flag').select2({
        templateResult: formatState,
        templateSelection: formatState,
        placeholder: "Chọn quốc gia",
        width: '100%',
        dropdownParent: $('#modal-cuoc-voip'),
        language: {
            noResults: function() {
                return "Không tìm thấy quốc gia";
            }
        }
    });
}

export { cuocPhiTable };