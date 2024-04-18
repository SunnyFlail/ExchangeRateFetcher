<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Infrastructure\Symfony\Cli;

use SunnyFlail\ExchangeRateFetcher\App\Message\FetchExchangeRates;
use SunnyFlail\ExchangeRateFetcher\App\MessageBus\MessageBusInterface;
use SunnyFlail\ExchangeRateFetcher\NBPApi\Enum\Table;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:fetch-currencies')]
final class FetchCurrenciesCommand extends Command
{
    public function __construct(private MessageBusInterface $messageBus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $style = new SymfonyStyle($input, $output);

        try {
            $this->messageBus->dispatch(new FetchExchangeRates(
                Table::A,
                new \DateTimeImmutable()
            ));
        } catch (\Throwable $e) {
            $style->error([
                'An exception occured while fetching currencies:',
                $e->getMessage(),
            ]);

            return Command::FAILURE;
        }

        $style->success('Successfully fetched currencies.');

        return Command::SUCCESS;
    }
}
