<?php

declare(strict_types=1);

namespace SunnyFlail\ExchangeRateFetcher\App\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use SunnyFlail\ExchangeRateFetcher\App\Entity\Currency;
use SunnyFlail\ExchangeRateFetcher\App\Repository\CurrencyRepositoryInterface;

final class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Currency $currency): void
    {
        if (!$this->entityManager->contains($currency)) {
            $this->entityManager->persist($currency);
        }

        $this->entityManager->flush();
    }

    public function findCurrencyByCode(string $code): ?Currency
    {
        return $this->entityManager->createQueryBuilder()
            ->select('curr')
            ->from(Currency::class, 'curr')
            ->where('curr.currencyCode = :code')
            ->setParameter('code', $code)
            ->setMaxResults(1)
            ->getQuery()
            ->execute()[0] ?? null
        ;
    }
}
