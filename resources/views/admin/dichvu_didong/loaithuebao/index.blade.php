@extends('layouts.admin')

@section('content')
<x-layout.content-header name="Danh sách" key="Loại thuê bao" />

<div class="container-fluid mt-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Quản lý Loại Thuê Bao</h5>
            <button class="btn btn-light shadow-sm" id="create-new" data-bs-toggle="modal" data-bs-target="#subscriptionModal">
                <i class="fas fa-plus-circle me-2"></i> Thêm Mới
            </button>
        </div>
        
        <div class="card-body">
            <!-- Bảng dữ liệu -->
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="subscription-table">
                    <thead class="table-light">
                        <tr>
                            <th width="10%">Hình Ảnh</th>
                            <th width="20%">Tên Loại Thuê Bao</th>
                            <th width="15%">Tiêu Đề</th>
                            <th width="15%">Loại Thuê Bao</th>
                            <th width="10%">Trạng Thái</th>
                            <th width="15%">Chi Tiết</th>
                            <th width="15%">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody id="subscription-table-body">
                        @foreach ($subscriptionTypes as $type)
                        <tr id="row-{{ $type->id }}" class="{{ $type->is_approved ? '' : 'table-warning' }}">
                            <td>
                                <img src="{{ asset('storage/' . $type->image) }}" alt="{{ $type->name }}" 
                                     class="img-thumbnail rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td class="fw-bold">{{ $type->name }}</td>
                            <td>{{ $type->title }}</td>
                            <td>
                                <span class="badge bg-{{ $type->subscription_category == 'Trả trước' ? 'info' : ($type->subscription_category == 'Trả sau' ? 'primary' : 'success') }}">
                                    {{ $type->subscription_category }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $type->is_approved ? 'success' : 'warning' }}">
                                    {{ $type->is_approved ? 'Đã duyệt' : 'Chờ duyệt' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('loaithuebao.show', ['subscriptionTypeId' => $type->id, 'id' => $type->id]) }}" 
                                   class="btn btn-sm btn-outline-info">
                                   <i class="fas fa-eye me-1"></i> Xem
                                </a>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-warning edit-btn" data-id="{{ $type->id }}">
                                        <i class="fas fa-edit me-1"></i> Sửa
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $type->id }}">
                                        <i class="fas fa-trash-alt me-1"></i> Xóa
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm/Sửa -->
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="subscriptionModalLabel">Thêm Loại Thuê Bao</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subscription-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="subscription-id">
                    
                    <div class="row">
                        <!-- Cột trái -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên Loại Thuê Bao <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-sm" id="name" name="name" required>
                                <div class="invalid-feedback">Vui lòng nhập tên loại thuê bao</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Tiêu Đề <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-sm" id="title" name="title" required>
                                <div class="invalid-feedback">Vui lòng nhập tiêu đề</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="subscription_category" class="form-label">Loại Thuê Bao <span class="text-danger">*</span></label>
                                <select class="form-select shadow-sm" id="subscription_category" name="subscription_category" required>
                                    <option value="Trả trước">Trả trước</option>
                                    <option value="Trả sau">Trả sau</option>
                                    <option value="Fast Connect">Fast Connect</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Cột phải -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="is_approved" class="form-label">Trạng Thái</label>
                                <select class="form-select shadow-sm" id="is_approved" name="is_approved">
                                    <option value="1">Đã duyệt</option>
                                    <option value="0">Chờ duyệt</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình Ảnh</label>
                                <input type="file" class="form-control shadow-sm" id="image" name="image" accept="image/*">
                                <small class="text-muted">Định dạng: JPG, PNG (Tối đa 2MB)</small>
                                <div class="invalid-feedback">Vui lòng chọn hình ảnh hợp lệ</div>
                            </div>
                            
                            <div class="text-center mt-2">
                                <img id="image-preview" src="" alt="Preview" class="img-thumbnail d-none" style="max-height: 150px;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Lưu Thay Đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')


<script>
$(document).ready(function() {
    // Khởi tạo DataTable
   // Khởi tạo DataTable với ngôn ngữ Tiếng Việt
        $('#subscription-table').DataTable({
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
    
    // Xử lý preview ảnh
    $('#image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Reset form khi mở modal thêm mới
    $('#create-new').click(function() {
        $('#subscription-form')[0].reset();
        $('#subscriptionModalLabel').text('Thêm Loại Thuê Bao');
        $('#subscription-id').val('');
        $('#image-preview').addClass('d-none').attr('src', '');
        $('#subscription-form').attr('data-action', 'create');
        $('.invalid-feedback').hide();
    });
    
    // Xử lý sửa
    $(document).on('click', '.edit-btn', function() {
    const id = $(this).data('id');
    
    axios.get(`/admin/subscription-types/${id}/edit`)
        .then(response => {
            const data = response.data;
            
            $('#subscription-id').val(data.id);
            $('#name').val(data.name).data('original-name', data.name);
            $('#title').val(data.title).data('original-title', data.title);
            $('#subscription_category').val(data.subscription_category)
                .data('original-subscription_category', data.subscription_category);
            $('#is_approved').val(data.is_approved ? '1' : '0')
                .data('original-is_approved', data.is_approved ? '1' : '0');
            
            if (data.image) {
                $('#image-preview').attr('src', `/storage/${data.image}`).removeClass('d-none');
            } else {
                $('#image-preview').addClass('d-none');
            }
            
            $('#subscriptionModalLabel').text('Chỉnh Sửa Loại Thuê Bao');
            $('#subscription-form').attr('data-action', 'edit');
            $('#subscriptionModal').modal('show');
        })
        .catch(error => {
            console.error(error);
            Swal.fire('Lỗi!', 'Không thể tải dữ liệu để chỉnh sửa', 'error');
        });
});
    
   // Biến cờ kiểm tra đang xử lý
   $('#subscription-form').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    let action = $('#subscription-form').attr('data-action');
    let id = $('#subscription-id').val();
    let url = '/admin/subscription-types';

    if (action === 'edit') {
        url += `/${id}`;
        formData.append('_method', 'PUT'); // Laravel yêu cầu _method để update
    }

    console.log("Dữ liệu gửi lên:", Object.fromEntries(formData));

    axios.post(url, formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
    })
    .then(response => {
        console.log("Phản hồi từ server:", response.data);
        Swal.fire('Thành công!', 'Dữ liệu đã được cập nhật.', 'success');
        $('#subscriptionModal').modal('hide');
        location.reload(); // Cập nhật lại bảng dữ liệu
    })
    .catch(error => {
        console.error("Lỗi:", error.response?.data || error);
        Swal.fire('Lỗi!', 'Không thể cập nhật dữ liệu.', 'error');
    });
});

    // Xử lý xóa
    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Bạn sẽ không thể hoàn tác hành động này!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/admin/subscription-types/${id}`)
                    .then(() => {
                        $(`#row-${id}`).fadeOut(300, function() {
                            $(this).remove();
                        });
                        
                        Swal.fire(
                            'Đã xóa!',
                            'Loại thuê bao đã được xóa.',
                            'success'
                        );
                    })
                    .catch(error => {
                        Swal.fire(
                            'Lỗi!',
                            'Không thể xóa loại thuê bao này.',
                            'error'
                        );
                    });
            }
        });
    });
});
</script>
@endsection