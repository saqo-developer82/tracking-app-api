<?php

namespace App\Repositories;

use App\Models\Tracking;
use App\Repositories\Contracts\TrackingRepositoryInterface;

class SqliteTrackingRepository implements TrackingRepositoryInterface
{
    /**
     * Retrieve tracking details based on the given tracking code.
     *
     * @param string $trackingCode The tracking code to search for.
     * @return array|null Returns an array with tracking details if found, otherwise null.
     */
    public function findByTrackingCode(string $trackingCode): ?array
    {
        $tracking = Tracking::where('tracking_code', $trackingCode)->first();

        if (!$tracking) {
            return null;
        }

        return [
            'tracking_code' => $tracking->tracking_code,
            'estimated_delivery_date' => $tracking->estimated_delivery_date->format('Y-m-d'),
            'status' => $tracking->status,
            'carrier' => $tracking->carrier,
            'origin' => $tracking->origin,
            'destination' => $tracking->destination
        ];
    }
}
