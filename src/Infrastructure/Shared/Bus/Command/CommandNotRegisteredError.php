<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Command;

use App\Domain\Shared\Bus\Command\CommandInterface;
use RuntimeException;

final class CommandNotRegisteredError extends RuntimeException
{
    public function __construct(CommandInterface $query)
    {
        $commandClass = \get_class($query);
        parent::__construct("The command <$commandClass> hasn't a command handler associated");
    }
}
