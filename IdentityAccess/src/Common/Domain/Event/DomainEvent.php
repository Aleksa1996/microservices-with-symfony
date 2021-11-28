<?php

namespace App\Common\Domain\Event;

use DateTimeImmutable;
use App\Common\Domain\Id;

interface DomainEvent
{
    public function getEntityId(): ?Id;

    public function getVersion(): int;

    public function getType(): string;

    public function getOccurredOn(): DateTimeImmutable;
}
