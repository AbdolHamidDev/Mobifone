@extends('layouts.admin')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="{{ asset('admins/goicuoc/goicuoc.css') }}">

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Gói Cước'])

<!-- Nhúng file incomplete.blade.php -->
@include('admin.goicuocs.incomplete', ['incompleteGoiCuocs' => $incompleteGoiCuocs])


<div class="container-fluid mt-4 px-4">

<div class="d-flex justify-content-between flex-wrap">
    <!-- Container for the first chart (goicuocChart) -->
    <div class="chart-container" style="flex: 1; max-width: 80%; height: 50vh; border-radius: 20px; overflow: hidden; margin-right: 20px; background-color: #ffffff; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out;">
        <canvas id="goicuocChart"></canvas>
    </div>

    <!-- Container for the second chart (statusChart) -->
    <div class="chart-container" style="flex: 1; height: 50vh; border-radius: 20px; overflow: hidden; margin-left: 20px; background-color: #ffffff; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out;">
        <div class="chart-wrapper" style="height: 100%;">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
</div>



    <!-- Nút thêm, import và export gói cước -->
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-primary btn-shadow me-2" data-bs-toggle="modal" data-bs-target="#addGoiCuocModal">
            <i class="fas fa-plus"></i> Thêm Gói Cước
        </button>
        <div class="d-flex">
            <button class="btn btn-success btn-shadow me-2" onclick="document.getElementById('importFileInput').click();">
                <i class="fas fa-file-import"></i> Thêm excel
            </button>
            <button class="btn btn-secondary btn-shadow" onclick="exportGoiCuocs();">
                <i class="fas fa-file-export"></i> Xuất excel
            </button>
            <input type="file" id="importFileInput" style="display: none;" onchange="importGoiCuocs(event)">
        </div>
    </div>

    <!-- Bảng DataTables -->
    <div class="table-responsive shadow-lg rounded-3 overflow-hidden">
        <table id="goicuocsTable" class="table table-bordered table-hover align-middle table-striped">
            <thead class="table-light text-center">
                <tr>
                    <th>#</th>
                    <th>Tên gói cước</th>
                    <th class="text-end">Giá</th>
                    <th class="text-center">Thời gian</th>
                    <th class="text-end">Dung lượng</th>
                    <th>Loại gói</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <!-- DataTables tự động điền -->
            </tbody>
        </table>
    </div>
    
</div>


