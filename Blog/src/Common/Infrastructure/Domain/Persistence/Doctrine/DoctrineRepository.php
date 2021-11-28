<?php

namespace App\Common\Infrastructure\Domain\Persistence\Doctrine;

use App\Common\Domain\Id;
use App\Common\Domain\Repository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class DoctrineRepository extends ServiceEntityRepository implements Repository
{
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function findById(Id $id)
    {
        return $this->find($id);
    }

    public function all(): array
    {
        return $this->findAll();
    }

    public function save($entity): void
    {
        $this->getEntityManager()->persist($entity);
    }
}
