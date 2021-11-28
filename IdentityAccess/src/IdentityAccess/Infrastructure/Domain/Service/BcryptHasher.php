<?php
namespace App\IdentityAccess\Infrastructure\Domain\Service;

use App\IdentityAccess\Domain\Hasher;

class BcryptHasher implements Hasher
{
    public function hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
