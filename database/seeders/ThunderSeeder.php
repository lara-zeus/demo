<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use LaraZeus\Thunder\Models\Office;

class ThunderSeeder extends Seeder
{
    /**
     * @throws \JsonException
     */
    public function run()
    {
        Office::factory()->count(4)->create();

    }
}
