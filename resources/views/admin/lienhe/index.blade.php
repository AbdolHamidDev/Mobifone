@extends('layouts.admin')

@section('content')
<div class="container">
    <x-layout.content-header name="Danh sách" key="Liên hệ" />

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Danh sách liên hệ</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Họ và Tên</th>
                            <th>Email</th>
                            <th>Số Điện Thoại</th>
                            <th>Lý Do</th>
                            <th>Nội dung</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->reason }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}">
                                    Xem nội dung
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="messageModalLabel{{ $contact->id }}">Nội dung liên hệ</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $contact->message }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($contact->status)
                                    <span class="badge bg-success">Đã Liên Hệ</span>
                                @else
                                    <span class="badge bg-warning">Chưa Liên Hệ</span>
                                @endif
                            </td>
                            <td>
                                @if (!$contact->status)
                                <form action="{{ route('contact.updateStatus', $contact->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-primary">Đánh dấu đã liên hệ</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-end">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
