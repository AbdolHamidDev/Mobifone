@extends('layouts.admin')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Gói Cước'])


<div class="chart-container">
    <canvas id="goicuocChart"></canvas>
</div>


<div class="container mx-auto mt-4">
    <!-- Nút thêm gói cước -->
    <button class="btn btn-primary btn-shadow" data-bs-toggle="modal" data-bs-target="#addGoiCuocModal">
        <i class="fas fa-plus"></i> Thêm Gói Cước
    </button>
    

    <!-- Bảng DataTables -->
    <div class="table-responsive shadow-lg">
        <table id="goicuocsTable" class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-white text-center">
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
            <form id="goicuocForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGoiCuocModalLabel">Thêm Gói Cước</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ten_goicuoc" class="form-label">Tên Gói Cước</label>
                            <input type="text" name="ten_goicuoc" id="ten_goicuoc" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="gia" class="form-label">Giá (VND)</label>
                            <input type="number" name="gia" id="gia" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="loai_goicuoc" class="form-label">Loại Gói Cước</label>
                        <select name="loai_goicuoc" id="loai_goicuoc" class="form-select" required>
                            <option value="thoai_quoc_te">Thỏa Thuận Quốc Tế</option>
                            <option value="chuyen_vung_quoc_te">Chuyển Vùng Quốc Tế</option>
                            <option value="tich_diem">Tích Điểm</option>
                            <option value="mobisafe">MOBISAFE</option>
                            <option value="quoc_te_linh_hoat">Quốc tế linh hoạt</option>
                            <option value="combo_trong_nuoc">Combo trong nước</option>
                            <option value="mobif">MOBIF</option>
                            <option value="sieu_data">Siêu data</option>
                            <option value="chi_dep">Chị đẹp</option>
                            <option value="combo">Combo</option>
                            <option value="gia_dinh">Gia đình</option>
                            <option value="hot">Hot</option>
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
                            <option value="phut_goi_quoc_te">phút gọi quốc tế</option>
                            <option value="phut_thoai_quoc_te_huong_han_quoc">phút thoại quốc tế hướng Hàn Quốc</option>
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
        api: '{{ route('goicuocs.api') }}',
        store: '{{ route('goicuocs.store') }}',
        changeStatus: (id) => `/admin/goicuocs/${id}/change-status`,
    };
    const csrfToken = '{{ csrf_token() }}';
</script>

<script src="{{ asset('admins/goicuoc/goicuoc.js') }}"></script>

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
function confirmDelete(goicuocId) {
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
            fetch(`/admin/goicuocs/${goicuocId}`, {
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
                        $('#goicuocsTable').DataTable().ajax.reload();
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi hệ thống!',
                        text: 'Không thể xóa gói cước. Vui lòng thử lại sau.',
                        confirmButtonText: 'OK'
                    });
                });
        }
    });
}


document.addEventListener("DOMContentLoaded", function () {
    fetch('/admin/api/goicuocs-stats')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('goicuocChart');
            if (!ctx) {
                console.error("Canvas không tồn tại!");
                return;
            }

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Số lượng gói cước',
                        data: data.counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)'
                    }]
                }
            });
        })
        .catch(error => console.error("Lỗi khi gọi API:", error));
});


</script>
<style>
    .chart-container {
    max-width: 900px; /* Giới hạn chiều rộng */
    margin: auto; /* Căn giữa */
    padding: 20px;
    background: #fff; /* Tạo nền trắng */
    border-radius: 10px; /* Bo góc */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Tạo hiệu ứng nổi */
}
</style>