<?php

namespace App\Repositories\Contracts;

interface TrackingRepositoryInterface
{
    public function findByTrackingCode(string $trackingCode): ?array;
}
