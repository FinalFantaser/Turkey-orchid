<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\Apartment;
use App\Models\Blog\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'category_id' => Category::ID_SALE,
            'address' => 'Турция, Мерсин, Эрдемли',
            'located_at' => 'у моря, в большом городе',
            'price_sale' => 2000000,
            'price_rent' => 0,
            'price_m2' => 12000,
            'area' => 180,
            'rooms' => '4+1 дуплекс (два отдельных входа)',
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

        //TODO Добавление фотографий
        
    }
}
