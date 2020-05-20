<?php

declare(strict_types=1);

namespace App\Application\Report\Find;

use App\Domain\Report\Model\Report;
use App\Domain\Report\ReportNotExist;
use App\Domain\Report\Repository\FindByIdInterface;
use App\Domain\Report\ValueObjects\ReportId;
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
        $id = new ReportId($command->id());

        $report = $this->repository->findById($id);

        if (!$report) {
            throw new ReportNotExist($id);
        }

        return new ReportResponse(Report::fromPrimitives(
            $report['id'],
            $report['title'],
            $report['description']
        ));
    }
}
