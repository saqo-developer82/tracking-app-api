<?php

namespace App\Repositories;

use App\Repositories\Contracts\TrackingRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class CsvTrackingRepository implements TrackingRepositoryInterface
{
    private string $csvFile;

    public function __construct()
    {
        $this->csvFile = config('tracking.csv_file');
        $this->ensureCsvExists();
    }

    /**
     * Retrieves the tracking details based on the given tracking code.
     *
     * This method reads a CSV file specified by the $csvFile property
     * and searches for a row that matches the provided tracking code.
     * If found, it returns the tracking details as an associative array.
     * If the CSV file does not exist or the tracking code is not found,
     * it returns null.
     *
     * @param string $trackingCode The tracking code to search for in the CSV file.
     * @return array|null An associative array of tracking details, or null if not found.
     */
    public function findByTrackingCode(string $trackingCode): ?array
    {
        if (!Storage::exists($this->csvFile)) {
            return null;
        }

        $csvContent = Storage::get($this->csvFile);
        $lines = explode("\n", $csvContent);

        // Skip header row
        foreach ($lines as $i => $line) {
            if ($i === 0) {
                continue;
            }

            $data = str_getcsv($line);
            if ($data[0] === $trackingCode) {
                return [
                    'tracking_code' => $data[0],
                    'estimated_delivery_date' => $data[1],
                    'status' => $data[2],
                    'carrier' => $data[3] ?? null,
                    'origin' => $data[4] ?? null,
                    'destination' => $data[5] ?? null
                ];
            }
        }

        return null;
    }

    /**
     * Ensures the existence of a CSV file in storage.
     * If the file does not exist, it creates the file, adds a header row,
     * and populates it with sample data entries.
     */
    private function ensureCsvExists(): void
    {
        if (!Storage::exists($this->csvFile)) {
            $header = "tracking_code,estimated_delivery_date,status,carrier,origin,destination";
            Storage::put($this->csvFile, $header);

            // Add some sample data
            $sampleData = $this->getSampleData();

            foreach ($sampleData as $data) {
                Storage::append($this->csvFile, $data);
            }
        }
    }

    /**
     * Retrieves sample data rows for the CSV file based on the request key value.
     * If the provided testing key matches the application's testing key,
     * a single test entry is returned. Otherwise, a default set of sample entries is provided.
     *
     * @return array Returns an array of sample data rows for the CSV file.
     */
    protected function getSampleData(): array
    {
        return request()->get('testing_key', '') == config('app.testing_key') ?
            ["TEST123456789,2024-06-15,in_transit,Test Carrier"] :
            [
                "TRK123456789,2024-06-15,in_transit,DHL,New York,Los Angeles",
                "TRK987654321,2024-06-12,delivered,FedEx,Chicago,Miami",
                "TRK456789123,2024-06-18,processing,UPS,Seattle,Denver"
            ];
    }
}
