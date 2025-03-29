import { initializeDataTable } from './datatable-config.js';
import { loadQuocGiaNhaKhaiThac, setupFormHandlers } from './form-handler.js';
import { initializeSelect2, setupFormValidation, setupModalTitle } from './select2-init.js';

let isInitialized = false;

export function initializeCuocQuocTe() {
    // Tránh khởi tạo nhiều lần
    if (isInitialized) return;
    isInitialized = true;

    // Khởi tạo DataTable
    const table = initializeDataTable();

    // Thiết lập các sự kiện form
    setupFormHandlers(table);

    // Khởi tạo Select2 và validation
    initializeSelect2();
    setupFormValidation();
    setupModalTitle();

    // Xóa sự kiện cũ trước khi bind mới
    $('#modal-cuoc-quoc-te').off('show.bs.modal').on('show.bs.modal', function() {
        $('body').css('overflow', 'auto'); 
        $('.modal-backdrop').remove();
        loadQuocGiaNhaKhaiThac().then(data => {
            const quocGiaDropdown = $('#select-quoc-gia');
            const nhaKhaiThacDropdown = $('#select-nha-khai-thac');

            quocGiaDropdown.empty().append('<option value="">-- Chọn quốc gia --</option>');
            nhaKhaiThacDropdown.empty().append('<option value="">-- Chọn nhà khai thác --</option>');

            data.quoc_gia.forEach(q => {
                quocGiaDropdown.append($('<option></option>').val(q.id).text(q.ten_quoc_gia));
            });

            data.nha_khai_thac.forEach(n => {
                nhaKhaiThacDropdown.append($('<option></option>').val(n.id).text(n.ten_nha_khai_thac));
            });

            // Khởi tạo lại Select2 sau khi thêm options
            if ($.fn.select2) {
                quocGiaDropdown.trigger('change');
                nhaKhaiThacDropdown.trigger('change');
            }
        }).catch(error => {
            console.error('Lỗi khi tải dữ liệu quốc gia và nhà khai thác:', error);
        });
    });
}

// Hàm cleanup khi cần
export function cleanupCuocQuocTe() {
    $('#modal-cuoc-quoc-te').off('show.bs.modal');
    isInitialized = false;
}