<?php

namespace App\IdentityAccess\Application\Command;

class RegisterUserCommand
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
        private string $password,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->email;
    }
}
