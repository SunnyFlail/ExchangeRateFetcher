<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\Tests\NBPApi\Sdk;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Sdk\NBPApiSdkInterface;

#[CoversClass(NBPApiSdkInterface::class)]
final class NBPApiSdkTest extends TestCase
{
    public function testFetchExchangeRates(): void
    {

    }
}
