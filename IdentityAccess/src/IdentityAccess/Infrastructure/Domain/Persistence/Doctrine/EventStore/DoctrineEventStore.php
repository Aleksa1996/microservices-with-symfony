<?php

namespace App\IdentityAccess\Infrastructure\Domain\Persistence\Doctrine\EventStore;

use App\Common\Domain\Event\EventStore;
use App\Common\Domain\Event\DomainEvent;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Messenger\Envelope;
use App\Common\Domain\Event\StoredDomainEvent;
use App\Common\Domain\Event\PublishableDomainEvent;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineEventStore extends ServiceEntityRepository implements EventStore
{
    private $domainEvents = [];

    public function __construct(ManagerRegistry $registry, string $entityClass, private SerializerInterface $serializer, private MessageBusInterface $eventBus)
    {
        parent::__construct($registry, $entityClass);
    }

    public function append(DomainEvent $domainEvent): void
    {
        $storedEvent = new StoredDomainEvent(
            $domainEvent->getEntityId(),
            $domainEvent->getType(),
            $this->serializer->serialize($domainEvent, 'json'),
            $domainEvent->getOccurredOn(),
        );
        $this->getEntityManager()->persist($storedEvent);

        if ($domainEvent instanceof PublishableDomainEvent) {
            $this->domainEvents[] = $domainEvent;
        }
    }

    public function publish(): void
    {
        foreach ($this->domainEvents as $domainEvent) {
            $this->eventBus->dispatch(
                (new Envelope(
                    $domainEvent
                ))->with(new DispatchAfterCurrentBusStamp())
            );
        }

        $this->domainEvents = [];
    }

    public function findById(int $id): mixed
    {
        return $this->find($id);
    }

    public function allStoredEventsSince(int $id): array
    {
        $query = $this->createQueryBuilder('e');

        if ($id) {
            $query->where('e.id > :id');
            $query->setParameters(['id' => $id]);
        }

        $query->orderBy('e.id');

        return $query->getQuery()->getResult();
    }
}
