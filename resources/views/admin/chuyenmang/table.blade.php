
<table class="min-w-full table-auto">
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
