@extends('layouts.admin')
<script src="{{ asset('admins/datatable-language.js') }}"></script>


@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'quốc gia'])

<div class="container">
   

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold text-gray-700 flex items-center">
                    <i class="fas fa-globe-americas text-blue-500 mr-2"></i> Danh sách Quốc Gia
                </h2>
                <button class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all flex items-center" id="btn-add">
                    <i class="fas fa-plus mr-2"></i> Thêm Quốc Gia
                </button>
            </div>
    
            <table id="quocgia" class="w-full text-sm text-gray-600 border-collapse">
                <thead class="bg-blue-500 text-white uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2 w-16 text-center">#</th>
                        <th class="px-4 py-2">Tên Quốc Gia</th>
                        <th class="px-4 py-2">Mã</th>
                        <th class="px-4 py-2 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-100"></tbody>
            </table>
        </div>
    </div>
    
</div>

<!-- Modal Thêm/Sửa Quốc Gia -->
<div class="modal fade" id="modal-quocgia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="form-quocgia" class="modal-content rounded-lg shadow-lg">
            @csrf
            <input type="hidden" id="quocgia_id">

            <div class="modal-header bg-blue-600 text-white">
                <h5 class="modal-title flex items-center">
                    <i class="fas fa-flag mr-2"></i> Thêm/Sửa Quốc Gia
                </h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <!-- Dropdown Chọn Quốc Gia -->
                <div class="mb-4">
                    <label class="form-label font-semibold">Chọn Quốc Gia</label>
                    <select class="form-control border px-3 py-2 rounded" id="select-quoc-gia">
                        <option value="">-- Chọn quốc gia --</option>
                    </select>
                </div>

                <!-- Hiển thị lá cờ quốc gia -->
                <div id="flag-display" class="flex items-center space-x-3 mb-4 hidden">
                    <img id="flag-img" src="" class="w-12 h-8 border rounded-md shadow">
                    <span id="flag-name" class="text-gray-700 font-semibold"></span>
                </div>

                <div class="mb-4">
                    <label class="form-label font-semibold">Tên Quốc Gia</label>
                    <input type="text" class="form-control bg-gray-100 border px-3 py-2 rounded" id="ten_quoc_gia" readonly>
                </div>

                <div class="mb-4">
                    <label class="form-label font-semibold">Mã Quốc Gia</label>
                    <input type="text" class="form-control bg-gray-100 border px-3 py-2 rounded" id="ma_quoc_gia" readonly>
                </div>
            </div>

            <div class="modal-footer bg-gray-100">
                <span id="duplicate-warning" class="text-red-500 hidden">⚠ Quốc gia này đã có trong danh sách!</span>
                <button type="submit" class="btn btn-success px-4 py-2 rounded" id="btn-save"> <i class="fas fa-save"></i> Lưu</button>
                <button type="button" class="btn btn-secondary px-4 py-2 rounded" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Hủy
                </button>
            </div>
        </form>
    </div>
</div>



<script>
    
