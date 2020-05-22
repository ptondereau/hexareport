<?php

declare(strict_types=1);

namespace App\Domain\Report\Repository;

use App\Domain\Report\Model\Report;
use App\Domain\Report\ValueObjects\ReportId;

interface FindByIdInterface
{
    public function findById(ReportId $id): ?Report;
}
