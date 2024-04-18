<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\Tests\NBPApi\Infrastructure\Symfony\Client;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Client\ClientException;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Infrastructure\Symfony\Client\JsonApiClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

#[CoversClass(JsonApiClient::class)]
final class JsonApiClientTest extends TestCase
{
    public function testGet(): void
    {
        $baseApiUrl = 'nbp.example.com/api';
        $client = $this->createMock(HttpClientInterface::class);
        $mockResponse = $this->createMock(ResponseInterface::class);

        $SUT = new JsonApiClient($baseApiUrl, $client);

        $client->expects($this->once())
            ->method('request')
            ->willReturn($mockResponse)
        ;
        $mockResponse->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200)
        ;
        $mockResponse->expects($this->once())
            ->method('getContent')
            ->willReturn('[{"rates":[{"currency":"Polski złoty","":"","mid":1.00}]}]')
        ;

        $SUT->get('/');
    }

    public function testGetThrows(): void
    {
        $baseApiUrl = 'nbp.example.com/api';
        $client = $this->createMock(HttpClientInterface::class);
        $mockResponse = $this->createMock(ResponseInterface::class);

        $SUT = new JsonApiClient($baseApiUrl, $client);

        $client->expects($this->once())
            ->method('request')
            ->willReturn($mockResponse)
        ;
        $mockResponse->expects($this->exactly(2))
            ->method('getStatusCode')
            ->willReturn(404)
        ;

        $this->expectException(ClientException::class);

        $SUT->get('/');
    }
}
