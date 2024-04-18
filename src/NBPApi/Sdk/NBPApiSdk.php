<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\NBPApi\Sdk;

use SunnyFlail\ExchangeRateFetcher\NBPApi\Client\ApiClientInterface;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Enum\Table;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Response\ExchangeRate;

final class NBPApiSdk implements NBPApiSdkInterface
{
    private const DATE_FORMAT = 'Y-m-d';

    public function __construct(private ApiClientInterface $apiClient)
    {
    }

    public function fetchExchangeRates(Table $table, \DateTimeInterface $date): iterable
    {
        $response = $this->apiClient->get(sprintf(
            'exchangerates/tables/%s/%s',
            $table->value,
            $date->format(self::DATE_FORMAT)
        ));

        $response = array_pop($response);
        $rates = $response['rates'] ?? [];

        foreach ($rates as $rate) {
            yield ExchangeRate::fromApiResponse($rate);
        }
    }
}
