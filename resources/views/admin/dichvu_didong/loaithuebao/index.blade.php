@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Loại thuê bao'])

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-primary shadow-sm" id="create-new" data-bs-toggle="modal" data-bs-target="#subscriptionModal">
            <i class="fas fa-plus"></i> Thêm Loại Thuê Bao
        </button>

    </div>

    <!-- Bảng dữ liệu -->
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover align-middle" id="subscription-table">
            <thead class="table-dark">
                <tr>
                    <th>Hình Ảnh</th>
                    <th>Tên Loại Thuê Bao</th>
                    <th>Tiêu Đề</th>
                    <th>Loại Thuê Bao</th>
                    <th>Kiểm Duyệt</th>
                    <th>Chi Tiết</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody id="subscription-table-body">
                @foreach ($subscriptionTypes as $type)
                    @include('admin.dichvu_didong.loaithuebao.row', ['type' => $type])
                @endforeach
            </tbody>
            
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="subscriptionModalLabel">Thêm Loại Thuê Bao</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subscription-form">
                    @csrf
                    <input type="hidden" name="id" id="subscription-id">

                    <!-- Bước 1 -->
                    <div class="form-group mb-3">
                        <label for="name">Tên Loại Thuê Bao</label>
                        <input type="text" name="name" id="name" class="form-control shadow-sm" required>
                    </div>

                    <!-- Bước 2 -->
                    <div class="form-group mb-3">
                        <label for="title">Tiêu Đề</label>
                        <input type="text" name="title" id="title" class="form-control shadow-sm" required>
                    </div>

                    <!-- Bước 3 -->
                    <div class="form-group mb-3">
                        <label for="image">Hình Ảnh</label>
                        <input type="file" name="image" id="image" class="form-control shadow-sm">
                        <small class="text-muted">Hỗ trợ: JPG, PNG (Max 2MB)</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="subscription_category">Loại Thuê Bao</label>
                        <select name="subscription_category" id="subscription_category" class="form-control shadow-sm" required>
                            <option value="Trả trước">Trả trước</option>
                            <option value="Trả sau">Trả sau</option>
                            <option value="Fast Connect">Fast Connect</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="is_approved">Kiểm Duyệt</label>
                        <select name="is_approved" id="is_approved" class="form-control shadow-sm">
                            <option value="1">Đã duyệt</option>
                            <option value="0">Chưa duyệt</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100 shadow-sm">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('subscriptionModal'));
    const form = document.getElementById('subscription-form');
    const tableBody = document.getElementById('subscription-table-body');

    // Reset form và modal khi nhấn "Thêm mới"
    document.getElementById('create-new').addEventListener('click', function () {
        form.reset();
        document.getElementById('subscriptionModalLabel').textContent = 'Thêm Loại Thuê Bao';
        form.setAttribute('data-action', 'create');
    });

    // Xử lý submit form
    form.addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(form);
    const action = form.getAttribute('data-action');
    const url = action === 'create' ? '/admin/subscription-types' : `/admin/subscription-types/${formData.get('id')}`;
    const method = action === 'create' ? 'POST' : 'PUT';

    axios({
        method: method,
        url: url,
        data: formData,
        headers: { 'Content-Type': 'multipart/form-data' }
    })
        .then(response => {
            if (action === 'create') {
                tableBody.insertAdjacentHTML('beforeend', response.data.html);
            } else {
                document.getElementById(`row-${formData.get('id')}`).outerHTML = response.data.html;
            }
            modal.hide();
        })
        .catch(error => {
    console.error('Error response:', error.response); // Log chi tiết phản hồi lỗi
    if (error.response && error.response.data && error.response.data.message) {
        alert(`Lỗi: ${error.response.data.message}`);
    } else {
        alert('Có lỗi xảy ra. Vui lòng thử lại!');
    }
});

});


    // Sửa loại thuê bao
    tableBody.addEventListener('click', function (event) {
    if (event.target.classList.contains('edit-btn')) {
        const id = event.target.getAttribute('data-id');
        axios.get(`/admin/subscription-types/${id}/edit`)
            .then(response => {
                const data = response.data;
                document.getElementById('subscription-id').value = data.id;
                document.getElementById('name').value = data.name;
                document.getElementById('title').value = data.title;
                document.getElementById('is_approved').value = data.is_approved;
                document.getElementById('subscription_category').value = data.subscription_category; // Bổ sung
                document.getElementById('subscriptionModalLabel').textContent = 'Chỉnh Sửa Loại Thuê Bao';
                form.setAttribute('data-action', 'edit');
                modal.show();
            })
            .catch(error => console.error(error));
    }
});


    // Xóa loại thuê bao
    tableBody.addEventListener('click', function (event) {
        if (event.target.classList.contains('delete-btn')) {
            const id = event.target.getAttribute('data-id');
            if (confirm('Bạn có chắc chắn muốn xóa?')) {
                axios.delete(`/admin/subscription-types/${id}`)
                    .then(() => {
                        document.getElementById(`row-${id}`).remove();
                    })
                    .catch(error => console.error(error));
            }
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function (e) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('preview-img');
                if (preview) {
                    preview.src = e.target.result;
                }
            };
            reader.readAsDataURL(this.files[0]);
        });
    }
});


$(document).ready(function () {
    $('#subscription-table').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        language: {
            search: "Tìm kiếm:",
            lengthMenu: "Hiển thị _MENU_ bản ghi",
            info: "Hiển thị _START_ đến _END_ trong tổng _TOTAL_ bản ghi",
            paginate: {
                first: "Đầu",
                last: "Cuối",
                next: "Sau",
                previous: "Trước",
            },
        },
    });
});
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.isConfirmed) {
                // Thực hiện xóa (gửi request AJAX hoặc chuyển hướng)
                console.log(`Xóa mục ID: ${id}`);
            }
        });
    });
});

</script>