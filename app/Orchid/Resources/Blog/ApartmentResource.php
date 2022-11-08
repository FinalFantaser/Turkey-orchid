<?php

namespace App\Orchid\Resources\Blog;

use App\Models\Blog\Apartment;
use App\Models\Blog\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
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
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return 'Квартиры';
    }

    /**
     * Get the displayable icon of the resource.
     *
     * @return string
     */
    public static function icon(): string
    {
        return 'building';
    }

    /**
     * Get the text for the create resource button.
     *
     * @return string|null
     */
    public static function createButtonLabel(): string
    {
        return 'Добавить квартиру';
    }

    /**
     * Get the text for the create resource toast.
     *
     * @return string
     */
    public static function createToastMessage(): string
    {
        return 'Квартира добавлена в базу данных';
    }

    /**
     * Get the text for the update resource button.
     *
     * @return string
     */
    public static function updateButtonLabel(): string
    {
        return 'Обновить данные квартиры';
    }

    /**
     * Get the text for the update resource toast.
     *
     * @return string
     */
    public static function updateToastMessage(): string
    {
        return 'Данные квартиры обновлены';
    }

    /**
     * Get the text for the delete resource button.
     *
     * @return string
     */
    public static function deleteButtonLabel(): string
    {
        return 'Удалить квартиру';
    }

    /**
     * Get the text for the delete resource toast.
     *
     * @return string
     */
    public static function deleteToastMessage(): string
    {
        return 'Квартира удалена из базы данных';
    }

    /**
     * Get the text for the save resource button.
     *
     * @return string
     */
    public static function saveButtonLabel(): string
    {
        return 'Сохранить данные квартиры';
    }

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

            TextArea::make('description')
                ->title('Описание')
                ->placeholder('Описание квартиры'),

            Input::make('images')
                ->type('file')
                ->multiple()
                ->title('Фотографии')
                ->maxFileSize(2),

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
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:256',
            'description' => 'string|max:1024',
            'seo_title' => 'string|max:256',
            'address' => 'string|max:256',
            'located_at' => 'string|max:256',
            'price_sale' => 'integer|gte:0',
            'price_rent' => 'integer|gte:0',
            'price_m2' => 'integer|gte:0',
            'area' => 'integer|gte:0',
            'rooms' => 'string|max:256',
            'bedrooms' => 'integer|gte:0',
            'bathrooms' => 'integer|gte:0',
            'floor' => 'integer|gte:0',
            'total_floors' => 'integer|gte:0',
            'details' => 'array|max:1024',
            'location' => 'array|max:1024',
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
            TD::make()
                ->render(function($model){
                    $thumb = $model->getThumbAdmin();
                    return "<img src=\"$thumb\" alt=\"Миниатюра\" class=\"img-thumbnail\">"; 
                }),

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
                return view('admin.partials.apartments.show_photos', ['photos' => $model->getThumbs(), 'apartment_id' => $model->id]);
            }),

            Sight::make(name: 'title', title: 'Название'),
            Sight::make(title: 'Категория')->render(function($model){
                return $model->category->title;
            }),
            Sight::make(name: 'description', title: 'Описание'),
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
        return [
        ];
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
        $model->fill($request->except('images')); //TODO Заменить на инструкция из репозитория
        $model->save();

        if($request->filled('images'))
            foreach($request->input('images') as $key => $file)
                $model->addMedia($request->input('images')[$key])->toMediaCollection();
    } //onSave

    public function onDelete(Apartment $model): void
    {
        $model->getMedia()->each->delete();
        $model->delete();
    } //onDelete
}
