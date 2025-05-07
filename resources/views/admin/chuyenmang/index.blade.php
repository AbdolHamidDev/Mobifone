@extends('layouts.admin')
@section('content')
<x-layout.content-header title="danh sách đăng ký" />

@if(session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
@endif



<div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
    <table class="min-w-full">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="py-3 px-4 text-left text-sm">ID</th>
                <th class="py-3 px-4 text-left text-sm">Họ tên</th>
                <th class="py-3 px-4 text-left text-sm">Số điện thoại</th>
                <th class="py-3 px-4 text-left text-sm">Email</th>
                <th class="py-3 px-4 text-left text-sm">Tỉnh/Thành phố</th>
                <th class="py-3 px-4 text-left text-sm">Quận/Huyện</th>
                <th class="py-3 px-4 text-left text-sm">Xã/Phường</th>
                <th class="py-3 px-4 text-left text-sm">Đã liên hệ</th>
                <th class="py-3 px-4 text-left text-sm">Hỗ trợ thủ tục</th>
                <th class="py-3 px-4 text-left text-sm">Nhận kết quả</th>
                <th class="py-3 px-4 text-left text-sm">Giới thiệu</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($dangKys as $dangKy)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-3 px-4 text-sm">{{ $dangKy->id }}</td>
                    <td class="py-3 px-4 text-sm">{{ $dangKy->ho_ten }}</td>
                    <td class="py-3 px-4 text-sm">{{ $dangKy->so_dien_thoai }}</td>
                    <td class="py-3 px-4 text-sm">{{ $dangKy->email }}</td>
                    <td class="py-3 px-4 text-sm">{{ $provinceMap[$dangKy->tinh_thanh_pho] ?? 'Chưa xác định' }}</td>
                    <td class="py-3 px-4 text-sm">{{ $districtMap[$dangKy->quan_huyen] ?? 'Chưa xác định' }}</td>
                    <td class="py-3 px-4 text-sm">{{ $wardMap[$dangKy->xa_phuong] ?? 'Chưa xác định' }}</td>
                    <td class="py-3 px-4 text-sm">
                        <button class="btn btn-sm {{ $dangKy->da_lien_he ? 'btn-success' : 'btn-warning' }} toggle-status" 
                                data-id="{{ $dangKy->id }}" data-field="lien-he">
                            {{ $dangKy->da_lien_he ? 'Đã liên hệ' : 'Chưa liên hệ' }}
                        </button>
                    </td>
                    <td class="py-3 px-4 text-sm">
                        <button class="btn btn-sm {{ $dangKy->ho_tro_thu_tuc ? 'btn-success' : 'btn-warning' }} toggle-status"
                                data-id="{{ $dangKy->id }}" data-field="ho-tro-thu-tuc">
                            {{ $dangKy->ho_tro_thu_tuc ? 'Đã hỗ trợ' : 'Chưa hỗ trợ' }}
                        </button>
                    </td>
                    <td class="py-3 px-4 text-sm">
                        <button class="btn btn-sm {{ $dangKy->nhan_ket_qua ? 'btn-success' : 'btn-warning' }} toggle-status"
                                data-id="{{ $dangKy->id }}" data-field="nhan-ket-qua">
                            {{ $dangKy->nhan_ket_qua ? 'Đã nhận' : 'Chưa nhận' }}
                        </button>
                    </td>
                    <td class="py-3 px-4 text-sm">
                        @if($dangKy->nguoi_gioi_thieu_ho_ten)
                            <button class="btn btn-sm btn-info toggle-intro" data-id="{{ $dangKy->id }}">Xem thông tin</button>
                            <div id="intro-{{ $dangKy->id }}" class="hidden py-2 px-4 bg-gray-100 mt-2 rounded">
                                <p><strong>Họ tên:</strong> {{ $dangKy->nguoi_gioi_thieu_ho_ten }}</p>
                                <p><strong>SĐT:</strong> {{ $dangKy->nguoi_gioi_thieu_so_dien_thoai }}</p>
                                <p><strong>Email:</strong> {{ $dangKy->nguoi_gioi_thieu_email }}</p>
                                <p><strong>Đơn vị:</strong> {{ $dangKy->nguoi_gioi_thieu_don_vi }}</p>
                            </div>
                        @else
                            Không có
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
// Hàm chung để xử lý toggle trạng thái
function handleToggleStatus(field) {
    const button = $(this);
    const dangKyId = button.data('id');
    
    $.ajax({
        url: `/admin/dang-ky/${dangKyId}/toggle-${field}`,
        method: 'POST',
        data: { _token: '{{ csrf_token() }}' },
        success: function(response) {
            if (response.success) {
                const isActive = response[field.replace(/-/g, '_')] == 1;
                button.toggleClass('btn-success btn-warning')
                      .text(isActive ? `Đã ${field.replace(/-/g, ' ')}` : `Chưa ${field.replace(/-/g, ' ')}`);
            }
        },
        error: function() {
            alert('Có lỗi xảy ra!');
        }
    });
}



// Khởi tạo sự kiện
$(document).ready(function() {
    // Sự kiện toggle trạng thái
    $(document).on('click', '.toggle-status', function() {
        handleToggleStatus.call(this, $(this).data('field'));
    });
    
    // Sự kiện toggle thông tin giới thiệu
    $(document).on('click', '.toggle-intro', function() {
        $(`#intro-${$(this).data('id')}`).toggleClass('hidden');
    });
    
    // Sự kiện tìm kiếm
    const searchInputs = $('#search-phone, #search-email');
    searchInputs.on('input', _.debounce(handleSearch, 300));
    
    // Sự kiện clear search
    $('#clear-phone, #clear-email').on('click', function() {
        $(this).siblings('input').val('').trigger('input');
    });
});
</script>

<style>
.btn { padding: 0.25rem 0.5rem; border-radius: 0.25rem; }
.btn-success { background: #10b981; color: white; }
.btn-warning { background: #f59e0b; color: white; }
.btn-info { background: #3b82f6; color: white; }
</style>
@endsection