<?php

namespace App\Http\Controllers;

use App\Commands\Lead\CreateCommand;
use App\Http\Requests\LeadRequest;
use App\Services\Service;
use Illuminate\Http\Response;

class CreateLeadController extends Controller
{
    public function __construct(
        private Service $service
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
        $this->service->command( new CreateCommand($request) );
        return response('Заявка подана', \Symfony\Component\HttpFoundation\Response::HTTP_CREATED);
    } //__invoke
}
