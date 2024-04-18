<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Normalizer;

interface ExchangeRateNormalizerInterface
{
    public function normalizeExchangeRate(float $exchangeRate): int;
}
