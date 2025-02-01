@extends('layouts.frontend')


<link rel="stylesheet" href="{{ asset('frontends/sothuebao/sothuebao_chitiet.css') }}">
@section('content')
<div class="container" style="padding-top: 15vh;">
    <div class="text-center mt-4">
        <p>
            Phiên đặt số có hiệu lực trong 
            <span id="countdown-timer">15:00</span> phút
        </p>
    </div>
    <form action="{{ route('frontend.dichvudidong.step2.process') }}" method="POST">
        @csrf
             <!-- Hidden field để truyền temp_id -->
         <input type="hidden" name="temp_id" value="{{ $tempId }}">
    
    <div class="progress-container">
        <div class="progress-step active">
            <div class="circle">1</div>
            <p>Chọn SIM</p>
        </div>
        <div class="progress-line"></div>
        <div class="progress-step">
            <div class="circle">2</div>
            <p>Đăng ký</p>
        </div>
        <div class="progress-line"></div>
        <div class="progress-step">
            <div class="circle">3</div>
            <p>Hoàn tất</p>
        </div>
    </div>
    
    
   <div class="d-flex justify-content-center">
    <div class="square-card text-white shadow-sm bg-background-card">
        <!-- Ảnh góc trên phải -->
        <div class="card-images-right">
            <img src="{{ asset('assets/images/logo-mobifone-card.jpg') }}" alt="Logo Mobifone" class="logo-image">
            <img src="{{ asset('assets/images/sim-card.jpg') }}" alt="Sim Card" class="sim-image">
        </div>
        

        <div class="card-body">
            <h5 class="card-title text-uppercase" style="margin-bottom: 10px;">
                {{ \App\Helpers\ContentHelper::formatLoaiThueBao($thueBao->loai_thue_bao) }}
            </h5>
            <h3 class="fw-bold text-warning">
                {{ $thueBao->so_thue_bao }}
            </h3>
            
            <p class="mb-1">Gói cước đăng ký</p>
            <h5 id="ten-goi-cuoc" class="fw-bold text-uppercase">{{ $thueBao->goi_cuoc ?? 'Chưa chọn' }}</h5>

            <hr class="my-3">
            <div class="d-flex justify-content-between">
                <div>
                    <small>Loại số</small>
                    <p class="mb-0">
                        {{ \App\Helpers\ContentHelper::formatLoaiSo($thueBao->loai_so) }}
                    </p>
                </div>
                <div>
                    <small>Khu vực hòa mạng</small>
                    <p class="mb-0">{{ $thueBao->khu_vuc }}</p>
                </div>
                <div>
                    <small>Phí giữ số</small>
                    <p class="mb-0">{{ $thueBao->phi_giu_so == 0 ? 'Miễn phí' : number_format($thueBao->phi_giu_so) . 'đ' }}</p>
                </div>
            </div>
            <hr class="my-3">
            <div class="d-flex justify-content-between">
                <div>
                    <small>Phí hòa mạng</small>
                    <p class="fw">{{ number_format($thueBao->phi_hoa_mang) }}đ</p>
                </div>
                <div>
                    <small>Giá gói cước</small>
                    <p id="gia-goi-cuoc" class="fw">0đ</p>
                </div>
                
                
            </div>
        </div>
    </div>
</div>

    
    

 <!-- Phần Gói cước đi kèm -->
