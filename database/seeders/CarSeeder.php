<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run()
    {
        Car::factory()
            ->count(10)
            ->create();
    }
}
