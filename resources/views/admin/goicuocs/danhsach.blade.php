@extends('layouts.admin')


@section('content')
<x-layout.content-header title="Danh sách Gói cước" />

<div class="container-fluid mt-4 px-4">

    <!-- Nút thêm, import và export -->
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addGoiCuocModal">
            <i class="fas fa-plus"></i> Thêm Gói Cước
        </button>
        <button class="btn btn-success me-2" onclick="document.getElementById('importFileInput').click();">
            <i class="fas fa-file-import"></i> Thêm Excel
        </button>
        <button class="btn btn-secondary" onclick="exportGoiCuocs();">
            <i class="fas fa-file-export"></i> Xuất Excel
        </button>
        <input type="file" id="importFileInput" style="display: none;" onchange="importGoiCuocs(event)">
    </div>

    <!-- Bảng danh sách gói cước -->
    <div class="table-responsive">
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
<div class="modal fade" id="addGoiCuocModal" tabindex="-1" aria-labelledby="addGoiCuocModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="goicuocForm" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="addGoiCuocModalLabel">Thêm Gói Cước Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ten_goicuoc" class="form-label">Tên Gói Cước</label>
                        <input type="text" class="form-control" id="ten_goicuoc" name="ten_goicuoc" required>
                    </div>

                    <div class="mb-3">
                        <label for="gia" class="form-label">Giá (VNĐ)</label>
                        <input type="number" class="form-control" id="gia" name="gia" required>
                    </div>

                    <div class="mb-3">
                        <label for="thoi_gian" class="form-label">Thời gian sử dụng (ngày)</label>
                        <input type="number" class="form-control" id="thoi_gian" name="thoi_gian" required>
                    </div>

                    <div class="mb-3">
                        <label for="dung_luong" class="form-label">Dung lượng</label>
                        <input type="number" class="form-control" id="dung_luong" name="dung_luong" required>
                    </div>

                    <div class="mb-3">
                        <label for="don_vi_dung_luong" class="form-label">Đơn vị dung lượng</label>
                        <select class="form-select" id="don_vi_dung_luong" name="don_vi_dung_luong" required>
                            <option value="">-- Chọn đơn vị --</option>
                            <option value="MB">MB</option>
                            <option value="GB">GB</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="loai_goicuoc" class="form-label">Loại Gói Cước</label>
                        <select class="form-select" id="loai_goicuoc" name="loai_goicuoc" required>
                            <option value="">-- Chọn loại --</option>
                            <option value="data">Data</option>
                            <option value="thoai">Thoại</option>
                            <option value="sms">SMS</option>
                            <option value="combo">Combo</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1">Kích hoạt</option>
                            <option value="0">Không kích hoạt</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu Gói Cước</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


<script>
   const routes = {
    api: '{{ route('goicuocs.api') }}',             // Route lấy danh sách gói cước (dùng cho DataTables)
    store: '{{ route('goicuocs.store') }}',         // Route thêm mới gói cước (POST)
    import: '{{ route('goicuocs.import') }}',       // Route import file Excel
    export: '{{ route('goicuocs.export') }}',       // Route export file Excel
    changeStatus: (id) => `/admin/goicuocs/${id}/change-status`, // Route đổi trạng thái gói cước
};

    const csrfToken = '{{ csrf_token() }}';
</script>

<script src="{{ asset('admins/goicuoc/goicuoc.js') }}"></script>

