<?php

declare(strict_types=1);

namespace App\Application\Report\Find;

use App\Domain\Report\ValueObjects\ReportId;
use App\Domain\Shared\Bus\Query\QueryInterface;

final class FindReportQuery implements QueryInterface
{
    private ReportId $id;

    public function __construct(ReportId $id)
    {
        $this->id = $id;
    }

    public function id(): ReportId
    {
        return $this->id;
    }
}
