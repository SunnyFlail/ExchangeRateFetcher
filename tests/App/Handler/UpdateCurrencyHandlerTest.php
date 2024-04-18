<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\Tests\App\Handler;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use SunnyFlail\ExchangeRateFetcher\App\Entity\Currency;
use SunnyFlail\ExchangeRateFetcher\App\Handler\UpdateCurrencyHandler;
use SunnyFlail\ExchangeRateFetcher\App\Infrastructure\Symfony\Uuid\UuidGenerator;
use SunnyFlail\ExchangeRateFetcher\App\Message\UpdateCurrency;
use SunnyFlail\ExchangeRateFetcher\App\Normalizer\ExchangeRateNormalizer;
use SunnyFlail\ExchangeRateFetcher\App\Repository\CurrencyRepositoryInterface;
use SunnyFlail\ExchangeRateFetcher\App\Uuid\Uuid;

#[CoversClass(UpdateCurrencyHandler::class)]
final class UpdateCurrencyHandlerTest extends TestCase
{
    public static function dataHandle(): iterable
    {
        yield 'New currency' => [
            'currencyName' => 'Złote polskie',
            'currencyCode' => 'PLN',
            'exchangeRate' => 1.0,
        ];

        yield 'Existing currency' => [
            'currencyName' => 'EURO',
            'currencyCode' => 'EUR',
            'exchangeRate' => 1.0,
            Currency::create(
                new Uuid('a6836d4f-7356-42e8-8404-d8506029c1d6'),
                'EURO',
                'EUR'
            ),
        ];
    }

    #[DataProvider('dataHandle')]
    public function testHandle(
        string $currencyName,
        string $currencyCode,
        float $exchangeRate,
        ?Currency $currency = null
    ): void {
        $currencyRepository = $this->createMock(CurrencyRepositoryInterface::class);
        $uuidGenerator = new UuidGenerator();
        $exchangeRateNormalizer = new ExchangeRateNormalizer();

        $message = new UpdateCurrency($currencyName, $currencyCode, $exchangeRate);

        $SUT = new UpdateCurrencyHandler(
            $currencyRepository,
            $uuidGenerator,
            $exchangeRateNormalizer
        );

        $currencyRepository
            ->expects($this->once())
            ->method('findCurrencyByCode')
            ->willReturn($currency)
        ;

        $SUT->__invoke($message);
    }
}
