<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory;

use App\Domain\Currency;
use App\Domain\CurrencyRepository;
use App\Domain\Exception\EntityNotFound;
use App\Domain\Exception\RecordAlreadyExists;

class CurrencyInMemoryRepository implements CurrencyRepository
{
    public function __construct(private array $storage = [])
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

    public function findByCurrencyCode(string $currencyCode): Currency|null
    {
        if (array_key_exists($currencyCode, $this->storage) === false) {
            throw EntityNotFound::forPrimaryKey($currencyCode);
        }
        return $this->storage[$currencyCode];
    }

    public function updateCurrencies(array $currencies): void
    {
        /**@var Currency $currency */
        foreach ($currencies as $currency) {
            try {
                $this->save($currency);
            } catch (RecordAlreadyExists $e) {
                $this->updateCurrencyIfNeccesary($currency);
            }
        }
    }

    private function updateCurrencyIfNeccesary(Currency $currency): void
    {
        /**@var Currency $storedCurrency */
        $storedCurrency = $this->storage[$currency->getCurrencyCode()];

        if ($currency->getCurrencyExchange() !== $storedCurrency->getCurrencyExchange()) {
            $this->storage[$currency->getCurrencyCode()] = $currency;
        }
    }
}
