
@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Số thuê bao'])

<div class="container mx-auto mt-4">
<!-- Biểu đồ trạng thái với UI hiện đại -->
<div class="card shadow-lg rounded-5 p-4 border-0 overflow-hidden" 
     style="background: linear-gradient(135deg, #ffffff, #f8f9fa); 
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12); 
            border-radius: 20px;">
    
    <div class="card-header text-center fw-bold text-dark" 
         style="font-size: 22px; padding: 15px; border-radius: 20px 20px 0 0;">
        📊 Thống kê trạng thái số thuê bao
    </div>

    <div class="card-body d-flex justify-content-center p-4">
        <!-- Tăng kích thước biểu đồ -->
        <canvas id="statusChart" style="max-width: 100%; height: 320px;"></canvas>
    </div>
</div>





<script>
    function importSoThueBao(event) {
        const file = event.target.files[0];
        if (file) {
            // Gửi file lên server bằng form ẩn hoặc AJAX (tùy chỉnh thêm nếu cần)
            alert(`Bạn đã chọn file: ${file.name}`);
        }
    }
</script>


<div class="table-responsive shadow-lg rounded-3 overflow-hidden p-3 bg-white">
    <table id="dataTable" class="table table-hover align-middle mb-0">
        <thead class="table-light text-center" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
            <tr class="fw-bold text-dark">


                <div class="d-flex justify-content-center align-items-center gap-2">
                    <!-- Nút Thêm Số Thuê Bao -->
                    <button class="btn text-white shadow-sm px-4 py-2 rounded-pill"
                            style="background: linear-gradient(135deg, #007bff, #0056b3); border: none;"
                            data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus me-1"></i> Thêm Số Thuê Bao
                    </button>
            
                    <!-- Nút Nhập Excel -->
                    <button class="btn text-white shadow-sm px-4 py-2 rounded-pill"
                            style="background: linear-gradient(135deg, #28a745, #218838); border: none;"
                            onclick="document.getElementById('importFileInput').click();"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Nhập danh sách từ file Excel">
                        <i class="fas fa-file-import me-1"></i> Nhập Excel
                    </button>
                    <input type="file" id="importFileInput" style="display: none;" onchange="importSoThueBao(event)">
            
                    <!-- Nút Xuất Excel -->
                    <a href="{{ route('so-thue-bao.export') }}"
                       class="btn text-white shadow-sm px-4 py-2 rounded-pill"
                       style="background: linear-gradient(135deg, #6c757d, #495057); border: none;"
                       data-bs-toggle="tooltip" data-bs-placement="top" title="Xuất danh sách ra file Excel">
                        <i class="fas fa-file-export me-1"></i> Xuất Excel
                    </a>
                </div>

                    <th>Số thuê bao</th>
                    <th>Loại thuê bao</th>
                    <th>Khu vực hòa mạng</th>
                    <th>Loại số</th>
                    <th>Phí giữ số</th>
                    <th>Phí hòa mạng</th>
                    <th>Trạng Thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($soThueBaos as $so)
                <tr id="row-{{ $so->id }}">
                    <td>{{ $so->so_thue_bao }}</td>
                    <td>{{ $so->loai_thue_bao == 'tra_truoc' ? 'Trả trước' : 'Trả sau' }}</td>
                    <td>{{ $so->khu_vuc }}</td>
                    <td>{{ $so->loai_so == 'so_vip' ? 'Số VIP' : 'Số Thường' }}</td>
                    <td>{{ $so->phi_giu_so > 0 ? number_format($so->phi_giu_so) . 'đ' : 'Miễn phí' }}</td>
                    <td>{{ number_format($so->phi_hoa_mang) }}đ</td>
                    <td class="text-center">
                        @if ($so->trang_thai === 'giu_so')
                            <span class="badge text-white py-2 px-3 rounded-pill shadow-sm badge-hover"
                                  style="background: linear-gradient(135deg, #28a745, #218838);"
                                  data-bs-toggle="tooltip" data-bs-placement="top" title="Số thuê bao đang được giữ lại, chưa sử dụng.">
                                <i class="fa fa-check-circle me-1"></i> Giữ số
                            </span>
                        @elseif ($so->trang_thai === 'chua_su_dung')
                            <span class="badge text-dark py-2 px-3 rounded-pill shadow-sm badge-hover"
                                  style="background: linear-gradient(135deg, #ffc107, #e0a800);"
                                  data-bs-toggle="tooltip" data-bs-placement="top" title="Số thuê bao chưa được sử dụng, đang chờ kích hoạt.">
                                <i class="fa fa-clock me-1"></i> Đang chờ sử dụng
                            </span>
                        @elseif ($so->trang_thai === 'hoa_mang')
                            <span class="badge text-white py-2 px-3 rounded-pill shadow-sm badge-hover"
                                  style="background: linear-gradient(135deg, #007bff, #0056b3);"
                                  data-bs-toggle="tooltip" data-bs-placement="top" title="Số thuê bao đã được kích hoạt thành công.">
                                <i class="fa fa-signal me-1"></i> Hòa mạng thành công
                            </span>
                        @else
                            <span class="badge text-white py-2 px-3 rounded-pill shadow-sm badge-hover"
                                  style="background: linear-gradient(135deg, #6c757d, #495057);"
                                  data-bs-toggle="tooltip" data-bs-placement="top" title="Trạng thái không xác định, vui lòng kiểm tra lại.">
                                <i class="fa fa-question-circle me-1"></i> Không xác định
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($so->trang_thai === 'chua_su_dung')
                            <!-- Nút Sửa -->
                            <button class="btn btn-sm text-white shadow-sm rounded-pill"
                                    style="background: linear-gradient(135deg, #5a6268, #495057); border: none;"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $so->id }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa thông tin số thuê bao">
                                <i class="fas fa-edit me-1"></i> Sửa
                            </button>
                    
                            <!-- Nút Xóa -->
                            <button class="btn btn-sm text-white shadow-sm rounded-pill"
                                    style="background: linear-gradient(135deg, #bd2130, #922b3e); border: none;"
                                    onclick="deleteSoThueBao({{ $so->id }})"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa số thuê bao này">
                                <i class="fas fa-trash-alt me-1"></i> Xóa
                            </button>
                        @else
                            <!-- Nút Không Khả Dụng -->
                            <button class="btn btn-sm text-white shadow-sm rounded-pill"
                                    style="background: linear-gradient(135deg, #adb5bd, #6c757d); border: none;" disabled
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Không thể sửa hoặc xóa số thuê bao này">
                                <i class="fas fa-ban me-1"></i> Không khả dụng
                            </button>
                        @endif
                    </td>
                </tr>


                 <!-- Modal Sửa -->
