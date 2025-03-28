<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\NBPApi\Client;

final class ClientException extends \Exception
{
    public function __construct(public readonly int $statusCode, string $message)
    {
        parent::__construct($message);
    }
}
