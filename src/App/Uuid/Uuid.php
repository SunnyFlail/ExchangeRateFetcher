<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Uuid;

final class Uuid implements \Stringable
{
    public function __construct(private string $uuid)
    {
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}
