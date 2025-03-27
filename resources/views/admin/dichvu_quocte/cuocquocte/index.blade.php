@extends('layouts.admin')

<link rel="stylesheet" href="{{ asset('admins/cuocquocte/style.css') }}">
@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Cước quốc tế'])


<div class="row mb-4 g-4">
    <!-- Card 1: Tổng số quốc gia - Phiên bản nâng cao -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 hover-effect">
            <div class="card-body position-relative">
                <!-- Hiệu ứng gradient background -->
                <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10" 
                     style="background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%); border-radius: inherit;"></div>
                
                <div class="d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h6 class="text-muted mb-2 fw-normal text-uppercase small">Quốc gia</h6>
                        <h2 class="mb-0 fw-bold" id="total-countries">0</h2>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-globe-americas text-primary fs-3"></i>
                    </div>
                </div>
                <div class="mt-3 position-relative">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill me-2" id="country-change">
                            <i class="fas fa-caret-up me-1"></i> 0%
                        </span>
                        <span class="text-muted small">So với tháng trước</span>
                    </div>
                    <div class="mt-1 small text-muted">Cập nhật: <span class="text-dark">Hôm nay</span></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card 2: Tổng số nhà khai thác - Phiên bản nâng cao -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 hover-effect">
            <div class="card-body position-relative">
                <!-- Hiệu ứng gradient background -->
                <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10" 
                     style="background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%); border-radius: inherit;"></div>
                
                <div class="d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h6 class="text-muted mb-2 fw-normal text-uppercase small">Nhà khai thác</h6>
                        <h2 class="mb-0 fw-bold" id="total-operators">0</h2>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
                        </div>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-tower-cell text-success fs-3"></i>
                    </div>
                </div>
                <div class="mt-3 position-relative">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill me-2" id="operator-change">
                            <i class="fas fa-caret-up me-1"></i> 0%
                        </span>
                        <span class="text-muted small">So với tháng trước</span>
                    </div>
                    <div class="mt-1 small text-muted">Cập nhật: <span class="text-dark">Hôm nay</span></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card 3: Trung bình cước gọi - Phiên bản nâng cao -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 hover-effect">
            <div class="card-body position-relative">
                <!-- Hiệu ứng gradient background -->
                <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10" 
                     style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%); border-radius: inherit;"></div>
                
                <div class="d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h6 class="text-muted mb-2 fw-normal text-uppercase small">TB cước gọi</h6>
                        <h2 class="mb-0 fw-bold" id="avg-call-rate">$0</h2>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 45%"></div>
                        </div>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-phone-volume text-warning fs-3"></i>
                    </div>
                </div>
                <div class="mt-3 position-relative">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill me-2" id="call-rate-change">
                            <i class="fas fa-caret-up me-1"></i> 0%
                        </span>
                        <span class="text-muted small">So với tháng trước</span>
                    </div>
                    <div class="mt-1 small text-muted">Cập nhật: <span class="text-dark">Hôm nay</span></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card 4: Trung bình cước data - Phiên bản nâng cao -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 hover-effect">
            <div class="card-body position-relative">
                <!-- Hiệu ứng gradient background -->
                <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10" 
                     style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); border-radius: inherit;"></div>
                
                <div class="d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h6 class="text-muted mb-2 fw-normal text-uppercase small">TB cước data</h6>
                        <h2 class="mb-0 fw-bold" id="avg-data-rate">$0</h2>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 55%"></div>
                        </div>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-database text-danger fs-3"></i>
                    </div>
                </div>
                <div class="mt-3 position-relative">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill me-2" id="data-rate-change">
                            <i class="fas fa-caret-down me-1"></i> 0%
                        </span>
                        <span class="text-muted small">So với tháng trước</span>
                    </div>
                    <div class="mt-1 small text-muted">Cập nhật: <span class="text-dark">Hôm nay</span></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mb-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0">
                <h5 class="fw-semibold mb-0">
                    <i class="fas fa-chart-bar me-2 text-primary"></i>Phân bố cước theo quốc gia
                </h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="countryRateChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0">
                <h5 class="fw-semibold mb-0">
                    <i class="fas fa-chart-pie me-2 text-success"></i>Tỷ lệ loại thuê bao
                </h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="subscriptionTypeChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-semibold mb-0">
            <i class="fas fa-trophy me-2 text-warning"></i>Top 10 quốc gia có cước cao nhất
        </h5>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="topRateFilter" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-filter me-1"></i> Loại cước
            </button>
            <ul class="dropdown-menu" aria-labelledby="topRateFilter">
                <li><a class="dropdown-item active" href="#" data-type="all">Tất cả</a></li>
                <li><a class="dropdown-item" href="#" data-type="call">Gọi về VN</a></li>
                <li><a class="dropdown-item" href="#" data-type="data">Data</a></li>
                <li><a class="dropdown-item" href="#" data-type="sms">SMS</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
       
            <table class="table table-hover" id="topCountriesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Quốc gia</th>
                        <th>Gọi về VN</th>
                        <th>Data</th>
                        <th>SMS</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dữ liệu sẽ được load bằng JS -->
                </tbody>
            </table>
        
    </div>
