<?php

declare(strict_types=1);

namespace App\Domain\Report\Exceptions;

use App\Domain\Report\ValueObjects\ReportId;
use App\Domain\Shared\Exceptions\DomainError;

final class ReportNotExist extends DomainError
{
    private ReportId $id;

    public function __construct(ReportId $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'report_not_exist';
    }

    protected function errorMessage(): string
    {
        return \sprintf('The report <%s> does not exist', $this->id->value());
    }
}
