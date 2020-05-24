<?php

declare(strict_types=1);

namespace App\Infrastructure\Report\Doctrine\Types;

use App\Domain\Report\ValueObjects\ReportId as DomainReportId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Ramsey\Uuid\Doctrine\UuidType;

class ReportId extends UuidType
{
    public const NAME = 'report_id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof DomainReportId ? (string) $value : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof DomainReportId) {
            return $value;
        }

        try {
            $id = new DomainReportId($value);
        } catch (\InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, static::NAME);
        }

        return $id;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
