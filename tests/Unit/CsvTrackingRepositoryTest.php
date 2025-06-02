<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\CsvTrackingRepository;
use App\Constants\TrackingStatuses;

class CsvTrackingRepositoryTest extends TestCase
{
    private CsvTrackingRepository $repository;
    private string $testCsvPath;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a temporary CSV file for testing
        $this->testCsvPath = storage_path('app/test_tracking.csv');
        config(['tracking.csv_file' => $this->testCsvPath]);

        $this->repository = new CsvTrackingRepository();
    }

    /**
     * Perform clean-up operations after each test case.
     *
     * This method checks for the existence of the test CSV file
     * and deletes it if it exists. It then invokes the parent's
     * tearDown method to execute additional clean-up operations.
     */
    protected function tearDown(): void
    {
        // Clean up test file
        if (file_exists($this->testCsvPath)) {
            unlink($this->testCsvPath);
        }
        parent::tearDown();
    }

    public function test_find_by_tracking_code_returns_correct_data(): void
    {
        // Act
        $result = $this->repository->findByTrackingCode('TRK123456789');

        // Assert
        $this->assertNotNull($result);
        $this->assertEquals('TRK123456789', $result['tracking_code']);
        $this->assertEquals(TrackingStatuses::IN_TRANSIT, $result['status']);
        $this->assertEquals('DHL', $result['carrier']);
    }
}
