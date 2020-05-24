<?php

declare(strict_types=1);

namespace App\Domain\Report\Model;

use App\Domain\Report\ValueObjects\Description;
use App\Domain\Report\ValueObjects\ReportId;
use App\Domain\Report\ValueObjects\Title;

final class Report
{
    private ReportId $id;

    private Title $title;

    private Description $description;

    private \DateTimeImmutable $createdAt;

    private function __construct(
        ReportId $id,
        Title $title,
        Description $description
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->createdAt = new \DateTimeImmutable();
    }

    public static function create(
        ReportId $id,
        Title $title,
        Description $description
    ): self {
        return new self($id, $title, $description);
    }

    public function changeTitle(Title $title): void
    {
        $this->title = $title;
    }

    public static function fromPrimitives(
        string $id,
        string $title,
        string $description
    ): self {
        return new self(
            new ReportId($id),
            new Title($title),
            new Description($description),
        );
    }
}