<div class="modal fade" id="editModal{{ $so->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg rounded-4 border-0">
            <form action="{{ route('so-thue-bao.update', $so->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-dark rounded-top-4">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-edit me-2"></i> Chỉnh sửa Số Thuê Bao
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="so_thue_bao" class="form-label fw-semibold">Số thuê bao</label>
                            <input type="text" class="form-control rounded-3" name="so_thue_bao" value="{{ $so->so_thue_bao }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="loai_thue_bao" class="form-label fw-semibold">Loại thuê bao</label>
                            <select class="form-select rounded-3" name="loai_thue_bao" required>
                                <option value="tra_truoc" {{ $so->loai_thue_bao == 'tra_truoc' ? 'selected' : '' }}>Trả trước</option>
                                <option value="tra_sau" {{ $so->loai_thue_bao == 'tra_sau' ? 'selected' : '' }}>Trả sau</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="loai_so" class="form-label fw-semibold">Loại số</label>
                            <select class="form-select rounded-3" name="loai_so" required>
                                <option value="so_thuong" {{ $so->loai_so == 'so_thuong' ? 'selected' : '' }}>Số Thường</option>
                                <option value="so_vip" {{ $so->loai_so == 'so_vip' ? 'selected' : '' }}>Số VIP</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="khu_vuc" class="form-label fw-semibold">Khu vực hòa mạng</label>
                            <input type="text" class="form-control rounded-3 bg-light" name="khu_vuc" value="{{ $so->khu_vuc }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="phi_giu_so" class="form-label fw-semibold">Phí giữ số</label>
                            <input type="number" class="form-control rounded-3" name="phi_giu_so" value="{{ $so->phi_giu_so }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phi_hoa_mang" class="form-label fw-semibold">Phí hòa mạng</label>
                            <input type="number" class="form-control rounded-3" name="phi_hoa_mang" value="{{ $so->phi_hoa_mang }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-warning px-4 rounded-pill text-white">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

                @endforeach
            </tbody>
                    
      








<!-- Modal Thêm -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg rounded-4 border-0">
            <form action="{{ route('so-thue-bao.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-plus-circle me-2"></i> Thêm Số Thuê Bao
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="so_thue_bao" class="form-label fw-semibold">Số thuê bao</label>
                            <input type="text" class="form-control rounded-3" name="so_thue_bao" required>
                        </div>
                        <div class="col-md-6">
                            <label for="loai_thue_bao" class="form-label fw-semibold">Loại thuê bao</label>
                            <select class="form-select rounded-3" name="loai_thue_bao" required>
                                <option value="tra_truoc">Trả trước</option>
                                <option value="tra_sau">Trả sau</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="loai_so" class="form-label fw-semibold">Loại số</label>
                            <select class="form-select rounded-3" name="loai_so" required>
                                <option value="so_thuong">Số Thường</option>
                                <option value="so_vip">Số VIP</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="khu_vuc" class="form-label fw-semibold">Khu vực hòa mạng</label>
                            <input type="text" class="form-control rounded-3 bg-light" name="khu_vuc" value="Toàn quốc" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="phi_giu_so" class="form-label fw-semibold">Phí giữ số</label>
                            <input type="number" class="form-control rounded-3" name="phi_giu_so" value="0" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phi_hoa_mang" class="form-label fw-semibold">Phí hòa mạng</label>
                            <input type="number" class="form-control rounded-3" name="phi_hoa_mang" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary px-4 rounded-pill">
                        <i class="fas fa-check-circle me-1"></i> Thêm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


