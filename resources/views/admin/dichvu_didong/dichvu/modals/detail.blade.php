<div class="modal fade" id="detailModal{{ $dichvu->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Chi Tiết Dịch Vụ: {{ $dichvu->ten_dich_vu }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>