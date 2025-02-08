@extends('layouts.frontend')

<link rel="stylesheet" href="{{ asset('frontends/goidata/goidata.css') }}">
<link rel="stylesheet" href="{{ asset('frontends/main_dieuhuong.css') }}">
@section('content')
<div class="container" style="padding-top: 15vh;">



        <!-- THANH ĐIỀU HƯỚNG -->
        <div class="breadcrumb">
            <a href="/"><i class="fas fa-home"></i> Trang chủ</a>
            <span class="divider">/</span>
            <a href="#">Dịch vụ di động</a>
            <span class="divider">/</span>
            <span class="current">Gói Data</span>
        
         
        </div>


   



 <!-- Gói Data nổi bật -->
    <div class="mb-5">
        <h4 class="text-primary mb-4 text-uppercase fw-bold text-center">Gói Data nổi bật</h4>
        <div id="goidataCarousel" class="carousel slide shadow-lg rounded-3 overflow-hidden" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($goidataNoiBat->chunk(3) as $key => $chunk)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row g-4 justify-content-center">
                            @foreach ($chunk as $goi)
                                <div class="col-md-4">
                                    <div class="card goi-data-card shadow-sm h-100" onclick="window.location.href='{{ route('frontend.dichvudidong2.chitiet', $goi->id) }}'">
                                        <div class="card-header text-center bg-primary text-white fw-bold">
                                            {{ $goi->ten_data }}
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
                                                    onclick="event.stopPropagation(); openRegisterModal('{{ $goi->id }}', '{{ $goi->ten_data }}')">
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
            <button class="carousel-control-prev" type="button" data-bs-target="#goidataCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#goidataCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    

 <!-- Tabs loại Gói Data -->
 <h4 class="text-primary mb-4">Gói Data</h4>
    <div class="tabs-container">
    <ul class="nav nav-tabs justify-content-center" id="goidataTabs" role="tablist">
        @php
            $loaigoidatas = [
                             "mien_phi_mxh"=>'Miễn phí MXH',
                           "dai_ky"=>'Dài kỳ',
                           "data_bo_sung"=>'Data bổ sung',
                            "thang"=>'Tháng',
                            "data_thuong"=>'Data thường',
                            "ngay"=>'Ngày',
                            "data_fastconnect" =>'Data Fastconnect',  
            ];
        @endphp
    
        @foreach ($loaigoidatas as $key => $value)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $key }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $key }}" type="button" role="tab" aria-controls="{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $value }}
                </button>
            </li>
        @endforeach
    </ul>
</div>

 <!-- Gói Data -->
<div class="tab-content py-4" id="goidataContent">
    @foreach ($loaigoidatas as $key => $value)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab">
            <div class="carousel-container position-relative">
                <div id="{{ $key }}Carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $goidataTheoLoai = $goidatas->where('loai_data', $key);
                            $chunks = $goidataTheoLoai->chunk(8);
                        @endphp

                        @if ($goidataTheoLoai->isNotEmpty())
                            @foreach ($chunks as $chunkKey => $chunk)
                                <div class="carousel-item {{ $chunkKey == 0 ? 'active' : '' }}">
                                    <div class="row g-4">
                                        @foreach ($chunk as $goi)
                                            <div class="col-md-3">
                                                <div class="card goi-data-card shadow-sm h-100" onclick="window.location.href='{{ route('frontend.dichvudidong2.chitiet', $goi->id) }}'">
                                                    <div class="card-header text-center bg-primary text-white fw-bold">
                                                        {{ $goi->ten_data }}
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <p class="price">
                                                            {{ number_format($goi->gia, 0, ',', '.') }} VNĐ / {{ $goi->thoi_gian }} ngày
                                                        </p>
                                                        <p class="feature mb-2 text-muted small">
                                                            <i class="fas fa-info-circle me-1 text-primary"></i> 
                                                            Loại Gói Data: <span class="fw-semibold text-dark">{{ $value }}</span>
                                                        </p>
                                                        <p class="feature mb-2 text-muted small">
                                                            <i class="fas fa-database me-1 text-success"></i> 
                                                            Dung lượng: <span class="fw-bold text-dark">{{ $goi->dung_luong }} {{ $goi->don_vi_dung_luong }}</span>
                                                        </p>
                                                        <button class="btn btn-primary btn-block"
                                                                type="button"
                                                                onclick="event.stopPropagation(); openRegisterModal('{{ $goi->id }}', '{{ $goi->ten_data }}')">
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
                                    <p class="text-muted mt-3">Hiện tại không có Gói Data nào thuộc loại "{{ $value }}".</p>
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
                <h5 class="modal-title" id="registerModalLabel">Đăng ký Gói Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="registerForm">
                <div class="modal-body">
                    <p id="selectedPackage" class="fw-bold"></p>
                    <input type="hidden" id="packageId" name="package_id" value="">
                    <input type="hidden" id="packageType" name="type" value="goidata"> <!-- Thêm type là goidata -->
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
const registerUrl = "{{ route('frontend.goidata.register') }}";
document.addEventListener('DOMContentLoaded', function () {
    const submitButton = document.getElementById('submitRegisterForm');
    if (submitButton) {
        submitButton.addEventListener('click', function () {
            const packageId = document.getElementById('packageId').value;
            const phoneNumber = document.getElementById('phoneNumber').value;

            if (!packageId || !phoneNumber) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Vui lòng nhập đầy đủ thông tin trước khi xác nhận.',
                });
                return;
            }

            fetch(registerUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ package_id: packageId, phoneNumber: phoneNumber, type: 'goidata' }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: data.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thất bại!',
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi hệ thống!',
                        text: 'Không thể hoàn thành yêu cầu. Vui lòng thử lại sau.',
                    });
                });
        });
    } else {
        console.error('#submitRegisterForm không tồn tại trong DOM.');
    }
});

</script>




<script src="{{ asset('frontends/goidata/goidata.js') }}"></script>

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

