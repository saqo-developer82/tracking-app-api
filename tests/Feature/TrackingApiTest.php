<?php

namespace Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tracking;
use Illuminate\Support\Facades\Storage;

class TrackingApiTest extends TestCase
{
    use RefreshDatabase;

    const BASE_URL = '/api/track';

    /**
     * Indicates whether the CSV driver is being used for tracking data storage.
     *
     * @var bool
     */
    private bool $isCsvDriver;

    /**
     * @var string
     */
    private string $testCsvPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->isCsvDriver = config('tracking.storage_driver') === 'csv';

        if ($this->isCsvDriver) {
            $this->testCsvPath = 'test_tracking_data.csv';
            config(['tracking.csv_file' => $this->testCsvPath]);
        }
    }

    public function test_can_track_existing_package()
    {
        if (! $this->isCsvDriver) {
            Tracking::create([
                'tracking_code' => 'TEST123456789',
                'estimated_delivery_date' => '2025-06-15',
                'status' => 'in_transit',
                'carrier' => 'Test Carrier'
            ]);
        }

        $response = $this->getJson(self::BASE_URL . '?' . http_build_query([
            'tracking_code' => 'TEST123456789',
            'testing_key' => config('app.testing_key'),
        ]));

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Tracking information retrieved successfully.'
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

    /**
     * Perform clean-up operations after each test case.
     *
     * This method checks for the existence of the test CSV file, when using the CSV driver,
     * and deletes it if it exists. It then invokes the parent's
     * tearDown method to execute additional clean-up operations.
     */
    protected function tearDown(): void
    {
        // Clean up test file
        if ($this->isCsvDriver && file_exists(Storage::path($this->testCsvPath))) {
            unlink(Storage::path($this->testCsvPath));
        }

        parent::tearDown();
    }
}
