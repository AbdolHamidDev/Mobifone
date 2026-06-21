<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\SoThueBao;

class SimPurchaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_sim_list(): void
    {
        $response = $this->get('/sim');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_filter_sim_by_prefix(): void
    {
        $response = $this->get('/sim?prefix=0909');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_filter_vip_sim(): void
    {
        $response = $this->get('/sim?type=vip');

        $response->assertStatus(200);
    }

    /** @test */
    public function guest_cannot_purchase_sim(): void
    {
        $sim = SoThueBao::factory()->create();

        $response = $this->post("/sim/{$sim->id}/order", [
            'name' => 'Test User',
            'phone' => '0909123456',
            'address' => 'Test Address',
        ]);

        $response->assertRedirect('/otp-login');
    }

    /** @test */
    public function authenticated_user_can_purchase_sim(): void
    {
        $user = User::factory()->create();
        $sim = SoThueBao::factory()->create(['status' => 'available']);

        $response = $this->actingAs($user)->post("/sim/{$sim->id}/order", [
            'name' => 'Test User',
            'phone' => '0909123456',
            'address' => 'Test Address',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'so_thue_bao_id' => $sim->id,
        ]);
    }

    /** @test */
    public function purchased_sim_status_changes_to_sold(): void
    {
        $user = User::factory()->create();
        $sim = SoThueBao::factory()->create(['status' => 'available']);

        $this->actingAs($user)->post("/sim/{$sim->id}/order", [
            'name' => 'Test User',
            'phone' => '0909123456',
            'address' => 'Test Address',
        ]);

        $this->assertDatabaseHas('so_thue_bao', [
            'id' => $sim->id,
            'status' => 'sold',
        ]);
    }

    /** @test */
    public function user_can_track_order_by_reference_code(): void
    {
        $user = User::factory()->create();
        $sim = SoThueBao::factory()->create(['status' => 'available']);

        $response = $this->actingAs($user)->post("/sim/{$sim->id}/order", [
            'name' => 'Test User',
            'phone' => '0909123456',
            'address' => 'Test Address',
        ]);

        $order = \App\Models\Order::where('user_id', $user->id)->first();
        
        $response = $this->get("/track-order/{$order->reference_code}");

        $response->assertStatus(200);
        $response->assertViewHas('order', $order);
    }
}