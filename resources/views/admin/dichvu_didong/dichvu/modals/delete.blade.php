<div class="modal fade" id="deleteModal{{ $dichvu->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dichvus.destroy', $dichvu->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <strong>Cảnh báo:</strong> Bạn sắp xóa dịch vụ này. Hành động này không thể hoàn tác!
                    </div>
                    <p>Bạn có chắc chắn muốn xóa dịch vụ <strong>{{ $dichvu->ten_dich_vu }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
</div>