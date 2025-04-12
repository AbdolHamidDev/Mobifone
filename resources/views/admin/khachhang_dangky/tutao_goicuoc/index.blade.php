@extends('layouts.admin')

@section('content')
<x-layout.content-header name="Khách hàng" key="tự tạo gói cước" />
<div class="container-fluid px-4">
 

    <div class="card shadow-sm mb-4">
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="customPackagesTable" class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Số điện thoại</th>
                            <th>Mã gói cước</th>
                            <th>Thoại nội mạng</th>
                            <th>Thoại ngoại mạng</th>
                            <th>Dung lượng</th>
                            <th>Giá tiền</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($packages as $package)
                            <tr>
                                <td>{{ $loop->iteration + ($packages->currentPage() - 1) * $packages->perPage() }}</td>
                                <td>{{ $package->phone_number }}</td>
                                <td><span class="badge bg-success">{{ $package->ma_goi_cuoc }}</span></td>
                                <td>{{ $package->thoai_noi_mang }} phút</td>
                                <td>{{ $package->thoai_ngoai_mang }} phút</td>
                                <td>{{ $package->dung_luong }} GB</td>
                                <td>{{ number_format($package->gia_tien, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $package->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
           
        </div>
    </div>
</div>
@endsection
<style>
    .table thead th {
    text-align: center;
    vertical-align: middle;
    background-color: #f8f9fa;
    color: #333;
}

.table tbody td {
    text-align: center;
    vertical-align: middle;
}

.badge.bg-success {
    font-size: 0.9rem;
    padding: 0.5em 0.8em;
}

    </style>

    <script>
 document.addEventListener('DOMContentLoaded', function () {
    $('#customPackagesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('custom-packages.api') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'phone_number', name: 'phone_number' },
            {
                data: 'ma_goi_cuoc',
                name: 'ma_goi_cuoc',
                render: function (data, type, row) {
                    return `<span class="badge bg-success">${data}</span>`;
                }
            },
            { data: 'thoai_noi_mang', name: 'thoai_noi_mang', orderable: false, searchable: false },
            { data: 'thoai_ngoai_mang', name: 'thoai_ngoai_mang', orderable: false, searchable: false },
            { data: 'dung_luong', name: 'dung_luong', orderable: false, searchable: false },
            { data: 'gia_tien', name: 'gia_tien', orderable: false, searchable: false },
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