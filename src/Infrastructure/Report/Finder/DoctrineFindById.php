<?php

namespace App\Infrastructure\Report\Finder;

use App\Domain\Report\Exceptions\ReportNotExist;
use App\Domain\Report\Finder\FindByIdInterface;
use App\Domain\Report\ValueObjects\ReportId;
use App\Domain\Report\ViewModel\ReportView;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;

final class DoctrineFindById implements FindByIdInterface
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findById(ReportId $id): ReportView
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select(
                'id',
                'title',
                'description',
                'created_at'
            )
            ->from('reports')
            ->where('id = :id')
            ->setParameter(':id', $id->value())
            ->execute();

        $stmt->setFetchMode(FetchMode::CUSTOM_OBJECT, ReportView::class);

        $model = $stmt->fetch();

        if (!$model instanceof ReportView) {
            throw new ReportNotExist($id);
        }

        return $model;
    }
}
