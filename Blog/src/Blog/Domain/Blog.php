<?php

namespace App\Blog\Domain;

use App\Common\Domain\Id;
use App\Blog\Domain\Author;
use App\Blog\Domain\Category;

class Blog
{
    public function __construct(private Id $id, private string $title, private string $content, private string $slug, private Category $category, private Author $author)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setContent($content);
        $this->setSlug($slug);
        $this->setCategory($category);
        $this->setAuthor($author);
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


    public function getTitle(): string
    {
        return $this->title;
    }

    private function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    private function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    private function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    private function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    private function setAuthor(Author $author): self
    {
        $this->author = $author;

        return $this;
    }
}
