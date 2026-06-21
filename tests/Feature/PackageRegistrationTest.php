<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Goicuoc;

class PackageRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_package_list(): void
    {
        $response = $this->get('/goicuoc');

        $response->assertStatus(200);
        $response->assertViewHas('goicuocs');
    }

    /** @test */
    public function user_can_view_package_details(): void
    {
        $package = Goicuoc::factory()->create();

        $response = $this->get("/goicuoc/{$package->id}");

        $response->assertStatus(200);
        $response->assertViewHas('goicuoc', $package);
    }

    /** @test */
    public function user_can_filter_packages_by_type(): void
    {
        $response = $this->get('/goicuoc?type=prepaid');

        $response->assertStatus(200);
    }

    /** @test */
    public function guest_cannot_register_package(): void
    {
        $package = Goicuoc::factory()->create();

        $response = $this->post("/goicuoc/{$package->id}/register", [
            'phone' => '0909123456',
        ]);

        $response->assertRedirect('/otp-login');
    }

    /** @test */
    public function authenticated_user_can_register_package(): void
    {
        $user = User::factory()->create();
        $package = Goicuoc::factory()->create();

        $response = $this->actingAs($user)->post("/goicuoc/{$package->id}/register", [
            'phone' => '0909123456',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('package_registrations', [
            'user_id' => $user->id,
            'goicuoc_id' => $package->id,
        ]);
    }
}