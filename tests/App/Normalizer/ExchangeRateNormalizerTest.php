<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\Tests\App\Normalizer;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use SunnyFlail\ExchangeRateFetcher\App\Normalizer\ExchangeRateNormalizer;

#[CoversClass(ExchangeRateNormalizer::class)]
final class ExchangeRateNormalizerTest extends TestCase
{
    public static function dataNormalize(): iterable
    {
        yield 'Small float' => [
            'exchangeRate' => 0.0005,
            'expected' => 5,
        ];

        yield 'Less than treshold' => [
            'exchangeRate' => 1.00004,
            'expected' => 10000,
        ];

        yield 'Over the treshold' => [
            'exchangeRate' => 2.00007,
            'expected' => 20001
        ];
    }

    #[DataProvider('dataNormalize')]
    public function testNormalize(float $exchangeRate, int $expected): void
    {
        $SUT = new ExchangeRateNormalizer();

        $result = $SUT->normalizeExchangeRate($exchangeRate);

        $this->assertSame($expected, $result);
    }
}
