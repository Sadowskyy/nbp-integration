<?php
declare(strict_types=1);

namespace App\Application\UseCase\Command;

use Symfony\Component\Console\Command\Command;

final class GetCurrenciesCommand extends Command
{
    protected static $defaultName = 'get-currencies';

    protected function configure()
    {
        parent::configure();

        $this->setHelp('This command allows you to get all currencies info stored in db');
    }
}