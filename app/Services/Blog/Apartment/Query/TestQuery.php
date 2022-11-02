<?php

namespace App\Services\Blog\Apartment\Query;

use App\Repositories\Blog\ApartmentReadRepository;
use App\Services\Query;

class TestQuery extends Query{
    public function __construct(
        private ApartmentReadRepository $repository
    )
    {}

    public function __invoke(): mixed
    {
        return $this->repository->findAll();
    }
};

?>