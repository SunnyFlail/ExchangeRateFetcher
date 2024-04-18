<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\NBPApi\Client;

interface ApiClientInterface
{
    /**
     * @throws ClientException
     */
    public function get(string $path, array $options = []): array;
}