</div>
<div class="container-fluid px-4 py-3">
    <!-- Header with Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary mb-0">
            <i class="fas fa-globe-americas me-2"></i>Quản Lý Cước Quốc Tế
        </h2>
        
        <div class="d-flex gap-2">
           
            <button class="btn btn-primary rounded-pill px-4" id="btn-add">
                <i class="fas fa-plus-circle me-2"></i>Thêm Mới
            </button>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="cuoc-quoc-te-table" class="table table-hover align-middle mb-0" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th width="50">ID</th>
                            <th>Quốc Gia</th>
                            <th>Nhà Khai Thác</th>
                            <th width="120">Loại Thuê Bao</th>
                            <th width="120">Gọi Trong Mạng</th>
                            <th width="120">Gọi về VN</th>
                            <th width="120">Gọi QT</th>
                            <th width="120">Nhận Gọi</th>
                            <th width="100">SMS</th>
                            <th width="100">Data</th>
                            <th width="120" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Loading Indicator -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="loadingToast" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-circle-notch fa-spin me-2"></i> Đang tải dữ liệu...
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

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


@section('js')
<script src="{{ asset('admins/cuocquocte/action.js') }}"></script>
<script>

    $(document).ready(function() {
        // Khởi tạo DataTable với cấu hình hiện có của bạn
        const table = $('#cuoc-quoc-te-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('cuoc-quoc-te.index') }}",
                beforeSend: function() {
                    $('#loadingToast').toast('show');
                },
                complete: function() {
                    $('#loadingToast').toast('hide');
                },
                error: function() {
                    $('#loadingToast').toast('hide');
                    showErrorToast('Lỗi khi tải dữ liệu');
                }
            },
            columns: [
                {data: 'id', name: 'id', className: 'fw-semibold'},
                {data: 'quoc_gia', name: 'quoc_gia', className: 'text-nowrap'},
                {data: 'nha_khai_thac', name: 'nha_khai_thac', className: 'text-nowrap'},
                {
                    data: 'loai_thue_bao', 
                    name: 'loai_thue_bao',
                    render: function(data) {
                        const badgeClass = data === 'Trả trước' ? 'bg-success' : 'bg-primary';
                        return `<span class="badge ${badgeClass}">${data}</span>`;
                    }
                },
                {
                    data: 'cuoc_goi_trong_mang', 
                    name: 'cuoc_goi_trong_mang',
                    className: 'price-cell',
                    render: function(data) {
                        return data ? formatCurrency(data) + '/ph' : '-';
                    }
                },
                {
                    data: 'cuoc_goi_ve_vn', 
                    name: 'cuoc_goi_ve_vn',
                    className: 'price-cell',
                    render: function(data) {
                        return data ? formatCurrency(data) + '/ph' : '-';
                    }
                },
                {
                    data: 'cuoc_quoc_te', 
                    name: 'cuoc_quoc_te',
                    className: 'price-cell',
                    render: function(data) {
                        return data ? formatCurrency(data) + '/ph' : '-';
                    }
                },
                {
                    data: 'cuoc_nhan_goi', 
                    name: 'cuoc_nhan_goi',
                    className: 'price-cell',
                    render: function(data) {
                        return data ? formatCurrency(data) + '/ph' : '-';
                    }
                },
                {
                    data: 'cuoc_sms', 
                    name: 'cuoc_sms',
                    className: 'price-cell',
                    render: function(data) {
                        return data ? formatCurrency(data) + '/sms' : '-';
                    }
                },
                {
                    data: 'cuoc_data', 
                    name: 'cuoc_data',
                    className: 'price-cell',
                    render: function(data) {
                        return data ? formatCurrency(data) + '/MB' : '-';
                    }
                },
                {
                    data: 'actions', 
                    name: 'actions', 
                    orderable: false, 
                    searchable: false,
                    className: 'text-center',
                    render: function(data, type, row) {
                        return `
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-outline-primary btn-action btn-edit" data-id="${row.id}" title="Chỉnh sửa">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger btn-action btn-delete" data-id="${row.id}" title="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ],
            language: {
                url: '/vendor/datatables/vi.json'
            }
        });

    

        // Helper function
        function formatCurrency(value) {
            return new Intl.NumberFormat('vi-VN').format(value);
        }
        
        function showErrorToast(message) {
            const toast = `<div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-exclamation-circle me-2"></i> ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>`;
            
            $('.toast-container').append(toast);
            setTimeout(() => $('.toast').remove(), 5000);
        }

        // Giữ nguyên các hàm xử lý hiện có
        function loadQuocGiaNhaKhaiThac() {
            $.get("/admin/get-quoc-gia-nha-khai-thac", function(data) {
                let quocGiaDropdown = $('#select-quoc-gia');
                let nhaKhaiThacDropdown = $('#select-nha-khai-thac');

                quocGiaDropdown.empty().append('<option value="">-- Chọn quốc gia --</option>');
                nhaKhaiThacDropdown.empty().append('<option value="">-- Chọn nhà khai thác --</option>');

                data.quoc_gia.forEach(q => {
                    quocGiaDropdown.append(`<option value="${q.id}">${q.ten_quoc_gia}</option>`);
                });

                data.nha_khai_thac.forEach(n => {
                    nhaKhaiThacDropdown.append(`<option value="${n.id}">${n.ten_nha_khai_thac}</option>`);
                });
            });
        }

        $('#btn-add').click(function () {
            $('#modal-cuoc-quoc-te').modal('show');
            $('#cuoc_quoc_te_id').val('');
            $('#form-cuoc-quoc-te')[0].reset();
            loadQuocGiaNhaKhaiThac();
        });

        $('#form-cuoc-quoc-te').submit(function (e) {
            e.preventDefault();
            let id = $('#cuoc_quoc_te_id').val();
            let url = id ? "/admin/cuoc-quoc-te/" + id : "/admin/cuoc-quoc-te";
            let method = id ? "PUT" : "POST";

            $.ajax({
                url: url,
                type: method,
                data: {
                    _token: "{{ csrf_token() }}",
                    quoc_gia_id: $('#select-quoc-gia').val(),
                    nha_khai_thac_id: $('#select-nha-khai-thac').val(),
                    loai_thue_bao: $('#loai_thue_bao').val(),
                    cuoc_goi_trong_mang: $('#cuoc_goi_trong_mang').val(),
                    cuoc_goi_ve_vn: $('#cuoc_goi_ve_vn').val(),
                    cuoc_quoc_te: $('#cuoc_quoc_te').val(),
                    cuoc_ve_tinh: $('#cuoc_ve_tinh').val(),
                    cuoc_nhan_goi: $('#cuoc_nhan_goi').val(),
                    cuoc_sms: $('#cuoc_sms').val(),
                    cuoc_data: $('#cuoc_data').val()
                },
                success: function (response) {
                    Swal.fire("Thành công!", response.message, "success");
                    $('#modal-cuoc-quoc-te').modal('hide');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    Swal.fire("Lỗi!", xhr.responseJSON.message || "Có lỗi xảy ra", "error");
                }
            });
        });

        // Xử lý sự kiện xóa
        $('body').on('click', '.btn-delete', function () {
            let id = $(this).data("id");
            Swal.fire({
                title: "Bạn có chắc muốn xóa?",
                text: "Hành động này không thể hoàn tác!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Xóa ngay!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/cuoc-quoc-te/" + id,
                        type: "DELETE",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function (response) {
                            Swal.fire("Đã xóa!", response.message, "success");
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire("Lỗi!", xhr.responseJSON.message || "Có lỗi xảy ra khi xóa", "error");
                        }
                    });
                }
            });
        });

        // Xử lý sự kiện sửa
        $('body').on('click', '.btn-edit', function () {
            let id = $(this).data("id");
            $.get("/admin/cuoc-quoc-te/" + id + "/edit", function (data) {
                $('#cuoc_quoc_te_id').val(data.id);
                $('#select-quoc-gia').val(data.quoc_gia_id);
                $('#select-nha-khai-thac').val(data.nha_khai_thac_id);
                $('#loai_thue_bao').val(data.loai_thue_bao);
                $('#cuoc_goi_trong_mang').val(data.cuoc_goi_trong_mang);
                $('#cuoc_goi_ve_vn').val(data.cuoc_goi_ve_vn);
                $('#cuoc_quoc_te').val(data.cuoc_quoc_te);
                $('#cuoc_ve_tinh').val(data.cuoc_ve_tinh);
                $('#cuoc_nhan_goi').val(data.cuoc_nhan_goi);
                $('#cuoc_sms').val(data.cuoc_sms);
                $('#cuoc_data').val(data.cuoc_data);
                loadQuocGiaNhaKhaiThac();
                $('#modal-cuoc-quoc-te').modal('show');
            }).fail(function() {
                Swal.fire("Lỗi!", "Không thể tải dữ liệu để chỉnh sửa", "error");
            });
        });
    });

    // Initialize select2
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#modal-cuoc-quoc-te'),
            width: '100%',
            placeholder: $(this).data('placeholder')
        });
        
        // Form validation
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
        
        // Dynamic title based on action
        $('#modal-cuoc-quoc-te').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var isEdit = button.data('edit');
            if(isEdit) {
                $('#modal-title-text').text('Chỉnh Sửa Cước Quốc Tế');
                $('#save-button').html('<i class="fas fa-sync-alt me-2"></i>Cập nhật');
            } else {
                $('#modal-title-text').text('Thêm Mới Cước Quốc Tế');
                $('#save-button').html('<i class="fas fa-save me-2"></i>Lưu thông tin');
            }
        });
    });

</script>

@endsection


@endsection
