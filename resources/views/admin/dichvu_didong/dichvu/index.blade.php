@extends('layouts.admin')
@section('content')
<x-layout.content-header title="Danh sách Dịch vụ" />

<div class="container-fluid mt-4">
    <div class="card">
        <!-- Header -->
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Quản lý dịch vụ</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Thêm Dịch Vụ
                </button>
            </div>
        </div>

        <!-- Body -->
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
                                <td>{{ $dichvu->ten_dich_vu }}</td>
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
                                <td>{{ $dichvu->loai_dich_vu }}</td>
                                <td class="text-center">
                                    @if ($dichvu->dichvuChitiet)
                                        <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" data-bs-target="#detailModal{{ $dichvu->id }}">
                                            Xem
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" 
                                            data-bs-toggle="modal" data-bs-target="#editDetailModal{{ $dichvu->id }}">
                                            Sửa
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-outline-success" 
                                            data-bs-toggle="modal" data-bs-target="#addDetailModal{{ $dichvu->id }}">
                                            Thêm
                                        </button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $dichvu->id }}">
                                        Sửa
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $dichvu->id }}">
                                        Xóa
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm dịch vụ -->
@include('admin.dichvu_didong.dichvu.modals.add')

<!-- Modal chi tiết, sửa, xóa -->
@foreach ($dichvus as $dichvu)
    @if ($dichvu->dichvuChitiet)
        @include('admin.dichvu_didong.dichvu.modals.detail', ['dichvu' => $dichvu])
        @include('admin.dichvu_didong.dichvu.modals.edit-detail', ['dichvu' => $dichvu])
    @endif
    
    @include('admin.dichvu_didong.dichvu.modals.add-detail', ['dichvu' => $dichvu])
    @include('admin.dichvu_didong.dichvu.modals.edit', ['dichvu' => $dichvu])
    @include('admin.dichvu_didong.dichvu.modals.delete', ['dichvu' => $dichvu])
@endforeach

@endsection