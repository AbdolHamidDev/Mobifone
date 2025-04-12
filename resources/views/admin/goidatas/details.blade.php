@extends('layouts.admin')
@section('content')
<x-layout.content-header name="Danh sách" key="Data chi tiết" />

<div class="container mx-auto mt-6 px-4">
    <!-- Search results -->
    <div id="accordion-container">
        @if ($details->isEmpty())
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 mb-4 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-600 mb-2">Chưa có chi tiết nào cho gói cước này</h3>
                <p class="text-gray-500 mb-6">Vui lòng thêm chi tiết để bắt đầu</p>
                <button class="btn btn-primary px-6 py-2 rounded-md shadow-sm" data-bs-toggle="modal" data-bs-target="#addDetailModal" onclick="setgoidataId({{ $id }})">
                    <i class="fas fa-plus mr-2"></i> Thêm Chi Tiết
                </button>
            </div>
        @else
            <!-- Accordion display -->
            <div class="space-y-4">
                @php $previousgoidataId = null; @endphp
    
                @foreach ($details as $detail)
                    @if ($detail->goidata_id != $previousgoidataId)
                        @php
                            $previousgoidataId = $detail->goidata_id;
                            $goidata = $detail->goidata;
                        @endphp
    
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                            <button class="w-full text-left p-5 flex items-center justify-between focus:outline-none accordion-header hover:bg-gray-50 transition-colors duration-200" 
                                    data-goidata_id="{{ $detail->goidata_id }}">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-blue-600 rounded-lg">
                                        <i class="fas fa-database"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">ID: {{ $detail->goidata_id }} - {{ $goidata->ten_data }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $details->where('goidata_id', $previousgoidataId)->count() }} chi tiết
                                        </p>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-300"></i>
                            </button>
                            <div class="hidden accordion-content border-t border-gray-200">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Key</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($details->where('goidata_id', $previousgoidataId) as $item)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->id }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->key }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->value }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <div class="flex items-center justify-end space-x-3">
                                                            <a href="{{ route('goidatas_detail.edit', $item->id) }}" 
                                                               class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                                               title="Chỉnh sửa">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('goidatas_detail.destroy', $item->id) }}" method="POST" class="inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                                        title="Xóa"
                                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa chi tiết này?')">
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

<!-- Pagination -->
@if($details->hasPages())
<div class="mt-8 px-4">
    <div class="flex items-center justify-between bg-white px-6 py-3 rounded-lg shadow-sm">
        <div class="text-sm text-gray-700">
            Hiển thị {{ $details->firstItem() }} đến {{ $details->lastItem() }} trong tổng số {{ $details->total() }} kết quả
        </div>
        <div class="flex space-x-2">
            {{ $details->links() }}
        </div>
    </div>
</div>
@endif

<!-- Add Detail Modal -->
<div class="modal fade" id="addDetailModal" tabindex="-1" aria-labelledby="addDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <form id="addDetailForm">
                @csrf
                <div class="modal-header bg-blue-600 text-white">
                    <h5 class="modal-title text-lg font-semibold" id="addDetailModalLabel">Thêm Chi Tiết Gói Cước</h5>
                    <button type="button" class="text-white opacity-80 hover:opacity-100" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-6">
                    <input type="hidden" name="goidata_id" id="goidata_id">
                    
                    <div class="mb-6">
                        <label for="details" class="block text-sm font-medium text-gray-700 mb-2">Thông tin chi tiết</label>
                        <textarea name="details" id="details" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                                  rows="6" placeholder="Nhập thông tin chi tiết (mỗi dòng dạng Key:Value)" required></textarea>
                        <p class="mt-2 text-sm text-gray-500">Ví dụ: <code class="bg-gray-100 px-2 py-1 rounded">Dung lượng:10GB</code></p>
                    </div>
                </div>
                <div class="modal-footer bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <button type="button" class="btn btn-secondary px-5 py-2 rounded-md" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary px-5 py-2 rounded-md shadow-sm">
                        <i class="fas fa-save mr-2"></i> Lưu Chi Tiết
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Accordion functionality
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            const icon = header.querySelector('i');
            
            // Toggle accordion
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
            
            // Smooth animation
            if (!content.classList.contains('hidden')) {
                content.style.maxHeight = content.scrollHeight + 'px';
                setTimeout(() => {
                    content.style.maxHeight = 'none';
                }, 300);
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                setTimeout(() => {
                    content.style.maxHeight = '0';
                }, 10);
            }
        });
        
        // Initialize max-height for hidden accordions
        const content = header.nextElementSibling;
        if (content.classList.contains('hidden')) {
            content.style.maxHeight = '0';
            content.style.overflow = 'hidden';
            content.style.transition = 'max-height 0.3s ease-out';
        }
    });

    function setgoidataId(id) {
        document.getElementById('goidata_id').value = id;
    }

    // Form submission with better UX
    document.getElementById('addDetailForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Đang xử lý...';
        
        const formData = new FormData(this);

        fetch('{{ route("goidatas_detail.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: data.message,
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition'
                }
            }).then(() => {
                location.reload();
            });
        })
        .catch(error => {
            let errorMessage = 'Đã xảy ra lỗi. Vui lòng thử lại sau.';
            if (error.message) {
                errorMessage = error.message;
            } else if (error.errors && error.errors.details) {
                errorMessage = error.errors.details[0];
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                html: `<div class="text-left">${errorMessage}</div>`,
                confirmButtonText: 'Đã hiểu',
                customClass: {
                    confirmButton: 'px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition'
                }
            });
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });
</script>
@endsection