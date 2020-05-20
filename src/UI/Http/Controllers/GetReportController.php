<?php

declare(strict_types=1);

namespace App\UI\Http\Controllers;

use App\Application\Report\Find\FindReportQuery;
use App\Application\Report\Find\ReportResponse;
use App\Domain\Shared\Bus\Query\QueryBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/report/{id}", name="get_report")
 */
class GetReportController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(int $id): Response
    {
        /** @var ReportResponse $response */
        $response = $this->queryBus->ask(new FindReportQuery($id));

        if (!$response) {
            return Response::create('Bad request', Response::HTTP_BAD_REQUEST);
        }

        return JsonResponse::create($response->report()->toArray());
    }
}
