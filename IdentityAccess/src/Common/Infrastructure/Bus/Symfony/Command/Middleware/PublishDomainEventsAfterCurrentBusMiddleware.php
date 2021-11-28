<?php

namespace App\Common\Infrastructure\Bus\Symfony\Command\Middleware;

use App\Common\Domain\Event\EventStore;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;

class PublishDomainEventsAfterCurrentBusMiddleware implements MiddlewareInterface
{
    private EventStore $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        try {
            // Execute the whole middleware stack & message handling for main dispatch:
            return $stack->next()->handle($envelope, $stack);
        } finally {
            $this->eventStore->publish();
        }
    }
}
