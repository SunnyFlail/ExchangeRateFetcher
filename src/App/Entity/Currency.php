<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Entity;

use SunnyFlail\ExchangeRateFetcher\App\Uuid\Uuid;

final class Currency
{
    private function __construct(
        private string $id,
        private string $name,
        private string $currencyCode,
        private ?int $exchangeRate
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getExchangeRate(): ?int
    {
        return $this->exchangeRate;
    }

    public function setExchangeRate(int $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    public static function create(
        Uuid $uuid,
        string $name,
        string $currencyCode,
        ?int $exchangeRate = null
    ): Currency {
        return new Currency($uuid->__toString(), $name, $currencyCode, $exchangeRate);
    }
}
