@extends('layouts.admin')

@section('title')
    <title>Admin Dashboard</title>
@endsection

@section('content')
@include('partials.content-header', ['name' => 'Dashboard', 'key' => ''])

<div class="container mt-4">
  
    <!-- Phần thống kê -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow border-left-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng Số Người Dùng
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1,234</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow border-left-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Doanh Thu Hôm Nay
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$12,345</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow border-left-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Yêu Cầu Hỗ Trợ
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">56</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-headset fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow border-left-danger">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Cảnh Báo Hệ Thống
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Phần hoạt động gần đây -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Hoạt Động Gần Đây</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Người dùng <b>John Doe</b> vừa đăng nhập</li>
                        <li class="list-group-item">Yêu cầu hỗ trợ mới từ <b>Jane Smith</b></li>
                        <li class="list-group-item">Hệ thống cập nhật thành công</li>
                        <li class="list-group-item">Thanh toán mới: <b>$123</b></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
