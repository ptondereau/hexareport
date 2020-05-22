<?php

declare(strict_types=1);

namespace App\Infrastructure\Report\Doctrine\Types;

use App\Domain\Report\ValueObjects\Description as DomainDescription;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class Description extends TextType
{
    public const NAME = 'description';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof DomainDescription ? (string) $value : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new DomainDescription((string) $value) : null;
    }

    public function getName()
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
