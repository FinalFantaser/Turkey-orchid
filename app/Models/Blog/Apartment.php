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
        'price',
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
        'price' => 'integer',
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
        'price' => 0,
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
        'price',
        'name',
    ];

    protected $allowedSorts = [
        'category_id',
        'price',
        'created_at'
    ];

    /**
     *      Фильтры поиска
     */
    public function scopeSale($query)
    {
        return $query->where('category_id', Category::ID_SALE);
    } //scopeSale

    public function scopeRent($query)
    {
        return $query->where('category_id', Category::ID_RENT);
    } //scopeSale

    public function scopePrice($query, int $from, int $to)
    {
        return $to > 0
            ? $query->whereBetween('price', [$from, $to])
            : $query->where('price', '>=', $from);
    } //scopePrice

    public function scopeSqm($query, int $from, int $to)
    {
        return $to > 0
            ? $query->whereBetween('price_m2', [$from, $to])
            : $query->where('price_m2', '>=', $from);
    } //scopeSqm

    public function scopeRooms($query, array $rooms)
    {
        //Определения наличия команды 4+ в массиве
        $more = false;
        if(in_array(needle: 'more', haystack: $rooms)){
            $more = true;
            $key = array_search(needle: 'more', haystack: $rooms);
            unset($rooms[$key]);
            
            if(count($rooms) < 1)
                return $query->where('rooms', '>=', 4);
        }

        if(count($rooms) < 1)
            return $query;

        return $query->whereIn('rooms', $rooms)
            ->when($more, function($query){
                return $query->orWhere('rooms', '>=', 4);
            });
    } //scopeRooms

    /**
     *      Преобразования изображений
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        //Стандартный размер изображения, используется для сжатия слишком больших исходных картинок
        $this->addMediaConversion('default')
           ->fit(Manipulations::FIT_MAX, 490, 332);
        
        //Миниатюра для админки
        $this->addMediaConversion('thumb_admin')
            ->fit(Manipulations::FIT_STRETCH, 50, 50);

        //Миниатюра для слайдера
        $this->addMediaConversion('thumb_slider')
            ->fit(Manipulations::FIT_MAX, 200, 150);

        //Миниатюра для каталога
        $this->addMediaConversion('thumb_catalog')
            ->crop(Manipulations::CROP_CENTER, 277, 300);

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

    public function getSliderThumbs(): array
    {
        if($this->hasMedia())
            return Arr::map(array: $this->getMedia()->all(), callback: function($item){
                return $item->getUrl('thumb_slider');
            });
        else
            return [];
    } //getSliderThumbs

    public function getCatalogThumbs(): array
    {
        if($this->hasMedia())
            return Arr::map(array: $this->getMedia()->all(), callback: function($item){
                return $item->getUrl('thumb_catalog');
            });
        else
            return [];
    } //getSliderThumbs

    public function getSliderThumb(int $index = 0): ?string
    {
        return $this->hasMedia() ? $this->getMedia()[$index]->getUrl('thumb_slider') : null;
    } //getSliderThumb

    public function getCatalogThumb(int $index = 0): ?string
    {
        return $this->hasMedia() ?  $this->getMedia()[$index]->getUrl('thumb_catalog') : null;
    } //getCatalogThumb
}
