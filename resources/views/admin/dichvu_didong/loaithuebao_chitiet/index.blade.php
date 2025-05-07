@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Danh sách: {{ $subscriptionType->name }}" />

<div class="container-fluid mt-3">
    <!-- Header Card -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h5 class="mb-0">Chi tiết: {{ $subscriptionType->name }}</h5>
            <div>
                <a href="{{ route('subscription-types.index') }}" class="btn btn-light btn-sm me-2">
                    Quay lại
                </a>
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                    Thêm mới
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table" id="subscription-details-table">
                    <thead>
                        <tr>
                            <th width="30%">Lợi ích</th>
                            <th width="20%">Giá cước</th>
                            <th width="30%">Hướng dẫn</th>
                            <th width="20%" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subscriptionType->loaithuebao as $detail)
                            <tr data-id="{{ $detail->id }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="text-primary me-2">•</div>
                                        <div>{!! nl2br(e($detail->benefits)) !!}</div>
                                    </div>
                                </td>
                                <td>
                                    {!! nl2br(e($detail->pricing)) !!}
                                </td>
                                <td>
                                    {!! nl2br(e($detail->instructions)) !!}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-sm btn-outline-warning edit-btn" 
                                                data-id="{{ $detail->id }}" 
                                                data-subscription-id="{{ $subscriptionType->id }}">
                                            Sửa
                                        </button>
                                        <form action="{{ route('loaithuebao.destroy', [$subscriptionType->id, $detail->id]) }}" 
                                              method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn">
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div>
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
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Thêm chi tiết mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('loaithuebao.store', $subscriptionType->id) }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="benefits" class="form-label">Lợi ích <span class="text-danger">*</span></label>
                            <textarea name="benefits" id="benefits" class="form-control" rows="3" required
                                      placeholder="Ví dụ:
- Miễn phí data 4GB/ngày
- Gọi nội mạng miễn phí"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pricing" class="form-label">Giá cước <span class="text-danger">*</span></label>
                            <textarea name="pricing" id="pricing" class="form-control" rows="3" required
                                      placeholder="Ví dụ:
- 50.000đ/tháng
- 120.000đ/3 tháng"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="instructions" class="form-label">Hướng dẫn <span class="text-danger">*</span></label>
                            <textarea name="instructions" id="instructions" class="form-control" rows="3" required
                                      placeholder="Ví dụ:
1. Soạn DK gửi 999
2. Nhận mã kích hoạt"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu chi tiết</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Chỉnh sửa chi tiết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(function() {
    // Khởi tạo DataTable đơn giản
    $('#subscription-details-table').DataTable({
        language: {
            url: '/vendor/datatables/vi.json'
        },
        columnDefs: [
            { orderable: false, targets: [3] }
        ]
    });

    // Xử lý edit modal
    $(document).on('click', '.edit-btn', function() {
        const detailId = $(this).data('id');
        const subscriptionTypeId = $(this).data('subscription-id');
        
        // Hiển thị loading đơn giản
        const $row = $(this).closest('tr');
        $row.addClass('table-warning');
        
        axios.get(`/admin/subscription-types/${subscriptionTypeId}/loaithuebao/${detailId}/edit`)
            .then(response => {
                $row.removeClass('table-warning');
                const data = response.data;
                
                $('#editBenefits').val(data.benefits);
                $('#editPricing').val(data.pricing);
                $('#editInstructions').val(data.instructions);
                
                $('#editForm').attr('action', `/admin/subscription-types/${subscriptionTypeId}/loaithuebao/${detailId}`);
                $('#editModal').modal('show');
            })
            .catch(error => {
                $row.removeClass('table-warning');
                alert('Không thể tải dữ liệu để chỉnh sửa');
                console.error(error);
            });
    });

    // Xử lý xóa với confirmation
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        
        if (confirm('Bạn có chắc chắn muốn xóa?')) {
            form.submit();
        }
    });
});
</script>
@endsection