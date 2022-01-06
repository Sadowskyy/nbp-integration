<?php
declare(strict_types=1);

namespace App\Application\Handlers;

use App\Domain\CurrencyRepository;

class GetCurrenciesHandler
{
    private CurrencyRepository $repository;

    public function __construct(CurrencyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getCurrencies(): array
    {
        return $this->repository->findAll();
    }
}