<?php

namespace App\Commands\Lead;

use App\Repositories\Lead\LeadRepository;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class RemoveCommand{
    private int $lead_id;

    public function __construct(
        Request $request,
        private LeadRepository $repository,
    )
    {
        $request->validate([
            'lead' => 'required|integer|exists:leads,id',
        ]);

        $this->lead_id = $request->lead;
    } //Конструктор

    public function __invoke()
    {
        $this->repository->remove($this->lead_id);
        Toast::info('Лид удалён из базы данных');
    } //__invoke
};

?>