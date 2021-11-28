<?php

namespace App\Blog\Application\Command;

class CreateCategoryCommand
{
    public function __construct(
        private string $id,
        private string $name,
        private ?string $parentId = null,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParentId(): ?string
    {
        return $this->parentId;
    }
}
