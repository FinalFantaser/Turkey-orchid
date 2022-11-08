<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private Service $service
    )
    {} //Конструктор

    public function main()
    {
        return view('client.main.index');
    } //main
}
