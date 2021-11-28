<?php

namespace App\Blog\Infrastructure\Messaging;

use App\Blog\Application\Command\CreateAuthorCommand;
use App\Common\Application\Bus\Command\CommandBus;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class OnUserRegisteredHandler implements MessageHandlerInterface
{
    public function __construct(
        private CommandBus $commandBus
    ) {
    }

    public function __invoke(UserRegisteredExternalEvent $event): void
    {
        $this->commandBus->handle(
            new CreateAuthorCommand(
                $event->getEntityId()['id'],
                $event->getName(),
                $event->getEmail(),
            )
        );
    }
}
