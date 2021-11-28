<?php

namespace App\IdentityAccess\Application\Command;

use App\Common\Domain\Id;
use App\IdentityAccess\Domain\Role;
use App\IdentityAccess\Domain\RoleRepository;
use App\Common\Application\Bus\Command\CommandHandler;

class CreateRoleHandler implements CommandHandler
{
    public function __construct(
        private RoleRepository $roleRepository
    ) {
    }

    public function __invoke(CreateRoleCommand $command): void
    {
        $role = new Role(
            new Id($command->getId()),
            $command->getName()
        );

        $this->roleRepository->save($role);
    }
}
