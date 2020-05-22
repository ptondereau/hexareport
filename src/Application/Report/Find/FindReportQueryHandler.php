<?php

declare(strict_types=1);

namespace App\Application\Report\Find;

use App\Domain\Report\ReportNotExist;
use App\Domain\Report\Repository\FindByIdInterface;
use App\Domain\Shared\Bus\Query\QueryHandlerInterface;

final class FindReportQueryHandler implements QueryHandlerInterface
{
    private FindByIdInterface $repository;

    public function __construct(FindByIdInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindReportQuery $command): ReportResponse
    {
        $report = $this->repository->findById($command->id());

        if (!$report) {
            throw new ReportNotExist($command->id());
        }

        return new ReportResponse($report);
    }
}
