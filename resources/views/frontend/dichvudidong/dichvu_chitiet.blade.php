@extends('layouts.frontend')
<link rel="stylesheet" href="{{ asset('frontends/main_dieuhuong.css') }}">
@section('content')
<div class="container" style="padding-top: 15vh;">

       <!-- THANH ĐIỀU HƯỚNG -->
       <div class="breadcrumb">
        <a href="/"><i class="fas fa-home"></i> Trang chủ</a>
        <span class="divider">/</span>
        <a href="#">Dịch vụ di động</a>
        <span class="divider">/</span>
        <a href="/dich-vu-di-dong/dich-vu">Dịch vụ</a>
        <span class="divider">/</span>
        <span class="current">Chi tiết dịch vụ</span>
    </div>
        <div class="row">
            <!-- Cột trái: Dịch vụ chính -->
            <div class="col-md-8">
            @if ($dichvu)
                <div class="card mb-4 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <!-- Hiển thị ảnh dịch vụ -->
                            <img src="{{ asset('storage/' . $dichvu->anh) }}" alt="{{ $dichvu->ten_dich_vu }}" class="img-fluid rounded-start">
                        </div>
                        
                        <div class="col-md-10">
                            <div class="card-body">
                                <!-- Hiển thị tên dịch vụ -->
                                <h5 class="card-title">{{ $dichvu->ten_dich_vu }}</h5>
                                <!-- Hiển thị nội dung dịch vụ -->
                                <p class="card-text">{{ $dichvu->noi_dung }}</p>
                                <!-- Hiển thị loại dịch vụ -->
                                <p class="card-text">
                                    <small class="text-muted">Loại dịch vụ: {{ $dichvu->loai_dich_vu }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

       <!-- Chi tiết dịch vụ -->
@if ($dichvuChitiets->isEmpty())
<div class="alert alert-warning text-center">
    <strong>Chưa có chi tiết dịch vụ cho dịch vụ này.</strong>
</div>
@else
<div class="row">
    @foreach ($dichvuChitiets as $chitiet)
        <div class="col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
              
                    <p class="card-text">
                        <strong class="text-large">Đối Tượng Sử Dụng:</strong><br>
                        {!! nl2br(\App\Helpers\ContentHelper::formatContent($chitiet->doi_tuong_su_dung)) !!}
                    </p>
                    <p class="card-text">
                        <strong class="text-large">Tính Năng Chính:</strong><br>
                        {!! nl2br(\App\Helpers\ContentHelper::formatContent($chitiet->tinh_nang_chinh)) !!}
                    </p>
                    <p class="card-text">
                        <strong class="text-large">Quy Định:</strong><br>
                        {!! nl2br(\App\Helpers\ContentHelper::formatContent($chitiet->quy_dinh)) !!}
                    </p>
                    <p class="card-text">
                        <strong class="text-large">Tiện Ích:</strong><br>
                        {!! nl2br(\App\Helpers\ContentHelper::formatContent($chitiet->tien_ich)) !!}
                    </p>
                </div>
                
                
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $dichvuChitiets->links() }}
</div>
@endif

</div>
     <!-- Cột phải: Hai dịch vụ khác -->
<div class="col-md-4">
    <h5 class="mb-3">Dịch vụ khác</h5>
    @foreach ($dichvuKhac as $dv)
        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4">
                    <!-- Hiển thị ảnh dịch vụ -->
                    <img src="{{ asset('storage/' . $dv->anh) }}" alt="{{ $dv->ten_dich_vu }}" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <!-- Hiển thị tên dịch vụ -->
                        <h6 class="card-title">{{ $dv->ten_dich_vu }}</h6>
                        <!-- Hiển thị nội dung đầy đủ -->
                        <p class="card-text">{{ $dv->noi_dung }}</p>
                        <!-- Nút Xem Chi Tiết -->
                        <a href="{{ route('frontend.dichvu_chitiet.index', ['id' => $dv->id]) }}" class="btn btn-sm btn-primary">
                            Xem Chi Tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

    </div>
</div>
@endsection
<style>
    .text-large {
        font-size: 1.2rem;
        font-weight: bold;
     
    }
</style>
