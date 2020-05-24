<?php

declare(strict_types=1);

namespace App\Application\Report\Command;

use App\Domain\Report\Repository\ReportRepositoryInterface;
use App\Domain\Shared\Bus\Command\CommandHandlerInterface;

final class ChangeTitleCommandHandler implements CommandHandlerInterface
{
    private ReportRepositoryInterface $repository;

    public function __construct(ReportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ChangeTitleCommand $command)
    {
        $report = $this->repository->get($command->id());

        $report->changeTitle($command->title());

        $this->repository->save($report);
    }
}
