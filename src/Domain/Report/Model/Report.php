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

    public function __construct(ReportId $id, Title $title, Description $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public static function create(Title $title, Description $description): self
    {
        return new self(ReportId::random(), $title, $description);
    }

    public static function fromPrimitives(string $id, string $title, string $description): self
    {
        return new self(
            new ReportId($id),
            new Title($title),
            new Description($description)
        );
    }

    public function id(): ReportId
    {
        return $this->id;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function description(): Description
    {
        return $this->description;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'title' => $this->title->value(),
            'description' => $this->description->value(),
        ];
    }
}
