<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\HasFaker;
use Database\Seeders\Concerns\HasImage;
use Illuminate\Database\Seeder;
use JsonException;

class HermesSeeder extends Seeder
{
    use HasFaker;
    use HasImage;

    /**
     * @throws JsonException
     */
    public function run(): void {}
}
