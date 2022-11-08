<?php

namespace App\Orchid\Screens;

use App\Models\Lead;
use App\Repositories\Lead\LeadReadRepository;
use App\Repositories\Lead\LeadRepository;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;

class LeadScreen extends Screen
{
    public function __construct(
        private LeadRepository $repository,
        private LeadReadRepository $readRepository
    )
    {}

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'leads' => $this->readRepository->findAll(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Заявки';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Список заявок, поступивших с сайта';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('leads', [
                TD::make(name: 'name', title: 'Имя'),
                TD::make(name: 'phone', title: 'Телефон'),
                TD::make(name: 'created_at', title: 'Дата')->sort()->filter(TD::FILTER_DATE_RANGE),
                TD::make('Действия')->render(function($model){
                    return Link::make()->icon('trash')->route('platform.leads.remove', ['lead' => $model->id]);
                }),
            ]),
        ];
    } //layout

    public function remove(Lead $lead)
    {
        $this->repository->remove($lead);
        Alert::success('Лид удалён из базы данных');
    } //remove
}
