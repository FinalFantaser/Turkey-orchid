<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\Apartment;
use App\Models\Blog\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Создание квартиры
        $apt = Apartment::updateOrCreate([
            'title' => 'Квартира 180 м²'
        ],
        [
            'seo_title' => 'Квартира 180 м2',
            'description' => 'Полностью мебелированная квартира планировки 3+1, 145 м2. 5 кондиционеров, 2 застекленных балкона и утроенная кухня.',
            'category_id' => Category::ID_SALE,
            'address' => 'Турция, Мерсин, Эрдемли',
            'located_at' => 'у моря, в большом городе',
            'price' => 2000000,
            'price_m2' => 12000,
            'area' => 180,
            'rooms' => 4,
            'bedrooms' => 1,
            'bathrooms' => 1,
            'floor' => 12,
            'total_floors' => 25,
            'details' => [
                '1' => ['text' => '4+1 180 м2 дуплекс (два отдельных входа)'],
                '2' => ['text' => 'верхний этаж сдается в аренду'],
                '3' => ['text' => 'отдельная кухня'],
                '4' => ['text' => 'удобные комнаты'],
                '5' => ['text' => 'нижняя подсекция: зал, спальня, детская комната, кухня, ванная + алатурка туалет, балкон'],
                '6' => ['text' => 'верхняя подсекция: зал, спальня, американская кухня, ванная, балкон'],
                '7' => ['text' => 'стороны: юг / восход / запад'],
            ],
            'location' => [
                '1' => ['text' => 'район кепез эмек'],
                '2' => ['text' => '​недалеко от трамвайной линии и обводной дороги'],
                '3' => ['text' => 'автобусная остановка - 2 мин'],
                '4' => ['text' => 'районный рынок - 2 мин'],
                '5' => ['text' => 'сетевые супермаркеты и пекарня в шаговой доступности'],
                '6' => ['text' => 'государственная школа'],
                '7' => ['text' => 'клиника здоровья (семейный врач)'],
                '8' => ['text' => 'муниципалитет кепеза'],
                '9' => ['text' => 'египетский базар'],
            ],
        ]);

        //Добавление фотографий
        for($i = 1; $i < 4; $i++){
            $apt->addMediaFromDisk("seed/img$i.jpg", 'public')->toMediaCollection();
            Storage::disk('public')->copy(from: "seed/_backup/img$i.jpg", to: "seed/img$i.jpg");
        }
    }
}
