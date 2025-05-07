<div class="row">
    <div class="col-md-6 mb-3">
        <h6 class="fw-bold">Đối tượng sử dụng:</h6>
        <div class="p-3 bg-light rounded">
            {{ $dichvu->dichvuChitiet->doi_tuong_su_dung }}
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <h6 class="fw-bold">Tính năng chính:</h6>
        <div class="p-3 bg-light rounded">
            {{ $dichvu->dichvuChitiet->tinh_nang_chinh }}
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <h6 class="fw-bold">Quy định:</h6>
        <div class="p-3 bg-light rounded">
            {{ $dichvu->dichvuChitiet->quy_dinh }}
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <h6 class="fw-bold">Tiện ích:</h6>
        <div class="p-3 bg-light rounded">
            {{ $dichvu->dichvuChitiet->tien_ich }}
        </div>
    </div>
</div>