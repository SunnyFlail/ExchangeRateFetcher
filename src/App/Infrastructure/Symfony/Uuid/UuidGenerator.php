<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Infrastructure\Symfony\Uuid;

use SunnyFlail\ExchangeRateFetcher\App\Uuid\Uuid;
use SunnyFlail\ExchangeRateFetcher\App\Uuid\UuidGeneratorInterface;
use Symfony\Component\Uid\UuidV4;

final class UuidGenerator implements UuidGeneratorInterface
{
    public function generateUuid(): Uuid
    {
        return new Uuid(UuidV4::v4()->toRfc4122());
    }
}
