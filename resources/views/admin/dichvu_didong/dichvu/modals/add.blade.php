<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dichvus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Thêm Dịch Vụ Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Dịch Vụ</label>
                        <input type="text" class="form-control" name="ten_dich_vu" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh</label>
                        <input type="file" class="form-control" name="anh" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội Dung</label>
                        <textarea class="form-control" name="noi_dung" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại Dịch Vụ</label>
                        <select class="form-select" name="loai_dich_vu" required>
                            <option value="" disabled selected>Chọn Loại Dịch Vụ</option>
                            <option value="Dịch vụ nổi bật">Dịch vụ nổi bật</option>
                            <option value="Giáo Dục">Giáo Dục</option>
                            <option value="Tài Chính">Tài Chính</option>
                            <option value="Giải Trí">Giải Trí</option>
                            <option value="Du Lịch">Du Lịch</option>
                            <option value="Internet An Toàn">Internet An Toàn</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
</div>