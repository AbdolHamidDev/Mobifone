@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Nhà khai thác'])

<div class="container">
    <button class="btn btn-primary mb-3" id="btn-add">+ Thêm Nhà Khai Thác</button>

    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Nhà Khai Thác</th>
                <th>Mã Nhà Khai Thác</th>
                <th>Quốc Gia</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal Thêm/Sửa Nhà Khai Thác -->
<div class="modal fade" id="modal-nha-khai-thac" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-nha-khai-thac">
            @csrf
            <input type="hidden" id="nha_khai_thac_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm/Sửa Nhà Khai Thác</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Dropdown Chọn Quốc Gia -->
                    <div class="mb-3">
                        <label class="form-label">Chọn Quốc Gia</label>
                        <select class="form-control" id="select-quoc-gia">
                            <option value="">-- Chọn quốc gia --</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Tên Nhà Khai Thác</label>
                        <input type="text" class="form-control" id="ten_nha_khai_thac" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mã Nhà Khai Thác</label>
                        <input type="text" class="form-control" id="ma_nha_khai_thac" required>
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
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('nha-khai-thac.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'ten_nha_khai_thac', name: 'ten_nha_khai_thac'},
                {data: 'ma_nha_khai_thac', name: 'ma_nha_khai_thac'},
                {data: 'quoc_gia', name: 'quoc_gia'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        });
    
        // Lấy danh sách quốc gia từ database
        function fetchQuocGia() {
            $.get("/admin/get-quoc-gia", function(data) {
                let select = $('#select-quoc-gia');
                select.empty().append('<option value="">-- Chọn quốc gia --</option>');
    
                data.forEach(quocgia => {
                    let option = `<option value="${quocgia.id}">${quocgia.ten_quoc_gia}</option>`;
                    select.append(option);
                });
            });
        }
    
        // Mở modal thêm nhà khai thác
        $('#btn-add').click(function() {
            $('#modal-nha-khai-thac').modal('show');
            $('#nha_khai_thac_id').val('');
            $('#ten_nha_khai_thac').val('');
            $('#ma_nha_khai_thac').val('');
            fetchQuocGia();
        });
    
        // Gửi dữ liệu Thêm/Sửa
        $('#form-nha-khai-thac').submit(function(e) {
            e.preventDefault();
            let id = $('#nha_khai_thac_id').val();
            let url = id ? "/admin/nha-khai-thac/" + id : "/admin/nha-khai-thac";
            let method = id ? "PUT" : "POST";
    
            $.ajax({
                url: url,
                type: method,
                data: {
                    _token: "{{ csrf_token() }}",
                    ten_nha_khai_thac: $('#ten_nha_khai_thac').val(),
                    ma_nha_khai_thac: $('#ma_nha_khai_thac').val(),
                    quoc_gia_id: $('#select-quoc-gia').val()
                },
                success: function(response) {
                    Swal.fire("Thành công!", response.message, "success");
                    $('#modal-nha-khai-thac').modal('hide');
                    table.ajax.reload();
                }
            });
        });
    
        // Xóa nhà khai thác
        $('body').on('click', '.btn-delete', function() {
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
                        url: "/admin/nha-khai-thac/" + id,
                        type: "DELETE",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            Swal.fire("Đã xóa!", response.message, "success");
                            table.ajax.reload();
                        }
                    });
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
    
    });
    </script>
    
@endsection
