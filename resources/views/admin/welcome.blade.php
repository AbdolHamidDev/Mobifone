@extends('layouts.admin')

@section('content')
<x-layout.content-header title="welcome" />

    <div class="container">
        <h1>Chào mừng, {{ auth()->user()->name }}!</h1>

        @if(auth()->user()->hasRole('admin'))
            <p>Bạn có quyền truy cập vào trang <strong>Dashboard</strong> để quản lý hệ thống.</p>
        @else
            <p>Bạn là người dùng, bạn có thể quản lý các cài đặt cơ bản của mình.</p>
        @endif
        
    </div>
@endsection
