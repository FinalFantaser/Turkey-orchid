<?php

namespace App\Services;

abstract class Service{    
    public function command(string $commandClassName)
    {
        $command = app($commandClassName);
        $command();
    } //command
    
    public function query(string $queryClassname)
    {
        $query = app($queryClassname);
        $query();
    } //command
};