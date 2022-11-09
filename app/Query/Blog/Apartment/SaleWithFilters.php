<?php

namespace App\Query\Blog\Apartment;

use App\Http\Requests\ApartmentSearchRequest;
use App\Http\Resources\Blog\Apartment\ApartmentBriefResource;
use App\Query\Query;
use App\Repositories\Blog\ApartmentReadRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class SaleWithFilters extends Query{
    public function __construct(ApartmentSearchRequest $request)
    {
        $this->price_from = $request->price_from;
        $this->price_to = $request->price_to;
        $this->m2_from = $request->m2_from;
        $this->m2_to = $request->m2_to;
        $this->date = Carbon::parse($request->date);
        $this->rooms = $request->rooms;

        $this->_loadRepositories(ApartmentReadRepository::class);
    } //__construct

    public function __invoke()
    {
        return ApartmentBriefResource::collection(
            $this->_buildQuery()
        );
    } //__invoke

    protected function _buildQuery(): Builder
    {
        $query = $this->apartmentReadRepository->query()->sale();

        
        return $query;
    } //_buildQuery
};

?>