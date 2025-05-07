<div class="modal fade" id="editModal{{ $dichvu->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dichvus.update', $dichvu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Sửa Dịch Vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Dịch Vụ</label>
                        <input type="text" class="form-control" name="ten_dich_vu" value="{{ $dichvu->ten_dich_vu }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh</label>
                        <input type="file" class="form-control" name="anh">
                        @if($dichvu->anh)
                            <div class="mt-2">
                                <small class="text-muted">Ảnh hiện tại:</small>
                                <img src="{{ asset('storage/' . $dichvu->anh) }}" alt="Ảnh dịch vụ" class="img-thumbnail mt-1" style="width: 100px;">
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội Dung</label>
                        <input type="text" class="form-control" name="noi_dung" value="{{ $dichvu->noi_dung }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại Dịch Vụ</label>
                        <select class="form-select" name="loai_dich_vu" required>
                            <option value="Dịch vụ nổi bật" {{ $dichvu->loai_dich_vu == 'Dịch vụ nổi bật' ? 'selected' : '' }}>Dịch vụ nổi bật</option>
                            <option value="Giáo Dục" {{ $dichvu->loai_dich_vu == 'Giáo Dục' ? 'selected' : '' }}>Giáo Dục</option>
                            <option value="Tài Chính" {{ $dichvu->loai_dich_vu == 'Tài Chính' ? 'selected' : '' }}>Tài Chính</option>
                            <option value="Giải Trí" {{ $dichvu->loai_dich_vu == 'Giải Trí' ? 'selected' : '' }}>Giải Trí</option>
                            <option value="Du Lịch" {{ $dichvu->loai_dich_vu == 'Du Lịch' ? 'selected' : '' }}>Du Lịch</option>
                            <option value="Internet An Toàn" {{ $dichvu->loai_dich_vu == 'Internet An Toàn' ? 'selected' : '' }}>Internet An Toàn</option>
                            <option value="Khác" {{ $dichvu->loai_dich_vu == 'Khác' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>