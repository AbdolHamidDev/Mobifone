@extends('layouts.admin')

@section('content')
<x-layout.content-header title="chat" />

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Danh sách khách hàng</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover border">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Số điện thoại</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conversations as $conversation)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="text-center">{{ $conversation->phone }}</td>
                                <td class="text-center">
                                    <a href="{{ route('chat.admin.messages', $conversation->id) }}" 
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-comments"></i> Xem tin nhắn
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
