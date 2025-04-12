    <!-- Modal Thêm/Sửa với Animation Nâng Cao -->
    <div class="modal fade" id="modal-cuoc-voip" tabindex="-1" role="dialog" aria-labelledby="modal-cuoc-voip-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content border-0 shadow-lg overflow-hidden">
                <form id="form-cuoc-voip" autocomplete="off">
                    @csrf
                    <input type="hidden" id="cuoc_voip_id">

                    <!-- Modal Header với gradient -->
                    <div class="modal-header bg-gradient-primary text-white py-3">
                        <div class="d-flex align-items-center">
                            <div class="modal-icon-circle bg-white text-primary mr-3">
                                <i class="fas fa-phone-volume fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="modal-title font-weight-bold mb-0" id="modal-cuoc-voip-title">
                                    <span id="modal-title">Thêm Cước VoIP Mới</span>
                                </h5>
                                <small class="d-block opacity-80" id="modal-subtitle">Nhập thông tin gói cước VoIP</small>
                            </div>
                        </div>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Modal Body với tabs -->
                    <div class="modal-body p-0">
                        <div class="row no-gutters">
                            <!-- Left Side - Form Inputs -->
                            <div class="col-md-8 p-4">
                                <div class="form-steps">
                                    <!-- Step 1 - Thông tin cơ bản -->
                                    <div class="form-step active" data-step="1">
                                        <div class="form-group animate__animated animate__fadeIn">
                                            <label class="form-label">
                                                <i class="fas fa-globe-asia mr-1 text-primary"></i>
                                                Quốc gia
                                            </label>
                                            <select id="select-quoc-gia" name="quoc_gia_id"
                                                class="form-control select2-with-flag">
                                                <option value="">-- Chọn quốc gia --</option>
                                                @foreach ($quocGias as $qg)
                                                    <option value="{{ $qg->id }}"
                                                        data-flag="{{ strtolower($qg->ma_quoc_gia) ?? 'vn' }}">
                                                        {{ $qg->ten_quoc_gia }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group animate__animated animate__fadeIn animate__delay-1s">
                                            <label class="form-label">
                                                <i class="fas fa-tags mr-1 text-primary"></i>
                                                Nhóm cước
                                            </label>
                                            <div class="input-group">
                                                <input type="text" id="nhom_cuoc" name="nhom_cuoc" class="form-control"
                                                    required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">Ví dụ: Cước quốc tế, Cước nội mạng</small>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group animate__animated animate__fadeIn animate__delay-2s">
                                                    <label class="form-label">
                                                        <i class="fas fa-hashtag mr-1 text-primary"></i>
                                                        Mã vùng
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">+</span>
                                                        </div>
                                                        <input type="text" id="ma_vung" name="ma_vung"
                                                            class="form-control" placeholder="84">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group animate__animated animate__fadeIn animate__delay-2s">
                                                    <label class="form-label">
                                                        <i class="fas fa-clock mr-1 text-primary"></i>
                                                        Block 6s đầu
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" id="block_6s_dau" name="block_6s_dau"
                                                            class="form-control" min="0" step="100">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-light">VNĐ</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Step 2 - Chi tiết giá (hidden by default) -->
                                    <div class="form-step" data-step="2" style="display:none;">
                                        <div class="price-settings">
                                            <h6 class="section-title text-primary mb-3">
                                                <i class="fas fa-money-bill-wave mr-2"></i>
                                                Cấu hình giá cước
                                            </h6>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group animate__animated animate__fadeIn">
                                                        <label class="form-label">
                                                            <i class="fas fa-stopwatch mr-1 text-success"></i>
                                                            Giá mỗi giây
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="number" id="gia_moi_giay" name="gia_moi_giay"
                                                                class="form-control" min="0" step="10">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-light">VNĐ/giây</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group animate__animated animate__fadeIn animate__delay-1s">
                                                        <label class="form-label">
                                                            <i class="fas fa-hourglass-start mr-1 text-success"></i>
                                                            Giá 1 phút đầu
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="number" id="gia_1_phut_dau"
                                                                name="gia_1_phut_dau" class="form-control" min="0"
                                                                step="100">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-light">VNĐ/phút</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group animate__animated animate__fadeIn animate__delay-2s">
                                                <label class="form-label">
                                                    <i class="fas fa-hourglass-end mr-1 text-success"></i>
                                                    Giá 1 phút tiếp theo
                                                </label>
                                                <div class="input-group">
                                                    <input type="number" id="gia_1_phut_tiep_theo"
                                                        name="gia_1_phut_tiep_theo" class="form-control" min="0"
                                                        step="100">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-light">VNĐ/phút</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="price-preview mt-4 animate__animated animate__fadeIn animate__delay-3s">
                                                <h6 class="section-title text-primary mb-3">
                                                    <i class="fas fa-chart-line mr-2"></i>
                                                    Xem trước tính cước
                                                </h6>
                                                <div class="card bg-light p-3">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span>Cuộc gọi 30 giây:</span>
                                                        <strong class="text-primary" id="preview-30s">0 VNĐ</strong>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span>Cuộc gọi 1 phút:</span>
                                                        <strong class="text-primary" id="preview-1m">0 VNĐ</strong>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span>Cuộc gọi 5 phút:</span>
                                                        <strong class="text-primary" id="preview-5m">0 VNĐ</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side - Progress & Actions -->
                            <div class="col-md-4 bg-light p-4 border-left">
                                <div class="form-progress sticky-top" style="top: 20px;">
                                    <h6 class="text-center text-muted mb-4">TIẾN TRÌNH</h6>
                                    <div class="steps">
                                        <div class="step active" data-step="1">
                                            <div class="step-number">1</div>
                                            <div class="step-info">
                                                <div class="step-title">Thông tin cơ bản</div>
                                                <small class="step-desc">Nhập quốc gia và nhóm cước</small>
                                            </div>
                                        </div>
                                        <div class="step" data-step="2">
                                            <div class="step-number">2</div>
                                            <div class="step-info">
                                                <div class="step-title">Cấu hình giá</div>
                                                <small class="step-desc">Thiết lập các mức giá</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="next-step mt-4">
                                        <button type="button" class="btn btn-outline-primary btn-block"
                                            id="btn-next-step">
                                            Tiếp theo <i class="fas fa-arrow-right ml-2"></i>
                                        </button>
                                    </div>

                                    <div class="form-actions mt-4 pt-3 border-top">
                                        <button type="button" class="btn btn-link text-muted btn-sm"
                                            data-dismiss="modal">
                                            <i class="fas fa-times mr-1"></i> Hủy bỏ
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-block mt-2" id="btn-save">
                                            <i class="fas fa-save mr-1"></i> Lưu gói cước
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>