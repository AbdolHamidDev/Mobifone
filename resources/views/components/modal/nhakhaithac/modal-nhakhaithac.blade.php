<!-- Modal Thêm/Sửa Nhà Khai Thác-->
<div class="modal fade" id="modal-nha-khai-thac" tabindex="-1" aria-labelledby="modalNhaKhaiThacLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="form-nha-khai-thac" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" id="nha_khai_thac_id">
            <div class="modal-content border-0">
                <!-- Modal Header với gradient -->
                <div class="modal-header bg-gradient-primary text-white py-3 px-4">
                    <div class="d-flex align-items-center w-100">
                        <div class="icon-wrapper bg-white bg-opacity-20 rounded-circle p-2 me-3">
                            <i class="fas fa-tower-cell text-white fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fs-4 fw-bold mb-0" id="modalNhaKhaiThacLabel">
                                <span id="modal-title-text">Thêm Mới Nhà Khai Thác</span>
                            </h5>
                            <p class="text-white-50 mb-0 small">Quản lý thông tin nhà khai thác viễn thông</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white btn-sm m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <!-- Cột 1 -->
                        <div class="col-md-6">
                            <!-- Dropdown Quốc Gia -->
                            <div class="form-floating mb-4">
                                <select class="form-select border-0 border-bottom" id="select-quoc-gia" style="border-radius: 0; border-bottom: 2px solid #dee2e6!important;" required>
                                    <option value="" selected disabled></option>
                                    <!-- Options sẽ được load bằng JS -->
                                </select>
                                <label for="select-quoc-gia" class="text-muted">
                                    <i class="fas fa-flag me-2"></i>Quốc gia <span class="text-danger">*</span>
                                </label>
                                <div class="invalid-feedback mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>Vui lòng chọn quốc gia
                                </div>
                            </div>

                            <!-- Tên Nhà Khai Thác -->
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control border-0 border-bottom" id="ten_nha_khai_thac" 
                                       placeholder=" " style="border-radius: 0; border-bottom: 2px solid #dee2e6!important;" required>
                                <label for="ten_nha_khai_thac" class="text-muted">
                                    <i class="fas fa-building me-2"></i>Tên nhà khai thác <span class="text-danger">*</span>
                                </label>
                                <div class="invalid-feedback mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>Vui lòng nhập tên nhà khai thác
                                </div>
                                <div class="form-text ps-4 mt-1 small">
                                    <i class="fas fa-info-circle me-2"></i>Nhập tên đầy đủ theo giấy phép
                                </div>
                            </div>
                        </div>

                        <!-- Cột 2 -->
                        <div class="col-md-6">
                            <!-- Mã Nhà Khai Thác -->
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control border-0 border-bottom" id="ma_nha_khai_thac" 
                                       placeholder=" " style="border-radius: 0; border-bottom: 2px solid #dee2e6!important;" required>
                                <label for="ma_nha_khai_thac" class="text-muted">
                                    <i class="fas fa-barcode me-2"></i>Mã nhà khai thác <span class="text-danger">*</span>
                                </label>
                                <div class="invalid-feedback mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>Vui lòng nhập mã nhà khai thác
                                </div>
                                <div class="form-text ps-4 mt-1 small">
                                    <i class="fas fa-info-circle me-2"></i>Mã định danh duy nhất (viết liền không dấu)
                                </div>
                            </div>

                            <!-- Thêm trường mẫu để minh họa -->
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control border-0 border-bottom" id="vi_do_hoat_dong" 
                                       placeholder=" " style="border-radius: 0; border-bottom: 2px solid #dee2e6!important;">
                                <label for="vi_do_hoat_dong" class="text-muted">
                                    <i class="fas fa-map-marker-alt me-2"></i>Vĩ độ hoạt động
                                </label>
                                <div class="form-text ps-4 mt-1 small">
                                    <i class="fas fa-info-circle me-2"></i>Tọa độ trung tâm (nếu có)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer bg-light py-3 px-4 border-top-0">
                    <button type="button" class="btn btn-lg btn-outline-secondary rounded-1 px-4 me-2" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Đóng
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary rounded-1 px-4 shadow-sm" id="save-button">
                        <i class="fas fa-save me-2"></i>Lưu thông tin
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>