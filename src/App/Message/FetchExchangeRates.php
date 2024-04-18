
<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Message;

use SunnyFlail\ExchangeRateFetcher\NBPApi\Enum\Table;

final readonly class FetchExchangeRates implements MessageInterface
{
    public function __construct(public Table $table, public \DateTimeInterface $date)
    {
    }
}
