<?php

namespace App\Blog\Application\Transformer;

use App\Blog\Application\Dto\AuthorDto;

class AuthorTransformer
{
    public function transform(array $entities)
    {
        return array_map(fn ($e) => new AuthorDto($e->getId()->getId(), $e->getName(), $e->getEmail()), $entities);
    }
}
