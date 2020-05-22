<?php

declare(strict_types=1);

namespace App\UI\CLI\Command;

use App\Application\Report\Query\Find\FindReportQuery;
use App\Domain\Shared\Bus\Query\QueryBusInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GetReportCommand extends Command
{
    protected QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('report:get')
            ->setDescription('Get report by ID.')
            ->addArgument('id', InputArgument::REQUIRED, 'Report id');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $id = $input->getArgument('id');

        $response = $this->queryBus->ask(new FindReportQuery($id));

        dump($response);

        return 0;
    }
}
