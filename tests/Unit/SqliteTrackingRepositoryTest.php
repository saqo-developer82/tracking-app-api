<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\SqliteTrackingRepository;
use App\Models\Tracking;
use App\DTOs\TrackingInfoDto;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SqliteTrackingRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private SqliteTrackingRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new SqliteTrackingRepository();
    }

    public function test_find_by_tracking_code_returns_correct_data(): void
    {
        // Arrange
        $trackingCode = Tracking::factory()->create([
            'tracking_code' => 'TRK123456789',
            'status' => 'in_transit',
            'carrier' => 'DHL'
        ]);

        // Act
        $result = $this->repository->findByTrackingCode('TRK123456789');

        // Assert
        $this->assertNotNull($result);
        $this->assertEquals('TRK123456789', $result['tracking_code']);
        $this->assertEquals('in_transit', $result['status']);
        $this->assertEquals('DHL', $result['carrier']);
    }
}
