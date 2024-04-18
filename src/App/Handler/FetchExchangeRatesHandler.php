<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Handler;

use SunnyFlail\ExchangeRateFetcher\App\Message\FetchExchangeRates;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Sdk\NBPApiSdkInterface;

final class FetchExchangeRatesHandler implements MessageHandlerInterface
{
    public function __construct(private NBPApiSdkInterface $nbpApiSdk)
    {
    }

    public function __invoke(FetchExchangeRates $message): void
    {
        $exchangeRates = $this->nbpApiSdk->fetchExchangeRates($message->table, $message->date);
    }
}
