@php
    $statusConfig = [
        'giu_so' => [
            'class' => 'bg-success',
            'icon' => 'fa-check-circle',
            'text' => 'Giữ số',
            'tooltip' => 'Số thuê bao đang được giữ lại, chưa sử dụng'
        ],
        'chua_su_dung' => [
            'class' => 'bg-warning text-dark',
            'icon' => 'fa-clock',
            'text' => 'Đang chờ sử dụng',
            'tooltip' => 'Số thuê bao chưa được sử dụng, đang chờ kích hoạt'
        ],
        'hoa_mang' => [
            'class' => 'bg-primary',
            'icon' => 'fa-signal',
            'text' => 'Hòa mạng thành công',
            'tooltip' => 'Số thuê bao đã được kích hoạt thành công'
        ],
        'default' => [
            'class' => 'bg-secondary',
            'icon' => 'fa-question-circle',
            'text' => 'Không xác định',
            'tooltip' => 'Trạng thái không xác định, vui lòng kiểm tra lại'
        ]
    ];

    $config = $statusConfig[$status] ?? $statusConfig['default'];
@endphp

<span class="badge {{ $config['class'] }} py-2 px-3" 
      data-bs-toggle="tooltip" title="{{ $config['tooltip'] }}">
    <i class="fas {{ $config['icon'] }} me-1"></i> {{ $config['text'] }}
</span>