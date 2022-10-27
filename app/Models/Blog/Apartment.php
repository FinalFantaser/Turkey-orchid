<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Apartment extends Model
{
    use AsSource, Filterable, Attachable;

    protected $fillable = [
        'category_id',

        'title',
        'seo_title',

        'address',
        'located_at',
        'price_sale',
        'price_rent',
        'price_m2',
        'area',
        'rooms',
        'bedrooms',
        'bathrooms',
        'floor',
        'total_floors',

        'details',
        'location',
    ];

    protected $casts = [
        'category_id' => 'integer',
        
        'title' => 'string',
        'seo_title' => 'string',
        
        'address' => 'string',
        'located_at' => 'string',
        'price_sale' => 'integer',
        'price_rent' => 'integer',
        'price_m2' => 'integer',
        'area' => 'integer',
        'rooms' => 'integer',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'floor' => 'integer',
        'total_floors' => 'integer',


        'details' => 'array',
        'location' => 'array',
    ];

    protected $attributes = [
        'title' => '',
        'seo_title' => '',

        'address' => '',
        'located_at' => '',
        'price_sale' => 0,
        'price_rent' => 0,
        'price_m2' => 0,
        'area' => 0,
        'rooms' => 0,
        'bedrooms' => 0,
        'bathrooms' => 0,
        'floor' => 0,
        'total_floors' => 0,

        
        'details' => [],
        'location' => [],
    ];

    /**
     *      Отношения
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(related: Apartment::class, foreignKey: 'category_id');
    } //category

    /**
     *      Геттеры
     */
    public function getPriceAttribute(): int
    {
        if($this->category_id === Category::ID_SALE)
            return $this->price_sale;
        elseif($this->category_id === Category::ID_RENT)
            return $this->price_rent;
        else
            return 0;
    } //getPriceAttribute
}
