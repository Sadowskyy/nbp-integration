<?php
declare(strict_types=1);

namespace App\Domain\Exception;

use Exception;

class RecordAlreadyExists extends Exception
{
    public static function forCurrencyCode(string $code): self
    {
        return new self("Entity for currency code ($code) exists.");
    }
}
