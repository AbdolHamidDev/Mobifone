@extends('layouts.admin')

@section('content')
    <x-layout.content-header title="Chỉnh sửa người dùng"/>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên người dùng</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Vai trò</label>
            <select class="form-select" id="role_id" name="role_id[]" multiple required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" 
                        @if($user->roles->contains($role->id)) selected @endif>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
