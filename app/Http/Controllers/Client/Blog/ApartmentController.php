<?php

namespace App\Http\Controllers\Client\Blog;

use App\Http\Controllers\Controller;
use App\Repositories\Blog\ApartmentReadRepository;
use App\Services\Blog\Apartment\ApartmentService;
use App\Services\Blog\Apartment\Query\TestQuery;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function __construct(
        private ApartmentService $service
    )
    {} //Конструктор

    public function test()
    {
        $data = $this->service->query(app(TestQuery::class));

        return $data->first()->title;
    } //test
}
