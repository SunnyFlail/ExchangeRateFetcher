<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\NBPApi\Infrastructure\Symfony\Client;

use SunnyFlail\ExchangeRateFetcher\NBPApi\Client\ApiClientInterface;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Client\ClientException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class JsonApiClient implements ApiClientInterface
{
    private string $baseApiUrl;

    public function __construct(string $baseApiUrl, private HttpClientInterface $client)
    {
        if (!str_ends_with($baseApiUrl, '/')) {
            $baseApiUrl .= '/';
        }

        $this->baseApiUrl = $baseApiUrl;
    }

    public function get(string $path, array $options = []): array
    {
        $response = $this->client->request(
            'GET',
            sprintf('%s%s', $this->baseApiUrl, $path),
            $this->buildOptions($options)
        );

        if (Response::HTTP_OK !== $response->getStatusCode()) {
            throw new ClientException($response->getStatusCode(), 'An error occurred while fetching data from api');
        }

        return json_decode($response->getContent(), true);
    }

    private function buildOptions(array $options): array
    {
        $options['headers'] = $options['headers'] ?? [];
        $options['headers']['Accept'] = 'application/json';

        return $options;
    }
}
