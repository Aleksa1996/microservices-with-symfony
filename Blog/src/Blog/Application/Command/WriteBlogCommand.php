<?php
namespace App\Blog\Application\Command;

class WriteBlogCommand
{
    public function __construct(
        private string $id,
        private string $title,
        private string $content,
        private string $categoryId,
        private string $authorId
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->categoryId = $categoryId;
        $this->authorId = $authorId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getAuthorId(): string
    {
        return $this->authorId;
    }
}
