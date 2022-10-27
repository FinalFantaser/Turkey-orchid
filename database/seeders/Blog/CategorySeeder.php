<?php

namespace Database\Seeders\Blog;

use App\Models\Blog\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate(['id' => Category::ID_SALE], ['title' => Category::TYPE_SALE]);
        Category::updateOrCreate(['id' => Category::ID_RENT], ['title' => Category::TYPE_RENT]);
    }
}
