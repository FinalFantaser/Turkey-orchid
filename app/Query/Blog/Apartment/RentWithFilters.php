<?php

namespace App\Query\Blog\Apartment;

use App\Models\Blog\Category;

class RentWithFilters extends SaleWithFilters{
    protected const CATEGORY = Category::ID_RENT;
};

?>