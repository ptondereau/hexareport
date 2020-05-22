<?php

declare(strict_types=1);

namespace App\Domain\Report\Repository;

use App\Domain\Report\Model\Report;
use App\Domain\Report\ValueObjects\ReportId;

interface ReportRepositoryInterface
{
    public function get(ReportId $id): Report;

    public function save(Report $report): void;
}
