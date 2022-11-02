<?php

namespace App\Services;

abstract class Service{
    public function __construct()
    {} //Конструктор

    public function query(string $queryClassName): mixed
    {
        $query = app($queryClassName);
        return $query();
    } //query
};

?>