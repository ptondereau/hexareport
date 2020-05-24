<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Query;

use App\Domain\Shared\Bus\Query\QueryBusInterface;
use App\Domain\Shared\Bus\Query\QueryInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerQueryBus implements QueryBusInterface
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function ask(QueryInterface $query)
    {
        return $this->handle($query);
    }
}
