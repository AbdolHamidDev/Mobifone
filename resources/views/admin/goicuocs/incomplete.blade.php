<style>
    .alert-box {
        display: flex;
        align-items: center;
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease-in-out;
        position: relative;
        overflow: hidden;
    }
    .alert-warning {
        background: linear-gradient(135deg, #fff3cd, #ffcc80);
        border-left: 5px solid #ffa000;
    }
    .alert-success {
        background: linear-gradient(135deg, #d4edda, #81c784);
        border-left: 5px solid #2e7d32;
    }
    .alert-icon {
        font-size: 28px;
        margin-right: 12px;
        animation: pop 0.4s ease-in-out;
    }
    .alert-content h5 {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }
    .alert-content p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #555;
    }
    .alert-action {
        margin-left: auto;
    }
    .btn-check {
        background-color: #fff;
        color: #333;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-check:hover {
        background-color: rgba(255, 255, 255, 0.8);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pop {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>

@if($incompleteGoiCuocs > 0)
<div class="alert-box alert-warning">
    <i class="fas fa-exclamation-triangle alert-icon text-warning"></i>
    <div class="alert-content">
        <h5>Thông báo quan trọng</h5>
        <p>Có <strong>{{ $incompleteGoiCuocs }}</strong> gói cước chưa hoàn tất. Vui lòng cập nhật để đảm bảo chính xác.</p>
    </div>
    <div class="alert-action">
        <button class="btn-check" onclick="location.href='/update-packages'">Cập nhật ngay</button>
    </div>
</div>
@else
<div class="alert-box alert-success">
    <i class="fas fa-check-circle alert-icon text-success"></i>
    <div class="alert-content">
        <h5>Hoàn tất cập nhật</h5>
        <p>Tất cả các gói cước đã được nhập đầy đủ. Cảm ơn bạn!</p>
    </div>
</div>
@endif
