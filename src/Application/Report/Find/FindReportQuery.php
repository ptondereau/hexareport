<?php

declare(strict_types=1);

namespace App\Application\Report\Find;

use App\Domain\Shared\Bus\Query\QueryInterface;

final class FindReportQuery implements QueryInterface
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
