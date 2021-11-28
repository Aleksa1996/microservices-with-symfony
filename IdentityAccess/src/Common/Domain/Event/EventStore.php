<?php

namespace App\Common\Domain\Event;

use App\Common\Domain\Event\DomainEvent;

interface EventStore
{
    public function findById(int $id): mixed;

    public function append(DomainEvent $domainEvent): void;

    public function publish(): void;

    public function allStoredEventsSince(int $id): array;
}
