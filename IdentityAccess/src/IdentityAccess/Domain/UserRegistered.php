<?php

namespace App\IdentityAccess\Domain;

use DateTimeImmutable;
use App\Common\Domain\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;
use App\Common\Domain\Event\PublishableDomainEvent;
use App\Common\Domain\Event\StorableDomainEvent;

class UserRegistered implements DomainEvent, PublishableDomainEvent, StorableDomainEvent
{
    use ImplementsDomainEvent;

    public function __construct(Id $id, private string $name, private string $email)
    {
        $this->entityId = $id;
        $this->occurredOn = new DateTimeImmutable();
    }

    public function getType(): string
    {
        return 'UserRegistered';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
