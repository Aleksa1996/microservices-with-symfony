<?php

namespace App\Blog\Application\Command;

use App\Common\Domain\Id;
use App\Blog\Domain\Category;
use App\Blog\Domain\CategoryRepository;
use App\Common\Application\Bus\Command\CommandHandler;
use App\Blog\Application\Exception\ParentCategoryNotFound;

class CreateCategoryHandler implements CommandHandler
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {
    }

    public function __invoke(CreateCategoryCommand $command): void
    {
        $parentCategory = null;
        if (!empty($command->getParentId())) {
            $parentCategory = $this->categoryRepository->findById(new Id($command->getParentId()));

            if (empty($parentCategory)) {
                throw new ParentCategoryNotFound();
            }
        }

        $category = new Category(
            new Id($command->getId()),
            $command->getName(),
            $parentCategory
        );

        $this->categoryRepository->save($category);
    }
}
