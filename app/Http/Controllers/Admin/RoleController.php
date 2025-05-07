<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.roles.index', compact('roles'));
    }
    
    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($item) {
            return explode(' ', $item->name)[1]; // Nhóm theo resource (users, roles, posts)
        });
        return view('admin.roles.create', compact('permissions'));
    }
    
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:roles,name',
        'permissions' => 'array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    $role = Role::create(['name' => $request->name]);

    // Chuyển ID → model
    $permissions = Permission::whereIn('id', $request->permissions)->get();
    $role->syncPermissions($permissions);

    return redirect()->route('roles.index')->with('success', 'Role created successfully');
}
    
    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($item) {
            return explode(' ', $item->name)[1];
        });
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }
    
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:roles,name,'.$id,
        'display_name' => 'required|string|max:255',
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,id', // Đảm bảo validate bằng ID
    ]);

    $role = Role::findOrFail($id);
    $role->update([
        'name' => $request->name,
        'display_name' => $request->display_name,
    ]);
    
    // Lấy danh sách permission names từ IDs
    $permissionNames = Permission::whereIn('id', $request->permissions ?? [])
                                ->pluck('name')
                                ->toArray();
    
    $role->syncPermissions($permissionNames); // Sử dụng tên permission thay vì ID

    return redirect()->route('roles.index')
                   ->with('success', 'Vai trò đã được cập nhật thành công');
}
    
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully');
    }
}