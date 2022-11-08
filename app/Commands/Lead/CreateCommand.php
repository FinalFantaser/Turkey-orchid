<?php

namespace App\Commands\Lead;

use App\Commands\Command;
use App\Http\Requests\LeadRequest;
use App\Repositories\Lead\LeadRepository;
use Illuminate\Http\Request;

class CreateCommand extends Command{

    public function __construct(
        LeadRequest $request,
        // private LeadRepository $repository,
    )
    {
        $this->name = $request->name;
        $this->phone = $request->phone;

        $this->_loadRepositories(['repository' => new LeadRepository]);
    } //Конструктор

    public function __invoke()
    {
        $this->repository->create(name: $this->name, phone: $this->phone);
    } //__invoke
};

?>