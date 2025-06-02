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

    /**
     * @return array
     */
    public static function getStatusesWithLabels(): array
    {
        return [
            self::PROCESSING => 'Processing',
            self::IN_TRANSIT => 'In Transit',
            self::DELIVERED => 'Delivered',
            self::DELAYED => 'Delayed',
        ];
    }
}
