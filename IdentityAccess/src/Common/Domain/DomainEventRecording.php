<?php

namespace App\Common\Domain;

use App\Common\Domain\Event\DomainEvent;

trait DomainEventRecording
{
    protected array $recordedDomainEvents = [];

    public function getRecordedDomainEvents(): array
    {
        return $this->recordedDomainEvents;
    }

    public function clearRecordedDomainEvents(): void
    {
        $this->recordedDomainEvents = [];
    }

    protected function recordThat(DomainEvent $domainEvent): void
    {
        $this->recordedDomainEvents[] = $domainEvent;
    }
}