<!-- Modal Thêm Gói Cước -->
<div class="modal fade" id="addGoiCuocModal" tabindex="-1" aria-labelledby="addGoiCuocModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <form id="goicuocForm" class="needs-validation" novalidate>
                <!-- Header với gradient -->
                <div class="modal-header bg-gradient-primary text-white rounded-top-3 py-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="bi bi-lightning-charge-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fs-5 fw-bold mb-0" id="addGoiCuocModalLabel">THÊM GÓI CƯỚC MỚI</h5>
                            <p class="small mb-0 opacity-75">Nhập đầy đủ thông tin gói cước</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <!-- Progress steps -->
                <div class="progress-steps bg-light">
                    <div class="step active" data-step="1">
                        <span>1. Thông tin cơ bản</span>
                    </div>
                    <div class="step" data-step="2">
                        <span>2. Cấu hình</span>
                    </div>
                    <div class="step" data-step="3">
                        <span>3. Xác nhận</span>
                    </div>
                </div>
                
                <div class="modal-body p-4">
                    @csrf
                    
                    <!-- Step 1: Basic Information -->
                    <div class="step-content" data-step-content="1">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="ten_goicuoc" class="form-label fw-semibold">
                                    <i class="bi bi-card-text me-1 text-primary"></i>Tên Gói Cước <span class="text-danger">*</span>
                                </label>
                                <div class="input-group has-validation">
                                    <input type="text" name="ten_goicuoc" id="ten_goicuoc" class="form-control form-control-lg" 
                                           placeholder="Ví dụ: Combo Data 4G 1GB/ngày" required>
                                    <div class="invalid-feedback">Vui lòng nhập tên gói cước</div>
                                </div>
                                <div class="form-text ps-2">Tối đa 50 ký tự</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="loai_goicuoc" class="form-label fw-semibold">
                                    <i class="bi bi-tags me-1 text-primary"></i>Loại Gói Cước <span class="text-danger">*</span>
                                </label>
                                <select name="loai_goicuoc" id="loai_goicuoc" class="form-select form-select-lg" required>
                                    <option value="" selected disabled>-- Chọn loại gói --</option>
                                    <optgroup label="Gói Quốc Tế">
                                        <option value="thoai_quoc_te">Thỏa Thuận Quốc Tế</option>
                                        <option value="chuyen_vung_quoc_te">Chuyển Vùng Quốc Tế</option>
                                        <option value="quoc_te_linh_hoat">Quốc tế linh hoạt</option>
                                    </optgroup>
                                    <optgroup label="Gói Data">
                                        <option value="sieu_data">Siêu data</option>
                                        <option value="combo_trong_nuoc">Combo trong nước</option>
                                    </optgroup>
                                    <optgroup label="Gói Khác">
                                        <option value="tich_diem">Tích Điểm</option>
                                        <option value="mobisafe">MOBISAFE</option>
                                        <option value="mobif">MOBIF</option>
                                        <option value="chi_dep">Chị đẹp</option>
                                        <option value="combo">Combo</option>
                                        <option value="gia_dinh">Gia đình</option>
                                        <option value="hot">Hot</option>
                                    </optgroup>
                                </select>
                                <div class="invalid-feedback">Vui lòng chọn loại gói</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="gia" class="form-label fw-semibold">
                                    <i class="bi bi-cash-coin me-1 text-primary"></i>Giá Gói <span class="text-danger">*</span>
                                </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-light">đ</span>
                                    <input type="number" name="gia" id="gia" class="form-control form-control-lg" 
                                           placeholder="50,000" min="1000" step="1000" required>
                                    <div class="invalid-feedback">Giá tối thiểu 1,000đ</div>
                                </div>
                                <div class="form-text ps-2">Nhập giá không bao gồm VAT</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-calendar-check me-1 text-primary"></i>Thời Hạn Sử Dụng <span class="text-danger">*</span>
                                </label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="thoi_han_type" id="ngay" value="ngay" checked>
                                    <label class="btn btn-outline-primary" for="ngay">Theo Ngày</label>
                                    
                                    <input type="radio" class="btn-check" name="thoi_han_type" id="thang" value="thang">
                                    <label class="btn btn-outline-primary" for="thang">Theo Tháng</label>
                                    
                                    <input type="radio" class="btn-check" name="thoi_han_type" id="tuy_chon" value="tuy_chon">
                                    <label class="btn btn-outline-primary" for="tuy_chon">Tùy Chọn</label>
                                </div>
                                
                                <div id="thoiGianContainer" class="mt-2">
                                    <input type="number" name="thoi_gian" id="thoi_gian" class="form-control" 
                                           placeholder="Nhập số ngày" min="1" required>
                                    <div class="invalid-feedback">Vui lòng nhập thời hạn</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 2: Configuration -->
                    <div class="step-content d-none" data-step-content="2">
                        <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-gear me-2"></i>Cấu hình gói cước</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="dung_luong" class="form-label fw-semibold">Dung Lượng Data <span class="text-danger">*</span></label>
                                <div class="input-group has-validation">
                                    <input type="number" name="dung_luong" id="dung_luong" class="form-control" 
                                           placeholder="Nhập dung lượng" min="1" required>
                                    <select name="don_vi_dung_luong" id="don_vi_dung_luong" class="form-select" style="max-width: 120px;" required>
                                        <option value="MB">MB</option>
                                        <option value="GB" selected>GB</option>
                                    </select>
                                    <div class="invalid-feedback">Vui lòng nhập dung lượng</div>
                                </div>
                                <div class="form-text">Dung lượng data/ngày</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="phut_goi" class="form-label fw-semibold">Phút Gọi</label>
                                <div class="input-group">
                                    <input type="number" name="phut_goi" id="phut_goi" class="form-control" placeholder="0" min="0">
                                    <span class="input-group-text">phút</span>
                                </div>
                                <div class="form-text">Nhập 0 nếu không bao gồm</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="sms" class="form-label fw-semibold">SMS</label>
                                <div class="input-group">
                                    <input type="number" name="sms" id="sms" class="form-control" placeholder="0" min="0">
                                    <span class="input-group-text">tin nhắn</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="toc_do" class="form-label fw-semibold">Tốc Độ</label>
                                <select name="toc_do" id="toc_do" class="form-select">
                                    <option value="" selected>Không giới hạn</option>
                                    <option value="2">2 Mbps</option>
                                    <option value="4">4 Mbps</option>
                                    <option value="10">10 Mbps</option>
                                    <option value="20">20 Mbps</option>
                                </select>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="goi_dac_biet" name="goi_dac_biet">
                                    <label class="form-check-label fw-semibold" for="goi_dac_biet">Gói đặc biệt (nổi bật trên trang chủ)</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="auto_renew" name="auto_renew" checked>
                                    <label class="form-check-label fw-semibold" for="auto_renew">Tự động gia hạn</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 3: Confirmation -->
                    <div class="step-content d-none" data-step-content="3">
                        <div class="text-center py-4">
                            <div class="bg-soft-primary rounded-circle d-inline-flex p-3 mb-3">
                                <i class="bi bi-check-circle-fill text-primary fs-1"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Xác nhận thông tin gói cước</h5>
                            <p class="text-muted mb-4">Vui lòng kiểm tra kỹ thông tin trước khi lưu</p>
                            
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="fw-semibold mb-1">Tên Gói:</h6>
                                                <p id="confirm_ten" class="text-muted mb-0">-</p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="fw-semibold mb-1">Loại Gói:</h6>
                                                <p id="confirm_loai" class="text-muted mb-0">-</p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="fw-semibold mb-1">Giá:</h6>
                                                <p id="confirm_gia" class="text-muted mb-0">-</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="fw-semibold mb-1">Thời Hạn:</h6>
                                                <p id="confirm_thoigian" class="text-muted mb-0">-</p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="fw-semibold mb-1">Dung Lượng:</h6>
                                                <p id="confirm_dungluong" class="text-muted mb-0">-</p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="fw-semibold mb-1">Phút Gọi:</h6>
                                                <p id="confirm_phutgoi" class="text-muted mb-0">-</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="confirm_check" required>
                                <label class="form-check-label fw-semibold" for="confirm_check">
                                    Tôi xác nhận thông tin trên là chính xác
                                </label>
                                <div class="invalid-feedback">Bạn cần xác nhận trước khi lưu</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-0 bg-light rounded-bottom-3">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4 me-auto" id="prevBtn" disabled>
                        <i class="bi bi-chevron-left me-1"></i> Quay lại
                    </button>
                    
                    <button type="button" class="btn btn-light rounded-pill px-4 me-2" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Hủy bỏ
                    </button>
                    
                    <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" id="nextBtn">
                        Tiếp tục <i class="bi bi-chevron-right ms-1"></i>
                    </button>
                    
                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm d-none" id="submitBtn">
                        <i class="bi bi-check-lg me-1"></i> Lưu Gói Cước
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
    const routes = {
        api: '{{ route('goicuocs.api') }}',
        store: '{{ route('goicuocs.store') }}',
        import: '{{ route('goicuocs.import') }}',
        export: '{{ route('goicuocs.export') }}',
        changeStatus: (id) => `/admin/goicuocs/${id}/change-status`,
    };
    const csrfToken = '{{ csrf_token() }}';
</script>

<script src="{{ asset('admins/goicuoc/goicuoc.js') }}"></script>

@endsection