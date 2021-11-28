<?php

namespace App\Blog\Application\Command;

class CreateAuthorCommand
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
}
