<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\MessageBus;

use SunnyFlail\ExchangeRateFetcher\App\Message\MessageInterface;

interface MessageBusInterface
{
    /**
     * @throws MessageBusException
     */
    public function dispatch(MessageInterface $message): void;
}
