@extends('layouts.admin')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('content')
@include('partials.content-header', ['name' => 'Gói cước', 'key' => 'Chi tiết'])

<div class="container mx-auto mt-6 px-4">


    <!-- Kết quả tìm kiếm -->
    <div id="accordion-container">
        @if ($details->isEmpty())
            <div class="text-center mt-6">
                <p class="text-gray-500 text-lg">Chưa có chi tiết nào cho gói cước này.</p>
                <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addDetailModal" onclick="setGoicuocId({{ $id }})">
                    <i class="fas fa-plus"></i> Thêm Chi Tiết
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
                            $goicuoc = $detail->goicuoc; // Lấy tên gói cước từ quan hệ
                        @endphp
    
                        <div class="bg-white shadow-lg rounded-lg">
                            <button class="w-full text-left p-4 flex items-center justify-between focus:outline-none accordion-header" data-goicuoc_id="{{ $detail->goicuoc_id }}">
                                <span class="text-lg font-semibold text-gray-800">ID: {{ $detail->goicuoc_id }} - {{ $goicuoc->ten_goicuoc }}</span>
                                <i class="fas fa-chevron-down transition-transform"></i>
                            </button>
                            <div class="hidden accordion-content p-4">
                                <table class="w-full table-auto border-collapse border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="border px-4 py-2">ID</th>
                                            <th class="border px-4 py-2">Key</th>
                                            <th class="border px-4 py-2">Value</th>
                                            <th class="border px-4 py-2">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details->where('goicuoc_id', $previousGoicuocId) as $item)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $item->id }}</td>
                                                <td class="border px-4 py-2">{{ $item->key }}</td>
                                                <td class="border px-4 py-2">{{ $item->value }}</td>
                                                <td class="border px-4 py-2 flex space-x-2">
                                                    <a href="{{ route('goicuocs_detail.edit', $item->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('goicuocs_detail.destroy', $item->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>   

<!-- Phân trang -->
<div class="mt-6">
    {{ $details->links() }}
</div>
@endsection



<!-- Modal Thêm Chi Tiết -->
<div class="modal fade" id="addDetailModal" tabindex="-1" aria-labelledby="addDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addDetailForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addDetailModalLabel">Thêm Chi Tiết Gói Cước</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input hidden chứa ID gói cước -->
                    <input type="hidden" name="goicuoc_id" id="goicuoc_id">

                    <!-- Nhập thông tin chi tiết -->
                    <div class="mb-4">
                        <label for="details" class="block text-sm font-medium">Thông tin chi tiết</label>
                        <textarea name="details" id="details" class="form-control" rows="6" placeholder="Nhập thông tin chi tiết (mỗi dòng dạng Key:Value)" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
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

   


</script>

<script>
    function setGoicuocId(id) {
        // Gán ID gói cước vào input hidden
        document.getElementById('goicuoc_id').value = id;
    }
</script>


<script>
    document.getElementById('addDetailForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Ngăn chặn hành vi submit mặc định

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
                    location.reload(); // Tải lại trang sau khi thêm thành công
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
