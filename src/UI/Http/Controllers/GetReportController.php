<?php

declare(strict_types=1);

namespace App\UI\Http\Controllers;

use App\Application\Report\Query\Find\FindReportQuery;
use App\Domain\Report\ViewModel\ReportView;
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

    public function __invoke(string $id): Response
    {
        /** @var ReportView $response */
        $response = $this->queryBus->ask(new FindReportQuery($id));

        if (!$response) {
            return Response::create('Bad request', Response::HTTP_BAD_REQUEST);
        }

        return JsonResponse::create([
            'data' => [
                'id' => $response->id,
                'title' => $response->title,
                'description' => $response->description,
                'created_at' => $response->created_at,
            ],
        ]);
    }
}
