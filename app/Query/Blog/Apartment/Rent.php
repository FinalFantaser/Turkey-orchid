<?php

namespace App\Query\Blog\Apartment;

use App\Http\Resources\Blog\Apartment\ApartmentBriefResource;
use App\Models\Blog\Category;
use App\Query\Query;
use App\Repositories\Blog\ApartmentReadRepository;

class Rent extends Query{
    private const PER_PAGE = 4;

    public function __construct()
    {
        $this->_loadRepositories(ApartmentReadRepository::class);
    } //Конструктор

    public function __invoke()
    {
        $apts = $this->apartmentReadRepository->query()
            ->where('category_id', Category::ID_RENT)
            ->paginate(self::PER_PAGE);

        return ApartmentBriefResource::collection($apts);
    } //__invoke
};

?>