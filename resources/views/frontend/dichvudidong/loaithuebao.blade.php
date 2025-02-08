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
            <span class="current">Loại thuê bao</span>
        
         
        </div>


    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <h4 class="text-primary">Danh mục</h4>
            <ul class="list-group shadow-sm">
                @foreach ($categories as $category)
    <li class="list-group-item {{ $selectedCategory == $category ? 'active' : '' }}"
    data-filter=".{{ \Illuminate\Support\Str::slug($category, '-') }}">
        <a href="{{ route('frontend.dichvudidong.loaithuebao', ['category' => $category]) }}"
           class="text-decoration-none text-dark {{ $selectedCategory == $category ? 'text-white' : '' }}">
            {{ $category }}
        </a>
    </li>
@endforeach

            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <h4 class="mb-4">Danh mục: <span class="text-primary">{{ $selectedCategory }}</span></h4>
            <div class="row">
                @forelse ($items as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <img src="{{ asset('storage/' . $item->image) }}" />

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate">{{ $item->name }}</h5>
                                <p class="card-text text-truncate" title="{{ $item->title }}">{{ $item->title }}</p>
                                <a href="{{ route('frontend.dichvudidong.details', ['subscriptionTypeId' => $item->id]) }}" class="btn btn-primary mt-auto">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Không có dữ liệu nào thuộc danh mục này.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
