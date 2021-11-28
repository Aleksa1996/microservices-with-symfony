<?php

namespace App\IdentityAccess\Application\Command;

class AssignRoleToUserCommand
{
    public function __construct(
        private string $userId,
        private string $roleId,
    ) {
        $this->userId = $userId;
        $this->roleId = $roleId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getRoleId(): string
    {
        return $this->roleId;
    }
}
