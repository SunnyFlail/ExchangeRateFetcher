<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Uuid;

interface UuidGeneratorInterface
{
    public function generateUuid(): Uuid;
}
