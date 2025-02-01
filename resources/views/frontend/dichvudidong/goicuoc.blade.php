@extends('layouts.frontend')

<link rel="stylesheet" href="{{ asset('frontends/goicuoc/goicuoc.css') }}">

@section('content')
<div class="container" style="padding-top: 15vh;">




    <!-- Phần Tạo Gói Cước -->
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h4 class="text-primary mb-4">Tự tạo gói cước</h4>
            <form id="customPackageForm">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone-number" name="phone_number" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Thoại nội mạng</label>
                        <input type="range" class="form-range" id="noi-mang-slider" name="thoai_noi_mang" min="0" max="60" value="10">
                        <p class="text-center"><span id="noi-mang-value">10</span> phút</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Thoại ngoại mạng</label>
                        <input type="range" class="form-range" id="ngoai-mang-slider" name="thoai_ngoai_mang" min="0" max="60" value="5">
                        <p class="text-center"><span id="ngoai-mang-value">5</span> phút</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Dung lượng</label>
                        <input type="range" class="form-range" id="data-slider" name="dung_luong" min="0.1" max="5" step="0.1" value="1">
                        <p class="text-center"><span id="data-value">1</span> GB</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <button class="btn btn-primary w-100" type="submit">Tạo gói</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
   



 <!-- gói cước nổi bật -->
    <div class="mb-5">
        <h4 class="text-primary mb-4 text-uppercase fw-bold text-center">Gói cước nổi bật</h4>
        <div id="goiCuocCarousel" class="carousel slide shadow-lg rounded-3 overflow-hidden" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($goiCuocNoiBat->chunk(3) as $key => $chunk)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row g-4 justify-content-center">
                            @foreach ($chunk as $goi)
                                <div class="col-md-4">
                                    <div class="card goi-cuoc-card shadow-sm h-100" onclick="window.location.href='{{ route('frontend.dichvudidong.chitiet', $goi->id) }}'">
                                        <div class="card-header text-center bg-primary text-white fw-bold">
                                            {{ $goi->ten_goicuoc }}
                                        </div>
                                        <div class="card-body text-center">
                                            <p class="price text-danger fw-bold mb-2">
                                                {{ number_format($goi->gia, 0, ',', '.') }} VNĐ
                                            </p>
                                            <p class="text-muted small">
                                                Thời gian sử dụng: <span class="fw-semibold">{{ $goi->thoi_gian }} ngày</span>
                                            </p>
                                            <p class="feature mb-3">
                                                Dung lượng: <span class="fw-bold">{{ $goi->dung_luong }} {{ $goi->don_vi_dung_luong }}</span>
                                            </p>
                                            <button class="btn btn-primary btn-block"
                                                    type="button"
                                                    onclick="event.stopPropagation(); openRegisterModal('{{ $goi->id }}', '{{ $goi->ten_goicuoc }}')">
                                                Đăng ký
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#goiCuocCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#goiCuocCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    

 <!-- Tabs loại gói cước -->
 <h4 class="text-primary mb-4">Gói cước</h4>
    <div class="tabs-container">
    <ul class="nav nav-tabs justify-content-center" id="goiCuocTabs" role="tablist">
        @php
            $loaiGoicuocs = [
                'thoai_quoc_te' => 'Thoại Quốc Tế',
                'chuyen_vung_quoc_te' => 'Chuyển Vùng Quốc Tế',
                'tich_diem' => 'Tích Điểm',
                'mobisafe' => 'MOBISAFE',
                'quoc_te_linh_hoat' => 'Quốc tế linh hoạt',
                'combo_trong_nuoc' => 'Combo trong nước',
                'mobif' => 'MOBIF',
                'sieu_data' => 'Siêu data',
                'chi_dep' => 'Chị đẹp',
                'combo' => 'Combo',
                'gia_dinh' => 'Gia đình',
                'hot' => 'Hot',
            ];
        @endphp
    
        @foreach ($loaiGoicuocs as $key => $value)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $key }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $key }}" type="button" role="tab" aria-controls="{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $value }}
                </button>
            </li>
        @endforeach
    </ul>
</div>

 <!-- gói cước -->
<div class="tab-content py-4" id="goiCuocContent">
    @foreach ($loaiGoicuocs as $key => $value)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab">
            <div class="carousel-container position-relative">
                <div id="{{ $key }}Carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $goiCuocTheoLoai = $goiCuocs->where('loai_goicuoc', $key);
                            $chunks = $goiCuocTheoLoai->chunk(8);
                        @endphp

                        @if ($goiCuocTheoLoai->isNotEmpty())
                            @foreach ($chunks as $chunkKey => $chunk)
                                <div class="carousel-item {{ $chunkKey == 0 ? 'active' : '' }}">
                                    <div class="row g-4">
                                        @foreach ($chunk as $goi)
                                            <div class="col-md-3">
                                                <div class="card goi-cuoc-card shadow-sm h-100" onclick="window.location.href='{{ route('frontend.dichvudidong.chitiet', $goi->id) }}'">
                                                    <div class="card-header text-center bg-primary text-white fw-bold">
                                                        {{ $goi->ten_goicuoc }}
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <p class="price">
                                                            {{ number_format($goi->gia, 0, ',', '.') }} VNĐ / {{ $goi->thoi_gian }} ngày
                                                        </p>
                                                        <p class="feature mb-2 text-muted small">
                                                            <i class="fas fa-info-circle me-1 text-primary"></i> 
                                                            Loại gói cước: <span class="fw-semibold text-dark">{{ $value }}</span>
                                                        </p>
                                                        <p class="feature mb-2 text-muted small">
                                                            <i class="fas fa-database me-1 text-success"></i> 
                                                            Dung lượng: <span class="fw-bold text-dark">{{ $goi->dung_luong }} {{ $goi->don_vi_dung_luong }}</span>
                                                        </p>
                                                        <button class="btn btn-primary btn-block"
                                                                type="button"
                                                                onclick="event.stopPropagation(); openRegisterModal('{{ $goi->id }}', '{{ $goi->ten_goicuoc }}')">
                                                            Đăng ký
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <div class="no-data-card shadow-sm py-4 px-3 rounded">
                                    <i class="fas fa-box-open text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-3">Hiện tại không có gói cước nào thuộc loại "{{ $value }}".</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($chunks->count() > 1)
                    <!-- Điều hướng carousel -->
                    <button class="carousel-control-prev custom-control-prev" type="button" data-bs-target="#{{ $key }}Carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next custom-control-next" type="button" data-bs-target="#{{ $key }}Carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        </div>
    @endforeach
</div>



    
 <!-- Modal Đăng ký -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Đăng ký gói cước</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="registerForm" method="POST" action="{{ route('frontend.goicuoc.register') }}">

                @csrf
                <div class="modal-body">
                    <p id="selectedPackage" class="fw-bold"></p>
                    <input type="hidden" id="packageId" name="package_id" value="">
                    <div class="form-group mb-3">
                        <label for="phoneNumber">Nhập số điện thoại</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Số điện thoại" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="submitRegisterForm">Xác nhận</button>

                </div>
            </form>
            
        </div>
    </div>
</div>

    
    
@endsection

<script>
    const registerUrl = "{{ route('frontend.goicuoc.register') }}";
    const customPackageStoreUrl = "{{ route('custom-package.store') }}";
</script>



<script src="{{ asset('frontends/goicuoc/goicuoc.js') }}"></script>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif


@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Thất bại!',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif

