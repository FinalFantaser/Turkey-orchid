<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Apartment;
use Illuminate\Http\Request;
use Intervention\Image\Exception\NotFoundException;

class ApartmentController extends Controller
{
    public function __construct()
    {
        //TODO Использовать сервисы и репозитории
    } //Конструктор

    public function deleteImage(int $apartment, int $imageIndex)
    {
        //TODO Заменить на сервис или репозиторий
        $apartment = Apartment::findOrFail($apartment);
        if($apartment->hasMedia()){
            $media = $apartment->getMedia();
            if($imageIndex < $media->count())
                $media[$imageIndex]->delete();
        }

        return back();
    } //deleteImage

    public function showImage(int $apartment, int $imageIndex)
    {
        //TODO Заменить на сервис или репозиторий
        $apartment = Apartment::findOrFail($apartment);
        if($apartment->hasMedia()){
            $media = $apartment->getMedia();
            if($imageIndex < $media->count())
                return view('admin.partials.apartments.photo', ['photo' => $apartment->getImageOriginal($imageIndex)]);
            else
                throw new NotFoundException();    
        }
        else
            throw new NotFoundException();
    } //showImage
}
