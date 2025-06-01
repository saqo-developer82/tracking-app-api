<?php

namespace Database\Seeders;

use App\Models\Tracking;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

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
                'status' => 'in_transit',
                'carrier' => 'DHL',
                'origin' => 'New York, NY',
                'destination' => 'Los Angeles, CA'
            ],
            [
                'tracking_code' => 'TRK567325339',
                'status' => 'delivered',
                'carrier' => 'FedEx',
                'origin' => 'Chicago, IL',
                'destination' => 'Philadelphia, PA'
            ],
            [
                'tracking_code' => 'TRK481003676',
                'estimated_delivery_date' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'status' => 'processing',
                'carrier' => 'UPS',
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
