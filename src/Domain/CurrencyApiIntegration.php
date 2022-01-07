<?php
declare(strict_types=1);

namespace App\Domain;

interface CurrencyApiIntegration
{
    public const API = 'http://api.nbp.pl/api/exchangerates/tables/a';
    public function getData(): array;
}