@extends('layouts.frontend')

@section('content')
<div class="container" style="padding-top: 15vh;">
    <!-- Header -->
    <div class="card shadow-sm mb-4 p-4">
        <div class="d-flex align-items-center">
            <div class="icon-container me-3">
                <img src="{{ asset('assets/images/sim.jpg') }}" alt="Gói cước icon" class="img-fluid rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
            </div>
            <div class="flex-grow-1">
                <h3 class="fw-bold text-primary">{{ $goi->ten_data }}</h3>
                <p class="mb-1">Giá: <span class="text-success fw-bold">{{ number_format($goi->gia, 0, ',', '.') }} VNĐ</span></p>
                <p>Thời hạn: {{ $goi->thoi_gian }} ngày</p>
            </div>
            <div>
                <button class="btn btn-primary btn-block"
                type="button"
                onclick="event.stopPropagation(); openRegisterModal('{{ $goi->id }}', '{{ $goi->ten_data }}')">
            Đăng ký
        </button>
            </div>
        </div>
    </div>

    <!-- Thông tin gói cước -->
    <div class="card shadow-sm mb-4 card-with-bg">
        <div class="card-header bg-light">
            <h5 class="mb-0 fw-bold text-secondary">Thông tin gói cước</h5>
        </div>
        <div class="card-body">
            @if ($goidataDetails->isNotEmpty())
                @foreach ($goidataDetails as $detail)
                    <div class="mb-3">
                        <h6 class="fw-bold">{{ $detail->key }}</h6>
                        <p class="text-muted">{!! nl2br(e($detail->value)) !!}</p>
                    </div>
                @endforeach
            @else
                <p class="text-muted text-center">Không có thông tin chi tiết cho gói cước này.</p>
            @endif
        </div>
    </div>
    

  <!-- Gói cước tương tự -->
<div class="mt-5">
    <h4 class="text-primary fw-bold mb-4">Gói cước tương tự</h4> <!-- Tiêu đề -->
    <div class="row">
        @foreach ($relatedgoidatas as $related)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm text-center p-3 border-0">
                    <div class="card-header bg-primary text-white fw-bold py-3">
                        {{ $related->ten_data }}
                    </div>
                    <div class="card-body">
                        <p class="price text-primary fw-bold mb-2">
                            {{ number_format($related->gia, 0, ',', '.') }} VNĐ / {{ $related->thoi_gian }} {{ $related->thoi_gian > 1 ? 'Ngày' : 'Ngày' }}
                        </p>
                        <p class="feature text-muted">
                            <i class="fas fa-phone-alt"></i> Thoại quốc tế: <span class="fw-bold">{{ $related->dung_luong }} {{ $related->don_vi_dung_luong }}</span>
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

    
</div>

  <!-- Modal Đăng ký -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Đăng ký gói cước</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="registerForm" method="POST" action="{{ route('frontend.goidata.register') }}">

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


<script src="{{ asset('frontends/goidata/goidata_chitiet.js') }}"></script>

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
    

<style>
  .icon-container img {
    border: 3px solid #007bff;
    padding: 5px;
    border-radius: 50%;
}

.card.shadow-sm {
    border-radius: 15px;
    transition: all 0.3s ease-in-out;
}

.card.shadow-sm:hover {
    transform: scale(1.02); /* Giảm độ phóng to */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); /* Giảm độ bóng */
}


.btn-primary {
    border-radius: 25px;
    font-size: 1rem;
    padding: 10px 20px;
}

.btn-outline-primary {
    border-radius: 25px;
    padding: 5px 15px;
}

.modal .btn-primary {
    background-color: #007bff;
    border: none;
    transition: background-color 0.3s ease;
}

.modal .btn-primary:hover {
    background-color: #0056b3;
}


.card {
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.02); /* Hiệu ứng hover nhẹ */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng đổ */
}

.card-header {
    font-size: 1.2rem;
    text-transform: uppercase;
    border-bottom: none;
}

.price {
    font-size: 1.1rem;
    font-weight: bold;
}

.feature {
    font-size: 0.9rem;
}

.btn-primary {
    border-radius: 20px;
    font-size: 1rem;
    padding: 10px 15px;
}

.btn-primary:hover {
    background-color: #004a99;
}



.card-with-bg {
    background-image: url('/assets/images/background.png'); /* Đường dẫn tới ảnh nền */
    background-size: cover; /* Đảm bảo ảnh nền phủ toàn bộ */
    background-position: center; /* Căn giữa ảnh nền */
    background-repeat: no-repeat; /* Không lặp lại ảnh */
    border-radius: 10px; /* Bo góc */
    overflow: hidden;
}

.card-with-bg .card-body {
    background-color: rgba(255, 255, 255, 0.8); /* Lớp phủ trắng mờ */
    border-radius: 10px; /* Bo góc cho nội dung */
}

</style>

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