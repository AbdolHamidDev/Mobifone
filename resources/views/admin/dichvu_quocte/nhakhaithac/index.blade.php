@extends('layouts.admin')
<script src="{{ asset('admins/datatable-language.js') }}"></script>
@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Nhà khai thác'])

<div class="container">
   

    <div class="p-6 bg-white shadow-lg rounded-xl">
        <!-- Header với nút thêm -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-700 flex items-center">
                <i class="fas fa-network-wired text-blue-500 mr-2"></i> Nhà Khai Thác
            </h2>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-all flex items-center gap-2" id="btn-add">
                <i class="fas fa-plus"></i> Thêm Nhà Khai Thác
            </button>
        </div>
    
        <!-- Bảng dữ liệu -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg shadow-sm yajra-datatable">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                    <tr>
                        <th class="px-4 py-3 border-b">#</th>
                        <th class="px-4 py-3 border-b"><i class="fas fa-building text-gray-500"></i> Tên</th>
                        <th class="px-4 py-3 border-b"><i class="fas fa-barcode text-gray-500"></i> Mã</th>
                        <th class="px-4 py-3 border-b"><i class="fas fa-globe text-gray-500"></i> Quốc Gia</th>
                        <th class="px-4 py-3 border-b text-center"><i class="fas fa-cogs text-gray-500"></i> Hành động</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-center"></tbody>
            </table>
        </div>
    </div>
    
    
</div>

