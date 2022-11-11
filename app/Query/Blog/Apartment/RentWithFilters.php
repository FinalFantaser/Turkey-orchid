<?php

namespace App\Query\Blog\Apartment;

use App\Models\Blog\Category;

class RentWithFilters extends SaleWithFilters{
    protected function _getCategory() //Метод для удобства наследования
    {
        return $this->apartmentReadRepository->query()->rent();
    } //_getCategory
};

?>