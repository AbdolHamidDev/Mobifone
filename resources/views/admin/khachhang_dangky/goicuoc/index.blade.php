@extends('layouts.admin')

@section('content')
<x-layout.content-header name="Khách hàng" key="Đã đăng ký gói cước" />

<div class="container mt-4">
    <div class="card shadow-sm">
   
        <div class="card-body">
            <div class="table-responsive">
                <table id="subscriptionsTable" class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Số điện thoại</th>
                            <th>Tên gói cước</th>
                            <th>Giá gói</th>
                            <th>Thời gian đăng ký</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subscriptions as $subscription)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subscription->phone_number }}</td>
                                <td>{{ $subscription->package->ten_goicuoc }}</td>
                                <td>{{ number_format($subscription->package->gia, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $subscription->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Chưa có đăng ký nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript DataTable -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#subscriptionsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('subscriptions.api') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'ten_goicuoc', name: 'package.ten_goicuoc' },
                { data: 'gia', name: 'package.gia', orderable: false, searchable: false },
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
<style>
    table tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.05);
}
body {
    font-family: 'Roboto', sans-serif;
}

.card-header {
    background: linear-gradient(45deg, #4caf50, #2196f3);
    color: white;
}

.table {
    border: 1px solid #ddd;
}

.table th {
    text-transform: uppercase;
    font-weight: bold;
}

    </style>