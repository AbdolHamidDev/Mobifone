@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('admins/cuocquocte/style.css') }}">
@endpush
@section('content')
<x-layout.content-header name="Danh sách" key="Cước quốc tế" />

<div class="row mb-4 g-4">

    <x-ui.cards.cuocquocte.tongquocgia/>
    <x-ui.cards.cuocquocte.tongnhakhaithac/>
    <x-ui.cards.cuocquocte.trungbinhcuocgoi/>
    <x-ui.cards.cuocquocte.trungbinhcuocdata/>
    <x-ui.charts.cuocquocte.phanbo-tyle/>
    <x-ui.tables.cuocquocte.top10-highest-rate/>

   <!-- Bảng core của cước quốc tế -->
<div class="container-fluid px-4 py-3">
    <!-- Header with Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary mb-0">
            <i class="fas fa-globe-americas me-2"></i>Quản Lý Cước Quốc Tế
        </h2>
        
        <div class="d-flex gap-2">
           
            <button class="btn btn-primary rounded-pill px-4" id="btn-add" 
            data-bs-toggle="modal" data-bs-target="#modal-cuoc-quoc-te">
        <i class="fas fa-plus-circle me-2"></i> Thêm Mới
    </button>
    
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="cuoc-quoc-te-table" class="table table-hover align-middle mb-0" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th width="50">ID</th>
                            <th>Quốc Gia</th>
                            <th>Nhà Khai Thác</th>
                            <th width="120">Loại Thuê Bao</th>
                            <th width="120">Gọi Trong Mạng</th>
                            <th width="120">Gọi về VN</th>
                            <th width="120">Gọi QT</th>
                            <th width="120">Nhận Gọi</th>
                            <th width="100">SMS</th>
                            <th width="100">Data</th>
                            <th width="120" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<x-ui.notifications.loading-toast message="Đang xử lý yêu cầu..." bgColor="bg-warning" />
<x-modal.modal-cuoc-quoc-te />

@push('scripts')
<script type="module" src="/admins/cuocquocte/main.js"></script>
<script type="module" src="/admins/cuocquocte/action.js"></script>
@endpush


@endsection
