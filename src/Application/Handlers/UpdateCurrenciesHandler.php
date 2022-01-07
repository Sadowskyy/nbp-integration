<?php
declare(strict_types=1);

namespace App\Application\Handlers;

use App\Domain\CurrencyApiIntegration;
use App\Domain\CurrencyRepository;

class UpdateCurrenciesHandler
{

    public function __construct(private CurrencyApiIntegration $apiIntegration,
                                private CurrencyRepository $currencyRepository)
    {
    }

    public function updateCurrencies(): void
    {
        $currencies = $this->apiIntegration->getData();

        $this->currencyRepository->updateCurrencies($currencies);
    }
}