<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Infrastructure\Symfony\MessageBus;

use SunnyFlail\ExchangeRateFetcher\App\MessageBus\MessageBusException;
use SunnyFlail\ExchangeRateFetcher\App\MessageBus\MessageBusInterface;
use SunnyFlail\ExchangeRateFetcher\App\Message\MessageInterface;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface as SymfonyMessageBus;

final class MessageBus implements MessageBusInterface
{
    use HandleTrait;

    public function __construct(private SymfonyMessageBus $messageBus)
    {
    }

    public function dispatch(MessageInterface $message): void
    {
        try {
            $this->handle($message);
        } catch (TransportException $e) {
            $exception = $e->getPrevious() ?? $e;

            throw new MessageBusException($exception->getMessage(), 0, $exception);
        }
    }
}
