<?php
declare(strict_types=1);

namespace App\Tests\Unit;

use App\Domain\Currency;
use App\Domain\CurrencyRepository;
use App\Domain\Exception\RecordAlreadyExists;
use App\Domain\Exception\EntityNotFound;
use App\Infrastructure\Memory\CurrencyInMemoryRepository;
use PHPUnit\Framework\TestCase;

class CurrencyRepositoryTest extends TestCase
{
    private CurrencyRepository $currencyRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->currencyRepository = new CurrencyInMemoryRepository(
            ['PLN' => new Currency('1234', 'polski zloty', 'PLN', 1.00)]
        );
    }

    public function testSaveMethodShouldThrowError(): void
    {
        $this->expectException(RecordAlreadyExists::class);
        $this->currencyRepository->save(new Currency('12323212', 'jakas waluta', 'PLN', 1.00));
    }

    public function testSaveMethodShouldRunFine(): void
    {
        $currency = new Currency('123', 'Euro', 'EUR', 4.00);

        $this->currencyRepository->save($currency);
        self::assertEquals($currency, $this->currencyRepository->findByCurrencyCode('EUR'));
    }

    public function testFindAllShouldReturnCollection(): void
    {
        self::assertEquals($this->currencyRepository->findAll(),
            [
                'collection' => ['PLN' => new Currency('1234', 'polski zloty', 'PLN', 1.00)]
            ]
        );
    }

    public function testFindAllShouldReturnEmptyCollection(): void
    {
        $this->currencyRepository = new CurrencyInMemoryRepository();

        self::assertEquals($this->currencyRepository->findAll(),
            [
                'collection' => []
            ]
        );
    }

    public function testFindByCurrencyCodeShouldReturnCurrency(): void
    {
        self::assertEquals($this->currencyRepository->findByCurrencyCode('PLN'),
            new Currency('1234', 'polski zloty', 'PLN', 1.00));
    }
    public function testFindByCurrencyCodeShouldReturnNull(): void
    {
        $this->expectException(EntityNotFound::class);
        $this->currencyRepository->findByCurrencyCode('EUR');
    }
}