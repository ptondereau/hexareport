<?php

declare(strict_types=1);

namespace App\Domain\Report\Finder;

use App\Domain\Report\ValueObjects\ReportId;
use App\Domain\Report\ViewModel\ReportView;

interface FindByIdInterface
{
    public function findById(ReportId $id): ReportView;
}
