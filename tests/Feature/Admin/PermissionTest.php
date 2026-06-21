<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_admin_panel(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/otp-login');
    }

    /** @test */
    public function authenticated_user_without_permission_cannot_access_admin(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_access_admin_panel(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_manage_packages(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/admin/goicuoc');

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_manage_sim_inventory(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/admin/sim');

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_view_orders(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/admin/orders');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_with_specific_permission_can_access_module(): void
    {
        $user = User::factory()->create();
        $permission = Permission::create(['name' => 'manage packages', 'guard_name' => 'web']);
        $role = Role::create(['name' => 'package_manager', 'guard_name' => 'web']);
        $role->givePermissionTo($permission);
        $user->assignRole('package_manager');

        $response = $this->actingAs($user)->get('/admin/goicuoc');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_without_specific_permission_cannot_access_module(): void
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'viewer', 'guard_name' => 'web']);
        $user->assignRole('viewer');

        $response = $this->actingAs($user)->get('/admin/goicuoc');

        $response->assertStatus(403);
    }
}