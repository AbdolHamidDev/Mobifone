@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Loại thuê bao', 'key' => 'Chi tiết'])
<div class="container mt-4">


    <a href="{{ route('subscription-types.index') }}" class="btn btn-secondary mb-3">Quay Lại</a>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Thêm Chi Tiết</button>

    <table class="table table-bordered table-hover shadow-sm rounded" id="subscription-details-table">
        <thead class="table-primary text-center">
            <tr>
                <th>Lợi Ích</th>
                <th>Giá Cước</th>
                <th>Hướng Dẫn</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subscriptionType->loaithuebao as $detail)
                <tr>
                    <td>{{ $detail->benefits ?? 'Chưa có dữ liệu' }}</td>
                    <td>{{ $detail->pricing ?? 'Chưa có dữ liệu' }}</td>
                    <td>{{ $detail->instructions ?? 'Chưa có dữ liệu' }}</td>
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $detail->id }}" data-subscription-id="{{ $subscriptionType->id }}">
                            <i class="fas fa-edit"></i> Sửa
                        </button>
                        <form action="{{ route('loaithuebao.destroy', [$subscriptionType->id, $detail->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Không có dữ liệu gì</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
</div>

<!-- Modal Thêm Chi Tiết -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addModalLabel"><i class="fas fa-plus"></i> Thêm Chi Tiết</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('loaithuebao.store', $subscriptionType->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="benefits">Lợi Ích</label>
                        <textarea name="benefits" id="benefits" class="form-control shadow-sm" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="pricing">Giá Cước</label>
                        <textarea name="pricing" id="pricing" class="form-control shadow-sm" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="instructions">Hướng Dẫn</label>
                        <textarea name="instructions" id="instructions" class="form-control shadow-sm" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal Sửa Chi Tiết -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Sửa Chi Tiết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="editBenefits">Lợi Ích</label>
                        <textarea name="benefits" id="editBenefits" class="form-control" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editPricing">Giá Cước</label>
                        <textarea name="pricing" id="editPricing" class="form-control" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editInstructions">Hướng Dẫn</label>
                        <textarea name="instructions" id="editInstructions" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const editBenefits = document.getElementById('editBenefits');
    const editPricing = document.getElementById('editPricing');
    const editInstructions = document.getElementById('editInstructions');

    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const detailId = this.getAttribute('data-id');
            const subscriptionTypeId = this.getAttribute('data-subscription-id');

            // Lấy dữ liệu hiện tại từ API hoặc DOM
            fetch(`/admin/subscription-types/${subscriptionTypeId}/loaithuebao/${detailId}/edit`)
                .then(response => response.json())
                .then(data => {
                    editBenefits.value = data.benefits;
                    editPricing.value = data.pricing;
                    editInstructions.value = data.instructions;

                    // Cập nhật action của form
                    editForm.action = `/admin/subscription-types/${subscriptionTypeId}/loaithuebao/${detailId}`;
                    new bootstrap.Modal(editModal).show();
                });
        });
    });
});



document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();
        const form = this.closest('form');
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
                form.submit();
            }
        });
    });
});

</script>