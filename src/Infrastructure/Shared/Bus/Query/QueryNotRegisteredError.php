<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Command;

use App\Domain\Shared\Bus\Query\QueryInterface;
use RuntimeException;

final class QueryNotRegisteredError extends RuntimeException
{
    public function __construct(QueryInterface $query)
    {
        $queryClass = \get_class($query);
        parent::__construct("The query <$queryClass> hasn't a query handler associated");
    }
}
