@extends('layouts.admin')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Gói Cước'])

<!-- Nhúng file incomplete.blade.php -->
@include('admin.goicuocs.incomplete', ['incompleteGoiCuocs' => $incompleteGoiCuocs])

<div class="d-flex justify-content-between flex-wrap">
    <div class="chart-container" style="flex: 1; max-width: 80%; height: 50vh;">
    <canvas id="goicuocChart"></canvas>
</div>

<div class="chart-container">
    <div class="chart-wrapper">
        <canvas id="statusChart"></canvas>
    </div>
</div>

</div>


<div class="container mx-auto mt-4">
    <!-- Nút thêm, import và export gói cước -->
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary btn-shadow" data-bs-toggle="modal" data-bs-target="#addGoiCuocModal">
            <i class="fas fa-plus"></i> Thêm Gói Cước
        </button>
        <div>
            <button class="btn btn-success btn-shadow" onclick="document.getElementById('importFileInput').click();">
                <i class="fas fa-file-import"></i> Thêm excel
            </button>
            <button class="btn btn-secondary btn-shadow" onclick="exportGoiCuocs();">
                <i class="fas fa-file-export"></i> Xuất excel
            </button>
            <input type="file" id="importFileInput" style="display: none;" onchange="importGoiCuocs(event)">
        </div>
    </div>

    <!-- Bảng DataTables -->
    <div class="table-responsive shadow-lg">
        <table id="goicuocsTable" class="table table-bordered table-hover align-middle">
            <thead class="table-white text-white text-center">
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
        import: '{{ route('goicuocs.import') }}',
        export: '{{ route('goicuocs.export') }}',
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

    function importGoiCuocs(event) {
        const file = event.target.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('file', file);
            formData.append('_token', csrfToken);

            fetch(routes.import, {
                method: 'POST',
                body: formData
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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Thất bại!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi hệ thống!',
                    text: 'Không thể import gói cước. Vui lòng thử lại sau.',
                    confirmButtonText: 'OK'
                });
            });
        }
    }

    function exportGoiCuocs() {
        window.location.href = routes.export;
    }

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

    document.addEventListener("DOMContentLoaded", async function () {
    try {
        const response = await fetch('/admin/api/goicuocs-stats');
        const data = await response.json();

        const ctx = document.getElementById('goicuocChart');
        if (!ctx) {
            console.error("Canvas không tồn tại!");
            return;
        }

        // Tạo gradient màu sắc
        const ctxCanvas = ctx.getContext('2d');
        const gradient = ctxCanvas.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(54, 162, 235, 0.8)');
        gradient.addColorStop(1, 'rgba(54, 162, 235, 0.2)');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Số lượng gói cước',
                    data: data.counts,
                    backgroundColor: gradient,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 10, // Bo góc thanh bar
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Thống kê số lượng gói cước', // 🎯 Tiêu đề biểu đồ
                        font: {
                            size: 20, // Kích thước chữ
                            weight: 'bold',
                        },
                        padding: {
                            top: 10,
                            bottom: 20
                        },
                        color: '#333' // Màu chữ
                    },
                    legend: {
                        display: false, // Ẩn legend để giao diện gọn hơn
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let value = context.raw || 0;
                                return `Số lượng: ${value}`;
                            }
                        },
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 12 },
                        padding: 10,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    x: {
                        grid: { display: false }, // Ẩn grid dọc
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)' // Màu grid nhẹ hơn
                        }
                    }
                },
                animation: {
                    duration: 1500, // Tăng thời gian animation
                    easing: 'easeOutBounce', // Hiệu ứng nhảy nhẹ khi load
                }
            }
        });

    } catch (error) {
        console.error("Lỗi khi gọi API:", error);
    }
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
        const activeCount = data.filter(item => item.status === 'active').length;
        const inactiveCount = data.filter(item => item.status === 'inactive').length;
        const total = activeCount + inactiveCount;

        // Tạo gradient màu sắc cho biểu đồ
        const greenGradient = statusCtx.createLinearGradient(0, 0, 0, 300);
        greenGradient.addColorStop(0, '#2ecc71');
        greenGradient.addColorStop(1, '#27ae60');

        const redGradient = statusCtx.createLinearGradient(0, 0, 0, 300);
        redGradient.addColorStop(0, '#e74c3c');
        redGradient.addColorStop(1, '#c0392b');

        // Cấu hình dữ liệu biểu đồ tròn
        const statusChartData = {
            labels: ['Kích hoạt', 'Tạm dừng'],
            datasets: [{
                data: [activeCount, inactiveCount],
                backgroundColor: [greenGradient, redGradient], // Gradient màu sắc
                borderColor: ['#27ae60', '#c0392b'],
                borderWidth: 2,
                hoverOffset: 8 // Hiệu ứng hover
            }]
        };

        // Hiển thị biểu đồ tròn (Pie Chart)
        new Chart(statusCtx, {
            type: 'doughnut', // Thay 'pie' thành 'doughnut' để có vòng tròn đẹp hơn
            data: statusChartData,
            options: {
                responsive: true,
                cutout: '50%', // Độ rỗng của biểu đồ Doughnut
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            },
                            color: '#333'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Tỷ lệ trạng thái Gói cước',
                        font: { size: 18, weight: 'bold' },
                        color: '#2c3e50'
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: {
                            label: function (tooltipItem) {
                                const value = tooltipItem.raw;
                                const percentage = ((value / total) * 100).toFixed(2);
                                return `${tooltipItem.label}: ${value} (${percentage}%)`;
                            }
                        }
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
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1); /* Hiệu ứng nổi */
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.chart-container h2 {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 20px;
}


.chart-container:hover {
    transform: scale(1.0);
}

canvas {
    max-width: 100%;
    max-height: 400px;
}


.chart-wrapper {
    max-width: 400px;
    margin: 40px auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 12px;
 
    display: flex;
    justify-content: center;
    align-items: center;
}



</style>