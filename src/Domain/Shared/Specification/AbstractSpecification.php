<?php

namespace App\Domain\Shared\Specification;

abstract class AbstractSpecification
{
    abstract public function isSatisfiedBy($value): bool;
}
