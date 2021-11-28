<?php

namespace App\IdentityAccess\Infrastructure\Domain\Persistence\Doctrine;

use App\IdentityAccess\Domain\RoleRepository;
use App\Common\Infrastructure\Domain\Persistence\Doctrine\DoctrineRepository;

class DoctrineRoleRepository extends DoctrineRepository implements RoleRepository
{
}
