<?php
declare(strict_types=1);

namespace App\Domain\Exception;

use Exception;

class EntityNotFound extends Exception
{
    public static function forPrimaryKey(string $primaryKey): self
    {
        return new self("Entity for primary key ($code) do not exists.");
    }
}
