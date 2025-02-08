@extends('layouts.frontend')
<link rel="stylesheet" href="{{ asset('frontends/main_dieuhuong.css') }}">
@section('content')
<div class="container" style="padding-top: 15vh;">
      <!-- THANH ĐIỀU HƯỚNG -->
      <div class="breadcrumb">
        <a href="/"><i class="fas fa-home"></i> Trang chủ</a>
        <span class="divider">/</span>
        <span class="current">Tra cứu đơn hàng</span>
    </div>

    <h2 class="text-center my-4">Tra Cứu Đơn Hàng</h2>

    @if ($orders->isEmpty())
        <div class="alert alert-warning text-center">
            Bạn chưa có đơn hàng nào.
        </div>
    @else
        <table id="ordersTable" class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Mã Đơn</th>
                    <th>Gói Cước</th>
                    <th>Loại SIM</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Đặt</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ $order->goiCuoc->ten_goicuoc ?? 'Không xác định' }}</td>
                    <td>{{ $order->sim_type }}</td>
                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
                    <td>
                        <span class="badge 
                            @if($order->trang_thai == 'Chờ xác nhận') bg-warning 
                            @elseif($order->trang_thai == 'Đã xác nhận') bg-info
                            @elseif($order->trang_thai == 'Đang giao') bg-primary
                            @elseif($order->trang_thai == 'Hoàn thành') bg-success
                            @else bg-danger
                            @endif">
                            {{ $order->trang_thai }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@section('js')
<!-- Thư viện jQuery (Tải trước DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Thư viện DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    if ($.fn.DataTable) {
        $('#ordersTable').DataTable({
            "language": {
                "search": "Tìm kiếm:",
                "lengthMenu": "Hiển thị _MENU_ đơn hàng",
                "info": "Hiển thị _START_ đến _END_ trong _TOTAL_ đơn hàng",
                "paginate": {
                    "first": "Trang đầu",
                    "last": "Trang cuối",
                    "next": "Tiếp",
                    "previous": "Trước"
                }
            }
        });
    } else {
        console.error("DataTables chưa được tải đúng cách.");
    }
  });
</script>
@endsection
