<?php

namespace App\Constants;

class TrackingCarriers
{
    const DHL = 'DHL';
    const FEDEX = 'FedEx';
    const UPS = 'UPS';
    const USPS = 'USPS';
    const AMAZON_LOGISTICS = 'Amazon Logistics';
    const FEDEX_EXPRESS = 'FedEx Express';

    /**
     * @return string[]
     */
    public static function all(): array
    {
        return [
            self::DHL,
            self::FEDEX,
            self::UPS,
            self::USPS,
            self::AMAZON_LOGISTICS,
            self::FEDEX_EXPRESS,
        ];
    }
}
