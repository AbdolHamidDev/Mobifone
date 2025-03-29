@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('admins/goivoip/style.css') }}">
@endpush
@section('content')
<x-layout.content-header name="Danh sách" key="Gói Voip" />

<!-- Khu vực Dasbroad và bảng -->
<div class="container-fluid py-4">

    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1><i class="fas fa-phone-alt"></i> Bảng điều khiển phân tích</h1>
            <div class="header-actions">
                <button class="btn btn-refresh"><i class="fas fa-sync-alt"></i> Làm mới</button>
            </div>
        </header>

        <div class="dashboard-content">
            <!-- Overview Cards -->
            <section class="overview-section">
                <div class="card">
                    <div class="card-icon bg-blue">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="card-content">
                        <h3>Tổng Quốc Gia</h3>
                        <p id="totalCountries">0</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon bg-green">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="card-content">
                        <h3>Tổng Nhóm Cước</h3>
                        <p id="totalGroups">0</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon bg-purple">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="card-content">
                        <h3>Tổng Gói Cước</h3>
                        <p id="totalPackages">0</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon bg-orange">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3>Tổng Vùng</h3>
                        <p id="totalRegions">0</p>
                    </div>
                </div>
            </section>

            <!-- Price Metrics Cards -->
            <section class="price-metrics-section">
                <div class="metric-card">
                    <h3>Giá TB Block 6s</h3>
                    <p id="avgBlock6s">0 VNĐ</p>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 2.5%
                    </div>
                </div>

                <div class="metric-card">
                    <h3>Giá TB Mỗi Giây</h3>
                    <p id="avgPricePerSecond">0 VNĐ</p>
                    <div class="trend down">
                        <i class="fas fa-arrow-down"></i> 1.8%
                    </div>
                </div>

                <div class="metric-card">
                    <h3>Giá TB Phút Đầu</h3>
                    <p id="avgPriceFirstMinute">0 VNĐ</p>
                    <div class="trend stable">
                        <i class="fas fa-equals"></i> 0.3%
                    </div>
                </div>
            </section>

            <!-- Charts Section -->
            <section class="charts-section">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-pie"></i> Phân Bổ Theo Quốc Gia</h3>
                        <div class="chart-actions">
                            <button class="btn-chart-action active">Tuần</button>
                            <button class="btn-chart-action">Tháng</button>
                            <button class="btn-chart-action">Năm</button>
                        </div>
                    </div>
                    <canvas id="countryChart"></canvas>
                </div>

                <div class="chart-container">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-bar"></i> Phân Bổ Nhóm Cước</h3>
                        <div class="chart-actions">
                            <button class="btn-chart-action active">Tuần</button>
                            <button class="btn-chart-action">Tháng</button>
                            <button class="btn-chart-action">Năm</button>
                        </div>
                    </div>
                    <canvas id="groupChart"></canvas>
                </div>

                <div class="chart-container">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-bar"></i> Giá Block 6s Theo Vùng</h3>
                        <div class="chart-actions">
                            <button class="btn-chart-action active">Tuần</button>
                            <button class="btn-chart-action">Tháng</button>
                            <button class="btn-chart-action">Năm</button>
                        </div>
                    </div>
                    <canvas id="block6sChart"></canvas>
                </div>

                <div class="chart-container">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-line"></i> Giá Mỗi Giây Theo Vùng</h3>
                        <div class="chart-actions">
                            <button class="btn-chart-action active">Tuần</button>
                            <button class="btn-chart-action">Tháng</button>
                            <button class="btn-chart-action">Năm</button>
                        </div>
                    </div>
                    <canvas id="pricePerSecondChart"></canvas>
                </div>
            </section>
            
            <!-- Table Section - Moved to be horizontal with the last card -->
            
                 <!-- Header with Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary mb-0">
            <i class="fas fa-phone-alt me-2"></i>Quản lý gói cước VoIP
        </h2>
        
        <div class="d-flex gap-2">
           
            <button class="btn btn-primary rounded-pill px-4" id="btn-add">
                <i class="fas fa-plus-circle me-2"></i>Thêm Mới
            </button>
        </div>
    </div>
                
                <div class="card shadow-sm border-0 table-card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="cuocPhiTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Quốc gia</th>
                                    <th>Nhóm cước</th>
                                    <th>Mã vùng</th>
                                    <th class="text-right">Block 6s đầu</th>
                                    <th class="text-right">Giá mỗi giây</th>
                                    <th class="text-right">Giá 1 phút đầu</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>

<!-- Modal Thêm/Sửa với Animation Nâng Cao -->
<div class="modal fade" id="modal-cuoc-voip" tabindex="-1" role="dialog" aria-labelledby="modal-cuoc-voip-title" aria-hidden="true">
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
                                        <select id="select-quoc-gia" name="quoc_gia_id" class="form-control select2-with-flag">
                                            <option value="">-- Chọn quốc gia --</option>
                                            @foreach($quocGias as $qg)
                                                <option value="{{ $qg->id }}" data-flag="{{ strtolower($qg->ma_quoc_gia) ?? 'vn' }}">
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
                                            <input type="text" id="nhom_cuoc" name="nhom_cuoc" class="form-control" required>
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
                                                    <input type="text" id="ma_vung" name="ma_vung" class="form-control" placeholder="84">
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
                                                    <input type="number" id="block_6s_dau" name="block_6s_dau" class="form-control" min="0" step="100">
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
                                                        <input type="number" id="gia_moi_giay" name="gia_moi_giay" class="form-control" min="0" step="10">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-light">VNĐ/giây</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group animate__animated animate__fadeIn animate__delay-1s">
                                                    <label class="form-label">
                                                        <i class="fas fa-hourglass-start mr-1 text-success"></i>
                                                        Giá 1 phút đầu
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" id="gia_1_phut_dau" name="gia_1_phut_dau" class="form-control" min="0" step="100">
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
                                                <input type="number" id="gia_1_phut_tiep_theo" name="gia_1_phut_tiep_theo" class="form-control" min="0" step="100">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-light">VNĐ/phút</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="price-preview mt-4 animate__animated animate__fadeIn animate__delay-3s">
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
                                    <button type="button" class="btn btn-outline-primary btn-block" id="btn-next-step">
                                        Tiếp theo <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                </div>
                                
                                <div class="form-actions mt-4 pt-3 border-top">
                                    <button type="button" class="btn btn-link text-muted btn-sm" data-dismiss="modal">
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



<!-- Loading Overlay -->
<div class="loading-overlay" style="display: none;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

@push('scripts')
<script src="{{ asset('admins/goivoip/action.js') }}"></script>
<script>
    var urlDashboard = "{{ route('goivoip.dashboard') }}";
</script>
<script>
    var urlDashboard1 = "{{ route('goivoip.dashboard1') }}";
</script>
@endpush

@endsection