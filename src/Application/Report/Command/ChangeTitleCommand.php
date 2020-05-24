<?php

declare(strict_types=1);

namespace App\Application\Report\Command;

use App\Domain\Report\ValueObjects\ReportId;
use App\Domain\Report\ValueObjects\Title;
use App\Domain\Shared\Bus\Command\CommandInterface;

final class ChangeTitleCommand implements CommandInterface
{
    private ReportId $id;

    private Title $title;

    public function __construct(string $id, string $title)
    {
        $this->id = new ReportId($id);
        $this->title = new Title($title);
    }

    public function id(): ReportId
    {
        return $this->id;
    }

    public function title(): Title
    {
        return $this->title;
    }
}
