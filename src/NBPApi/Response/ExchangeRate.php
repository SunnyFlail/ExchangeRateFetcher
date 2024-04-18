<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\NBPApi\Response;

final readonly class ExchangeRate implements ResponseInterface
{
    private function __construct(
        public string $currency,
        public string $code,
        public float $mid
    ) {
    }

    public static function fromApiResponse(array $data): static
    {
        return new ExchangeRate($data['currency'], $data['code'], $data['mid']);
    }
}
