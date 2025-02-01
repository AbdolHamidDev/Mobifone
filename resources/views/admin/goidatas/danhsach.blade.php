@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Gói data'])

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

<!-- Modal Thêm Gói data -->
<div class="modal fade" id="addGoidataModal" tabindex="-1" aria-labelledby="addGoidataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="goidataForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGoidataModalLabel">Thêm Gói data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_data" class="form-label">Tên Gói data</label>
                        <input type="text" name="ten_data" id="ten_data" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="gia" class="form-label">Giá (VND)</label>
                        <input type="number" name="gia" id="gia" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="loai_data" class="form-label">Loại Gói data</label>
                        <select name="loai_data" id="loai_data" class="form-select" required>
                            <option value="mien_phi_mxh">Miễn phí MXH</option>
                            <option value="dai_ky">Dài kỳ</option>
                            <option value="data_bo_sung">Data bổ sung</option>
                            <option value="thang">Tháng</option>
                            <option value="data_thuong">Data thường</option>
                            <option value="ngay">Ngày</option>
                            <option value="data_fastconnect">Data Fastconnect</option>                
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="thoi_gian" class="form-label">Thời Gian (ngày)</label>
                        <input type="number" name="thoi_gian" id="thoi_gian" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="dung_luong" class="form-label">Dung Lượng</label>
                        <input type="number" name="dung_luong" id="dung_luong" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="don_vi_dung_luong" class="form-label">Đơn Vị Dung Lượng</label>
                        <select name="don_vi_dung_luong" id="don_vi_dung_luong" class="form-select" required>
                            <option value="MB">MB</option>
                            <option value="GB">GB</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
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

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: "{{ session('success') }}",
            confirmButtonText: 'OK'
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Thất bại',
            text: "{{ session('error') }}",
            confirmButtonText: 'OK'
        });
    @endif

   

    // Xác nhận xóa
function confirmDelete(GoidataId) {
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Hành động này không thể hoàn tác!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/Goidatas/${GoidataId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                        // Cập nhật bảng dữ liệu
                        $('#goidatasTable').DataTable().ajax.reload();
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi hệ thống!',
                        text: 'Không thể xóa Gói data. Vui lòng thử lại sau.',
                        confirmButtonText: 'OK'
                    });
                });
        }
    });
}
</script>
