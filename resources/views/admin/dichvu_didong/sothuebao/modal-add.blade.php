<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('so-thue-bao.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i> Thêm Số Thuê Bao
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="so_thue_bao" class="form-label">Số thuê bao</label>
                            <input type="text" class="form-control" name="so_thue_bao" required>
                        </div>
                        <div class="col-md-6">
                            <label for="loai_thue_bao" class="form-label">Loại thuê bao</label>
                            <select class="form-select" name="loai_thue_bao" required>
                                <option value="tra_truoc">Trả trước</option>
                                <option value="tra_sau">Trả sau</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="loai_so" class="form-label">Loại số</label>
                            <select class="form-select" name="loai_so" required>
                                <option value="so_thuong">Số Thường</option>
                                <option value="so_vip">Số VIP</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="khu_vuc" class="form-label">Khu vực hòa mạng</label>
                            <input type="text" class="form-control bg-light" name="khu_vuc" value="Toàn quốc" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="phi_giu_so" class="form-label">Phí giữ số</label>
                            <input type="number" class="form-control" name="phi_giu_so" value="0" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phi_hoa_mang" class="form-label">Phí hòa mạng</label>
                            <input type="number" class="form-control" name="phi_hoa_mang" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle me-1"></i> Thêm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>