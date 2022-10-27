<?php

namespace App\Orchid\Resources\Blog;

use App\Models\Blog\Apartment;
use App\Models\Blog\Category;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\NumberRange;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class ApartmentResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Apartment::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('title')
                ->title('Название квартиры')
                ->placeholder('Название квартиры'),

            Input::make('address')
                ->title('Адрес')
                ->placeholder('Адрес'),

            Input::make('located_at')
                ->title('Расположение')
                ->placeholder('Расположение'),

            NumberRange::make('price_sale')
                ->title('Цена продажи'),

            NumberRange::make('price_rent')
                ->title('Цена аренды'),

            NumberRange::make('price_m2')
                ->title('Цена за м2'),
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            // TD::make('id'),
            TD::make(title: 'Категория')
                ->render(function($model){
                    return $model->category->title;
                }),
            TD::make(name: 'title', title: 'Название'),
            TD::make(title: 'Цена')
                ->render(function($model){
                    return $model->price;
                }),

            TD::make('created_at', 'Дата')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make(name: 'title', title: 'Название'),
            Sight::make(name: 'address', title: 'Адрес'),
            Sight::make(name: 'located_at', title: 'Расположение'),
            Sight::make(name: 'price_sale', title: 'Цена продажи'),
            Sight::make(name: 'price_rent', title: 'Цена аренды'),
            Sight::make(name: 'price_m2', title: 'Цена за м2'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * Get relationships that should be eager loaded when performing an index query.
     *
     * @return array
     */
    public function with(): array
    {
        return ['category'];
    }

    /**
     * Get the number of models to return per page
     *
     * @return int
     */
    public static function perPage(): int
    {
        return 10;
    }
}
