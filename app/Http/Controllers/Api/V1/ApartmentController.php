<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Service;
use Illuminate\Http\Request;

use App\Query\Blog\Apartment\Sale as FindForSaleQuery;
use App\Query\Blog\Apartment\Rent as FindForRentQuery;
use App\Query\Blog\Apartment\ById as FindByIdQuery;

class ApartmentController extends Controller
{
    public function __construct(
        private Service $service
    )
    {} //Конструктор

    public function sale() //Загрузка квартир на продажу
    {
        return $this->service->query(new FindForSaleQuery);
    } //sale

    public function rent() //Загрузка квартир для аренды
    {
        return $this->service->query(new FindForRentQuery);
    } //rent

    public function show(int $apartment) //Загрузка полной информации по квартире
    {
        return $this->service->query(new FindByIdQuery($apartment));
    } //show
}
