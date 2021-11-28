<?php

namespace App\Common\Domain\Event;

use App\Common\Domain\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;

class StoredDomainEvent implements DomainEvent
{
    use ImplementsDomainEvent;

    private ?int $id;

    private string $type;

    private string $body;

    public function __construct(Id $entityId, string $type, string $body, \DateTimeImmutable $occurredOn)
    {
        $this->entityId = $entityId;
        $this->type = $type;
        $this->body = $body;
        $this->occurredOn = $occurredOn;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
