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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('goidataChart').getContext('2d');

    fetch(routes.api, {
        headers: { 'X-CSRF-TOKEN': csrfToken }
    })
    .then(response => response.json())
    .then(result => {
        console.log('Dữ liệu trả về:', result); // Debug dữ liệu API

        const data = result.data;
        if (!Array.isArray(data)) throw new Error('Dữ liệu không hợp lệ');

        // Xử lý dữ liệu thành số lượng gói data theo từng loại
        const goidataCounts = data.reduce((acc, goidata) => {
            acc[goidata.loai_data] = (acc[goidata.loai_data] || 0) + 1;
            return acc;
        }, {});

        // Màu sắc chuyên nghiệp hơn
        const colors = [
            'rgba(75, 192, 192, 0.7)', 'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)',
            'rgba(153, 102, 255, 0.7)', 'rgba(255, 159, 64, 0.7)'
        ];

        // Chuẩn bị dữ liệu cho biểu đồ
        const chartData = {
            labels: Object.keys(goidataCounts),
            datasets: [{
                label: 'Số lượng Gói data',
                data: Object.values(goidataCounts),
                backgroundColor: colors,
                borderColor: colors.map(color => color.replace('0.7', '1')), // Tăng độ nét
                borderWidth: 2,
                hoverOffset: 10 // Hiệu ứng nổi bật khi hover
            }]
        };

        // Khởi tạo biểu đồ tròn với hiệu ứng animation
        new Chart(ctx, {
            type: 'pie',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: { size: 14 },
                            color: '#333'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Thống kê số lượng Gói data',
                        font: { size: 18 }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                let value = tooltipItem.raw;
                                let label = tooltipItem.label;
                                return `${label}: ${value} gói`;
                            }
                        }
                    }
                },
                animation: {
                    animateRotate: true,
                    animateScale: true
                }
            }
        });
    })
    .catch(error => {
        console.error('Lỗi khi tải dữ liệu:', error);
        ctx.font = "16px Arial";
        ctx.fillText("Không thể tải dữ liệu", 50, 50);
    });
});

</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const statusCtx = document.getElementById('statusChart').getContext('2d');

    fetch(routes.api, {
        headers: { 'X-CSRF-TOKEN': csrfToken }
    })
    .then(response => response.json())
    .then(result => {
        console.log('Dữ liệu trạng thái:', result);

        const data = result.data;
        if (!Array.isArray(data)) throw new Error('Dữ liệu không hợp lệ');

        // Đếm số lượng trạng thái active & inactive
        const statusCounts = {
            "Kích hoạt": data.filter(item => item.status === 'active').length,
            "Tạm dừng": data.filter(item => item.status === 'inactive').length
        };

        // Cấu hình dữ liệu biểu đồ cột
        const statusChartData = {
            labels: Object.keys(statusCounts),
            datasets: [{
                label: 'Số lượng Gói Data',
                data: Object.values(statusCounts),
                backgroundColor: ['#2ecc71', '#95a5a6'], // Xanh (Active) & Xám (Inactive)
                borderColor: ['#27ae60', '#7f8c8d'],
                borderWidth: 2
            }]
        };

        // Hiển thị biểu đồ cột (Bar Chart)
        new Chart(statusCtx, {
            type: 'bar',
            data: statusChartData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                },
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Thống kê trạng thái Gói Data',
                        font: { size: 18 }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Lỗi tải dữ liệu trạng thái:', error));
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