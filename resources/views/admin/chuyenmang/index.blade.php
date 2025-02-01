@extends('layouts.admin')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('content')
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'Đăng ký'])

@if(session('success'))
    <div class="alert alert-success mb-4">
        <strong>{{ session('success') }}</strong>
    </div>
@endif
<div class="mb-6 flex items-center space-x-4">
    <!-- Tìm kiếm theo số điện thoại -->
    <div class="relative w-1/2">
        <input type="text" id="search-phone" class="search-input border border-gray-300 p-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full pl-12 pr-12 transition-all duration-300 ease-in-out"
               placeholder="Tìm kiếm theo số điện thoại..." aria-label="Tìm kiếm theo số điện thoại">
        <!-- Biểu tượng kính lúp -->
        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 search-icon text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20" style="z-index: 1;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-7-7 7 7 0 017 7z"/>
        </svg>
        <!-- Nút Clear -->
        <button id="clear-phone" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none" style="z-index: 2;">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Tìm kiếm theo email -->
    <div class="relative w-1/2">
        <input type="text" id="search-email" class="search-input border border-gray-300 p-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full pl-12 pr-12 transition-all duration-300 ease-in-out"
               placeholder="Tìm kiếm theo email..." aria-label="Tìm kiếm theo email">
        <!-- Biểu tượng kính lúp -->
        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 search-icon text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20" style="z-index: 1;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-7-7 7 7 0 017 7z"/>
        </svg>
        <!-- Nút Clear -->
        <button id="clear-email" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none" style="z-index: 2;">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>


<!-- CSS cho hiệu ứng -->
<style>
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
    .focus\:ring-indigo-500:focus {
        ring-color: #6366f1;
    }
    .focus\:border-indigo-500:focus {
        border-color: #6366f1;
    }
    input::placeholder {
        padding-left: 24px;  /* Tăng khoảng cách của placeholder từ bên trái */
    }

    .search-input {
    position: relative;
}

.search-icon {
    transition: opacity 0.3s ease;
}

/* Ẩn kính lúp khi có dữ liệu trong input */
.search-input:not(:placeholder-shown) + .search-icon {
    opacity: 0;
}

</style>

<!-- JS cho nút clear -->
<script>
    document.getElementById('clear-phone').addEventListener('click', function() {
        document.getElementById('search-phone').value = '';
    });

    document.getElementById('clear-email').addEventListener('click', function() {
        document.getElementById('search-email').value = '';
    });
</script>


