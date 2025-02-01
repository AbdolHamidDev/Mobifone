@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Tuyển dụng'])

<div class="container mx-auto px-4 py-6">
    <a href="{{ route('tuyendung.create') }}" class="inline-block bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-medium px-6 py-2 rounded-full shadow-md transition-all duration-300 hover:from-blue-600 hover:to-blue-700 hover:shadow-lg mb-4">
        + Tạo công việc mới
    </a>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
        <table class="min-w-full table-auto">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm">
                <tr>
                    <th class="px-6 py-4 text-left">ID</th>
                    <th class="px-6 py-4 text-left">Vị trí</th>
                    <th class="px-6 py-4 text-left">Mô tả</th>
                    <th class="px-6 py-4 text-left">Yêu cầu</th>
                    <th class="px-6 py-4 text-left">Lương</th>
                    <th class="px-6 py-4 text-left">Thời gian ứng tuyển</th>
                    <th class="px-6 py-4 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach ($tuyendungs as $tuyendung)
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4">{{ $tuyendung->id }}</td>
                        <td class="px-6 py-4">{{ $tuyendung->vi_tri }}</td>
                        <td class="px-6 py-4">{{ Str::limit($tuyendung->mo_ta, 50) }}</td>
                        <td class="px-6 py-4">{{ Str::limit($tuyendung->yeu_cau, 50) }}</td>
                        <td class="px-6 py-4">
                            @if(is_numeric($tuyendung->luong))
                                {{ number_format($tuyendung->luong) }} đ
                            @else
                                {{ $tuyendung->luong ?? 'Liên hệ để biết thêm' }}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($tuyendung->thoi_gian_ung_tuyen == '9999-12-31') <!-- Kiểm tra nếu giá trị là tuyển gấp -->
                                <span class="text-red-500 font-semibold">Tuyển gấp</span>
                            @else
                                {{ \Carbon\Carbon::parse($tuyendung->thoi_gian_ung_tuyen)->format('d/m/Y') }}
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 text-center flex items-center justify-center space-x-4">
                            <a href="{{ route('tuyendung.edit', $tuyendung->id) }}" class="text-yellow-500 hover:text-yellow-600 transition-all duration-300">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Form Xóa với SweetAlert2 -->
                            <form action="{{ route('tuyendung.destroy', $tuyendung->id) }}" method="POST" class="inline-block" id="delete-form-{{ $tuyendung->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-500 hover:text-red-600 transition-all duration-300 delete-btn" data-id="{{ $tuyendung->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Xử lý sự kiện click vào nút xóa
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: "Dữ liệu này sẽ không thể phục hồi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu người dùng chọn Xóa, gửi form
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });
    });
</script>
@endsection
