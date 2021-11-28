<?php

namespace App\Blog\Domain;

use App\Common\Domain\Id;

class Author
{
    public function __construct(private Id $id, private string $name, private string $email)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
    }

    public function getId(): Id
    {
        return $this->id;
    }

    private function setId(Id $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    private function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