<div class="overflow-x-auto bg-white rounded-lg shadow-md mt-6">
    <table class="min-w-full table-auto">
        <thead class="bg-gradient-to-r from-purple-600 to-blue-500 text-white">
            <tr>
                <th class="py-3 px-4 text-left font-semibold text-sm">ID</th>
                <th class="py-3 px-4 text-left font-semibold text-sm">Họ tên</th>
                <th class="py-3 px-4 text-left font-semibold text-sm">Số điện thoại</th>
                <th class="py-3 px-4 text-left font-semibold text-sm">Email</th>
                <th class="py-3 px-4 text-left font-semibold text-sm">Tỉnh/Thành phố</th>
                <th class="py-3 px-4 text-left font-semibold text-sm">Quận/Huyện</th>
                <th class="py-3 px-4 text-left font-semibold text-sm">Xã/Phường</th>
                <th class="py-3 px-4 text-left font-semibold text-sm">Đã liên hệ</th>
                <th class="py-3 px-4 text-left font-semibold text-sm">Hỗ trợ thủ tục</th>
                <th class="py-3 px-4 text-left font-semibold text-sm">Nhận kết quả</th>
                <th class="py-3 px-4 text-left font-semibold text-sm">Giới thiệu</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($dangKys as $dangKy)
                <tr class="border-t hover:bg-gray-100">
                    <td class="py-3 px-4 text-sm">{{ $dangKy->id }}</td>
                    <td class="py-3 px-4 text-sm">{{ $dangKy->ho_ten }}</td>
                    <td class="py-3 px-4 text-sm">{{ $dangKy->so_dien_thoai }}</td>
                    <td class="py-3 px-4 text-sm">{{ $dangKy->email }}</td>
                    <td class="py-3 px-4 text-sm">{{ $provinceMap[$dangKy->tinh_thanh_pho] ?? 'Chưa xác định' }}</td>
                    <td class="py-3 px-4 text-sm">{{ $districtMap[$dangKy->quan_huyen] ?? 'Chưa xác định' }}</td>
                    <td class="py-3 px-4 text-sm">{{ $wardMap[$dangKy->xa_phuong] ?? 'Chưa xác định' }}</td>
                    <td class="py-3 px-4 text-sm fixed-width">
                        <button class="btn btn-sm btn-{{ $dangKy->da_lien_he ? 'success' : 'warning' }} toggle-lien-he" 
                                data-id="{{ $dangKy->id }}">
                            {{ $dangKy->da_lien_he ? 'Đã liên hệ' : 'Chưa liên hệ' }}
                        </button>
                    </td>
                    <td class="py-3 px-4 text-sm fixed-width">
                        <button class="btn btn-sm btn-{{ $dangKy->ho_tro_thu_tuc ? 'success' : 'warning' }} toggle-ho-tro-thu-tuc"
                                data-id="{{ $dangKy->id }}">
                            {{ $dangKy->ho_tro_thu_tuc ? 'Đã hỗ trợ' : 'Chưa hỗ trợ' }}
                        </button>
                    </td>
                    <td class="py-3 px-4 text-sm fixed-width">
                        <button class="btn btn-sm btn-{{ $dangKy->nhan_ket_qua ? 'success' : 'warning' }} toggle-nhan-ket-qua"
                                data-id="{{ $dangKy->id }}">
                            {{ $dangKy->nhan_ket_qua ? 'Đã nhận' : 'Chưa nhận' }}
                        </button>
                    </td>

                    <!-- Sử dụng Accessor -->
                    <td class="py-3 px-4 text-sm">
                        @if($dangKy->nguoi_gioi_thieu_ho_ten)
                            <button class="btn btn-sm btn-info show-intro" data-id="{{ $dangKy->id }}">Xem thông tin</button>
                            <!-- Dropdown với thông tin giới thiệu -->
                            <div id="intro-{{ $dangKy->id }}" class="intro-details hidden py-2 px-4 bg-gray-200 mt-2 rounded shadow">
                                <p><strong>Họ tên người giới thiệu:</strong> {{ $dangKy->nguoi_gioi_thieu_ho_ten }}</p>
                                <p><strong>Số điện thoại:</strong> {{ $dangKy->nguoi_gioi_thieu_so_dien_thoai }}</p>
                                <p><strong>Email:</strong> {{ $dangKy->nguoi_gioi_thieu_email }}</p>
                                <p><strong>Đơn vị:</strong> {{ $dangKy->nguoi_gioi_thieu_don_vi }}</p> <!-- Sử dụng Accessor -->
                                <p><strong>Cấp phòng:</strong> {{ $dangKy->nguoi_gioi_thieu_don_vi_cap_phong }}</p> <!-- Sử dụng Accessor -->
                            </div>
                        @else
                            Không có thông tin
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>
@endsection


<script>
 $(document).on('click', '.toggle-lien-he', function() {
    var dangKyId = $(this).data('id');  // Lấy ID từ thuộc tính data-id
    var button = $(this);
    
    $.ajax({
        url: '/admin/dang-ky/' + dangKyId + '/toggle-lien-he',  // Đảm bảo URL này trỏ đến route thích hợp
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',  // Token bảo mật CSRF
        },
        success: function(response) {
            // Cập nhật giao diện sau khi thay đổi trạng thái
            if (response.success) {
                if (response.da_lien_he == 1) {  // Nếu giá trị là 1, đổi sang Đã liên hệ
                    button.removeClass('btn-warning').addClass('btn-success');
                    button.text('Đã liên hệ');
                } else {  // Nếu giá trị là 0, đổi sang Chưa liên hệ
                    button.removeClass('btn-success').addClass('btn-warning');
                    button.text('Chưa liên hệ');
                }
            }
        },
        error: function() {
            alert('Có lỗi xảy ra!');
        }
    });
});

