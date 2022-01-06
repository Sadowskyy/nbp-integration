<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory;

use App\Domain\Currency;
use App\Domain\CurrencyRepository;
use App\Domain\Exception\RecordAlreadyExists;

class CurrencyInMemoryRepository implements CurrencyRepository
{
    public function __construct(private array $storage)
    {
    }

    public function save(Currency $currency): void
    {
        if (array_key_exists($currency->getCurrencyCode(), $this->storage) === true) {
            throw RecordAlreadyExists::forCurrencyCode($currency->getCurrencyCode());
        }

        $this->storage[$currency->getCurrencyCode()] = $currency;
    }

    public function findAll(): array
    {
        return [
            'collection' => $this->storage
        ];
    }
}
