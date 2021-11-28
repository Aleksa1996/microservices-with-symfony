<?php

namespace App\Blog\Infrastructure\Domain\Persistence\Doctrine;

use App\Blog\Domain\CategoryRepository;
use App\Common\Infrastructure\Domain\Persistence\Doctrine\DoctrineRepository;

class DoctrineCategoryRepository extends DoctrineRepository implements CategoryRepository
{
}
