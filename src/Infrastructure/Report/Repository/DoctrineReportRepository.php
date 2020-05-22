<?php

declare(strict_types=1);

namespace App\Infrastructure\Report\Repository;

use App\Domain\Report\Exceptions\ReportNotExist;
use App\Domain\Report\Model\Report;
use App\Domain\Report\Repository\ReportRepositoryInterface;
use App\Domain\Report\ValueObjects\ReportId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineReportRepository extends ServiceEntityRepository implements ReportRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function get(ReportId $id): Report
    {
        /** @var Report|null $report */
        $report = $this->find($id->value());

        if (null === $report) {
            throw new ReportNotExist($id);
        }

        return $report;
    }

    public function save(Report $report): void
    {
        $this->getEntityManager()->persist($report);
        $this->getEntityManager()->flush();
    }
}
