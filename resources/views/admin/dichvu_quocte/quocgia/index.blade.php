@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('admins/quocgia/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="{{ asset('admins/datatable-language.js') }}"></script>
    <script type="module" src="/admins/quocgia/main.js"></script>
@endpush

@section('content')
<x-layout.content-header name="Danh sách" key="Quốc gia" />

<!-- Sử dụng Component Modal Select Map -->
<x-map.select-map />

<!-- Sử dụng Tailwind CSS để tạo giao diện-->
<div class="container">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold text-gray-700 flex items-center">
                    <i class="fas fa-globe-americas text-blue-500 mr-2"></i> Danh sách Quốc Gia
                </h2>
                <button class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all flex items-center" 
                data-bs-toggle="modal" data-bs-target="#modal-quoc-gia">
                <i class="fas fa-plus mr-2"></i> Thêm Quốc Gia
            </button>
            
            </div>
    
            <table id="quocgia" class="w-full text-sm text-gray-600 border-collapse">
                <thead class="bg-blue-500 text-white uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2 w-16 text-center">#</th>
                        <th class="px-4 py-2">Tên Quốc Gia</th>
                        <th class="px-4 py-2">Mã</th>
                        <th class="px-4 py-2 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-100"></tbody>
            </table>
        </div>
    </div>  
</div>


<!-- Sử dụng Component Modal -->
<x-modal.modal-quocgia id="modal-quoc-gia" title="Thêm/Sửa Quốc Gia">
</x-modal.modal-quocgia>

    
@endsection
