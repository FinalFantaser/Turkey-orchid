<?php

namespace App\Http\Controllers\Admin;

use App\Commands\Lead\RemoveCommand;
use App\Http\Controllers\Controller;
use App\Services\Service;
use Illuminate\Http\Request;


class DeleteLeadController extends Controller
{
    public function __construct(
        private Service $service,
    )
    {}

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->service->command(
            new RemoveCommand($request)
        );
        
        return back();
    }
}
