<?php

namespace App\Common\Domain;

use App\Common\Domain\Id;

interface Repository
{
    public function findById(Id $id);

    public function all(): array;

    public function save($entity): void;
}
