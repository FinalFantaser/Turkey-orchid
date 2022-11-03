<?php

namespace App\Commands;

use Illuminate\Http\Request;

abstract class Command{
    // abstract public function __construct(Request $request);
    abstract public function __invoke();
};

?>