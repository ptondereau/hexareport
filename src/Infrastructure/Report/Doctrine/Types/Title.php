<?php

declare(strict_types=1);

namespace App\Infrastructure\Report\Doctrine\Types;

use App\Domain\Report\ValueObjects\Title as DomainTitle;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class Title extends StringType
{
    public const NAME = 'title';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof DomainTitle ? (string) $value : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new DomainTitle((string) $value) : null;
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
