<!-- filepath: c:\xampp\htdocs\mobifone\resources\views\admin\goidatas\danhsach.blade.php -->
@extends('layouts.admin')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="{{ asset('admins/goidata/goidata.css') }}">

@section('content')
<x-layout.content-header name="Danh sách" key="Gói data" />

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
    <!-- Nút thêm, nhập và xuất Gói data -->
    <div class="d-flex justify-content-start mb-4">
        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addGoidataModal">
            <i class="fas fa-plus"></i> Thêm Gói data
        </button>
        <button class="btn btn-success me-2" onclick="document.getElementById('importFileInput').click();">
            <i class="fas fa-file-import"></i> Nhập Excel
        </button>
        <button class="btn btn-secondary" onclick="exportGoidatas();">
            <i class="fas fa-file-export"></i> Xuất Excel
        </button>
        <input type="file" id="importFileInput" style="display: none;" onchange="importGoidatas(event)">
    </div>

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

<!-- Modal Thêm Gói data -->
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
        import: '{{ route('Goidatas.import') }}',
        export: '{{ route('Goidatas.export') }}',
        changeStatus: (id) => `/admin/goidatas/${id}/change-status`,
    };
    const csrfToken = '{{ csrf_token() }}';

    // Hàm nhập Excel
    function importGoidatas(event) {
        const fileInput = event.target;
        const formData = new FormData();
        formData.append('file', fileInput.files[0]);
        formData.append('_token', csrfToken);

        fetch(routes.import, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: data.message,
                    confirmButtonText: 'OK',
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại!',
                    text: data.message || 'Đã xảy ra lỗi.',
                    confirmButtonText: 'OK',
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi hệ thống!',
                text: 'Không thể hoàn thành yêu cầu. Vui lòng thử lại sau.',
                confirmButtonText: 'OK',
            });
        });
    }

    // Hàm xuất Excel
    function exportGoidatas() {
        window.location.href = routes.export;
    }
</script>

<script src="{{ asset('admins/goidata/goidata.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>