<?php

declare(strict_types=1);

namespace App\Application\Report\Query\Find;

use App\Domain\Report\Finder\FindByIdInterface;
use App\Domain\Report\ViewModel\ReportView;
use App\Infrastructure\Shared\Bus\Query\AbstractMessengerQueryHandler;

final class FindReportQueryHandler extends AbstractMessengerQueryHandler
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

    public static function getHandledMessages(): iterable
    {
        yield FindReportQuery::class;
    }
}
