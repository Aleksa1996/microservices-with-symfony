<?php

namespace App\Common\Domain;

interface RecordingDomainEvents
{
    public function getRecordedDomainEvents(): array;

    public function clearRecordedDomainEvents(): void;
}
