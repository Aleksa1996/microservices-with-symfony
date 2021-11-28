<?php

namespace App\Blog\Infrastructure\Domain\Persistence\Doctrine;

use App\Blog\Domain\AuthorRepository;
use App\Common\Infrastructure\Domain\Persistence\Doctrine\DoctrineRepository;

class DoctrineAuthorRepository extends DoctrineRepository implements AuthorRepository
{
}
