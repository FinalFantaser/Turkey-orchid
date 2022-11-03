<?php

namespace App\Query;

abstract class Query{
    abstract public function __invoke();
};