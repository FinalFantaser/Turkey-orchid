<?php

namespace App\Query\Blog\Apartment;

use App\Http\Requests\ApartmentSearchRequest;
use App\Http\Resources\Blog\Apartment\ApartmentBriefResource;
use App\Query\Query;
use App\Repositories\Blog\ApartmentReadRepository;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class SaleWithFilters extends Query{
    protected const PER_PAGE = 8;
    
    public function __construct(ApartmentSearchRequest $request)
    {
        $this->price_from = $request->price_from;
        $this->price_to = $request->price_to;
        $this->m2_from = $request->m2_from;
        $this->m2_to = $request->m2_to;
        $this->date = $request->filled('date') ? Carbon::parse($request->date)->startOfDay() : null;
        $this->rooms = $request->has('rooms') ? Arr::whereNotNull($request->rooms) : [];

        $this->_loadRepositories(ApartmentReadRepository::class);
    } //__construct

    public function __invoke()
    {   
        return ApartmentBriefResource::collection(
            $this->_buildQuery()
        );
    } //__invoke

    protected function _buildQuery(): LengthAwarePaginator
    {
        $query = $this->_getCategory()
            ->price($this->price_from, $this->price_to)
            ->sqm($this->m2_from, $this->m2_to)
            ->rooms($this->rooms)
            ->when(!is_null($this->date), function($query){
                return $query->whereDate('created_at', '>=', $this->date);
            })
            ->paginate(static::PER_PAGE);

        return $query;
    } //_buildQuery

    protected function _getCategory() //Метод для удобства наследования
    {
        return $this->apartmentReadRepository->query()->sale();
    } //_getCategory
};

?>