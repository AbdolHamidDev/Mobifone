@extends('layouts.frontend')
<link rel="stylesheet" href="{{ asset('frontends/sothuebao/sothuebao_chitiet.css') }}">
@section('content')
<div class="container">
    <h1 class="text-center text-success mt-5">Cảm ơn bạn đã đặt hàng!</h1>

  
    <!-- Modal -->
    
    <div class="modal fade" id="orderCompleteModal" tabindex="-1" aria-labelledby="orderCompleteModalLabel" aria-hidden="true">
      
    

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="orderCompleteModalLabel">Đặt hàng thành công!</h5>
                    <div class="progress-container">
                        <div class="progress-step completed"> <!-- Bước hoàn thành -->
                            <div class="circle"></div>
                            <p>Chọn SIM</p>
                        </div>
                        <div class="progress-line completed"></div>
                        <div class="progress-step completed"> <!-- Bước hiện tại -->
                            <div class="circle"></div>
                            <p>Đăng ký</p>
                        </div>
                        <div class="progress-line completed"></div>
                        <div class="progress-step completed">
                            <div class="circle"></div>
                            <p>Hoàn tất</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/hoantat.jpg') }}" alt="Đặt hàng thành công" style="width: 80px;">
                        <p class="mt-3">Mã giữ số: <strong>{{ session('order_code') }}</strong></p>
                        <p class="mb-3">Khách hàng: <strong>{{ session('customer_name') }}</strong></p>
                        <p class="mb-3">Tổng thanh toán: <strong>{{ number_format(session('total_amount')) }}đ</strong></p>
                
                        @if (session('sim_type') === 'eSIM' && session('qr_code'))
                        <div class="text-center mt-3">
                            <h5>Mã QR Code của bạn</h5>
                            <img src="{{ session('qr_code') }}" alt="QR Code" class="qr-code">
                            <p class="text-muted">Quét mã này để kích hoạt eSIM</p>
                        </div>
                    @endif
                    
                    </div>
                </div>
                
                <div class="modal-footer">
                    <a href="{{ route('frontend.home') }}" class="btn btn-primary">Về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if (session('order_complete'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = new bootstrap.Modal(document.getElementById('orderCompleteModal'));
        modal.show();
    });
</script>
@endif



<style>
    /* Container chính */
    .progress-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Mỗi bước */
    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Vòng tròn */
    .circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ddd; /* Màu mặc định */
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        font-weight: bold;
        color: #000; /* Màu chữ mặc định */
        position: relative;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Bước hoàn thành với dấu check */
    .progress-step.completed .circle {
        background-color: #007bff; /* Màu xanh lá */
        color: white; /* Dấu check màu trắng */
    }

    .progress-step.completed .circle::before {
        content: '✓'; /* Dấu check */
        font-family: Arial, sans-serif;
        font-size: 20px;
        font-weight: bold;
        position: absolute;
        color: white;
    }

    .progress-step.completed .circle > span {
        display: none; /* Ẩn số khi đã có dấu check */
    }

    /* Bước hiện tại */
    .progress-step.active .circle {
        background-color: #007bff; /* Màu xanh dương */
        color: white; /* Màu chữ */
        font-weight: bold;
    }

    /* Đường kết nối */
    .progress-line {
        flex: 1;
        height: 4px;
        background-color: #ddd; /* Màu mặc định */
        transition: background-color 0.3s;
    }

    .progress-line.active {
        background-color: #007bff; /* Màu xanh dương khi active */
    }


    .qr-code {
        width: 200px; /* Điều chỉnh kích thước QR Code */
        height: auto; /* Đảm bảo tỷ lệ đúng */
        margin-top: 15px;
        border: 5px solid #ddd; /* Viền nhẹ */
        padding: 10px;
        border-radius: 10px;
        background: #fff;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

</style>