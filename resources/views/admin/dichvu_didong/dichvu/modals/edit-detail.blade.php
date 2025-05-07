<div class="modal fade" id="editDetailModal{{ $dichvu->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dichvu_chitiet.update', $dichvu->dichvuChitiet->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">Sửa Chi Tiết Dịch Vụ: {{ $dichvu->ten_dich_vu }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Đối tượng sử dụng</label>
                        <textarea class="form-control" name="doi_tuong_su_dung" rows="2">{{ $dichvu->dichvuChitiet->doi_tuong_su_dung }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tính năng chính</label>
                        <textarea class="form-control" name="tinh_nang_chinh" rows="4">{{ $dichvu->dichvuChitiet->tinh_nang_chinh }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quy định</label>
                        <textarea class="form-control" name="quy_dinh" rows="2">{{ $dichvu->dichvuChitiet->quy_dinh }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tiện ích</label>
                        <textarea class="form-control" name="tien_ich" rows="2">{{ $dichvu->dichvuChitiet->tien_ich }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-warning">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>