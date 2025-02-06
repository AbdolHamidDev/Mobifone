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
            <span class="current">Quốc tế</span>
        </div>

    <h2 class="mb-4 fw-bold">Nhóm dịch vụ</h2>
    <div class="row">
        @php
        $services = [
            [
                'title' => 'Thuê bao MobiFone ra nước ngoài',
                'bg' => asset('assets/images/ranuocngoai.jpg'),
                'route' => route('frontend.dichvu.ra-nuoc-ngoai')
            ],
            [
                'title' => 'Thuê bao nước ngoài đến Việt Nam',
                'bg' => asset('assets/images/nuocngoaidenvietnam.jpg'),
                'route' => route('frontend.dichvu.nuoc-ngoai-den-vn')
            ],
            [
                'title' => 'Dịch vụ Thoại quốc tế',
                'bg' => asset('assets/images/thoaiquocte.jpg'),
                'route' => route('frontend.dichvu.thoai-quoc-te')
            ],
            [
                'title' => 'Dịch vụ quốc tế khác',
                'bg' => asset('assets/images/quoctekhac.jpg'),
                'route' => route('frontend.dichvu.quoc-te-khac')
            ]
        ];
    @endphp
    

        @foreach($services as $service)
            <div class="col-md-6 mb-4">
                <div class="service-card" style="background-image: url('{{ $service['bg'] }}');">
                    <div class="service-content">
                        <h3>{{ $service['title'] }}</h3>
                        <a href="{{ $service['route'] }}" class="btn btn-detail">CHI TIẾT →</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .service-card {
        position: relative;
        width: 100%;
        height: 350px;
        background-size: cover;
        background-position: center;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: flex-end;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }



    .service-content {
        background: rgba(255, 255, 255, 0.95);
        padding: 15px;
        width: 100%;
        border-radius: 0 0 12px 12px;
        text-align: center;
        transition: background 0.3s ease-in-out;
    }

    .service-card:hover .service-content {
        background: rgba(255, 255, 255, 1);
    }

    .btn-detail {
        display: inline-block;
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s;
    }




</style>
@endsection
