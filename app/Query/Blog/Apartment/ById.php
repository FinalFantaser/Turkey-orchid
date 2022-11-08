<?php

namespace App\Query\Blog\Apartment;

use App\Http\Resources\Blog\Apartment\ApartmentFullResource;
use App\Query\Query;
use App\Repositories\Blog\ApartmentReadRepository;

class ById extends Query{

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->_loadRepositories(ApartmentReadRepository::class);
    } //Конструктор

    public function __invoke()
    {
        $apt = $this->apartmentReadRepository
            ->findById(id: $this->id);

        return new ApartmentFullResource($apt);
    } //__invoke
};

?>