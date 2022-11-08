<?php

namespace App\Services;

use App\Commands\Command;
use App\Query\Query;

class Service{    
    public function command(Command $command)
    {
        return $command();
    } //command
    
    public function query(Query $query)
    {
        return $query();
    } //command
};