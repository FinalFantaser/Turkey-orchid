<?php

namespace App\Repositories\Lead;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LeadReadRepository{
    public function query(): Builder
    {
        return Lead::query()->filters()->defaultSort('created_at');
    }

    public function findById(int $id, bool $fail = true): ?Lead
    {
        // return $fail ? Lead::find($id) : Lead::findOrFail($id);
        return $fail ? $this->query()->find($id) : $this->query()->findOrFail($id);
    } //findById

    public function findAll(bool $paginate = true, int $perPage = 50): Collection|LengthAwarePaginator
    {
        return $paginate ? $this->query()->paginate($perPage) : $this->query()->get();
    } //findAll
};

?>