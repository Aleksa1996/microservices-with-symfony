<?php

namespace App\IdentityAccess\Infrastructure\Domain\Persistence\Doctrine;

use App\IdentityAccess\Domain\UserRepository;
use App\Common\Infrastructure\Domain\Persistence\Doctrine\DoctrineRepository;

class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
}
