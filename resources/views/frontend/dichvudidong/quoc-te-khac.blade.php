@extends('layouts.frontend')

<link rel="stylesheet" href="{{ asset('frontends/dichvuquocte/ranuocngoai.css') }}">
<link rel="stylesheet" href="{{ asset('frontends/main_dieuhuong.css') }}">
<script src="https://cdn.tailwindcss.com"></script>
@section('content')
    <div class="container" style="padding-top: 15vh;">

            <!-- THANH ĐIỀU HƯỚNG -->
            <div class="breadcrumb">
                <a href="/"><i class="fas fa-home"></i> Trang chủ</a>
                <span class="divider">/</span>
                <a href="#">Dịch vụ di động</a>
                <span class="divider">/</span>
                <a href="/dich-vu-quoc-te">Quốc tế</a>
                <span class="divider">/</span>
                <span class="current">Dịch vụ quốc tế khác</span>
            </div>

<!-- Nội dung danh mục -->
<div class="container">
    <button class="btn btn-outline-primary arrow-btn d-none" id="prevCard">
        <i class="fas fa-chevron-left"></i>
    </button>
    <div class="row">
        @foreach($dichvusKhac as $dichvu)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card h-100 shadow rounded-4 border-0">
                <div class="avatar-wrapper">
                    <img src="{{ asset('storage/' . $dichvu->anh) }}" 
                         alt="{{ $dichvu->ten_dich_vu }}">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold" style="color: #003366;">{{ $dichvu->ten_dich_vu }}</h5>
                    <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($dichvu->noi_dung, 100) }}</p>
                </div>
                <div class="card-footer bg-light border-0 text-center">
                    <a href="{{ route('frontend.dichvu_chitiet.index', ['id' => $dichvu->id]) }}" 
                        class="btn btn-primary px-4 py-2 rounded-pill text-white shadow-sm">
                        Xem Chi Tiết <i class="fas fa-arrow-right"></i>
                     </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button class="btn btn-outline-primary arrow-btn d-none" id="nextCard">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>





    </div>
@endsection
<style>
            /* Tabs */
            .nav-tabs {
                flex-wrap: nowrap;
                overflow-x: auto;
                border-bottom: none;
            }
            
            .nav-tabs .nav-link {
                font-size: 0.95rem;
                font-weight: 600;
                border-radius: 30px;
                padding: 12px 20px;
                color: #0a4584;
                border: none;
                background-color: #f8f9fa;
                margin-right: 8px;
                transition: all 0.3s ease-in-out;
                white-space: nowrap;
            }
            
            .nav-tabs .nav-link.active {
                background-color: #007bff;
                color: #fff;
            }
            
            .nav-tabs .nav-link:hover {
                background-color: #e9ecef;
                color: #007bff;
            }
            
            .arrow-btn {
            border-radius: 50%;
            margin: 0;
            padding: 0.5rem; 
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;

            position: absolute; /* Định vị tuyệt đối */
            top: 50%; /* Giữa chiều cao container */
            transform: translateY(-50%); /* Căn chỉnh giữa */
            z-index: 2; /* Nút luôn ở trên cùng */
            background-color: #ffffff; /* Thêm màu nền nếu cần */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bóng nhẹ */
        }

        #prevCard {
            left: -1px; /* Đẩy nút gần container hơn */
        }

        #nextCard {
            right: -1px; /* Đẩy nút gần container hơn */
        }




        /* Cards */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.125);
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        



        
        /* Button */
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #003d80);
            transform: scale(1.05);
        }
        
        /* Spacing */
        .container {
            max-width: 1200px;
        }
        .tab-content .row {
        display: flex; /* Sắp xếp ngang */
        flex-wrap: nowrap; /* Không cho xuống dòng */
        overflow-x: auto; /* Cho phép cuộn ngang */
        gap: 1rem; /* Khoảng cách giữa các card */
    }

    .tab-content .col-lg-4 {
        flex: 0 0 auto; /* Không cho card co lại hoặc chiếm toàn bộ không gian */
        width: 30%; /* Đảm bảo chiều rộng card không bị giãn */
    }

    .arrow-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
    }
    @media (max-width: 1200px) {
        .tab-content .col-lg-4 {
            width: 45%; /* Hiển thị 2 card trên màn hình nhỏ hơn */
        }
    }

    @media (max-width: 768px) {
        .tab-content .col-lg-4 {
            width: 80%; /* Hiển thị 1 card trên màn hình nhỏ hơn */
        }
    }
    .tab-content .row {
        overflow-x: hidden; /* Ẩn thanh cuộn mặc định */
        position: relative;
    }
    .avatar-wrapper {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        overflow: hidden; /* Cắt phần dư bên ngoài */
        background-color: #f8f9fa; /* Màu nền nếu ảnh không lấp đầy */
        margin: 0 auto;
    }

    .avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

</style>


