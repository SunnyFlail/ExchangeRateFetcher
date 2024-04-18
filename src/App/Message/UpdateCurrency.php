<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Message;

final readonly class UpdateCurrency implements MessageInterface
{
    public function __construct(
        public string $currencyName,
        public string $currencyCode,
        public float $exchangeRate
    ) {
    }
}
