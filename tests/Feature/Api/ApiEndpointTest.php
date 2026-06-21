<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Goicuoc;
use App\Models\GoiData;

class ApiEndpointTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function api_goicuoc_returns_json(): void
    {
        $response = $this->get('/api/goicuoc');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'price',
                'description',
            ],
        ]);
    }

    /** @test */
    public function api_goidata_returns_json(): void
    {
        $response = $this->get('/api/goidata');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'price',
                'data_amount',
            ],
        ]);
    }

    /** @test */
    public function api_goicuoc_returns_paginated_results(): void
    {
        Goicuoc::factory(25)->create();

        $response = $this->get('/api/goicuoc');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'current_page',
            'data',
            'total',
            'per_page',
        ]);
    }

    /** @test */
    public function api_goicuoc_can_be_filtered_by_type(): void
    {
        $response = $this->get('/api/goicuoc?type=prepaid');

        $response->assertStatus(200);
    }

    /** @test */
    public function api_goidata_can_be_filtered_by_price_range(): void
    {
        $response = $this->get('/api/goidata?min_price=10000&max_price=50000');

        $response->assertStatus(200);
    }

    /** @test */
    public function api_quoc_gia_returns_countries(): void
    {
        $response = $this->get('/api/quoc-gia');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'code',
            ],
        ]);
    }

    /** @test */
    public function api_cuoc_quoc_te_returns_international_rates(): void
    {
        $response = $this->get('/api/cuoc-quoc-te');

        $response->assertStatus(200);
    }

    /** @test */
    public function api_get_countries_returns_voip_countries(): void
    {
        $response = $this->get('/api/get-countries');

        $response->assertStatus(200);
    }

    /** @test */
    public function api_get_rates_returns_voip_rates(): void
    {
        $response = $this->get('/api/get-rates');

        $response->assertStatus(200);
    }

    /** @test */
    public function api_package_summary_returns_statistics(): void
    {
        $response = $this->get('/api/package-summary');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'total_packages',
            'total_data_packages',
            'total_sim',
        ]);
    }

    /** @test */
    public function unauthenticated_user_cannot_access_protected_api(): void
    {
        $response = $this->get('/api/khachhang/goicuoc');

        $response->assertStatus(401);
    }

    /** @test */
    public function authenticated_user_can_access_protected_api(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
                         ->get('/api/khachhang/goicuoc');

        $response->assertStatus(200);
    }
}