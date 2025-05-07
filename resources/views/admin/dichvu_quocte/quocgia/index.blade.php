@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Danh sách quốc gia" />

<div class="container">
    <button class="btn btn-primary mb-3" id="btn-add">+ Thêm Quốc Gia</button>

    <table class="table table-bordered yajra-datatable" id ="quocgia">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Quốc Gia</th>
                <th>Mã Quốc Gia</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- Modal Thêm/Sửa Quốc Gia -->
<div class="modal fade" id="modal-quocgia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-quocgia">
            @csrf
            <input type="hidden" id="quocgia_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm/Sửa Quốc Gia</h5>
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
                        <label class="form-label">Tên Quốc Gia</label>
                        <input type="text" class="form-control" id="ten_quoc_gia" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Mã Quốc Gia</label>
                        <input type="text" class="form-control" id="ma_quoc_gia" readonly>
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
 document.addEventListener('DOMContentLoaded', function () {
    // Khởi tạo DataTable cho Quốc Gia
    var table = $('#quocgia').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('quoc-gia.index') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'ten_quoc_gia', name: 'ten_quoc_gia' },
            { data: 'ma_quoc_gia', name: 'ma_quoc_gia' },
            {
                data: 'id',
                name: 'actions',
                render: (data) => `
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-outline-primary btn-sm btn-edit me-2" data-id="${data}">
                            <i class="fas fa-edit"></i> Sửa
                        </button>
                        <button class="btn btn-outline-danger btn-sm btn-delete" data-id="${data}">
                            <i class="fas fa-trash-alt"></i> Xóa
                        </button>
                    </div>
                `
            }
        ],
        language: {
            sProcessing: "Đang xử lý...",
            sLengthMenu: "Hiển thị _MENU_ bản ghi",
            sZeroRecords: "Không tìm thấy dữ liệu phù hợp",
            sInfo: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            sInfoEmpty: "Hiển thị 0 đến 0 của 0 bản ghi",
            sInfoFiltered: "(lọc từ _MAX_ bản ghi)",
            sSearch: "Tìm kiếm:",
            oPaginate: {
                sFirst: "Đầu",
                sLast: "Cuối",
                sNext: "Sau",
                sPrevious: "Trước",
            },
        }
    });

    // Xử lý sự kiện mở modal để thêm quốc gia
    $('#btn-add').click(function () {
        $('#modal-quocgia').modal('show');
        $('#quocgia_id').val('');
        $('#ten_quoc_gia').val('');
        $('#ma_quoc_gia').val('');
        fetchCountries();
    });

    // Gọi API lấy danh sách quốc gia
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

        } catch (error) {
            console.error("Lỗi khi lấy danh sách quốc gia:", error);
        }
    }

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

    </script>
    
@endsection
