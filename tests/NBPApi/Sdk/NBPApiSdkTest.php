<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\Tests\NBPApi\Sdk;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Client\ApiClientInterface;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Enum\Table;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Sdk\NBPApiSdk;

#[CoversClass(NBPApiSdk::class)]
final class NBPApiSdkTest extends TestCase
{
    public function testFetchExchangeRates(): void
    {
        $expectedDate = '2024-04-18';
        $table = Table::A;
        $date = \DateTime::createFromFormat('Y-m-d', $expectedDate);
        $expectedPath = 'exchangerates/tables/a/2024-04-18';
        $returnedData = [[
            'rates' => [[
                'currency' => 'Polski złoty',
                'code' => 'PLN',
                'mid' => 1.00,
            ]],
        ]];

        $apiClient = $this->createMock(ApiClientInterface::class);

        $SUT = new NBPApiSdk($apiClient);

        $apiClient->expects($this->once())
            ->method('get')
            ->with($expectedPath)
            ->willReturn($returnedData)
        ;

        $this->assertCount(1, iterator_to_array($SUT->fetchExchangeRates($table, $date)));
    }
}
