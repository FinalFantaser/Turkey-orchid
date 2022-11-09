<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApartmentSearchRequest;
use App\Services\Service;
use Illuminate\Http\Request;

use App\Query\Blog\Apartment\Sale as FindForSaleQuery;
use App\Query\Blog\Apartment\Rent as FindForRentQuery;
use App\Query\Blog\Apartment\ById as FindByIdQuery;
use App\Query\Blog\Apartment\SaleWithFilters;

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

    public function saleFiltered(ApartmentSearchRequest $request) //Загрузка квартир на продажу с фильтрацией
    {
        return $this->service->query(
            new SaleWithFilters($request)
        );
    } //saleFiltered

    public function rent() //Загрузка квартир для аренды
    {
        return $this->service->query(new FindForRentQuery);
    } //rent

    public function rentFiltered(ApartmentSearchRequest $request) //Загрузка квартир для аренды с фильтрацией
    {
        
    } //rentFiltered

    public function show(int $apartment) //Загрузка полной информации по квартире
    {
        return $this->service->query(new FindByIdQuery($apartment));
    } //show
}
