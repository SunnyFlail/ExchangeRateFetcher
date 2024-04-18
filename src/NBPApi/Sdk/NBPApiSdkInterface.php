<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\NBPApi\Sdk;

use SunnyFlail\ExchangeRateFetcher\NBPApi\Enum\Table;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Response\ExchangeRate;

interface NBPApiSdkInterface
{
    /**
     * @return iterable<ExchangeRate>
     */
    public function fetchExchangeRates(Table $table, \DateTimeInterface $date): iterable;
}