<div class="mt-5">
    <h4 class="text-center fw-bold">Gói cước đi kèm</h4>
    <p class="text-center text-muted">Chọn một trong các gói cước theo nhu cầu sử dụng của bạn</p>
    <div class="d-flex justify-content-center flex-wrap gap-4 mt-4">
        @foreach ($goiCuoc as $goi)
            <label class="package-card" for="goi_cuoc_{{ $loop->index }}" style="cursor: pointer;">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold">{{ $goi->ten_goicuoc }}</h6>
                    <input 
                    type="radio" 
                    id="goi_cuoc_{{ $loop->index }}" 
                    name="goi_cuoc" 
                    value="{{ $goi->id }}" 
                    onclick="updateGiaGoiCuoc('{{ $goi->ten_goicuoc }}', '{{ number_format($goi->gia) }}', '{{ $goi->id }}')" 
                    style="cursor: pointer;"
                    @if ($loop->first) checked @endif
                >
                </div>
                <hr>
                <p class="text-muted small mb-2">Thời gian: {{ $goi->thoi_gian }} ngày</p>
                <h5>{{ number_format($goi->gia) }}đ</h5>
                <hr>
                @if ($goi->details->isNotEmpty())
                    <ul>
                        @foreach ($goi->details as $detail)
                            <li><i class="fas fa-check-circle text-success me-1"></i>{{ $detail->key }}: {{ $detail->value }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted small">Không có thông tin chi tiết</p>
                @endif
                <hr>
                <a href="#" class="text-primary fw-bold">Xem thêm</a>
            </label>
        @endforeach
    </div>







    <div class="d-flex justify-content-center gap-3 my-5 action-buttons">
        <button class="btn btn-outline-secondary btn-lg w-25">Quay lại</button>
      
            <!-- Lấy ID số thuê bao -->
            <input type="hidden" name="so_thue_bao_id" value="{{ $thueBao->id }}">
    
            <!-- Lấy ID gói cước được chọn -->
            <input type="hidden" id="selected-goi-cuoc-id" name="goi_cuoc_id" value="">
    
            <button type="submit" class="btn btn-primary btn-lg w-25">Tiếp tục</button>
        </form>
    </div>
    
    
    
    </div>
</div>
@endsection

<script>
function updateGiaGoiCuoc(tenGoiCuoc, giaGoiCuoc, goiCuocId) {
    // Cập nhật tên và giá gói cước
    document.getElementById('ten-goi-cuoc').innerText = tenGoiCuoc;
    document.getElementById('gia-goi-cuoc').innerText = `${giaGoiCuoc}đ`;

    // Cập nhật ID gói cước vào input hidden
    document.getElementById('selected-goi-cuoc-id').value = goiCuocId;
}

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const endTimeKey = 'countdownEndTime'; // Key lưu thời gian trong localStorage
        const timerElement = document.getElementById('countdown-timer');
    
        function resetTimer() {
            const currentTime = new Date().getTime();
            const newEndTime = currentTime + 15 * 60 * 1000; // 15 phút từ hiện tại
            localStorage.setItem(endTimeKey, newEndTime);
        }
    
        function updateCountdown() {
            const now = new Date().getTime();
            let endTime = localStorage.getItem(endTimeKey);
    
            if (!endTime || now >= endTime) {
                // Nếu hết hạn hoặc không có thời gian lưu, reset lại
                resetTimer();
                endTime = localStorage.getItem(endTimeKey);
            }
    
            const remainingTime = endTime - now;
    
            if (remainingTime > 0) {
                const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                timerElement.innerHTML = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            } else {
                // Khi hết thời gian, xóa session, reset lại và thông báo người dùng
                localStorage.removeItem(endTimeKey);
                resetTimer();
                timerElement.innerHTML = '15:00';
    
                Swal.fire({
                    title: 'Hết thời gian hiệu lực!',
                    text: 'Phiên đặt số của bạn đã hết hiệu lực. Bạn sẽ được quay lại.',
                    icon: 'warning',
                    confirmButtonText: 'Đóng',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.history.back(); // Quay lại trang trước đó
                    }
                });
            }
        }
    
        // Khi người dùng thoát trang, reset lại thời gian
        window.addEventListener('beforeunload', function () {
            resetTimer();
        });
    
        // Cập nhật mỗi giây
        const countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown();
    });
    </script>
    
<script>
    // Đặt giá và tên của gói đầu tiên (nếu có) khi trang được tải
    document.addEventListener('DOMContentLoaded', function () {
        const firstGoiCuoc = document.querySelector('input[name="goi_cuoc"]:checked');
        if (firstGoiCuoc) {
            const tenGoiCuoc = firstGoiCuoc.value;
            const gia = firstGoiCuoc.closest('label').querySelector('h5').innerText;
            updateGoiCuoc(tenGoiCuoc, gia);
        }
    });

    // Hàm cập nhật giá và tên gói cước
    function updateGoiCuoc(tenGoiCuoc, gia) {
        // Cập nhật giá gói cước
        document.getElementById('gia-goi-cuoc').innerText = gia;

        // Cập nhật tên gói cước
        document.getElementById('ten-goi-cuoc').innerText = tenGoiCuoc;
    }
</script>
