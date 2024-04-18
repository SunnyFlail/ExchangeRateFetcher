<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Handler;

use SunnyFlail\ExchangeRateFetcher\App\Entity\Currency;
use SunnyFlail\ExchangeRateFetcher\App\Message\UpdateCurrency;
use SunnyFlail\ExchangeRateFetcher\App\Normalizer\ExchangeRateNormalizerInterface;
use SunnyFlail\ExchangeRateFetcher\App\Repository\CurrencyRepositoryInterface;
use SunnyFlail\ExchangeRateFetcher\App\Uuid\UuidGeneratorInterface;

final class UpdateCurrencyHandler implements MessageHandlerInterface
{
    public function __construct(
        private CurrencyRepositoryInterface $currencyRepository,
        private UuidGeneratorInterface $uuidGenerator,
        private ExchangeRateNormalizerInterface $currencyRateNormalizer
    ) {
    }

    public function __invoke(UpdateCurrency $message): void
    {
        $currency = $this->currencyRepository->findCurrencyByCode($message->currencyCode);

        if (!$currency) {
            $currency = Currency::create(
                $this->uuidGenerator->generateUuid(),
                $message->currencyName,
                $message->currencyCode
            );
        }

        $newExchangeRate = $this->currencyRateNormalizer->normalizeExchangeRate($message->exchangeRate);

        if ($newExchangeRate === $currency->getExchangeRate()) {
            return;
        }

        $currency->setExchangeRate($newExchangeRate);

        $this->currencyRepository->save($currency);
    }
}
