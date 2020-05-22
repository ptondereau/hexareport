<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Query;

use App\Domain\Shared\Bus\Query\QueryBusInterface;
use App\Domain\Shared\Bus\Query\QueryInterface;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class MessengerQueryBus implements QueryBusInterface
{
    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function ask(QueryInterface $query)
    {
        try {
            /** @var HandledStamp $stamp */
            $stamp = $this->queryBus
                ->dispatch($query)
                ->last(HandledStamp::class);

            return $stamp->getResult();
        } catch (NoHandlerForMessageException $unused) {
            throw new QueryNotRegisteredError($query);
        }
    }
}