<style>
    input[readonly] {
    background-color: #e9ecef; /* Màu nền nhạt */
    cursor: not-allowed; /* Con trỏ chuột thể hiện không thể chỉnh sửa */
}
.badge-hover:hover {
    transform: scale(1.1);
    transition: 0.3s ease-in-out;
    filter: brightness(1.2);
}

    </style>


@section('js')
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "lengthMenu": "Hiển thị _MENU_ mục",
                "zeroRecords": "Không tìm thấy kết quả",
                "info": "Hiển thị _PAGE_ trên _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(lọc từ _MAX_ mục)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "next": "Tiếp",
                    "previous": "Trước"
                }
            },
            "pageLength": 10, // Số mục hiển thị trên mỗi trang
            "ordering": true,
            "responsive": true
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

</script>

<!-- Import Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Import Chart.js Plugin DataLabels -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('statusChart').getContext('2d');
    
        // Gradient màu sắc chuyên nghiệp
        const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient1.addColorStop(0, "#28a745");
        gradient1.addColorStop(1, "#66bb6a");
    
        const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient2.addColorStop(0, "#ffc107");
        gradient2.addColorStop(1, "#ffca28");
    
        const gradient3 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient3.addColorStop(0, "#007bff");
        gradient3.addColorStop(1, "#42a5f5");
    
        const gradient4 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient4.addColorStop(0, "#6c757d");
        gradient4.addColorStop(1, "#b0bec5");
    
        // Dữ liệu biểu đồ
        const statusData = {
            labels: ['📌 Giữ số', '🛠️ Chưa sử dụng', '📶 Hòa mạng', '❓ Không xác định'],
            datasets: [{
                label: 'Số lượng thuê bao',
                data: [
                    {{ $soThueBaos->where('trang_thai', 'giu_so')->count() }},
                    {{ $soThueBaos->where('trang_thai', 'chua_su_dung')->count() }},
                    {{ $soThueBaos->where('trang_thai', 'hoa_mang')->count() }},
                    {{ $soThueBaos->where('trang_thai', 'khong_xac_dinh')->count() }}
                ],
                backgroundColor: [gradient1, gradient2, gradient3, gradient4],
                borderRadius: 10, // Bo góc cột
                borderSkipped: false, // Không cắt góc trên
            }]
        };
    
        // Cấu hình biểu đồ
        const config = {
            type: 'bar',
            data: statusData,
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                 
                    datalabels: {
                        anchor: 'end',
                        align: 'right',
                        color: '#black',
                        font: { size: 14, weight: 'bold' },
                        formatter: (value) => value.toLocaleString() + " thuê bao"
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { display: false },
                        ticks: { color: '#444', font: { size: 14, weight: 'bold' } }
                    },
                    y: {
                        grid: { display: false },
                        ticks: { color: '#444', font: { size: 14, weight: 'bold' } }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            },
            plugins: [ChartDataLabels]
        };
    
        // Khởi tạo biểu đồ
        new Chart(ctx, config);
    });
    </script>


<script>
    function importSoThueBao(event) {
        const file = event.target.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('file', file);

            fetch('{{ route('so-thue-bao.import') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Thành công!',
                        text: 'Nhập dữ liệu thành công.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: 'Đã xảy ra lỗi khi nhập dữ liệu: ' + data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Đã xảy ra lỗi khi nhập dữ liệu.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
    }
</script>

<script>
    function deleteSoThueBao(id) {
        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Hành động này không thể hoàn tác!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Xóa",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ route('so-thue-bao.destroy', '') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // 🔹 Xóa hàng khỏi bảng
                        let rowElement = document.getElementById(`row-${id}`);
                        if (rowElement) rowElement.remove();

                        // 🔹 Hiển thị thông báo thành công
                        Swal.fire("Đã xóa!", "Số thuê bao đã được xóa.", "success");
                    } else {
                        Swal.fire("Lỗi!", "Không thể xóa số thuê bao.", "error");
                    }
                })
                .catch(error => {
                    console.error("Lỗi:", error);
                    Swal.fire("Lỗi!", "Đã xảy ra lỗi khi xóa số thuê bao.", "error");
                });
            }
        });
    }
</script>
@endsection