@extends('layouts.admin')

<link rel="stylesheet" href="{{ asset('admins/dichvu/dichvu.css') }}">
@section('content')
<x-layout.content-header name="Danh sách" key="Dịch vụ" />

    <div class="container-fluid mt-4">
        <!-- Card chứa toàn bộ nội dung -->
        <div class="card shadow-sm">
            <!-- Header card với tiêu đề và nút thêm -->
            <div class="card-header bg-white border-bottom-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-concierge-bell me-2"></i>Quản lý dịch vụ
                    </h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus-circle me-1"></i> Thêm Dịch Vụ
                    </button>
                </div>
            </div>

            <!-- Body card chứa bảng danh sách -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center">#</th>
                                <th>Tên Dịch Vụ</th>
                                <th width="120">Ảnh</th>
                                <th>Nội Dung</th>
                                <th width="150">Loại Dịch Vụ</th>
                                <th width="120" class="text-center">Chi Tiết</th>
                                <th width="150" class="text-center">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dichvus as $dichvu)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $dichvu->ten_dich_vu }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ asset('storage/' . $dichvu->anh) }}" alt="Ảnh dịch vụ" 
                                                class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 200px;" title="{{ $dichvu->noi_dung }}">
                                            {{ $dichvu->noi_dung }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($dichvu->loai_dich_vu == 'Dịch vụ nổi bật') bg-danger
                                            @elseif($dichvu->loai_dich_vu == 'Giáo Dục') bg-success
                                            @elseif($dichvu->loai_dich_vu == 'Tài Chính') bg-warning text-dark
                                            @elseif($dichvu->loai_dich_vu == 'Giải Trí') bg-info
                                            @elseif($dichvu->loai_dich_vu == 'Du Lịch') bg-primary
                                            @elseif($dichvu->loai_dich_vu == 'Internet An Toàn') bg-dark
                                            @else bg-secondary
                                            @endif">
                                            {{ $dichvu->loai_dich_vu }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($dichvu->dichvuChitiet)
                                            <!-- Nút Xem Chi Tiết -->
                                            <button class="btn btn-sm btn-outline-primary rounded-circle me-1" 
                                                data-bs-toggle="modal" data-bs-target="#detailModal{{ $dichvu->id }}"
                                                title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- Nút Sửa Chi Tiết -->
                                            <button class="btn btn-sm btn-outline-warning rounded-circle" 
                                                data-bs-toggle="modal" data-bs-target="#editDetailModal{{ $dichvu->id }}"
                                                title="Sửa chi tiết">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @else
                                            <!-- Nút Thêm Chi Tiết -->
                                            <button class="btn btn-sm btn-outline-success rounded-circle" 
                                                data-bs-toggle="modal" data-bs-target="#addDetailModal{{ $dichvu->id }}"
                                                title="Thêm chi tiết">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <!-- Nút Sửa -->
                                        <button class="btn btn-sm btn-outline-purple rounded-circle me-1" 
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $dichvu->id }}"
                                            title="Sửa dịch vụ">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        <!-- Nút Xóa -->
                                        <button class="btn btn-sm btn-outline-danger rounded-circle" 
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $dichvu->id }}"
                                            title="Xóa dịch vụ">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Xem Chi Tiết -->
                                @if ($dichvu->dichvuChitiet)
                                    <div class="modal fade" id="detailModal{{ $dichvu->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-info-circle me-2"></i>Chi Tiết Dịch Vụ: {{ $dichvu->ten_dich_vu }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <h6 class="fw-bold text-primary">Đối tượng sử dụng:</h6>
                                                            <div class="p-3 bg-light rounded">
                                                                {{ $dichvu->dichvuChitiet->doi_tuong_su_dung }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <h6 class="fw-bold text-primary">Tính năng chính:</h6>
                                                            <div class="p-3 bg-light rounded">
                                                                {{ $dichvu->dichvuChitiet->tinh_nang_chinh }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <h6 class="fw-bold text-primary">Quy định:</h6>
                                                            <div class="p-3 bg-light rounded">
                                                                {{ $dichvu->dichvuChitiet->quy_dinh }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <h6 class="fw-bold text-primary">Tiện ích:</h6>
                                                            <div class="p-3 bg-light rounded">
                                                                {{ $dichvu->dichvuChitiet->tien_ich }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-1"></i> Đóng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Modal Thêm Chi Tiết -->
                                <div class="modal fade" id="addDetailModal{{ $dichvu->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('dichvu_chitiet.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="dichvu_id" value="{{ $dichvu->id }}">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-plus-circle me-2"></i>Thêm Chi Tiết Dịch Vụ
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="doi_tuong_su_dung" class="form-label fw-bold">Đối tượng sử dụng</label>
                                                        <textarea class="form-control" name="doi_tuong_su_dung" rows="2" placeholder="Nhập đối tượng sử dụng..."></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tinh_nang_chinh" class="form-label fw-bold">Tính năng chính</label>
                                                        <textarea class="form-control" id="tinh_nang_chinh" name="tinh_nang_chinh" rows="4" placeholder="Nhập tính năng chính..."></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="quy_dinh" class="form-label fw-bold">Quy định</label>
                                                        <textarea class="form-control" name="quy_dinh" rows="2" placeholder="Nhập quy định..."></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tien_ich" class="form-label fw-bold">Tiện ích</label>
                                                        <textarea class="form-control" name="tien_ich" rows="2" placeholder="Nhập tiện ích..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-1"></i> Hủy
                                                    </button>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-save me-1"></i> Thêm Chi Tiết
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Sửa Chi Tiết -->
                                @if ($dichvu->dichvuChitiet)
                                    <div class="modal fade" id="editDetailModal{{ $dichvu->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('dichvu_chitiet.update', $dichvu->dichvuChitiet->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header bg-warning text-dark">
                                                        <h5 class="modal-title">
                                                            <i class="fas fa-edit me-2"></i>Sửa Chi Tiết Dịch Vụ: {{ $dichvu->ten_dich_vu }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="doi_tuong_su_dung" class="form-label fw-bold">Đối tượng sử dụng</label>
                                                            <textarea class="form-control" name="doi_tuong_su_dung" rows="2">{{ $dichvu->dichvuChitiet->doi_tuong_su_dung }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tinh_nang_chinh" class="form-label fw-bold">Tính năng chính</label>
                                                            <textarea class="form-control" name="tinh_nang_chinh" rows="2">{{ $dichvu->dichvuChitiet->tinh_nang_chinh }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="quy_dinh" class="form-label fw-bold">Quy định</label>
                                                            <textarea class="form-control" name="quy_dinh" rows="2">{{ $dichvu->dichvuChitiet->quy_dinh }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tien_ich" class="form-label fw-bold">Tiện ích</label>
                                                            <textarea class="form-control" name="tien_ich" rows="2">{{ $dichvu->dichvuChitiet->tien_ich }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            <i class="fas fa-times me-1"></i> Hủy
                                                        </button>
                                                        <button type="submit" class="btn btn-warning">
                                                            <i class="fas fa-save me-1"></i> Cập Nhật
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Modal Sửa chính -->
                                <div class="modal fade" id="editModal{{ $dichvu->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('dichvus.update', $dichvu->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-purple text-white">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-edit me-2"></i>Sửa Dịch Vụ
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="ten_dich_vu" class="form-label fw-bold">Tên Dịch Vụ</label>
                                                        <input type="text" class="form-control" name="ten_dich_vu" value="{{ $dichvu->ten_dich_vu }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="anh" class="form-label fw-bold">Ảnh</label>
                                                        <input type="file" class="form-control" name="anh">
                                                        @if($dichvu->anh)
                                                            <div class="mt-2">
                                                                <small class="text-muted">Ảnh hiện tại:</small>
                                                                <img src="{{ asset('storage/' . $dichvu->anh) }}" alt="Ảnh dịch vụ" class="img-thumbnail mt-1" style="width: 100px;">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="noi_dung" class="form-label fw-bold">Nội Dung</label>
                                                        <input type="text" class="form-control" name="noi_dung" value="{{ $dichvu->noi_dung }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="loai_dich_vu" class="form-label fw-bold">Loại Dịch Vụ</label>
                                                        <select class="form-select" name="loai_dich_vu" required>
                                                            <option value="Dịch vụ nổi bật" {{ $dichvu->loai_dich_vu == 'Dịch vụ nổi bật' ? 'selected' : '' }}>Dịch vụ nổi bật</option>
                                                            <option value="Giáo Dục" {{ $dichvu->loai_dich_vu == 'Giáo Dục' ? 'selected' : '' }}>Giáo Dục</option>
                                                            <option value="Tài Chính" {{ $dichvu->loai_dich_vu == 'Tài Chính' ? 'selected' : '' }}>Tài Chính</option>
                                                            <option value="Giải Trí" {{ $dichvu->loai_dich_vu == 'Giải Trí' ? 'selected' : '' }}>Giải Trí</option>
                                                            <option value="Du Lịch" {{ $dichvu->loai_dich_vu == 'Du Lịch' ? 'selected' : '' }}>Du Lịch</option>
                                                            <option value="Internet An Toàn" {{ $dichvu->loai_dich_vu == 'Internet An Toàn' ? 'selected' : '' }}>Internet An Toàn</option>
                                                            <option value="Khác" {{ $dichvu->loai_dich_vu == 'Khác' ? 'selected' : '' }}>Khác</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-1"></i> Hủy
                                                    </button>
                                                    <button type="submit" class="btn btn-purple text-white">
                                                        <i class="fas fa-save me-1"></i> Cập Nhật
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Xóa chính -->
                                <div class="modal fade" id="deleteModal{{ $dichvu->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('dichvus.destroy', $dichvu->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-exclamation-triangle me-2"></i>Xác nhận xóa
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-warning" role="alert">
                                                        <i class="fas fa-exclamation-circle me-2"></i>
                                                        <strong>Cảnh báo:</strong> Bạn sắp xóa dịch vụ này. Hành động này không thể hoàn tác!
                                                    </div>
                                                    <p>Bạn có chắc chắn muốn xóa dịch vụ <strong class="text-danger">{{ $dichvu->ten_dich_vu }}</strong>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-1"></i> Hủy
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt me-1"></i> Xóa
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer card với phân trang (nếu có) -->
            @if(method_exists($dichvus, 'hasPages') && $dichvus->hasPages())
            <div class="card-footer bg-white">
                {{ $dichvus->links() }}
            </div>
        @endif
        </div>
    </div>

    <!-- Modal Thêm chính-->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dichvus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-plus-circle me-2"></i>Thêm Dịch Vụ Mới
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ten_dich_vu" class="form-label fw-bold">Tên Dịch Vụ</label>
                            <input type="text" class="form-control" name="ten_dich_vu" required placeholder="Nhập tên dịch vụ...">
                        </div>
                        <div class="mb-3">
                            <label for="anh" class="form-label fw-bold">Ảnh</label>
                            <input type="file" class="form-control" name="anh" required>
                            <small class="text-muted">Chọn ảnh đại diện cho dịch vụ</small>
                        </div>
                        <div class="mb-3">
                            <label for="noi_dung" class="form-label fw-bold">Nội Dung</label>
                            <input type="text" class="form-control" name="noi_dung" required placeholder="Nhập nội dung ngắn gọn...">
                        </div>
                        <div class="mb-3">
                            <label for="loai_dich_vu" class="form-label fw-bold">Loại Dịch Vụ</label>
                            <select class="form-select" name="loai_dich_vu" required>
                                <option value="" disabled selected>-- Chọn Loại Dịch Vụ --</option>
                                <option value="Dịch vụ nổi bật">Dịch vụ nổi bật</option>
                                <option value="Giáo Dục">Giáo Dục</option>
                                <option value="Tài Chính">Tài Chính</option>
                                <option value="Giải Trí">Giải Trí</option>
                                <option value="Du Lịch">Du Lịch</option>
                                <option value="Internet An Toàn">Internet An Toàn</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Hủy
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Lưu lại
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    .bg-purple {
        background-color: #6f42c1;
    }
    .btn-purple {
        background-color: #6f42c1;
        color: white;
    }
    .btn-outline-purple {
        border-color: #6f42c1;
        color: #6f42c1;
    }
    .btn-outline-purple:hover {
        background-color: #6f42c1;
        color: white;
    }
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
    .img-thumbnail {
        transition: transform 0.3s ease;
    }
    .img-thumbnail:hover {
        transform: scale(1.05);
    }
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }

    
</style>