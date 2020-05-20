<?php

declare(strict_types=1);

namespace App\Domain\Report\ValueObjects;

use App\Domain\Shared\ValueObjects\AbstractString;

final class Title extends AbstractString
{
    public function isEquals(self $other): bool
    {
        return $this->value() === $other->value();
    }
}
