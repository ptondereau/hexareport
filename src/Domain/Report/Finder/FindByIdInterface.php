<?php

namespace App\Domain\Report\Finder;

use App\Domain\Report\ValueObjects\ReportId;
use App\Domain\Report\ViewModel\ReportView;

interface FindByIdInterface
{
    public function findById(ReportId $id): ReportView;
}
