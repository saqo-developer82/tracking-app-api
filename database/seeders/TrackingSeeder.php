<?php

namespace Database\Seeders;

use App\Models\Tracking;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Constants\{
    TrackingCarriers,
    TrackingStatuses
};

class TrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        Tracking::truncate();

        // Create specific test data
        $specificData = [
            [
                'tracking_code' => 'TRK123456789',
                'estimated_delivery_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'status' => TrackingStatuses::IN_TRANSIT,
                'carrier' => TrackingCarriers::DHL,
                'origin' => 'New York, NY',
                'destination' => 'Los Angeles, CA'
            ],
            [
                'tracking_code' => 'TRK567325339',
                'status' => TrackingStatuses::DELIVERED,
                'carrier' => TrackingCarriers::FEDEX,
                'origin' => 'Chicago, IL',
                'destination' => 'Philadelphia, PA'
            ],
            [
                'tracking_code' => 'TRK481003676',
                'estimated_delivery_date' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'status' => TrackingStatuses::PROCESSING,
                'carrier' => TrackingCarriers::UPS,
                'origin' => 'Fort Worth, TX',
                'destination' => 'Columbus, OH'
            ],
        ];

        foreach ($specificData as $data) {
            Tracking::factory()->create($data);
        }

        // Create random data
        Tracking::factory(20)->create();
        Tracking::factory(5)->delivered()->create();
        Tracking::factory(3)->inTransit()->create();
    }
}
