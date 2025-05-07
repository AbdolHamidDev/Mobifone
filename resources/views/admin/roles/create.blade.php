@extends('layouts.admin')

@section('content')
<x-layout.content-header title="Thêm vai trò mới"/>

<div class="card">
    <div class="card-header">
        <h4>{{ isset($role) ? 'Edit' : 'Create' }} Role</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}">
            @csrf
            @if(isset($role)) @method('PUT') @endif
            
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" class="form-control" value="{{ $role->name ?? old('name') }}" required>
            </div>
            
            <div class="form-group">
                <label>Permissions</label>
                @foreach($permissions as $resource => $perms)
                <div class="card mb-3">
                    <div class="card-header">{{ ucfirst($resource) }}</div>
                    <div class="card-body">
                        @foreach($perms as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="permissions[]" 
                                   value="{{ $permission->id }}"
                                   @if(isset($rolePermissions) && in_array($permission->id, $rolePermissions)) checked @endif>
                            <label class="form-check-label">{{ $permission->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection