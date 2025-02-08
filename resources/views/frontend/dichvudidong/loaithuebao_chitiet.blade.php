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
            <a href="/dich-vu-di-dong/loai-thue-bao/">Thuê bao</a>
            <span class="divider">/</span>
            <span class="current">Chi tiết loại thuê bao</span>
        </div>
    <div class="row gx-5">
        <!-- Chi tiết thuê bao -->
        <div class="col-lg-8">
            <div class="card shadow-lg mb-5">
                <div class="card-body text-center">
                    <h1 class="display-6 text-primary">{{ $subscriptionType->name }}</h1>
                    <p class="text-muted mb-4">{{ $subscriptionType->title }}</p>
                    <img src="{{ asset('storage/' . $subscriptionType->image) }}" 

                         alt="{{ $subscriptionType->name }}" 
                         class="img-fluid rounded shadow" 
                         style="max-width: 100%; height: auto;">
                </div>
            </div>

            <!-- Danh sách chi tiết gói thuê bao -->
            <div class="mb-5">
                <h4 class="mb-4 text-secondary">Danh sách chi tiết</h4>
                <div class="row g-4">
                    @forelse ($subscriptionType->loaithuebao as $detail)
                        <div class="col-md-12">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-success">Gói ID: {{ $detail->id }}</h5>
                                    <p><strong class="text-dark">Lợi ích:</strong></p>
                                    <p class="text-muted">{!! nl2br(e($detail->benefits)) !!}</p>
                                    
                                    <p><strong class="text-dark">Giá Cước:</strong></p>
                                    <p class="text-muted">{!! nl2br(e($detail->pricing)) !!}</p>
                                    
                                    <p><strong class="text-dark">Hướng Dẫn:</strong></p>
                                    <p class="text-muted">{!! nl2br(e($detail->instructions)) !!}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                Không có dữ liệu chi tiết cho loại thuê bao này.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Các thuê bao khác -->
        <div class="col-lg-4">
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <h4 class="mb-4 text-secondary text-center">Thuê Bao Khác</h4>
                    @foreach ($otherSubscriptionTypes as $item)
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="row g-0">
                                <div class="col-4">
                                    <img src="{{ asset('storage/' . $item->image) }}" 

                                         class="img-fluid rounded-start" 
                                         alt="{{ $item->name }}" 
                                         style="height: 100%; object-fit: cover;">
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h6 class="card-title text-primary">{{ $item->name }}</h6>
                                        <p class="text-muted small">{{ \Illuminate\Support\Str::limit($item->title, 50) }}</p>

                                        <a href="{{ route('frontend.dichvudidong.details', ['subscriptionTypeId' => $item->id]) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Nút quay lại -->
    <div class="text-center mt-5">
        <a href="{{ url('/dich-vu-di-dong/loai-thue-bao') }}" class="btn btn-secondary btn-lg">
            <i class="fas fa-arrow-left"></i> Quay Lại
        </a>
    </div>
</div>
@endsection
