<?php

namespace App\IdentityAccess\Domain;

use App\Common\Domain\Id;

class Role
{
    public function __construct(private Id $id, private string $name)
    {
        $this->setId($id);
        $this->setName($name);
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
}
