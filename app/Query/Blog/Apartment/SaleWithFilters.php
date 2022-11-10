<?php

namespace App\Query\Blog\Apartment;

use App\Http\Requests\ApartmentSearchRequest;
use App\Http\Resources\Blog\Apartment\ApartmentBriefResource;
use App\Models\Blog\Category;
use App\Query\Query;
use App\Repositories\Blog\ApartmentReadRepository;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class SaleWithFilters extends Query{
    protected const PER_PAGE = 8;
    protected const CATEGORY = Category::ID_SALE;

    public function __construct(ApartmentSearchRequest $request)
    {
        $this->price_from = $request->price_from;
        $this->price_to = $request->price_to;
        $this->m2_from = $request->m2_from;
        $this->m2_to = $request->m2_to;
        $this->date = $request->filled('date') ? Carbon::parse($request->date)->startOfDay() : null;
        $this->rooms = $request->rooms;

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
        $query = $this->apartmentReadRepository->query()
            ->price(category_id: static::CATEGORY, from: $this->price_from, to: $this->price_to)
            ->sqm($this->m2_from, $this->m2_to)
            ->rooms($this->rooms)
            ->when(!is_null($this->date), function($query){
                return $query->whereDate('created_at', '>=', $this->date);
            })
            ->paginate(static::PER_PAGE);

        return $query;
    } //_buildQuery
};

?>