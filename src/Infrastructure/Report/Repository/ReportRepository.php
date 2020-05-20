<?php

declare(strict_types=1);

namespace App\Infrastructure\Report\Repository;

use App\Domain\Report\Repository\FindByIdInterface;
use App\Domain\Report\ValueObjects\ReportId;
use App\Infrastructure\Report\Entity\Report;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

class ReportRepository extends ServiceEntityRepository implements FindByIdInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function findById(ReportId $id): ?array
    {
        return $this->createQueryBuilder('report')
            ->andWhere('report.id = :id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getOneOrNullResult(AbstractQuery::HYDRATE_ARRAY);
    }
}
