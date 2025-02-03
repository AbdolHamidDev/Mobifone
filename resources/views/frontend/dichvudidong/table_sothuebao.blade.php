
    @forelse($soThueBao as $so)
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
    @empty
        <tr>
            <td colspan="5" class="text-center">Không tìm thấy số thuê bao nào</td>
        </tr>
    @endforelse

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