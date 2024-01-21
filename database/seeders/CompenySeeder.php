<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Compeny;
use Illuminate\Database\Seeder;

class CompenySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Compeny::factory()
            ->count(10)
            ->has(Car::factory()->count(3))
            ->create();
    }
}
