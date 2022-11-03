<?php

namespace App\Http\Controllers;

use App\Commands\Lead\CreateCommand;
use App\Http\Requests\LeadRequest;
use App\Services\LeadService;

class CreateLeadController extends Controller
{
    public function __construct(
        private LeadService $service
    )
    {}

    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\LeadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LeadRequest $request)
    {
        $this->service->command( CreateCommand::class );

        return back();
    }
}
