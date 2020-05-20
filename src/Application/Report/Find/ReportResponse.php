<?php

declare(strict_types=1);

namespace App\Application\Report\Find;

use App\Domain\Report\Model\Report;
use App\Domain\Shared\Bus\Query\Response;

class ReportResponse implements Response
{
    private Report $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function report(): Report
    {
        return $this->report;
    }
}
