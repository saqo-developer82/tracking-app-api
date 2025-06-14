<?php

namespace App\Constants;

class TrackingStatuses
{
    const PROCESSING = 'processing';
    const IN_TRANSIT = 'in_transit';
    const DELIVERED = 'delivered';
    const DELAYED = 'delayed';

    /**
     * @return array
     */
    public static function all(): array
    {
        return [
            self::PROCESSING,
            self::IN_TRANSIT,
            self::DELIVERED,
            self::DELAYED,
        ];
    }
}
