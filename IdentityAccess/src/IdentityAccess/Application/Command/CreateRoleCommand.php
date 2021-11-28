<?php

namespace App\IdentityAccess\Application\Command;

class CreateRoleCommand
{
    public function __construct(
        private string $id,
        private string $name,
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
