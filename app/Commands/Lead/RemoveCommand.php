<?php

namespace App\Commands\Lead;

use App\Commands\Command;
use App\Repositories\Lead\LeadRepository;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class RemoveCommand extends Command{
    public function __construct(
        Request $request,
        // private LeadRepository $repository,
    )
    {
        $request->validate([
            'lead' => 'required|integer|exists:leads,id',
        ]);

        $this->lead_id = $request->lead;
        $this->_loadRepositories(['repository' => new LeadRepository]);
    } //Конструктор

    public function __invoke()
    {
        $this->repository->remove($this->lead_id);
        Toast::info('Лид удалён из базы данных');
    } //__invoke
};

?>