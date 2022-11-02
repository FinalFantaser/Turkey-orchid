<div class="row">
    @foreach ($photos as $photo)        
        <div class="col-2  text-center">
            <div class="row">
                <div class="col text-center">
                    <a href="{{route('platform.apartments.media.show', ['apartment' => $apartment_id, 'imageIndex' => $loop->index])}}" target="_blank">
                        <img src="{{$photo}}" alt="Фото {{$loop->index + 1}}" class="img-thumbnail">
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col text-center">
                    <a href="{{route('platform.apartments.media.destroy', ['apartment' => $apartment_id, 'imageIndex' => $loop->index])}}" class="text-u-l">
                        Удалить
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>