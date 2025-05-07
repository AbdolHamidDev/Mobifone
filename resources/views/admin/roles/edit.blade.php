@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Chỉnh sửa vai trò"/>

<div class="card">
    <div class="card-header">
        <h4>Chỉnh sửa vai trò: {{ $role->display_name }}</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-3">
                <label for="name" class="form-label">Tên vai trò (system)</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                <small class="text-muted">Tên dùng trong hệ thống (viết liền không dấu, ví dụ: admin, manager)</small>
            </div>
            
            <div class="form-group mb-3">
                <label for="display_name" class="form-label">Tên hiển thị</label>
                <input type="text" name="display_name" class="form-control" value="{{ old('display_name', $role->display_name) }}" required>
                <small class="text-muted">Tên hiển thị cho người dùng (ví dụ: Quản trị viên)</small>
            </div>
            
            <div class="form-group mb-3">
                <label class="form-label">Quyền hạn</label>
                @foreach($permissions as $group => $items)
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">{{ $group }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($items as $permission)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="permissions[]" 
                                           value="{{ $permission->id }}"
                                           id="perm_{{ $permission->id }}"
                                           @if(in_array($permission->id, $rolePermissions)) checked @endif>
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ $permission->display_name ?? $permission->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>
@endsection