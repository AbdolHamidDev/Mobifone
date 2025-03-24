@extends('layouts.admin')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Gói Data'])

<div class="d-flex justify-content-between flex-wrap">
    <!-- Biểu đồ tròn (Thống kê loại gói data) -->
    <div class="chart-container" style="flex: 1; max-width: 48%; height: 50vh;">
        <canvas id="goidataChart"></canvas>
    </div>

    <!-- Biểu đồ cột (Thống kê trạng thái active/inactive) -->
    <div class="chart-container" style="flex: 1; max-width: 48%; height: 50vh;">
        <canvas id="statusChart"></canvas>
    </div>
</div>



<div class="container mx-auto mt-4">
    <!-- Nút thêm Gói data -->
    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addGoidataModal">
        <i class="fas fa-plus"></i> Thêm Gói data
    </button>

    <!-- Bảng DataTables -->
    <div class="table-responsive shadow-lg">
        <table id="goidatasTable" class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Tên Gói data</th>
                    <th>Giá</th>
                    <th>Thời gian</th>
                    <th>Dung lượng</th>
                    <th>Loại gói</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <!-- DataTables tự động điền -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Thêm Gói data - Phiên bản nâng cấp UX/UI -->
<div class="modal fade" id="addGoidataModal" tabindex="-1" aria-labelledby="addGoidataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="goidataForm" class="needs-validation" novalidate>
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fs-5" id="addGoidataModalLabel">
                        <i class="bi bi-database-add me-2"></i>Thêm Gói Data Mới
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_data" class="form-label fw-semibold">Tên Gói data <span class="text-danger">*</span></label>
                        <input type="text" name="ten_data" id="ten_data" class="form-control form-control-lg" placeholder="Nhập tên gói data" required>
                        <div class="invalid-feedback">Vui lòng nhập tên gói data</div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="gia" class="form-label fw-semibold">Giá (VND) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="gia" id="gia" class="form-control" placeholder="0" required>
                                    <span class="input-group-text">₫</span>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập giá gói data</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="loai_data" class="form-label fw-semibold">Loại Gói data <span class="text-danger">*</span></label>
                                <select name="loai_data" id="loai_data" class="form-select" required>
                                    <option value="" selected disabled>-- Chọn loại gói --</option>
                                    <option value="mien_phi_mxh">Miễn phí MXH</option>
                                    <option value="dai_ky">Dài kỳ</option>
                                    <option value="data_bo_sung">Data bổ sung</option>
                                    <option value="thang">Tháng</option>
                                    <option value="data_thuong">Data thường</option>
                                    <option value="ngay">Ngày</option>
                                    <option value="data_fastconnect">Data Fastconnect</option>                
                                </select>
                                <div class="invalid-feedback">Vui lòng chọn loại gói data</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="thoi_gian" class="form-label fw-semibold">Thời Gian <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="thoi_gian" id="thoi_gian" class="form-control" placeholder="30" required>
                                    <span class="input-group-text">ngày</span>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập thời gian</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dung_luong" class="form-label fw-semibold">Dung Lượng <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="dung_luong" id="dung_luong" class="form-control" placeholder="1" required>
                                    <select name="don_vi_dung_luong" id="don_vi_dung_luong" class="form-select" style="max-width: 100px">
                                        <option value="MB">MB</option>
                                        <option value="GB" selected>GB</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">Vui lòng nhập dung lượng</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Đóng
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Lưu Gói Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

<script>
    const routes = {
        api: '{{ route('Goidatas.api') }}',
        store: '{{ route('Goidatas.store') }}',
        changeStatus: (id) => `/admin/goidatas/${id}/change-status`,
    };
    const csrfToken = '{{ csrf_token() }}';
</script>

<script src="{{ asset('admins/goidata/goidata.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<style>
    .chart-container {
        max-width: 900px; /* Giới hạn chiều rộng */
        margin: auto; /* Căn giữa */
        padding: 20px;
        background: #fff; /* Tạo nền trắng */
        border-radius: 10px; /* Bo góc */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Tạo hiệu ứng nổi */
    }
       #goidatasTable {
        width: 100% !important;
    }
    #goidatasTable th {
        background-color: #f8f9fa;
        font-weight: 600;
        white-space: nowrap;
    }
    #goidatasTable td {
        vertical-align: middle;
    }
    .btn-action-group {
        gap: 0.5rem;
    }
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    .btn-view {
        color: #17a2b8;
        border-color: #17a2b8;
    }
    .btn-view:hover {
        background-color: rgba(23, 162, 184, 0.1);
    }
    .btn-edit {
        color: #007bff;
        border-color: #007bff;
    }
    .btn-edit:hover {
        background-color: rgba(0, 123, 255, 0.1);
    }
    .btn-delete {
        color: #dc3545;
        border-color: #dc3545;
    }
    .btn-delete:hover {
        background-color: rgba(220, 53, 69, 0.1);
    }
    .btn-status {
        color: white !important;
        min-width: 100px;
    }
    .data-capacity-badge {
        background-color: #e9ecef;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-family: monospace;
    }
    .bg-purple {
        background-color: #6f42c1 !important;
    }
    .animate__animated {
        --animate-duration: 0.5s;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.5rem;
        margin: 0 2px;
        border-radius: 0.25rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #0d6efd !important;
        color: white !important;
        border: none;
    }
`;
</style>