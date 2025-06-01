<?php

namespace Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tracking;

class TrackingApiTest extends TestCase
{
    const BASE_URL = '/api/track';

    use RefreshDatabase;

    public function test_can_track_existing_package()
    {
        /*$trackingData = Tracking::factory()->count(1)->create([
            'role' => 'admin', // override just this field
        ]);*/
        Tracking::create([
            'tracking_code' => 'TEST123456789',
            'estimated_delivery_date' => '2025-06-15',
            'status' => 'in_transit',
            'carrier' => 'Test Carrier'
        ]);

        $response = $this->getJson(self::BASE_URL . '?' . http_build_query(
            [
                'tracking_code' => 'TEST123456789',
            ]
        ));

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'tracking_code' => "TEST123456789",
                    'estimated_delivery_date' => "2025-06-15",
                    'status' => "in_transit",
                    'carrier' => "Test Carrier",
                    'origin' => null,
                    'destination' => null
                ]
            ]);
    }

    public function test_returns_404_for_non_existent_tracking_code()
    {
        $response = $this->getJson(self::BASE_URL . '?' . http_build_query(
            [
                'tracking_code' => 'NONEXISTENT',
            ]
        ));

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'Tracking code not found.'
            ]);
    }

    public function test_validates_tracking_code_format()
    {
        $response = $this->getJson(self::BASE_URL . '?' . http_build_query(
            [
                'tracking_code' => 'short',
            ]
        ));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['tracking_code']);
    }
}
