@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Loại thuê bao', 'key' => 'Chi tiết'])

<div class="container-fluid mt-4">
    <!-- Header Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-sim-card me-2"></i>Chi tiết: {{ $subscriptionType->name }}
            </h4>
            <div>
                <a href="{{ route('subscription-types.index') }}" class="btn btn-light btn-sm me-2">
                    <i class="fas fa-arrow-left me-1"></i> Quay lại
                </a>
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus-circle me-1"></i> Thêm mới
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="subscription-details-table">
                    <thead class="table-light">
                        <tr>
                            <th width="30%" class="ps-4">Lợi ích</th>
                            <th width="20%">Giá cước</th>
                            <th width="30%">Hướng dẫn</th>
                            <th width="20%" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subscriptionType->loaithuebao as $detail)
                            <tr data-aos="fade-in" data-id="{{ $detail->id }}">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-primary-light me-3">
                                            <i class="fas fa-check-circle text-primary"></i>
                                        </div>
                                        <div class="benefits-text">{!! nl2br(e($detail->benefits)) !!}</div>
                                    </div>
                                </td>
                                <td class="text-nowrap">
                                    <span class="badge bg-success-light text-success">
                                        {!! nl2br(e($detail->pricing)) !!}
                                    </span>
                                </td>
                                <td>
                                    <div class="instructions-text">{!! nl2br(e($detail->instructions)) !!}</div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-sm btn-outline-warning edit-btn" 
                                                data-id="{{ $detail->id }}" 
                                                data-subscription-id="{{ $subscriptionType->id }}">
                                            <i class="fas fa-edit me-1"></i>
                                        </button>
                                        <form action="{{ route('loaithuebao.destroy', [$subscriptionType->id, $detail->id]) }}" 
                                              method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn">
                                                <i class="fas fa-trash-alt me-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                        <h5 class="text-muted">Chưa có dữ liệu chi tiết</h5>
                                        <p class="text-muted">Hãy thêm chi tiết mới để bắt đầu</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-success text-white">
                <h5 class="modal-title" id="addModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Thêm chi tiết mới
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('loaithuebao.store', $subscriptionType->id) }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="benefits" class="form-label">Lợi ích <span class="text-danger">*</span></label>
                            <textarea name="benefits" id="benefits" class="form-control" rows="3" required></textarea>
                            <small class="text-muted">Mỗi lợi ích nên được phân cách bằng xuống dòng</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pricing" class="form-label">Giá cước <span class="text-danger">*</span></label>
                            <textarea name="pricing" id="pricing" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="instructions" class="form-label">Hướng dẫn <span class="text-danger">*</span></label>
                            <textarea name="instructions" id="instructions" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Lưu chi tiết
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-warning text-white">
                <h5 class="modal-title" id="editModalLabel">
                    <i class="fas fa-edit me-2"></i>Chỉnh sửa chi tiết
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="editBenefits" class="form-label">Lợi ích <span class="text-danger">*</span></label>
                            <textarea name="benefits" id="editBenefits" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editPricing" class="form-label">Giá cước <span class="text-danger">*</span></label>
                            <textarea name="pricing" id="editPricing" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editInstructions" class="form-label">Hướng dẫn <span class="text-danger">*</span></label>
                            <textarea name="instructions" id="editInstructions" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="fas fa-sync-alt me-2"></i>Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('css')
<style>
    .icon-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.1);
    }
    .bg-success-light {
        background-color: rgba(25, 135, 84, 0.1);
    }
    .benefits-text, .instructions-text {
        white-space: pre-wrap;
        word-break: break-word;
    }
    .empty-state {
        padding: 2rem;
        text-align: center;
    }
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
    }
    .bg-gradient-success {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
    }
    .bg-gradient-warning {
        background: linear-gradient(135deg, #f46b45 0%, #eea849 100%);
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Khởi tạo animation
        AOS.init({
            duration: 600,
            once: true
        });

        // Khởi tạo DataTable với ngôn ngữ Tiếng Việt
        $('#subscription-details-table').DataTable({
            language: {
                url: '/vendor/datatables/vi.json' // Đường dẫn đến file ngôn ngữ cục bộ
            },
            columnDefs: [
                { orderable: false, targets: [3] } // Cột hành động không sắp xếp
            ],
            responsive: true,
            dom: '<"top"lf>rt<"bottom"ip>',
            initComplete: function() {
                $('.dataTables_filter input').attr('placeholder', 'Tìm kiếm...');
            }
        });

        // Xử lý edit modal
        $(document).on('click', '.edit-btn', function() {
            const detailId = $(this).data('id');
            const subscriptionTypeId = $(this).data('subscription-id');
            
            // Hiển thị loading
            Swal.fire({
                title: 'Đang tải dữ liệu...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            // Lấy dữ liệu từ API
            axios.get(`/admin/subscription-types/${subscriptionTypeId}/loaithuebao/${detailId}/edit`)
                .then(response => {
                    Swal.close();
                    const data = response.data;
                    
                    // Điền dữ liệu vào form
                    $('#editBenefits').val(data.benefits);
                    $('#editPricing').val(data.pricing);
                    $('#editInstructions').val(data.instructions);
                    
                    // Cập nhật action form
                    $('#editForm').attr('action', `/admin/subscription-types/${subscriptionTypeId}/loaithuebao/${detailId}`);
                    
                    // Hiển thị modal
                    $('#editModal').modal('show');
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Không thể tải dữ liệu để chỉnh sửa',
                        confirmButtonText: 'Đóng'
                    });
                    console.error(error);
                });
        });

        // Xử lý xóa với confirmation
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Bạn sẽ không thể hoàn tác hành động này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Đang xóa...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                    
                    form.submit();
                }
            });
        });

        // Thêm placeholder cho textarea
        $('#benefits, #editBenefits').attr('placeholder', 'Ví dụ:\n- Miễn phí data 4GB/ngày\n- Gọi nội mạng miễn phí\n- Ưu đãi xem phim');
        $('#pricing, #editPricing').attr('placeholder', 'Ví dụ:\n- 50.000đ/tháng\n- 120.000đ/3 tháng\n- Miễn phí đăng ký');
        $('#instructions, #editInstructions').attr('placeholder', 'Ví dụ:\n1. Soạn DK gửi 999\n2. Nhận mã kích hoạt\n3. Nhập mã để kích hoạt');
    });
</script>

@endsection