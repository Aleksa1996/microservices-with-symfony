<?php

namespace App\IdentityAccess\Application\Command;

use App\Common\Domain\Id;
use App\IdentityAccess\Domain\User;
use App\IdentityAccess\Domain\Hasher;
use App\IdentityAccess\Domain\UserRepository;
use App\Common\Application\Bus\Command\CommandHandler;

class RegisterUserHandler implements CommandHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private Hasher $passwordHasher
    ) {
    }

    public function __invoke(RegisterUserCommand $command): void
    {
        $user = new User(
            new Id($command->getId()),
            $command->getName(),
            $command->getEmail(),
            $this->passwordHasher->hash($command->getPassword())
        );

        $this->userRepository->save($user);
    }
}
