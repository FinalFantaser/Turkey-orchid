<?php

namespace App\Services;

abstract class Service{
    public function __construct()
    {} //Конструктор

    public function query(callable $query): mixed
    {
        return $query();
    } //query
};

?>