<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Normalizer;

final class ExchangeRateNormalizer implements ExchangeRateNormalizerInterface
{
    public function normalizeExchangeRate(float $exchangeRate): int
    {
        return (int) ((float) number_format($exchangeRate, 4) * 10000);
    }
}
