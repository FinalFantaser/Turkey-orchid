<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Category extends Model
{
    use AsSource, Filterable, Attachable;

    protected $fillable = [
        'title',
    ];

    public const TYPE_SALE = 'Купить квартиру';
    public const TYPE_RENT = 'Снять квартиру';

    public const ID_SALE = 1;
    public const ID_RENT = 2;

    /**
     *      Отношения
     */
    public function apartments(): HasMany
    {
        return $this->hasMany(related: Apartment::class);
    } //apartments
}
