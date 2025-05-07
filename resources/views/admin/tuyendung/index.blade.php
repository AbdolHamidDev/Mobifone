@extends('layouts.admin')

@section('content')
<x-layout.content-header title="danh sách tuyển dụng" />
<div class="container mx-auto px-4 py-6">
    <a href="{{ route('tuyendung.create') }}" class="btn btn-primary mb-4">+ Tạo công việc mới</a>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive bg-white shadow rounded">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Vị trí</th>
                    <th>Mô tả</th>
                    <th>Yêu cầu</th>
                    <th>Lương</th>
                    <th>Thời gian ứng tuyển</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tuyendungs as $tuyendung)
                    <tr>
                        <td>{{ $tuyendung->id }}</td>
                        <td>{{ $tuyendung->vi_tri }}</td>
                        <td>{{ Illuminate\Support\Str::limit($tuyendung->mo_ta, 50) }}</td>
                        <td>{{ Illuminate\Support\Str::limit($tuyendung->yeu_cau, 50) }}</td>
                        <td>
                            {{ is_numeric($tuyendung->luong) ? number_format($tuyendung->luong) . ' đ' : ($tuyendung->luong ?? 'Liên hệ để biết thêm') }}
                        </td>
                        <td>
                            {{ $tuyendung->thoi_gian_ung_tuyen === '9999-12-31' ? 'Tuyển gấp' : \Carbon\Carbon::parse($tuyendung->thoi_gian_ung_tuyen)->format('d/m/Y') }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('tuyendung.edit', $tuyendung->id) }}" class="text-warning mx-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tuyendung.destroy', $tuyendung->id) }}" method="POST" class="d-inline delete-form" data-id="{{ $tuyendung->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-link text-danger p-0">
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
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.querySelector('button').addEventListener('click', () => {
            const id = form.getAttribute('data-id');
            if (confirm('Bạn có chắc chắn muốn xóa? Dữ liệu này sẽ không thể phục hồi!')) {
                form.submit();
            }
        });
    });
</script>
@endsection