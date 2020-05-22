<?php

declare(strict_types=1);

namespace App\Application\Report\Query\Find;

use App\Domain\Report\Finder\FindByIdInterface;
use App\Domain\Report\ViewModel\ReportView;
use App\Domain\Shared\Bus\Query\QueryHandlerInterface;

final class FindReportQueryHandler implements QueryHandlerInterface
{
    private FindByIdInterface $finder;

    public function __construct(FindByIdInterface $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(FindReportQuery $command): ReportView
    {
        return $this->finder->findById($command->id());
    }
}
