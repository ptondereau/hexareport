<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Query;

use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

abstract class AbstractMessengerQueryHandler implements MessageSubscriberInterface
{
    abstract public static function getHandledMessages(): iterable;
}
