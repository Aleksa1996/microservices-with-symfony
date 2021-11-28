<?php

namespace App\Blog\Infrastructure\Domain\Persistence\Doctrine;

use App\Blog\Domain\BlogRepository;
use App\Common\Infrastructure\Domain\Persistence\Doctrine\DoctrineRepository;

class DoctrineBlogRepository extends DoctrineRepository implements BlogRepository
{
}
