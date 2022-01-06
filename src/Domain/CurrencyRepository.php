<?php
declare(strict_types=1);

namespace App\Domain;

interface CurrencyRepository
{
    public function save(Currency $currency): void;
    public function findAll(): array;
}