<?php
declare(strict_types=1);

namespace App\Application\UseCase\Command;

use App\Application\Handlers\UpdateCurrenciesHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCurrenciesCommand extends Command
{
    protected static $defaultName = 'update-currencies';

    protected function configure()
    {
        parent::configure();
        $this->setHelp('This command allows you to update all currencies info stored in db');
    }

    public function __construct(private UpdateCurrenciesHandler $handler)
    {
        parent::__construct(self::$defaultName);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->handler->updateCurrencies();

        return 1;
    }

}