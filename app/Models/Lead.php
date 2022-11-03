<?php

namespace App\Models;

use App\Casts\Lead\DateTime;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Lead extends Model
{
    use AsSource, Filterable;
    
    protected $fillable = [
        'name',
        'phone',
    ];

    protected $allowedSorts = [
        'name',
        'phone',
        'created_at',
    ];

    protected $allowedFilters = [
        'created_at',
    ];

    protected $casts = [
        'created_at' => DateTime::class,
        'updated_at' => DateTime::class,
    ];
}