<!-- Modal Thêm/Sửa Nhà Khai Thác -->
<div class="modal fade" id="modal-nha-khai-thac" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Tăng kích thước modal -->
        <form id="form-nha-khai-thac">
            @csrf
            <input type="hidden" id="nha_khai_thac_id">
            <div class="modal-content shadow-lg rounded-lg">
                <div class="modal-header bg-blue-500 text-white">
                    <h5 class="modal-title font-semibold"><i class="fas fa-network-wired mr-2"></i> Thêm/Sửa Nhà Khai Thác</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Dropdown Chọn Quốc Gia (Có tìm kiếm) -->
                    <div class="mb-3">
                        <label class="form-label font-medium">Chọn Quốc Gia <span class="text-red-500">*</span></label>
                        <select class="form-control select2" id="select-quoc-gia" required>
                            <option value="">-- Chọn quốc gia --</option>
                        </select>
                        <small class="text-red-500 hidden" id="error-quoc-gia">Vui lòng chọn quốc gia!</small>
                    </div>

                    <!-- Nhập Tên Nhà Khai Thác -->
                    <div class="mb-3">
                        <label class="form-label font-medium">Tên Nhà Khai Thác <span class="text-red-500">*</span></label>
                        <input type="text" class="form-control" id="ten_nha_khai_thac" required placeholder="Nhập tên nhà khai thác">
                        <small class="text-red-500 hidden" id="error-ten">Vui lòng nhập tên!</small>
                    </div>

                    <!-- Nhập Mã Nhà Khai Thác -->
                    <div class="mb-3">
                        <label class="form-label font-medium">Mã Nhà Khai Thác <span class="text-red-500">*</span></label>
                        <input type="text" class="form-control" id="ma_nha_khai_thac" required placeholder="Nhập mã nhà khai thác">
                        <small class="text-red-500 hidden" id="error-ma">Mã nhà khai thác không hợp lệ!</small>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer bg-gray-100">
                    <button type="submit" class="btn btn-success flex items-center gap-2" id="btn-save">
                        <span id="btn-text">Lưu</span>
                        <span class="spinner-border spinner-border-sm hidden" id="btn-loading"></span>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    
    $(document).ready(function () {
    // Kích hoạt Select2 (Dropdown có tìm kiếm)
    $("#select-quoc-gia").select2({
        placeholder: "Chọn quốc gia",
        width: "100%",
        allowClear: true
    });

    // Kiểm tra lỗi nhập liệu trước khi gửi form
    $("#form-nha-khai-thac").on("submit", function (e) {
        e.preventDefault();
        let valid = true;

        if ($("#select-quoc-gia").val() === "") {
            $("#error-quoc-gia").removeClass("hidden");
            valid = false;
        } else {
            $("#error-quoc-gia").addClass("hidden");
        }

        if ($("#ten_nha_khai_thac").val().trim() === "") {
            $("#error-ten").removeClass("hidden");
            valid = false;
        } else {
            $("#error-ten").addClass("hidden");
        }

        if ($("#ma_nha_khai_thac").val().trim() === "") {
            $("#error-ma").removeClass("hidden");
            valid = false;
        } else {
            $("#error-ma").addClass("hidden");
        }

        if (!valid) return;

        // Hiển thị hiệu ứng loading
        $("#btn-text").text("Đang lưu...");
        $("#btn-loading").removeClass("hidden");

      
       
    });
});

   $(function () {
            // Cấu hình các cột của DataTable
            var columns = [
                {data: 'id', name: 'id'},
                {data: 'ten_nha_khai_thac', name: 'ten_nha_khai_thac'},
                {data: 'ma_nha_khai_thac', name: 'ma_nha_khai_thac'},
                {data: 'quoc_gia', name: 'quoc_gia'},
                {
                    data: 'id',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function (data) {
                        return `
                            <div class="flex justify-center gap-2">
                                <button class="btn-edit bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded-md transition-all shadow-md" data-id="${data}" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-delete bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded-md transition-all shadow-md" data-id="${data}" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ];

            // ✅ Khởi tạo DataTable
            table = initDataTable('.yajra-datatable', "{{ route('nha-khai-thac.index') }}", columns);
        });
  

    // ✅ Hàm lấy danh sách quốc gia (có hiệu ứng Loading)
    async function fetchQuocGia() {
        let select = $('#select-quoc-gia');
        select.html('<option value="">🔄 Đang tải...</option>');

        try {
            let response = await $.get("/admin/get-quoc-gia");
            select.empty().append('<option value="">-- Chọn quốc gia --</option>');
            response.forEach(quocgia => {
                select.append(`<option value="${quocgia.id}">${quocgia.ten_quoc_gia}</option>`);
            });
        } catch (error) {
            console.error("❌ Lỗi khi tải danh sách quốc gia:", error);
        }
    }

    // ✅ Mở modal Thêm nhà khai thác
    $('#btn-add').click(function() {
        $('#modal-nha-khai-thac').modal('show');
        $('#nha_khai_thac_id').val('');
        $('#ten_nha_khai_thac').val('');
        $('#ma_nha_khai_thac').val('');
        fetchQuocGia();
    });

    // ✅ Gửi dữ liệu Thêm/Sửa (Sử dụng Async)
    $('#form-nha-khai-thac').submit(async function(e) {
        e.preventDefault();
        let id = $('#nha_khai_thac_id').val();
        let url = id ? `/admin/nha-khai-thac/${id}` : "/admin/nha-khai-thac";
        let method = id ? "PUT" : "POST";

        try {
            let response = await $.ajax({
                url: url,
                type: method,
                data: {
                    _token: "{{ csrf_token() }}",
                    ten_nha_khai_thac: $('#ten_nha_khai_thac').val(),
                    ma_nha_khai_thac: $('#ma_nha_khai_thac').val(),
                    quoc_gia_id: $('#select-quoc-gia').val()
                }
            });

            Swal.fire("🎉 Thành công!", response.message, "success");
            $('#modal-nha-khai-thac').modal('hide');
            table.ajax.reload(null, false); // 🔄 Chỉ reload dữ liệu thay vì tải lại toàn bộ
        } catch (error) {
            Swal.fire("❌ Lỗi!", "Có lỗi xảy ra, vui lòng thử lại.", "error");
        }
    });

    // ✅ Xóa nhà khai thác (Thêm hiệu ứng xác nhận)
    $('body').on('click', '.btn-delete', function() {
        let id = $(this).data("id");

        Swal.fire({
            title: "❗ Bạn có chắc chắn muốn xóa?",
            text: "Hành động này không thể hoàn tác!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "🗑️ Xóa ngay!",
            cancelButtonText: "❌ Hủy"
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    await $.ajax({
                        url: `/admin/nha-khai-thac/${id}`,
                        type: "DELETE",
                        data: { _token: "{{ csrf_token() }}" }
                    });

                    Swal.fire("✅ Xóa thành công!", "Dữ liệu đã được xóa.", "success");
                    table.ajax.reload(null, false);
                } catch (error) {
                    Swal.fire("❌ Lỗi!", "Không thể xóa, vui lòng thử lại.", "error");
                }
            }
        });
    });

// Sửa nhà khai thác
$('body').on('click', '.btn-edit', function() {
            let id = $(this).data("id");
            $.get("/admin/nha-khai-thac/" + id + "/edit", function(data) {
                $('#nha_khai_thac_id').val(data.id);
                $('#ten_nha_khai_thac').val(data.ten_nha_khai_thac);
                $('#ma_nha_khai_thac').val(data.ma_nha_khai_thac);
                $('#select-quoc-gia').val(data.quoc_gia_id);
                $('#modal-nha-khai-thac').modal('show');
            });
        });
    </script>
    
@endsection
