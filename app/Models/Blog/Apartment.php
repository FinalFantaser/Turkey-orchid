<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Apartment extends Model implements HasMedia
{
    use AsSource, Filterable, InteractsWithMedia;

    protected $fillable = [
        'category_id',

        'title',
        'seo_title',
        
        'description',

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
        'rooms' => 'string',
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

        
        'details' => '{}',
        'location' => '{}',
    ];

    protected $allowedFilters = [
        'category_id',
        'name',
    ];

    protected $allowedSorts = [
        'category_id',
        'created_at'
    ];

    /**
     *      Преобразования
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        //Стандартный размер изображения, используется для сжатия слишком больших исходных картинок
        $this->addMediaConversion('default')
           ->fit(Manipulations::FIT_MAX, 490, 332);
        
        //Миниатюра для админки
        $this->addMediaConversion('thumb_admin')
            ->fit(Manipulations::FIT_STRETCH, 50, 50);

        //Миниатюра для клиентской части
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_MAX, 100, 100);
    } //registerMediaConversions

    /**
     *      Отношения
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(related: Category::class, foreignKey: 'category_id');
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

    public function getImageOriginal(int $index = 0): ?string
    {
        return $this->hasMedia() ? $this->getMedia()[$index]->getUrl() : null;
    } //getImageOriginal

    public function getImage(int $index = 0): ?string
    {
        return $this->hasMedia() ? $this->getMedia()[$index]->getUrl('default') : null;
    } //getImage

    public function getImages(): array
    {
        if($this->hasMedia())
            return Arr::map(array: $this->getMedia()->all(), callback: function($item){
                return $item->getUrl('default');
            });
        else
            return [];
    } //getImages

    public function getThumbAdmin(): ?string
    {
        return $this->hasMedia() ? $this->getMedia()->first()->getUrl('thumb_admin') : null;
    } //getThumbAdmin

    public function getThumbs(): array
    {
        if($this->hasMedia())
            return Arr::map(array: $this->getMedia()->all(), callback: function($item){
                return $item->getUrl('thumb');
            });
        else
            return [];
    } //getThumbs

    public function getThumb(int $index = 0): string
    {
        return $this->getMedia()[$index]->getUrl('thumb');
    } //getThumb
}