$(document).on('click', '.toggle-ho-tro-thu-tuc', function() {
    var dangKyId = $(this).data('id');
    var button = $(this);

    $.ajax({
        url: '/admin/dang-ky/' + dangKyId + '/toggle-ho-tro-thu-tuc',
        method: 'POST',
        data: { _token: '{{ csrf_token() }}' },
        success: function(response) {
            if (response.success) {
                if (response.ho_tro_thu_tuc == 1) {
                    button.removeClass('btn-warning').addClass('btn-success');
                    button.text('Đã hỗ trợ');
                } else {
                    button.removeClass('btn-success').addClass('btn-warning');
                    button.text('Chưa hỗ trợ');
                }
            }
        },
        error: function() {
            alert('Có lỗi xảy ra!');
        }
    });
});


// Xử lý khi nhấn vào nút "Nhận kết quả"
$(document).on('click', '.toggle-nhan-ket-qua', function() {
    var dangKyId = $(this).data('id');  // Lấy ID từ thuộc tính data-id
    var button = $(this);  // Lưu đối tượng nút bấm để cập nhật giao diện
    
    $.ajax({
        url: '/admin/dang-ky/' + dangKyId + '/toggle-nhan-ket-qua',  // Gọi đến route đã định nghĩa
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',  // CSRF token bảo mật
        },
        success: function(response) {
            // Cập nhật giao diện sau khi thay đổi trạng thái
            if (response.success) {
                if (response.nhan_ket_qua == 1) {  // Nếu trạng thái là đã nhận
                    button.removeClass('btn-warning').addClass('btn-success');
                    button.text('Đã nhận');
                } else {  // Nếu trạng thái là chưa nhận
                    button.removeClass('btn-success').addClass('btn-warning');
                    button.text('Chưa nhận');
                }
            }
        },
        error: function() {
            alert('Có lỗi xảy ra!');
        }
    });
});


$(document).ready(function() {
    // Sử dụng sự kiện delegated để bắt sự kiện trên các phần tử được thêm vào
    $(document).on('click', '.show-intro', function() {
        var dangKyId = $(this).data('id');
        var introDetailDiv = $('#intro-' + dangKyId);
        
        // Toggle sự hiển thị của thông tin giới thiệu
        introDetailDiv.toggleClass('hidden');
    });
});


$(document).ready(function() {
    // Hàm gửi yêu cầu AJAX khi người dùng nhập tìm kiếm
    function searchData() {
        var phone = $('#search-phone').val();
        var email = $('#search-email').val();

        $.ajax({
            url: '{{ route("admin.dangky.search") }}',  // Thêm route xử lý tìm kiếm
            method: 'GET',
            data: {
                phone: phone,
                email: email
            },
            success: function(response) {
                // Cập nhật danh sách trong bảng với dữ liệu mới
                $('tbody').html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }

    // Lắng nghe nhiều sự kiện trên ô tìm kiếm
    $('#search-phone, #search-email').on('input keyup change', function() {
        searchData();
    });

    // Xử lý trường hợp ô tìm kiếm bị xóa bằng cách nhấn nút "clear" (nếu có)
    $('#clear-phone').on('click', function() {
        $('#search-phone').val(''); // Xóa dữ liệu trong ô tìm kiếm
        searchData(); // Gửi lại yêu cầu AJAX để làm mới danh sách
    });

    $('#clear-email').on('click', function() {
        $('#search-email').val(''); // Xóa dữ liệu trong ô tìm kiếm
        searchData(); // Gửi lại yêu cầu AJAX để làm mới danh sách
    });
});

</script>
<style>
/* Cố định kích thước cho các cột chứa nút */
.fixed-width {
    width: 150px; /* Bạn có thể thay đổi giá trị này theo yêu cầu */
    text-align: center; /* Căn giữa các nút */
}

</style>

