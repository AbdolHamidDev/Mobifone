<tr id="row-{{ $type->id }}">
    <td>
        <img src="{{ asset('storage/' . $type->image) }}" alt="{{ $type->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
    </td>
    <td>{{ $type->name }}</td>
    <td>{{ $type->title }}</td>
    <td>{{ $type->subscription_category }}</td>
    <td>
        <span class="badge bg-{{ $type->is_approved ? 'success' : 'warning' }}">
            {{ $type->is_approved ? 'Đã duyệt' : 'Chưa duyệt' }}
        </span>
    </td>
    <td>
        <a href="{{ route('loaithuebao.index', ['subscriptionTypeId' => $type->id]) }}" class="btn btn-link text-primary">
            <i class="fas fa-info-circle"></i> Xem
        </a>
    </td>
    <td>
        <button class="btn btn-warning btn-sm edit-btn me-2" data-id="{{ $type->id }}">
            <i class="fas fa-edit"></i> Sửa
        </button>
        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $type->id }}">
            <i class="fas fa-trash"></i> Xóa
        </button>
    </td>
</tr>