document.addEventListener('DOMContentLoaded', function () {
    const columns = [
        { data: 'id', name: 'id', className: "px-4 py-2 text-center font-bold" },
        { data: 'ten_quoc_gia', name: 'ten_quoc_gia', className: "px-4 py-2" },
        {
            data: 'ma_quoc_gia',
            name: 'ma_quoc_gia',
            className: "px-4 py-2",
            render: (data) => {
                let flagUrl = `https://flagcdn.com/w40/${data.toLowerCase()}.png`;
                return `<div class="flex items-center">
                            <img src="${flagUrl}" alt="Flag" class="w-6 h-4 mr-2 rounded border">
                            ${data}
                        </div>`;
            }
        },
        {
            data: 'id',
            name: 'actions',
            orderable: false,
            searchable: false,
            className: "text-center",
            render: (data) => `
                <div class="flex justify-center space-x-2">
          

                    <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition-all btn-delete" data-id="${data}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            `
        }
    ];

    // Gọi hàm khởi tạo DataTable từ file `datatable-config.js`
    table = initDataTable('#quocgia', "{{ route('quoc-gia.index') }}", columns);



    // Khi mở modal thêm quốc gia
    $('#btn-add').click(async function () {
        $('#modal-quocgia').modal('show');
        $('#quocgia_id').val('');
        $('#ten_quoc_gia').val('');
        $('#ma_quoc_gia').val('');
        $('#btn-save').show(); // Hiển thị lại nút Lưu nếu trước đó đã ẩn
        $('#duplicate-warning').hide(); // Ẩn cảnh báo nếu trước đó đã hiển thị

        await fetchCountries();
    });

    // Hàm lấy danh sách quốc gia từ API
    async function fetchCountries() {
        try {
            const response = await fetch("https://restcountries.com/v3.1/all");
            const data = await response.json();
            let select = $('#select-quoc-gia');
            select.empty().append('<option value="">-- Chọn quốc gia --</option>');

            data.forEach(country => {
                let option = `<option value="${country.cca2}" data-name="${country.name.common}">
                                ${country.name.common}
                              </option>`;
                select.append(option);
            });

            // Kiểm tra khi chọn quốc gia
            checkExistingCountry();

        } catch (error) {
            console.error("Lỗi khi lấy danh sách quốc gia:", error);
        }
    }

    // Hàm kiểm tra quốc gia đã tồn tại
    function checkExistingCountry() {
        let existingCountries = new Set(); // Danh sách mã quốc gia đã có
        table.rows().data().each((row) => {
            existingCountries.add(row.ma_quoc_gia);
        });

        $('#select-quoc-gia').on('change', function () {
            let selectedCode = $(this).val();
            let selectedName = $(this).find(":selected").data("name");

            $('#ten_quoc_gia').val(selectedName);
            $('#ma_quoc_gia').val(selectedCode);

            if (existingCountries.has(selectedCode)) {
                $('#btn-save').hide(); // Ẩn nút Lưu nếu quốc gia đã tồn tại
                $('#duplicate-warning').show(); // Hiển thị thông báo
            } else {
                $('#btn-save').show(); // Hiện nút Lưu nếu quốc gia chưa có
                $('#duplicate-warning').hide(); // Ẩn cảnh báo
            }
        });
    }



// Gọi hàm khi trang tải
fetchCountries();


    // Cập nhật tên và mã quốc gia khi chọn từ dropdown
    $('#select-quoc-gia').change(function () {
        let selectedOption = $(this).find(':selected');
        $('#ten_quoc_gia').val(selectedOption.data('name'));
        $('#ma_quoc_gia').val(selectedOption.val());
    });

    // Xử lý Thêm/Sửa quốc gia
    $('#form-quocgia').submit(function (e) {
        e.preventDefault();
        let id = $('#quocgia_id').val();
        let url = id ? `/admin/quoc-gia/${id}` : "/admin/quoc-gia";
        let method = id ? "PUT" : "POST";

        $.ajax({
            url: url,
            type: method,
            data: {
                _token: "{{ csrf_token() }}",
                ten_quoc_gia: $('#ten_quoc_gia').val(),
                ma_quoc_gia: $('#ma_quoc_gia').val()
            },
            success: function (response) {
                Swal.fire("Thành công!", response.message, "success");
                $('#modal-quocgia').modal('hide');
                table.ajax.reload();
            }
        });
    });

    // Xử lý xóa quốc gia
    $('#quocgia').on('click', '.btn-delete', function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Bạn có chắc muốn xóa?",
            text: "Hành động này không thể hoàn tác!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Xóa ngay!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/quoc-gia/${id}`,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function (response) {
                        Swal.fire("Đã xóa!", response.message, "success");
                        table.ajax.reload();
                    }
                });
            }
        });
    });

    // Xử lý sửa quốc gia
    $('#quocgia').on('click', '.btn-edit', function () {
        let id = $(this).data("id");
        $.get(`/admin/quoc-gia/${id}/edit`, function (data) {
            $('#quocgia_id').val(data.id);
            $('#ten_quoc_gia').val(data.ten_quoc_gia);
            $('#ma_quoc_gia').val(data.ma_quoc_gia);
            $('#modal-quocgia').modal('show');
        });
    });
});


async function fetchCountries() {
    try {
        const response = await fetch("https://restcountries.com/v3.1/all");
        const data = await response.json();
        let select = $('#select-quoc-gia');
        select.empty().append('<option value="">-- Chọn quốc gia --</option>');

        data.forEach(country => {
            let option = `
                <option value="${country.cca2}" data-name="${country.name.common}" data-flag="${country.flags.svg}">
                    ${country.name.common}
                </option>`;
            select.append(option);
        });

        // Hiển thị lá cờ khi chọn quốc gia
        select.change(function () {
            let selectedOption = $(this).find(':selected');
            let flagUrl = selectedOption.data('flag');
            let countryName = selectedOption.data('name');

            if (flagUrl) {
                $('#flag-display').removeClass('hidden');
                $('#flag-img').attr('src', flagUrl);
                $('#flag-name').text(countryName);
            } else {
                $('#flag-display').addClass('hidden');
            }
        });

    } catch (error) {
        console.error("Lỗi khi lấy danh sách quốc gia:", error);
    }
}

// Gọi hàm khi modal mở
$('#modal-quocgia').on('shown.bs.modal', function () {
    fetchCountries();
});










    </script>
    
@endsection
