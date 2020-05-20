<?php

declare(strict_types=1);

namespace App\Infrastructure\Report\Entity;

use App\Domain\Shared\EntityInterface;
use Ramsey\Uuid\UuidInterface;

class Report implements EntityInterface
{
    public UuidInterface $id;

    public string $title;

    public string $description;
}
