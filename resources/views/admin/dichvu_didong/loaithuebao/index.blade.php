@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Danh sách loại thuê bao " />

<div class="container-fluid mt-3">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h5 class="mb-0">Quản lý Loại Thuê Bao</h5>
            <button class="btn btn-light" id="create-new" data-bs-toggle="modal" data-bs-target="#subscriptionModal">
                Thêm Mới
            </button>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="subscription-table">
                    <thead>
                        <tr>
                            <th>Hình Ảnh</th>
                            <th>Tên Loại Thuê Bao</th>
                            <th>Tiêu Đề</th>
                            <th>Loại Thuê Bao</th>
                            <th>Trạng Thái</th>
                            <th>Chi Tiết</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptionTypes as $type)
                        <tr id="row-{{ $type->id }}" class="{{ $type->is_approved ? '' : 'table-warning' }}">
                            <td>
                                <img src="{{ asset('storage/' . $type->image) }}" alt="{{ $type->name }}" 
                                     class="img-thumbnail rounded-circle" width="60" height="60">
                            </td>
                            <td>{{ $type->name }}</td>
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
                                   Xem
                                </a>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-warning edit-btn" data-id="{{ $type->id }}">
                                        Sửa
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $type->id }}">
                                        Xóa
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
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="subscriptionModalLabel">Thêm Loại Thuê Bao</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subscription-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="subscription-id">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên Loại Thuê Bao <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Tiêu Đề <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="subscription_category" class="form-label">Loại Thuê Bao <span class="text-danger">*</span></label>
                                <select class="form-select" id="subscription_category" name="subscription_category" required>
                                    <option value="Trả trước">Trả trước</option>
                                    <option value="Trả sau">Trả sau</option>
                                    <option value="Fast Connect">Fast Connect</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="is_approved" class="form-label">Trạng Thái</label>
                                <select class="form-select" id="is_approved" name="is_approved">
                                    <option value="1">Đã duyệt</option>
                                    <option value="0">Chờ duyệt</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình Ảnh</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted">Định dạng: JPG, PNG (Tối đa 2MB)</small>
                            </div>
                            
                            <div class="text-center mt-2">
                                <img id="image-preview" src="" alt="Preview" class="img-thumbnail d-none" style="max-height: 150px;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">
                            Lưu Thay Đổi
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
$(function() {
    // Khởi tạo DataTable đơn giản
    $('#subscription-table').DataTable({
        language: {
            url: '/vendor/datatables/vi.json'
        }
    });
    
    // Preview ảnh
    $('#image').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Reset form khi thêm mới
    $('#create-new').on('click', function() {
        $('#subscription-form')[0].reset();
        $('#subscriptionModalLabel').text('Thêm Loại Thuê Bao');
        $('#subscription-id').val('');
        $('#image-preview').addClass('d-none').attr('src', '');
    });
    
    // Xử lý sửa
    $(document).on('click', '.edit-btn', function() {
        const id = $(this).data('id');
        
        axios.get(`/admin/subscription-types/${id}/edit`)
            .then(response => {
                const data = response.data;
                
                $('#subscription-id').val(data.id);
                $('#name').val(data.name);
                $('#title').val(data.title);
                $('#subscription_category').val(data.subscription_category);
                $('#is_approved').val(data.is_approved ? '1' : '0');
                
                if (data.image) {
                    $('#image-preview').attr('src', `/storage/${data.image}`).removeClass('d-none');
                }
                
                $('#subscriptionModalLabel').text('Chỉnh Sửa Loại Thuê Bao');
                $('#subscriptionModal').modal('show');
            })
            .catch(error => {
                console.error(error);
                alert('Không thể tải dữ liệu để chỉnh sửa');
            });
    });
    
    // Xử lý submit form
    $('#subscription-form').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const id = $('#subscription-id').val();
        const url = id ? `/admin/subscription-types/${id}` : '/admin/subscription-types';
        const method = id ? 'PUT' : 'POST';
        
        axios.post(url, formData, {
            headers: { 
                'Content-Type': 'multipart/form-data',
                'X-HTTP-Method-Override': method 
            }
        })
        .then(() => {
            alert('Thao tác thành công');
            location.reload();
        })
        .catch(error => {
            console.error(error);
            alert('Có lỗi xảy ra');
        });
    });
    
    // Xử lý xóa
    $(document).on('click', '.delete-btn', function() {
        if (!confirm('Bạn có chắc chắn muốn xóa?')) return;
        
        const id = $(this).data('id');
        
        axios.delete(`/admin/subscription-types/${id}`)
            .then(() => {
                $(`#row-${id}`).remove();
                alert('Đã xóa thành công');
            })
            .catch(error => {
                console.error(error);
                alert('Xóa thất bại');
            });
    });
});
</script>
@endsection