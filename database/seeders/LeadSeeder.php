<?php

namespace Database\Seeders;

use App\Repositories\Lead\LeadRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    use WithoutModelEvents;

    public function __construct(
        private LeadRepository $repository
    )
    {} //Конструктор

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->repository->updateOrCreate(name: 'Тест', phone: '7-000-000-00-00');
    }
}
