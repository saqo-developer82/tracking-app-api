<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\SqliteTrackingRepository;
use App\Models\Tracking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Constants\{
    TrackingCarriers,
    TrackingStatuses
};

class SqliteTrackingRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private SqliteTrackingRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new SqliteTrackingRepository();
    }

    /**
     * Tests if the repository method correctly retrieves data by tracking code.
     *
     * This test covers the scenario where a tracking record is created with a
     * specific tracking code, status, and carrier. The method is then invoked
     * with the same tracking code, and the returned data is validated to ensure
     * it matches the expected values.
     */
    public function test_find_by_tracking_code_returns_correct_data(): void
    {
        // Arrange
        $trackingCode = Tracking::factory()->create([
            'tracking_code' => 'TRK123456789',
            'status' => TrackingStatuses::IN_TRANSIT,
            'carrier' => TrackingCarriers::DHL
        ]);

        // Act
        $result = $this->repository->findByTrackingCode('TRK123456789');

        // Assert
        $this->assertNotNull($result);
        $this->assertEquals('TRK123456789', $result['tracking_code']);
        $this->assertEquals(TrackingStatuses::IN_TRANSIT, $result['status']);
        $this->assertEquals(TrackingCarriers::DHL, $result['carrier']);
    }
}
