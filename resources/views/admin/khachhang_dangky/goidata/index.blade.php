@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Khách hàng', 'key' => 'Đăng ký gói Data'])

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="subscriptionsDataTable" class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Số điện thoại</th>
                            <th>Tên gói Data</th>
                            <th>Giá gói</th>
                            <th>Thời gian đăng ký</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#subscriptionsDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('subscriptions2.api') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'ten_data', name: 'goiData.ten_data' },
                { data: 'gia', name: 'goiData.gia', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' }
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
            },
        });
    });
</script>
@endsection
