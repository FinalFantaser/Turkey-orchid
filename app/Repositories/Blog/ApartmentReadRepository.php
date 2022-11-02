<?php

namespace App\Repositories\Blog;

use App\Models\Blog\Apartment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ApartmentReadRepository{
    /**
     *      Открытые функции
     */
    public function query(): Builder
    {
        return Apartment::query()->with(['category']);
    } //query

    public function findById(int $id, bool $fail = true): ?Apartment
    {
        $query = $this->query()->where(['id' => $id]);
        return $fail ? $query->firstOrFail() : $query->first();
    } //findById

    public function findAll(bool $paginate = true, int $perPage = 10): Collection|LengthAwarePaginator
    {
        return $paginate ? $this->query()->paginate($perPage) : $this->query()->get();
    } //findAll
};

?>