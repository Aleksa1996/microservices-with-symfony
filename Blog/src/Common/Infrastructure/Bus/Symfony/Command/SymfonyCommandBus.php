<?php

namespace App\Common\Infrastructure\Bus\Symfony\Command;

use App\Common\Application\Bus\Command\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyCommandBus implements CommandBus
{
    public function __construct(private MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function handle($command): void
    {
        $this->bus->dispatch($command);
    }
}
