<?php

namespace App\Blog\Application\Dto;

class AuthorDto
{
    public function __construct(private string $id, private string $name, private string $email)
    {
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
}
