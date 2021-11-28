<?php

namespace App\Blog\Application\Query;

use App\Blog\Domain\AuthorRepository;
use App\Common\Application\Bus\Query\QueryHandler;
use App\Blog\Application\Transformer\AuthorTransformer;

class AuthorCollectionQueryHandler implements QueryHandler
{

    public function __construct(private AuthorRepository $authorRepository, private AuthorTransformer $authorTransformer)
    {
    }

    public function __invoke(AuthorCollectionQuery $query)
    {
        return $this->authorTransformer->transform($this->authorRepository->all());
    }
}
