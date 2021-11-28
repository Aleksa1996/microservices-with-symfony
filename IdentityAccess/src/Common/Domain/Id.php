<?php

namespace App\Common\Domain;

use Ramsey\Uuid\Uuid;

class Id
{
    public function __construct(private ?string $id = null)
    {
        $this->setId($id);
    }

    public function getId(): string
    {
        return $this->id;
    }

    private function setId(?string $id)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();

        return $this;
    }

    public function __toString(): string
    {
        return (string)$this->id;
    }
}
