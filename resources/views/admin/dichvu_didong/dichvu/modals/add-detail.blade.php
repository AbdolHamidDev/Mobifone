<div class="modal fade" id="addDetailModal{{ $dichvu->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dichvu_chitiet.store') }}" method="POST">
                @csrf
                <input type="hidden" name="dichvu_id" value="{{ $dichvu->id }}">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Thêm Chi Tiết Dịch Vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Đối tượng sử dụng</label>
                        <textarea class="form-control" name="doi_tuong_su_dung" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tính năng chính</label>
                        <textarea class="form-control" name="tinh_nang_chinh" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quy định</label>
                        <textarea class="form-control" name="quy_dinh" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tiện ích</label>
                        <textarea class="form-control" name="tien_ich" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">Thêm Chi Tiết</button>
                </div>
            </form>
        </div>
    </div>
</div>