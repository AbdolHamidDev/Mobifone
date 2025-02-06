@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Sửa', 'key' => 'Gói Cước'])

<div class="container mx-auto py-6 px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Cập Nhật Gói Cước</h2>
        <form id="editGoicuocForm" action="{{ route('goicuocs.update', $goicuoc->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="ten_goicuoc" class="block text-sm font-medium text-gray-700">Tên Gói Cước</label>
                    <input type="text" name="ten_goicuoc" id="ten_goicuoc" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $goicuoc->ten_goicuoc }}" required>
                </div>
                <div>
                    <label for="gia" class="block text-sm font-medium text-gray-700">Giá (VND)</label>
                    <input type="number" name="gia" id="gia" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $goicuoc->gia }}" required>
                </div>
                <div>
                    <label for="loai_goicuoc" class="block text-sm font-medium text-gray-700">Loại Gói Cước</label>
                    <select name="loai_goicuoc" id="loai_goicuoc" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        @foreach ([
                            'thoai_quoc_te' => 'Thỏa Thuận Quốc Tế',
                            'chuyen_vung_quoc_te' => 'Chuyển Vùng Quốc Tế',
                            'tich_diem' => 'Tích Điểm',
                            'mobisafe' => 'MOBISAFE',
                            'quoc_te_linh_hoat' => 'Quốc tế linh hoạt',
                            'combo_trong_nuoc' => 'Combo trong nước',
                            'mobif' => 'MOBIF',
                            'sieu_data' => 'Siêu data',
                            'chi_dep' => 'Chị đẹp',
                            'combo' => 'Combo',
                            'gia_dinh' => 'Gia đình',
                            'hot' => 'Hot',
                        ] as $value => $label)
                            <option value="{{ $value }}" {{ $goicuoc->loai_goicuoc == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="thoi_gian" class="block text-sm font-medium text-gray-700">Thời Gian (ngày)</label>
                    <input type="number" name="thoi_gian" id="thoi_gian" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $goicuoc->thoi_gian }}" required>
                </div>
                <div>
                    <label for="dung_luong" class="block text-sm font-medium text-gray-700">Dung Lượng</label>
                    <input type="number" name="dung_luong" id="dung_luong" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $goicuoc->dung_luong }}" required>
                </div>
                <div>
                    <label for="don_vi_dung_luong" class="block text-sm font-medium text-gray-700">Đơn Vị Dung Lượng</label>
                    <select name="don_vi_dung_luong" id="don_vi_dung_luong" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="MB" {{ $goicuoc->don_vi_dung_luong == 'MB' ? 'selected' : '' }}>MB</option>
                        <option value="GB" {{ $goicuoc->don_vi_dung_luong == 'GB' ? 'selected' : '' }}>GB</option>
                        <option value="phut_goi_quoc_te" {{ $goicuoc->don_vi_dung_luong == 'phut_goi_quoc_te' ? 'selected' : '' }}>phút gọi quốc tế</option>
                        <option value="phut_thoai_quoc_te_huong_han_quoc" {{ $goicuoc->don_vi_dung_luong == 'phut_thoai_quoc_te_huong_han_quoc' ? 'selected' : '' }}>phút thoại quốc tế hướng Hàn Quốc</option>
                    </select>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-semibold rounded-md shadow-md hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cập Nhật Gói Cước</button>
            </div>
        </form>
    </div>
</div>
@endsection
<script>
     document.addEventListener('DOMContentLoaded', function () {
    const editForm = document.getElementById('editGoicuocForm');

    if (editForm) { // Kiểm tra nếu form tồn tại
        editForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Ngăn hành vi submit mặc định của form

            const formData = new FormData(editForm);

            fetch(editForm.action, {
                method: 'POST', // Phương thức gửi dữ liệu
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData, // Dữ liệu form
            })
                .then(response => response.json()) // Chuyển kết quả trả về thành JSON
                .then(data => {
                    if (data.success) {
                        // Hiển thị thông báo SweetAlert thành công
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: data.message,
                            confirmButtonText: 'OK',
                        }).then(() => {
                            // Chuyển hướng người dùng sau khi cập nhật
                            window.location.href = '/admin/goicuocs';
                        });
                    } else {
                        // Hiển thị thông báo SweetAlert thất bại
                        Swal.fire({
                            icon: 'error',
                            title: 'Thất bại!',
                            text: data.message || 'Đã xảy ra lỗi.',
                            confirmButtonText: 'OK',
                        });
                    }
                })
                .catch(error => {
                    // Hiển thị lỗi hệ thống
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi hệ thống!',
                        text: 'Không thể hoàn thành yêu cầu. Vui lòng thử lại sau.',
                        confirmButtonText: 'OK',
                    });
                });
        });
    }
});
</script>