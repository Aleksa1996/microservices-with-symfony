<?php

namespace App\Common\Infrastructure\Bus\Symfony\Query;

use App\Common\Application\Bus\Query\QueryBus;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyQueryBus implements QueryBus
{
    public function __construct(private MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function handle($query): mixed
    {
        $this->bus->dispatch($query);
    }
}
