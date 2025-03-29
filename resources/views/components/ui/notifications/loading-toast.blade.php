@props([
    'message' => 'Đang tải dữ liệu...',  // Nội dung mặc định
    'bgColor' => 'bg-primary',           // Màu nền mặc định
    'iconClass' => 'fas fa-circle-notch fa-spin' // Icon mặc định
])

<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="loadingToast" class="toast align-items-center text-white {{ $bgColor }} border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="{{ $iconClass }} me-2"></i> {{ $message }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
