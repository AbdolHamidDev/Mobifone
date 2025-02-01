


<table class="table table-hover align-middle">
    <thead class="bg-primary text-white">
        <tr>
            <th>Số thuê bao</th>
            <th>Loại thuê bao</th>
            <th>Khu vực hòa mạng</th>
            <th>Phí hòa mạng</th>
            <th class="text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($soThueBao as $so)
            @if($so->trang_thai === 'chua_su_dung') {{-- Chỉ hiển thị số thuê bao có trạng thái chua_su_dung --}}
                <tr>
                    <td>{{ $so->so_thue_bao }}</td>
                    <td>{{ $so->loai_thue_bao == 'tra_truoc' ? 'Trả trước' : 'Trả sau' }}</td>
                    <td>
                        {{ $so->khu_vuc }}
                        <span 
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            title="Khu vực 28 MobiFone&#10;• {{ $so->khu_vuc }}"
                            class="custom-tooltip-icon"
                        >
                            <i class="fas fa-info-circle"></i>
                        </span>
                    </td>
                    <td>{{ number_format($so->phi_hoa_mang) }}đ</td>
                    <td class="text-center">
                        <a href="{{ route('frontend.dichvudidong.chitiet', ['id' => $so->id]) }}" class="btn btn-primary btn-sm">
                            chọn
                        </a>
                    </td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="5" class="text-center">Không tìm thấy số thuê bao nào</td>
            </tr>
        @endforelse
    </tbody>
    
</table>
<div id="pagination-container">
    {{ $soThueBao->links() }}
</div>


@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            customClass: 'custom-tooltip', // Áp dụng CSS tùy chỉnh
            placement: 'top'
        });
    });
});

</script>



@endsection