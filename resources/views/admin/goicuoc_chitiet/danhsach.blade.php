@extends('layouts.admin')
@section('content')
<x-layout.content-header title="Danh sách gói cước chi tiết" />
<div class="container mx-auto mt-6 px-4">
    <!-- Kết quả tìm kiếm -->
    <div id="accordion-container">
        @if ($details->isEmpty())
            <div class="text-center mt-6 py-8 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500 text-lg mb-4">Chưa có chi tiết nào cho gói cước này.</p>
                <button class="btn btn-primary px-6 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors" 
                        data-bs-toggle="modal" data-bs-target="#addDetailModal" onclick="setGoicuocId({{ $id }})">
                    <i class="fas fa-plus mr-2"></i> Thêm Chi Tiết
                </button>
            </div>
        @else
            <!-- Hiển thị accordion -->
            <div class="space-y-4">
                @php $previousGoicuocId = null; @endphp
    
                @foreach ($details as $detail)
                    @if ($detail->goicuoc_id != $previousGoicuocId)
                        @php
                            $previousGoicuocId = $detail->goicuoc_id;
                            $goicuoc = $detail->goicuoc;
                        @endphp
    
                        <div class="bg-white shadow-md rounded-lg overflow-hidden transition-all duration-300 hover:shadow-lg">
                            <button class="w-full text-left p-5 flex items-center justify-between focus:outline-none accordion-header bg-gray-50 hover:bg-gray-100" 
                                    data-goicuoc_id="{{ $detail->goicuoc_id }}">
                                <span class="text-lg font-semibold text-gray-800">
                                    <span class="text-blue-600">ID: {{ $detail->goicuoc_id }}</span> - {{ $goicuoc->ten_goicuoc }}
                                </span>
                                <i class="fas fa-chevron-down transition-transform duration-300"></i>
                            </button>
                            <div class="hidden accordion-content bg-gray-50 border-t border-gray-200">
                                <div class="overflow-x-auto p-4">
                                    <table class="w-full table-auto border-collapse rounded-lg overflow-hidden">
                                        <thead>
                                            <tr class="bg-gray-200 text-gray-700">
                                                <th class="px-6 py-3 text-left">ID</th>
                                                <th class="px-6 py-3 text-left">Key</th>
                                                <th class="px-6 py-3 text-left">Value</th>
                                                <th class="px-6 py-3 text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($details->where('goicuoc_id', $previousGoicuocId) as $item)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->id }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $item->key }}</td>
                                                    <td class="px-6 py-4">{{ $item->value }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                                        <div class="flex justify-center space-x-3">
                                                            <a href="{{ route('goicuocs_detail.edit', $item->id) }}" 
                                                               class="text-yellow-500 hover:text-yellow-700 transition-colors"
                                                               title="Chỉnh sửa">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('goicuocs_detail.destroy', $item->id) }}" method="POST" class="inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="text-red-500 hover:text-red-700 transition-colors"
                                                                        title="Xóa"
                                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>   

<!-- Phân trang -->
<div class="mt-6 flex justify-center">
    {{ $details->links() }}
</div>
@endsection

<!-- Modal Thêm Chi Tiết -->
<div class="modal fade" id="addDetailModal" tabindex="-1" aria-labelledby="addDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <form id="addDetailForm">
                @csrf
                <div class="modal-header bg-blue-600 text-white">
                    <h5 class="modal-title text-lg font-semibold" id="addDetailModalLabel">Thêm Chi Tiết Gói Cước</h5>
                    <button type="button" class="text-white hover:text-gray-200" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-6">
                    <input type="hidden" name="goicuoc_id" id="goicuoc_id">

                    <div class="mb-4">
                        <label for="details" class="block text-sm font-medium text-gray-700 mb-2">Thông tin chi tiết</label>
                        <textarea name="details" id="details" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                  rows="6" 
                                  placeholder="Nhập thông tin chi tiết (mỗi dòng dạng Key:Value)" 
                                  required></textarea>
                        <p class="mt-1 text-sm text-gray-500">Ví dụ: Dung lượng: 2GB, Tốc độ: 4G</p>
                    </div>
                </div>
                <div class="modal-footer bg-gray-50 px-6 py-4 border-t">
                    <button type="button" 
                            class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Lưu thông tin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('js')
<script>
    // Accordion toggle
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            const icon = header.querySelector('i');

            // Toggle accordion
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    });

    function setGoicuocId(id) {
        document.getElementById('goicuoc_id').value = id;
    }
</script>

<script>
    document.getElementById('addDetailForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('{{ route("goicuocs_detail.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: data.message,
                    confirmButtonText: 'OK',
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại!',
                    text: data.message || 'Đã xảy ra lỗi.',
                    confirmButtonText: 'OK',
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi hệ thống!',
                text: 'Không thể hoàn thành yêu cầu. Vui lòng thử lại sau.',
                confirmButtonText: 'OK',
            });
        });
    });
</script>
@endsection