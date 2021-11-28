<?php

namespace App\Blog\Infrastructure\Messaging;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\BusNameStamp;
use Symfony\Component\Messenger\Exception\MessageDecodingFailedException;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializer;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class MessageSerializer implements SerializerInterface
{
    public function __construct(private SymfonySerializer $serializer)
    {
    }

    public function decode(array $encodedEnvelope): Envelope
    {
        if (empty($encodedEnvelope['headers']['type']) || empty($encodedEnvelope['body'])) {
            throw new MessageDecodingFailedException('invalid.message');
        }

        $event = $this->serializer->deserialize(
            $encodedEnvelope['body'],
            $this->mapEventToClass($encodedEnvelope['headers']['type']),
            'json'
        );

        $envelope = new Envelope($event);
        $envelope->with(new BusNameStamp('event.bus'));

        // in case of redelivery, unserialize any stamps
        $stamps = [];
        if (isset($encodedEnvelope['headers']['stamps'])) {
            $stamps = unserialize($encodedEnvelope['headers']['stamps']);
        }

        $envelope = $envelope->with(...$stamps);

        return $envelope;
    }

    public function encode(Envelope $envelope): array
    {
        // this is called if a message is redelivered for "retry"
        // expand this logic later if you handle more than
        // just one message class
        if ($type = $this->mapEventToClass(get_class($envelope->getMessage()))) {
            $data = $this->serializer->serialize(
                $envelope->getMessage(),
                'json'
            );
        }

        $allStamps = [];
        foreach ($envelope->all() as $stamps) {
            $allStamps = array_merge($allStamps, $stamps);
        }

        return [
            'body' => $data,
            'headers' => [
                // store stamps as a header - to be read in decode()
                'stamps' => serialize($allStamps),
                'type' => $type,
            ],
        ];
    }

    private function mapEventToClass($class)
    {
        return match ($class) {
            'App\IdentityAccess\Domain\UserRegistered' => UserRegisteredExternalEvent::class,
            UserRegisteredExternalEvent::class => UserRegisteredExternalEvent::class,
            default => false
        };
    }
}
