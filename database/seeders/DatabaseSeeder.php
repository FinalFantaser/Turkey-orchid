<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Blog\ApartmentSeeder;
use Database\Seeders\Blog\CategorySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            ApartmentSeeder::class,
            LeadSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}
