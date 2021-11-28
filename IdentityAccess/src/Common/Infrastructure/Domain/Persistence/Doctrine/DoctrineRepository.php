<?php

namespace App\Common\Infrastructure\Domain\Persistence\Doctrine;

use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Id;
use App\Common\Domain\Repository;
use App\Common\Domain\Event\EventStore;
use Doctrine\Persistence\ManagerRegistry;
use App\Common\Domain\RecordingDomainEvents;
use App\Common\Domain\Event\StorableDomainEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class DoctrineRepository extends ServiceEntityRepository implements Repository
{
    public function __construct(ManagerRegistry $registry, string $entityClass, private EventStore $eventStore)
    {
        parent::__construct($registry, $entityClass);
    }

    public function findById(Id $id)
    {
        return $this->find($id);
    }

    public function save($entity): void
    {
        $this->getEntityManager()->persist($entity);

        if ($entity instanceof RecordingDomainEvents) {
            $this->appendDomainEvents($entity);
        }
    }

    private function appendDomainEvents(RecordingDomainEvents $entity): void
    {
        foreach ($entity->getRecordedDomainEvents() as $domainEvent) {
            if ($domainEvent instanceof DomainEvent && $domainEvent instanceof StorableDomainEvent) {
                $this->eventStore->append($domainEvent);
            }
        }

        $entity->clearRecordedDomainEvents();
    }
}
