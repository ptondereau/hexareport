<?php

declare(strict_types=1);

namespace App\Domain\Report\ValueObjects;

use App\Domain\Shared\ValueObjects\AbstractString;

final class Description extends AbstractString
{
    public function isEquals(self $other): bool
    {
        return $this->value() === $other->value();
    }
}
