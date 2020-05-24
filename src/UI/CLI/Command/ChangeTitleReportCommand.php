<?php

declare(strict_types=1);

namespace App\UI\CLI\Command;

use App\Application\Report\Command\ChangeTitleCommand;
use App\Application\Report\Query\Find\FindReportQuery;
use App\Domain\Shared\Bus\Command\CommandBusInterface;
use App\Domain\Shared\Bus\Query\QueryBusInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ChangeTitleReportCommand extends Command
{
    protected QueryBusInterface $queryBus;

    protected CommandBusInterface $commandBus;

    public function __construct(
        QueryBusInterface $queryBus,
        CommandBusInterface $commandBus
    ) {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('report:change-title')
            ->setDescription('Change title of a report.')
            ->addArgument('id', InputArgument::REQUIRED, 'Report id')
            ->addArgument(
                'title',
                InputArgument::REQUIRED,
                'New title for the report',
            );
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $id = $input->getArgument('id');
        $title = $input->getArgument('title');

        $this->commandBus->dispatch(new ChangeTitleCommand($id, $title));

        $response = $this->queryBus->ask(new FindReportQuery($id));

        dump($response);

        return 0;
    }
}
