<?php

namespace App\Blog\Application\Command;

use App\Common\Domain\Id;
use App\Blog\Domain\Author;
use App\Blog\Domain\AuthorRepository;
use App\Common\Application\Bus\Command\CommandHandler;

class CreateAuthorHandler implements CommandHandler
{
    public function __construct(
        private AuthorRepository $authorRepository
    ) {
    }

    public function __invoke(CreateAuthorCommand $command): void
    {
        $author = new Author(
            new Id($command->getId()),
            $command->getName(),
            $command->getEmail(),
        );

        $this->authorRepository->save($author);
    }
}
