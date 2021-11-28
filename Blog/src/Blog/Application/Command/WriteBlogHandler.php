<?php

namespace App\Blog\Application\Command;

use App\Blog\Domain\Blog;
use App\Common\Domain\Id;
use App\Blog\Domain\BlogRepository;
use App\Blog\Domain\AuthorRepository;
use App\Blog\Domain\CategoryRepository;
use App\Blog\Application\Exception\AuthorNotFound;
use App\Blog\Application\Exception\CategoryNotFound;
use App\Common\Application\Bus\Command\CommandHandler;

class WriteBlogHandler implements CommandHandler
{
    public function __construct(
        private BlogRepository $blogRepository,
        private CategoryRepository $categoryRepository,
        private AuthorRepository $authorRepository
    ) {
    }

    public function __invoke(WriteBlogCommand $command): void
    {
        $category = $this->categoryRepository->findById(new Id($command->getCategoryId()));

        if (empty($category)) {
            throw new CategoryNotFound();
        }

        $author = $this->authorRepository->findById(new Id($command->getAuthorId()));

        if (empty($author)) {
            throw new AuthorNotFound();
        }

        $blog = new Blog(
            new Id($command->getId()),
            $command->getTitle(),
            $command->getContent(),
            'slug',
            $category,
            $author
        );

        $this->blogRepository->save($blog);
    }
}
