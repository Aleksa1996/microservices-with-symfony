<?php

namespace App\Common\Domain\Event;

use App\Common\Domain\Id;
use DateTimeImmutable;

trait ImplementsDomainEvent
{
    private ?Id $entityId = null;

    private int $version = 1;

    private  $occurredOn;

    public function getEntityId(): ?Id
    {
        return $this->entityId;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function getOccurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
