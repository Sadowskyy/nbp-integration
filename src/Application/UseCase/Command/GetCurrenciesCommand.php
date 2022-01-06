<?php
declare(strict_types=1);

namespace App\Application\UseCase\Command;

use App\Application\Handlers\GetCurrenciesHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function json_encode;

final class GetCurrenciesCommand extends Command
{
    protected static $defaultName = 'get-currencies';

    protected function configure()
    {
        parent::configure();
        $this->setHelp('This command allows you to get all currencies info stored in db');
    }

    public function __construct(private GetCurrenciesHandler $getCurrenciesHandler)
    {
        parent::__construct(self::$defaultName);
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       $output->write(json_encode($this->getCurrenciesHandler->getCurrencies()));

        return 1;
    }
}