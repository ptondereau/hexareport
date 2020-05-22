<?php

declare(strict_types=1);

namespace App\Infrastructure\Report\Repository;

use App\Domain\Report\Model\Report;
use App\Domain\Report\Repository\FindByIdInterface;
use App\Domain\Report\ValueObjects\ReportId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReportRepository extends ServiceEntityRepository implements FindByIdInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function findById(ReportId $id): ?Report
    {
        return $this->createQueryBuilder('report')
            ->andWhere('report.id = :id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getOneOrNullResult();
    }
}
