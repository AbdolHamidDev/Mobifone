@extends('layouts.admin')

<link rel="stylesheet" href="{{ asset('admins/dichvu/dichvu.css') }}">
@section('content')
    @include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Dịch vụ'])

    <div class="container mt-4">
        <!-- Nút thêm dịch vụ -->
        <div class="d-flex justify-content-end">
            <button class="button" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fas fa-plus"></i> Thêm Dịch Vụ
            </button>
        </div>



        <!-- Bảng danh sách dịch vụ -->
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên Dịch Vụ</th>
                    <th>Ảnh</th>
                    <th>Nội Dung</th>
                    <th>Loại Dịch Vụ</th>
                    <th>Chi Tiết</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dichvus as $dichvu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dichvu->ten_dich_vu }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $dichvu->anh) }}" alt="Ảnh dịch vụ">
                        </td>
                        <td>{{ $dichvu->noi_dung }}</td>
                        <td>{{ $dichvu->loai_dich_vu }}</td>
                        <td style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                            @if ($dichvu->dichvuChitiet)
                                <!-- Nút Xem Chi Tiết -->
                                <button class="btn btn-sm"
                                    style="padding: 6px; border-radius: 50%; width: 36px; height: 36px; display: flex; justify-content: center; align-items: center; background-color: #6c63ff; color: white; border: none;"
                                    data-bs-toggle="modal" data-bs-target="#detailModal{{ $dichvu->id }}">
                                    <i class="fas fa-eye" style="font-size: 16px;"></i>
                                </button>

                                <!-- Nút Sửa Chi Tiết -->
                                <button class="btn btn-sm"
                                    style="padding: 6px; border-radius: 50%; width: 36px; height: 36px; display: flex; justify-content: center; align-items: center; background-color: #ffa41b; color: white; border: none;"
                                    data-bs-toggle="modal" data-bs-target="#editDetailModal{{ $dichvu->id }}">
                                    <i class="fas fa-edit" style="font-size: 16px;"></i>
                                </button>
                            @else
                                <!-- Nút Thêm Chi Tiết -->
                                <button class="btn btn-sm"
                                    style="padding: 6px; border-radius: 50%; width: 36px; height: 36px; display: flex; justify-content: center; align-items: center; background-color: #28a745; color: white; border: none;"
                                    data-bs-toggle="modal" data-bs-target="#addDetailModal{{ $dichvu->id }}">
                                    <i class="fas fa-plus" style="font-size: 16px;"></i>
                                </button>
                            @endif
                        </td>

                        <td>

                            <!-- Nút Sửa -->
                            <button class="btn btn-sm"
                                style="background-color: #d126b2; color: white; border: none; padding: 6px; border-radius: 50%; width: 36px; height: 36px; display: flex; justify-content: center; align-items: center;"
                                data-bs-toggle="modal" data-bs-target="#editModal{{ $dichvu->id }}">
                                <i class="bi bi-pencil-fill" style="font-size: 16px;"></i>
                            </button>

                            <!-- Nút Xóa -->
                            <button class="btn btn-sm"
                                style="background-color: #dc3545; color: white; border: none; padding: 6px; border-radius: 50%; width: 36px; height: 36px; display: flex; justify-content: center; align-items: center;"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $dichvu->id }}">
                                <i class="fas fa-trash-alt" style="font-size: 16px;"></i>
                            </button>
                        </td>

                    </tr>

                    <!-- Modal Xem Chi Tiết -->
                    @if ($dichvu->dichvuChitiet)
                        <div class="modal fade" id="detailModal{{ $dichvu->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Chi Tiết Dịch Vụ: {{ $dichvu->ten_dich_vu }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Đối tượng sử dụng:</strong>
                                            {{ $dichvu->dichvuChitiet->doi_tuong_su_dung }}</p>
                                        <p><strong>Tính năng chính:</strong> {{ $dichvu->dichvuChitiet->tinh_nang_chinh }}
                                        </p>
                                        <p><strong>Quy định:</strong> {{ $dichvu->dichvuChitiet->quy_dinh }}</p>
                                        <p><strong>Tiện ích:</strong> {{ $dichvu->dichvuChitiet->tien_ich }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
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
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thêm Chi Tiết Dịch Vụ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="doi_tuong_su_dung" class="form-label">Đối tượng sử dụng</label>
                                            <textarea class="form-control" name="doi_tuong_su_dung" rows="2"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tinh_nang_chinh" class="form-label">Tính năng chính</label>
                                            <textarea class="form-control" id="tinh_nang_chinh" name="tinh_nang_chinh" rows="4"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="quy_dinh" class="form-label">Quy định</label>
                                            <textarea class="form-control" name="quy_dinh" rows="2"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tien_ich" class="form-label">Tiện ích</label>
                                            <textarea class="form-control" name="tien_ich" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary">Thêm Chi Tiết</button>
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
                                    <form action="{{ route('dichvu_chitiet.update', $dichvu->dichvuChitiet->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Sửa Chi Tiết Dịch Vụ: {{ $dichvu->ten_dich_vu }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="doi_tuong_su_dung" class="form-label">Đối tượng sử
                                                    dụng</label>
                                                <textarea class="form-control" name="doi_tuong_su_dung" rows="2">{{ $dichvu->dichvuChitiet->doi_tuong_su_dung }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tinh_nang_chinh" class="form-label">Tính năng chính</label>
                                                <textarea class="form-control" name="tinh_nang_chinh" rows="2">{{ $dichvu->dichvuChitiet->tinh_nang_chinh }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="quy_dinh" class="form-label">Quy định</label>
                                                <textarea class="form-control" name="quy_dinh" rows="2">{{ $dichvu->dichvuChitiet->quy_dinh }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tien_ich" class="form-label">Tiện ích</label>
                                                <textarea class="form-control" name="tien_ich" rows="2">{{ $dichvu->dichvuChitiet->tien_ich }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-warning">Cập Nhật</button>
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
                                <form action="{{ route('dichvus.update', $dichvu->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Sửa Dịch Vụ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="ten_dich_vu" class="form-label">Tên Dịch Vụ</label>
                                            <input type="text" class="form-control" name="ten_dich_vu"
                                                value="{{ $dichvu->ten_dich_vu }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="anh" class="form-label">Ảnh</label>
                                            <input type="file" class="form-control" name="anh">
                                        </div>
                                        <div class="mb-3">
                                            <label for="noi_dung" class="form-label">Nội Dung</label>
                                            <input type="text" class="form-control" name="noi_dung"
                                                value="{{ $dichvu->noi_dung }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="loai_dich_vu" class="form-label">Loại Dịch Vụ</label>
                                            <select class="form-select" name="loai_dich_vu" required>
                                                <option value="Dịch vụ nổi bật"
                                                    {{ $dichvu->loai_dich_vu == 'Dịch vụ nổi bật' ? 'selected' : '' }}>Dịch
                                                    vụ nổi bật</option>
                                                <option value="Giáo Dục"
                                                    {{ $dichvu->loai_dich_vu == 'Giáo Dục' ? 'selected' : '' }}>Giáo Dục
                                                </option>
                                                <option value="Tài Chính"
                                                    {{ $dichvu->loai_dich_vu == 'Tài Chính' ? 'selected' : '' }}>Tài Chính
                                                </option>
                                                <option value="Giải Trí"
                                                    {{ $dichvu->loai_dich_vu == 'Giải Trí' ? 'selected' : '' }}>Giải Trí
                                                </option>
                                                <option value="Du Lịch"
                                                    {{ $dichvu->loai_dich_vu == 'Du Lịch' ? 'selected' : '' }}>Du Lịch
                                                </option>
                                                <option value="Internet An Toàn"
                                                    {{ $dichvu->loai_dich_vu == 'Internet An Toàn' ? 'selected' : '' }}>
                                                    Internet An Toàn</option>
                                                <option value="Khác"
                                                    {{ $dichvu->loai_dich_vu == 'Khác' ? 'selected' : '' }}>Khác</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-warning">Cập Nhật</button>
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
                                    <div class="modal-header">
                                        <h5 class="modal-title">Xóa Dịch Vụ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bạn có chắc chắn muốn xóa dịch vụ <strong>{{ $dichvu->ten_dich_vu }}</strong>?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                @endforeach
            </tbody>
        </table>
    </div>

                    <!-- Modal Thêm chính-->
                    <div class="modal fade" id="addModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('dichvus.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thêm Dịch Vụ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="ten_dich_vu" class="form-label">Tên Dịch Vụ</label>
                                            <input type="text" class="form-control" name="ten_dich_vu" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="anh" class="form-label">Ảnh</label>
                                            <input type="file" class="form-control" name="anh">
                                        </div>
                                        <div class="mb-3">
                                            <label for="noi_dung" class="form-label">Nội Dung</label>
                                            <input type="text" class="form-control" name="noi_dung" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="loai_dich_vu" class="form-label">Loại Dịch Vụ</label>
                                            <select class="form-select" name="loai_dich_vu" required>
                                                <option value="" disabled selected>Chọn Loại Dịch Vụ</option>
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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
@endsection
