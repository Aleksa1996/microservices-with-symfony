<?php

namespace App\Common\Infrastructure\Bus\Symfony\Query;

use Symfony\Component\Messenger\HandleTrait;
use App\Common\Application\Bus\Query\QueryBus;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function handle($query): mixed
    {
        return $this->handleQuery($query);
    }
}
