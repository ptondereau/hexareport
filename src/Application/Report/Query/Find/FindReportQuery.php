<?php

declare(strict_types=1);

namespace App\Application\Report\Query\Find;

use App\Domain\Report\ValueObjects\ReportId;
use App\Domain\Shared\Bus\Query\QueryInterface;

final class FindReportQuery implements QueryInterface
{
    private ReportId $id;

    public function __construct(string $id)
    {
        $this->id = new ReportId($id);
    }

    public function id(): ReportId
    {
        return $this->id;
    }
}
