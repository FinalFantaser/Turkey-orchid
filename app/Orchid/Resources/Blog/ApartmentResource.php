<?php

namespace App\Orchid\Resources\Blog;

use App\Models\Blog\Apartment;
use App\Models\Blog\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\NumberRange;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
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
            Select::make('category_id')
                ->title('Категория')
                ->options([
                    Category::ID_SALE => Category::TYPE_SALE,
                    Category::ID_RENT => Category::TYPE_RENT,
                ]),

            Input::make('title')
                ->title('Название квартиры')
                ->placeholder('Название квартиры'),

            Input::make('seo_title')
                ->title('SEO-заголовок')
                ->placeholder('SEO-заголовок'),

            Upload::make('attachment')
                ->title('Фотографии')
                ->maxFileSize(2)
                ->targetId()
                ->targetRelativeUrl()
                ->acceptedFiles('image/*'),

            Group::make([
                Input::make('address')
                ->title('Адрес')
                ->placeholder('Адрес'),

                Input::make('located_at')
                    ->title('Расположение')
                    ->placeholder('Расположение'),
            ])->fullWidth(),

            Group::make([
                Input::make('price_sale')
                ->type('number')
                ->title('Цена продажи'),

                Input::make('price_rent')
                    ->type('number')
                    ->title('Цена аренды'),

                Input::make('price_m2')
                    ->type('number')
                    ->title('Цена за м2'),

                Input::make('area')
                    ->type('number')
                    ->title('Площадь'),
            ])->autoWidth(),

            Group::make([
                Input::make('rooms')
                    ->title('Всего комнат'),

                Input::make('bedrooms')
                    ->type('number')
                    ->title('Кол-во спален'),

                Input::make('bathrooms')
                    ->type('number')
                    ->title('Кол-во ванных'),
            ])->autoWidth(),

            Group::make([
                Input::make('floor')
                    ->type('number')
                    ->title('Этаж'),

                Input::make('total_floors')
                    ->type('number')
                    ->title('Этажность'),
            ])->autoWidth(),

            Group::make([
                Matrix::make('details')->title('Особенности')
                    ->columns(['Текст' => 'text'])
                    ->fields([Input::make()->type('text')]),

                Matrix::make('location')->title('Местоположение')
                    ->columns(['Текст' => 'text'])
                    ->fields([Input::make()->type('text')]),
            ])->fullWidth(),
        ];
    }

    /**
     * Get the validation rules that apply to save/update.
     *
     * @return array
     */
    public function rules(Model $model): array
    {
        return [
            // 'category_id' => 'required|exists:categories,id',
            // 'title' => 'required|string|max:256',
            // 'seo_title' => 'required|string|max:256',
            // 'address' => 'required|string|max:256',
            // 'located_at' => 'required|string|max:256',
            // 'price_sale' => 'required|integer|gte:0',
            // 'price_rent' => 'required|integer|gte:0',
            // 'price_m2' => 'required|integer|gte:0',
            // 'area' => 'required|integer|gte:0',
            // 'rooms' => 'required|string|max:256',
            // 'bedrooms' => 'required|integer|gte:0',
            // 'bathrooms' => 'required|integer|gte:0',
            // 'floor' => 'required|integer|gte:0',
            // 'total_floors' => 'required|integer|gte:0',
            // 'details' => 'required|array|max:1024',
            // 'location' => 'required|array|max:1024',
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
            // TD::make()
            //     ->render(function($model){
            //         $pic = $model->attachment()->first();
            //         if(is_null($pic))
            //             return 'Без изображения'; //TODO картинка по умолчанию
            //         else
            //             // return '<img src="' . $pic->url . '" alt="Миниатюра">';
            //             return "<img src=\"$pic->url\" alt=\"Миниатюра\">";
            //     }),

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
            Sight::make(title: 'Фото')->render(function($model){
                if($model->attachment->isNotEmpty()){
                    $arr = Arr::map(array: $model->attachment()->get()->all(),
                    callback: function($value){
                        return "<img src=\"{$value['url']}\">";
                    });

                    return Arr::join(array: $arr, glue: '');
                }
            }),

            Sight::make(name: 'title', title: 'Название'),
            Sight::make(title: 'Категория')->render(function($model){
                return $model->category->title;
            }),
            Sight::make(name: 'address', title: 'Адрес'),
            Sight::make(name: 'located_at', title: 'Расположение'),
            Sight::make(name: 'price_sale', title: 'Цена продажи'),
            Sight::make(name: 'price_rent', title: 'Цена аренды'),
            Sight::make(name: 'price_m2', title: 'Цена за м2'),
            Sight::make(name: 'area', title: 'Площадь'),
            Sight::make(name: 'rooms', title: 'Всего комнат'),
            Sight::make(name: 'bedrooms', title: 'Кол-во спален'),
            Sight::make(name: 'bathrooms', title: 'Кол-во ванных'),
            Sight::make(name: 'floor', title: 'Этаж'),
            Sight::make(name: 'total_floors', title: 'Этажность'),
            Sight::make(title: 'Особенности')->render(function($model){
                $items = Arr::map(array: Arr::pluck(array: $model->details, value: 'text'),
                callback: function($item, $key){
                    return Str::of($item)->prepend('<i><b>' . $key + 1 . ')</b></i> ');
                });

                return Arr::join(array: $items, glue: '<br>');
            }),
            Sight::make(title: 'Местоположение')->render(function($model){
                $items = Arr::map(array: Arr::pluck(array: $model->location, value: 'text'),
                callback: function($item, $key){
                    return Str::of($item)->prepend('<i><b>' . $key + 1 . ')</b></i> ');
                });

                return Arr::join(array: $items, glue: '<br>');
            }),

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

    public function onSave(ResourceRequest $request, Apartment $model): void
    {
        $model->attachment()->syncWithoutDetaching(
            $request->input('attachment', [])
        );
    } //onSave

    public function onDelete(Apartment $model): void
    {
        $model->attachment->each->delete();
    } //onDelete
}
