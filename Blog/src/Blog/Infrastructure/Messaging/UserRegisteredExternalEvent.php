<?php

namespace App\Blog\Infrastructure\Messaging;

use DateTimeImmutable;

class UserRegisteredExternalEvent
{
    public function __construct(private array $entityId, private string $name, private string $email, private DateTimeImmutable $occurredOn)
    {
    }

    public function getEntityId(): array
    {
        return $this->entityId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getOccurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
