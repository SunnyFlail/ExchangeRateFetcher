<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\NBPApi\Response;

interface ResponseInterface
{
    public static function fromApiResponse(array $data): static;
}
