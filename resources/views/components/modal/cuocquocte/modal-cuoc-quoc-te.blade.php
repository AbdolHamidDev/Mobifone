<!-- Modern Modal -->
<div class="modal fade" id="modal-cuoc-quoc-te" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="form-cuoc-quoc-te" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" id="cuoc_quoc_te_id">
            <div class="modal-content border-0 shadow-lg">
                <!-- Modal Header -->
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title fs-5 fw-semibold">
                        <i class="fas fa-globe-americas me-2"></i>
                        <span id="modal-title-text">Thêm Mới Cước Quốc Tế</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- Column 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="select-quoc-gia" class="form-label fw-medium">
                                    <i class="fas fa-flag me-2 text-primary"></i>Quốc Gia
                                </label>
                                <select class="form-select select2" id="select-quoc-gia" required>
                                    <option value="" selected disabled>-- Chọn quốc gia --</option>
                                </select>
                                <div class="invalid-feedback">Vui lòng chọn quốc gia</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="select-nha-khai-thac" class="form-label fw-medium">
                                    <i class="fas fa-tower-cell me-2 text-primary"></i>Nhà Khai Thác
                                </label>
                                <select class="form-select select2" id="select-nha-khai-thac" required>
                                    <option value="" selected disabled>-- Chọn nhà khai thác --</option>
                                </select>
                                <div class="invalid-feedback">Vui lòng chọn nhà khai thác</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="loai_thue_bao" class="form-label fw-medium">
                                    <i class="fas fa-sim-card me-2 text-primary"></i>Loại Thuê Bao
                                </label>
                                <select class="form-select" id="loai_thue_bao" required>
                                    <option value="" selected disabled>-- Chọn loại thuê bao --</option>
                                    <option value="Trả trước">Trả trước</option>
                                    <option value="Trả sau">Trả sau</option>
                                </select>
                                <div class="invalid-feedback">Vui lòng chọn loại thuê bao</div>
                            </div>
                        </div>
                        
                        <!-- Column 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cuoc_goi_trong_mang" class="form-label fw-medium">
                                    <i class="fas fa-phone-alt me-2 text-success"></i>Gọi Trong Mạng (VNĐ/phút)
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="cuoc_goi_trong_mang" min="0" step="100" required>
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập giá trị hợp lệ</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="cuoc_goi_ve_vn" class="form-label fw-medium">
                                    <i class="fas fa-phone-volume me-2 text-success"></i>Gọi về VN (VNĐ/phút)
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="cuoc_goi_ve_vn" min="0" step="100" required>
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập giá trị hợp lệ</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Second Row -->
                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="cuoc_quoc_te" class="form-label fw-medium">
                                    <i class="fas fa-phone-square-alt me-2 text-info"></i>Gọi Quốc Tế (VNĐ/phút)
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="cuoc_quoc_te" min="0" step="100" required>
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập giá trị hợp lệ</div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="cuoc_ve_tinh" class="form-label fw-medium">
                                    <i class="fas fa-satellite-dish me-2 text-info"></i>Gọi Vệ Tinh (VNĐ/phút)
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="cuoc_ve_tinh" min="0" step="100">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="cuoc_nhan_goi" class="form-label fw-medium">
                                    <i class="fas fa-phone-incoming me-2 text-info"></i>Nhận Cuộc Gọi (VNĐ/phút)
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="cuoc_nhan_goi" min="0" step="100" required>
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập giá trị hợp lệ</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Third Row -->
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cuoc_sms" class="form-label fw-medium">
                                    <i class="fas fa-sms me-2 text-warning"></i>Gửi SMS (VNĐ/tin nhắn)
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="cuoc_sms" min="0" step="100" required>
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập giá trị hợp lệ</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cuoc_data" class="form-label fw-medium">
                                    <i class="fas fa-database me-2 text-danger"></i>Data (VNĐ/MB)
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="cuoc_data" min="0" step="10" required>
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập giá trị hợp lệ</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Hủy bỏ
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4" id="save-button">
                        <i class="fas fa-save me-2"></i>Lưu thông tin
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>