@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Danh sách Cước quốc tế" />

<div class="container">
    <button class="btn btn-primary mb-3" id="btn-add">+ Thêm Cước Quốc Tế</button>

    <table id="cuoc-quoc-te-table" class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Quốc Gia</th>
                <th>Nhà Khai Thác</th>
                <th>Loại Thuê Bao</th>
                <th>Gọi Trong Mạng</th>
                <th>Gọi về VN</th>
                <th>Gọi Quốc Tế</th>
                <th>Gọi Vệ Tinh</th>
                <th>Nhận Cuộc Gọi</th>
                <th>Gửi SMS</th>
                <th>Data (MB)</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modal-cuoc-quoc-te" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-cuoc-quoc-te">
            @csrf
            <input type="hidden" id="cuoc_quoc_te_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm/Sửa Cước Quốc Tế</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Chọn Quốc Gia</label>
                        <select class="form-control" id="select-quoc-gia"></select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Chọn Nhà Khai Thác</label>
                        <select class="form-control" id="select-nha-khai-thac"></select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại Thuê Bao</label>
                        <select class="form-control" id="loai_thue_bao">
                            <option value="Trả trước">Trả trước</option>
                            <option value="Trả sau">Trả sau</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gọi Trong Mạng</label>
                        <input type="number" class="form-control" id="cuoc_goi_trong_mang">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gọi về VN</label>
                        <input type="number" class="form-control" id="cuoc_goi_ve_vn">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gọi Quốc Tế</label>
                        <input type="number" class="form-control" id="cuoc_quoc_te">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gọi Vệ Tinh</label>
                        <input type="number" class="form-control" id="cuoc_ve_tinh">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nhận Cuộc Gọi</label>
                        <input type="number" class="form-control" id="cuoc_nhan_goi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gửi SMS</label>
                        <input type="number" class="form-control" id="cuoc_sms">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data (MB)</label>
                        <input type="number" class="form-control" id="cuoc_data">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
$(document).ready(function() {
    if ($('#cuoc-quoc-te-table').length) {
        $('#cuoc-quoc-te-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cuoc-quoc-te.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'quoc_gia', name: 'quoc_gia'},
                {data: 'nha_khai_thac', name: 'nha_khai_thac'},
                {data: 'loai_thue_bao', name: 'loai_thue_bao'},
                {data: 'cuoc_goi_trong_mang', name: 'cuoc_goi_trong_mang'},
                {data: 'cuoc_goi_ve_vn', name: 'cuoc_goi_ve_vn'},
                {data: 'cuoc_quoc_te', name: 'cuoc_quoc_te'},
                {data: 'cuoc_ve_tinh', name: 'cuoc_ve_tinh'},
                {data: 'cuoc_nhan_goi', name: 'cuoc_nhan_goi'},
                {data: 'cuoc_sms', name: 'cuoc_sms'},
                {data: 'cuoc_data', name: 'cuoc_data'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        });
    } else {
        console.error("Bảng không tồn tại, kiểm tra ID hoặc class của bảng.");
    }


    // Load danh sách quốc gia và nhà khai thác từ database
    function loadQuocGiaNhaKhaiThac() {
        $.get("/admin/get-quoc-gia-nha-khai-thac", function(data) {
            let quocGiaDropdown = $('#select-quoc-gia');
            let nhaKhaiThacDropdown = $('#select-nha-khai-thac');

            quocGiaDropdown.empty().append('<option value="">-- Chọn quốc gia --</option>');
            nhaKhaiThacDropdown.empty().append('<option value="">-- Chọn nhà khai thác --</option>');

            data.quoc_gia.forEach(q => {
                quocGiaDropdown.append(`<option value="${q.id}">${q.ten_quoc_gia}</option>`);
            });

            data.nha_khai_thac.forEach(n => {
                nhaKhaiThacDropdown.append(`<option value="${n.id}">${n.ten_nha_khai_thac}</option>`);
            });
        });
    }

    // Mở modal thêm mới
    $('#btn-add').click(function () {
        $('#modal-cuoc-quoc-te').modal('show');
        $('#cuoc_quoc_te_id').val('');
        $('#form-cuoc-quoc-te')[0].reset();
        loadQuocGiaNhaKhaiThac();
    });

    // Thêm/Sửa cước quốc tế
    $('#form-cuoc-quoc-te').submit(function (e) {
        e.preventDefault();
        let id = $('#cuoc_quoc_te_id').val();
        let url = id ? "/admin/cuoc-quoc-te/" + id : "/admin/cuoc-quoc-te";
        let method = id ? "PUT" : "POST";

        $.ajax({
            url: url,
            type: method,
            data: {
                _token: "{{ csrf_token() }}",
                quoc_gia_id: $('#select-quoc-gia').val(),
                nha_khai_thac_id: $('#select-nha-khai-thac').val(),
                loai_thue_bao: $('#loai_thue_bao').val(),
                cuoc_goi_trong_mang: $('#cuoc_goi_trong_mang').val(),
                cuoc_goi_ve_vn: $('#cuoc_goi_ve_vn').val(),
                cuoc_quoc_te: $('#cuoc_quoc_te').val(),
                cuoc_ve_tinh: $('#cuoc_ve_tinh').val(),
                cuoc_nhan_goi: $('#cuoc_nhan_goi').val(),
                cuoc_sms: $('#cuoc_sms').val(),
                cuoc_data: $('#cuoc_data').val()
            },
            success: function (response) {
                Swal.fire("Thành công!", response.message, "success");
                $('#modal-cuoc-quoc-te').modal('hide');
                table.ajax.reload();
            }
        });
    });

    // Xóa cước quốc tế
    $('body').on('click', '.btn-delete', function () {
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
                    url: "/admin/cuoc-quoc-te/" + id,
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

    // Sửa cước quốc tế
    $('body').on('click', '.btn-edit', function () {
        let id = $(this).data("id");
        $.get("/admin/cuoc-quoc-te/" + id + "/edit", function (data) {
            $('#cuoc_quoc_te_id').val(data.id);
            $('#select-quoc-gia').val(data.quoc_gia_id);
            $('#select-nha-khai-thac').val(data.nha_khai_thac_id);
            $('#loai_thue_bao').val(data.loai_thue_bao);
            $('#cuoc_goi_trong_mang').val(data.cuoc_goi_trong_mang);
            $('#cuoc_goi_ve_vn').val(data.cuoc_goi_ve_vn);
            $('#cuoc_quoc_te').val(data.cuoc_quoc_te);
            $('#cuoc_ve_tinh').val(data.cuoc_ve_tinh);
            $('#cuoc_nhan_goi').val(data.cuoc_nhan_goi);
            $('#cuoc_sms').val(data.cuoc_sms);
            $('#cuoc_data').val(data.cuoc_data);
            $('#modal-cuoc-quoc-te').modal('show');
        });
    });

});


</script>
@endsection
