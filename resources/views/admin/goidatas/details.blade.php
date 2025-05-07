@extends('layouts.admin')
@section('content')
<x-layout.content-header title="Danh sách data chi tiết" />
<div class="container mx-auto mt-6 px-4">
    @if ($details->isEmpty())
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-lg text-gray-600 mb-2">Chưa có chi tiết nào cho gói cước này</h3>
            <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addDetailModal" onclick="setgoidataId({{ $id }})">
                Thêm Chi Tiết
            </button>
        </div>
    @else
        <div class="space-y-4">
            @php $previousgoidataId = null; @endphp

            @foreach ($details as $detail)
                @if ($detail->goidata_id != $previousgoidataId)
                    @php
                        $previousgoidataId = $detail->goidata_id;
                        $goidata = $detail->goidata;
                    @endphp

                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <button class="w-full text-left p-4 flex items-center justify-between accordion-header" 
                                data-goidata_id="{{ $detail->goidata_id }}">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"></path><path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"></path><path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-medium">ID: {{ $detail->goidata_id }} - {{ $goidata->ten_data }}</h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $details->where('goidata_id', $previousgoidataId)->count() }} chi tiết
                                    </p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="hidden accordion-content border-t border-gray-200">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs text-gray-500 uppercase">ID</th>
                                            <th class="px-4 py-2 text-left text-xs text-gray-500 uppercase">Key</th>
                                            <th class="px-4 py-2 text-left text-xs text-gray-500 uppercase">Value</th>
                                            <th class="px-4 py-2 text-right text-xs text-gray-500 uppercase">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($details->where('goidata_id', $previousgoidataId) as $item)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-3 text-sm">{{ $item->id }}</td>
                                                <td class="px-4 py-3 text-sm">{{ $item->key }}</td>
                                                <td class="px-4 py-3 text-sm">{{ $item->value }}</td>
                                                <td class="px-4 py-3 text-right">
                                                    <div class="flex justify-end space-x-2">
                                                        <a href="{{ route('goidatas_detail.edit', $item->id) }}" 
                                                           class="text-blue-600 hover:text-blue-800"
                                                           title="Chỉnh sửa">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                                        </a>
                                                        <form action="{{ route('goidatas_detail.destroy', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="text-red-600 hover:text-red-800"
                                                                    title="Xóa"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa chi tiết này?')">
                                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
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

@if($details->hasPages())
<div class="mt-6 px-4">
    <div class="flex flex-col sm:flex-row items-center justify-between bg-white px-4 py-3 rounded shadow-sm">
        <div class="text-sm text-gray-700 mb-2 sm:mb-0">
            Hiển thị {{ $details->firstItem() }} đến {{ $details->lastItem() }} trong tổng số {{ $details->total() }} kết quả
        </div>
        <div>
            {{ $details->links() }}
        </div>
    </div>
</div>
@endif

<!-- Add Detail Modal -->
<div class="modal fade" id="addDetailModal" tabindex="-1" aria-labelledby="addDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addDetailForm">
                @csrf
                <div class="modal-header bg-blue-600 text-white">
                    <h5 class="modal-title">Thêm Chi Tiết Gói Cước</h5>
                    <button type="button" class="text-white" data-bs-dismiss="modal" aria-label="Close">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="goidata_id" id="goidata_id">
                    
                    <div class="mb-4">
                        <label for="details" class="block text-sm mb-2">Thông tin chi tiết</label>
                        <textarea name="details" id="details" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" 
                                  rows="5" placeholder="Nhập thông tin chi tiết (mỗi dòng dạng Key:Value)" required></textarea>
                        <p class="mt-1 text-sm text-gray-500">Ví dụ: <code class="bg-gray-100 px-1 rounded">Dung lượng:10GB</code></p>
                    </div>
                </div>
                <div class="modal-footer bg-gray-50 px-4 py-3 border-t">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">
                        Lưu Chi Tiết
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    // Accordion functionality
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            const icon = header.querySelector('svg:last-child');
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
            
            if (!content.classList.contains('hidden')) {
                content.style.maxHeight = content.scrollHeight + 'px';
            } else {
                content.style.maxHeight = '0';
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

    // Form submission
    document.getElementById('addDetailForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Đang xử lý...';
        
        const formData = new FormData(this);

        fetch('{{ route("goidatas_detail.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Đã xảy ra lỗi');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });
</script>
@endsection