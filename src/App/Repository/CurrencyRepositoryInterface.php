<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Repository;

use SunnyFlail\ExchangeRateFetcher\App\Entity\Currency;

interface CurrencyRepositoryInterface
{
    public function save(Currency $currency): void;

    public function findCurrencyByCode(string $code): ?Currency;
}
