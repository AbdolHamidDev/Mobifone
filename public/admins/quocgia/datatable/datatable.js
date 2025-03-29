/**
 * Hàm khởi tạo và xử lý DataTable
 */

// Khởi tạo DataTable
function initDataTable(selector, apiUrl, columns) {
    const table = $(selector).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: apiUrl,
            type: "GET"
        },
        columns: columns,
        language: {
            url: "/vendor/datatables/vi.json"
        },
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]]
    });
    
    // Lưu trữ biến table để có thể truy cập từ nơi khác
    window.table = table;
    
    return table;
}

// Hàm khởi tạo cột cho DataTable quốc gia
function initCountryColumns() {
    return [
        {
            data: "id",
            name: "id",
            className: "px-4 py-2 text-center font-bold",
        },
        { 
            data: "ten_quoc_gia", 
            name: "ten_quoc_gia", 
            className: "px-4 py-2" 
        },
        {
            data: "ma_quoc_gia",
            name: "ma_quoc_gia",
            className: "px-4 py-2",
            render: (data) => {
                let flagUrl = `https://flagcdn.com/w40/${data.toLowerCase()}.png`;
                return `<div class="flex items-center">
                            <img src="${flagUrl}" alt="Flag" class="w-6 h-4 mr-2 rounded border">
                            ${data}
                        </div>`;
            },
        },
        {
            data: "id",
            name: "actions",
            orderable: false,
            searchable: false,
            className: "text-center",
            render: (data) => `
                <div class="flex justify-center space-x-2">
                    <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition-all btn-delete" data-id="${data}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            `,
        },
    ];
}

// Xuất các hàm
export { initDataTable, initCountryColumns };