@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Sửa gói data" />
<div class="container mx-auto py-6 px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Cập Nhật Gói Data</h2>
        <form id="editgoidataForm" action="{{ route('Goidatas.update', $Goidata->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="ten_data" class="block text-sm font-medium text-gray-700">Tên Gói Data</label>
                    <input type="text" name="ten_data" id="ten_data" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $Goidata->ten_data }}" required>
                </div>
                <div>
                    <label for="gia" class="block text-sm font-medium text-gray-700">Giá (VND)</label>
                    <input type="number" name="gia" id="gia" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $Goidata->gia }}" required>
                </div>
                <div>
                    <label for="loai_data" class="block text-sm font-medium text-gray-700">Loại Gói Data</label>
                    <select name="loai_data" id="loai_data" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        @foreach ([
                              "mien_phi_mxh"=>'Miễn phí MXH',
                           "dai_ky"=>'Dài kỳ',
                           "data_bo_sung"=>'Data bổ sung',
                            "thang"=>'Tháng',
                            "data_thuong"=>'Data thường',
                            "ngay"=>'Ngày',
                            "data_fastconnect" =>'Data Fastconnect',  
                        ] as $value => $label)
                            <option value="{{ $value }}" {{ $Goidata->loai_data == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="thoi_gian" class="block text-sm font-medium text-gray-700">Thời Gian (ngày)</label>
                    <input type="number" name="thoi_gian" id="thoi_gian" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $Goidata->thoi_gian }}" required>
                </div>
                <div>
                    <label for="dung_luong" class="block text-sm font-medium text-gray-700">Dung Lượng</label>
                    <input type="number" name="dung_luong" id="dung_luong" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $Goidata->dung_luong }}" required>
                </div>
                <div>
                    <label for="don_vi_dung_luong" class="block text-sm font-medium text-gray-700">Đơn Vị Dung Lượng</label>
                    <select name="don_vi_dung_luong" id="don_vi_dung_luong" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="MB" {{ $Goidata->don_vi_dung_luong == 'MB' ? 'selected' : '' }}>MB</option>
                        <option value="GB" {{ $Goidata->don_vi_dung_luong == 'GB' ? 'selected' : '' }}>GB</option>
                    </select>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-semibold rounded-md shadow-md hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cập Nhật Gói Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
<script>
     document.addEventListener('DOMContentLoaded', function () {
    const editForm = document.getElementById('editgoidataForm');

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
                            window.location.href = '/admin/Goidatas';
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