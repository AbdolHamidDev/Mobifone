@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Danh sách gói Voip" />

  
<button class="btn btn-primary mb-3" id="btn-add">+ Thêm Gói Voip</button>

    <table class="table table-bordered" id="cuocPhiTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Quốc gia</th>
                <th>Nhóm cước</th>
                <th>Mã vùng</th>
                <th>Block 6s đầu</th>
                <th>Giá mỗi giây</th>
                <th>Giá 1 phút đầu</th>
                <th>Hành động</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal Thêm/Sửa -->
<div class="modal fade" id="modal-cuoc-voip">
    <div class="modal-dialog">
        <form id="form-cuoc-voip">
            @csrf
            <input type="hidden" id="cuoc_voip_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm/Sửa Cước VoIP</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Chọn quốc gia -->
                    <label>Chọn quốc gia:</label>
                    <select id="select-quoc-gia" name="quoc_gia_id" class="form-control">
                        @foreach($quocGias as $qg)
                            <option value="{{ $qg->id }}">{{ $qg->ten_quoc_gia }}</option>
                        @endforeach
                    </select>

                    <!-- Nhóm cước -->
                    <label>Nhóm cước:</label>
                    <input type="text" id="nhom_cuoc" name="nhom_cuoc" class="form-control" required>

                    <!-- Mã vùng -->
                    <label>Mã vùng:</label>
                    <input type="text" id="ma_vung" name="ma_vung" class="form-control">

                    <!-- Block 6s đầu -->
                    <label>Block 6s đầu:</label>
                    <input type="number" id="block_6s_dau" name="block_6s_dau" class="form-control">

                    <!-- Giá mỗi giây -->
                    <label>Giá mỗi giây:</label>
                    <input type="number" id="gia_moi_giay" name="gia_moi_giay" class="form-control">

                    <!-- Giá 1 phút đầu -->
                    <label>Giá 1 phút đầu:</label>
                    <input type="number" id="gia_1_phut_dau" name="gia_1_phut_dau" class="form-control">

                    <!-- Giá 1 phút tiếp theo -->
                    <label>Giá 1 phút tiếp theo:</label>
                    <input type="number" id="gia_1_phut_tiep_theo" name="gia_1_phut_tiep_theo" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>





<script>
    $(document).ready(function() {
        let table = $('#cuocPhiTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('goi-voip-cuoc-phi.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'quoc_gia_id', name: 'quoc_gia_id' },
                { data: 'nhom_cuoc', name: 'nhom_cuoc' },
                { data: 'ma_vung', name: 'ma_vung' },
                { data: 'block_6s_dau', name: 'block_6s_dau' },
                { data: 'gia_moi_giay', name: 'gia_moi_giay' },
                { data: 'gia_1_phut_dau', name: 'gia_1_phut_dau' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    
        // Mở modal Thêm mới
        $('#btn-add').click(function () {
            $('#modal-cuoc-voip').modal('show');
            $('#cuoc_voip_id').val('');
            $('#form-cuoc-voip')[0].reset();
        });
    
        // Sửa cước VoIP - Mở modal và tải dữ liệu
        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            $.get("/admin/goi-voip-cuoc-phi/" + id + "/edit", function(data) {
                $('#modal-cuoc-voip').modal('show');
                $('#cuoc_voip_id').val(data.id);
                $('#select-quoc-gia').val(data.quoc_gia_id);
                $('#nhom_cuoc').val(data.nhom_cuoc);
                $('#ma_vung').val(data.ma_vung);
                $('#block_6s_dau').val(data.block_6s_dau);
                $('#gia_moi_giay').val(data.gia_moi_giay);
                $('#gia_1_phut_dau').val(data.gia_1_phut_dau);
                $('#gia_1_phut_tiep_theo').val(data.gia_1_phut_tiep_theo);
            });
        });
    
        // Lưu (Thêm/Sửa) cước VoIP
        $('#form-cuoc-voip').submit(function(e) {
            e.preventDefault();
            let id = $('#cuoc_voip_id').val();
            let url = id ? "/admin/goi-voip-cuoc-phi/" + id : "/admin/goi-voip-cuoc-phi";
            let method = id ? "PUT" : "POST";
    
            $.ajax({
                url: url,
                type: method,
                data: {
                    _token: "{{ csrf_token() }}",
                    quoc_gia_id: $('#select-quoc-gia').val(),
                    nhom_cuoc: $('#nhom_cuoc').val(),
                    ma_vung: $('#ma_vung').val(),
                    block_6s_dau: $('#block_6s_dau').val(),
                    gia_moi_giay: $('#gia_moi_giay').val(),
                    gia_1_phut_dau: $('#gia_1_phut_dau').val(),
                    gia_1_phut_tiep_theo: $('#gia_1_phut_tiep_theo').val()
                },
                success: function(response) {
                    Swal.fire("Thành công!", response.message, "success");
                    $('#modal-cuoc-voip').modal('hide');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    Swal.fire("Lỗi!", "Vui lòng kiểm tra dữ liệu nhập vào.", "error");
                }
            });
        });
    
        // Xóa cước VoIP
        $(document).on('click', '.delete-btn', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa?",
                text: "Hành động này không thể hoàn tác!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Có, xóa ngay!",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/goi-voip-cuoc-phi/" + id,
                        type: "DELETE",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            Swal.fire("Đã xóa!", response.message, "success");
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire("Lỗi!", "Không thể xóa cước phí.", "error");
                        }
                    });
                }
            });
        });
    
    });
    </script>
    
    
    @endsection