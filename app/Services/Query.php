<?php

namespace App\Services;

abstract class Query{
    abstract function __invoke(): mixed;
}


?>