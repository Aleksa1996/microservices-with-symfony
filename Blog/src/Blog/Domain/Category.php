<?php

namespace App\Blog\Domain;

use App\Common\Domain\Id;
use Doctrine\Common\Collections\ArrayCollection;

class Category
{
    public function __construct(private Id $id, private string $name, private ?Category $parent = null, private $children = [])
    {
        $this->setId($id);
        $this->setName($name);
        $this->setParent($parent);
        $this->setChildren($children);
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

    public function getParent(): ?Category
    {
        return $this->parent;
    }

    private function setParent(?Category $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChildren(): array
    {
        return $this->children->toArray();
    }

    private function setChildren(array $children): self
    {
        $this->children = new ArrayCollection($children);

        return $this;
    }
}
