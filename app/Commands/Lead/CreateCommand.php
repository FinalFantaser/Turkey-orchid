<?php

namespace App\Commands\Lead;

use App\Http\Requests\LeadRequest;
use App\Repositories\Lead\LeadRepository;
use Illuminate\Http\Request;

class CreateCommand{
    private string $name;
    private string $phone;

    public function __construct(
        LeadRequest $request,
        private LeadRepository $repository,
    )
    {
        $this->name = $request->name;
        $this->phone = $request->phone;
    } //Конструктор

    public function __invoke()
    {
        $this->repository->create(name: $this->name, phone: $this->phone);
    } //__invoke
};

?>