@extends('layouts.admin')

@section('content')
<x-layout.content-header name="Lịch sử" key="Hủy gói" />
<div class="container">

    
    <div class="mb-3">
        <label for="filter-type">Lọc theo loại gói:</label>
        <select id="filter-type" class="form-select">
            <option value="all">Tất cả</option>
            <option value="goicuoc">Gói Cước</option>
            <option value="goidata">Gói Data</option>
        </select>
    </div>

    <table id="cancellation-table" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Số Điện Thoại</th>
                <th>Tên Gói</th>
                <th>Giá</th>
                <th>Loại Gói</th>
                <th>Lý Do Hủy</th>
                <th>Người Hủy</th>
                <th>Thời Gian Hủy</th>
                <th>Hành Động</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    let table = $('#cancellation-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("cancellations.apiIndex") }}',
            data: function(d) {
                d.type = $('#filter-type').val(); // Gửi thêm bộ lọc
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'phone_number', name: 'phone_number' },
            { data: 'package_name', name: 'package_name' },
            { data: 'package_price', name: 'package_price' },
            { data: 'type_label', name: 'type_label' },
            { data: 'cancel_reason', name: 'cancel_reason' },
            { data: 'cancel_by', name: 'cancel_by' },
            { data: 'cancelled_at', name: 'cancelled_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            search: "Tìm kiếm nhanh:",
            lengthMenu: "Hiển thị _MENU_ bản ghi",
            info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            paginate: {
                previous: "Trước",
                next: "Tiếp"
            }
        }
    });

    // Lọc theo loại gói
    $('#filter-type').on('change', function() {
        table.ajax.reload();
    });
});
</script>
@endsection
