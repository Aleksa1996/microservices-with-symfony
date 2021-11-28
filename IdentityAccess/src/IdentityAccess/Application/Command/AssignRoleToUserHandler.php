<?php

namespace App\IdentityAccess\Application\Command;

use App\Common\Domain\Id;
use App\IdentityAccess\Domain\RoleRepository;
use App\IdentityAccess\Domain\UserRepository;
use App\Common\Application\Bus\Command\CommandHandler;
use App\IdentityAccess\Application\Exception\RoleNotFound;
use App\IdentityAccess\Application\Exception\UserNotFound;

class AssignRoleToUserHandler implements CommandHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private RoleRepository $roleRepository
    ) {
    }

    public function __invoke(AssignRoleToUserCommand $command): void
    {
        $user = $this->userRepository->findById(new Id($command->getUserId()));

        if (empty($user)) {
            throw new UserNotFound();
        }

        $role = $this->roleRepository->findById(new Id($command->getRoleId()));

        if (empty($role)) {
            throw new RoleNotFound();
        }

        $user->assignRole($role);

        $this->roleRepository->save($user);
    }
}
