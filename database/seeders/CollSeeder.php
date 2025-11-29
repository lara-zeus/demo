<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CollSeeder extends Seeder
{
    /**
     * @throws \JsonException
     */
    public function run()
    {
        DB::table(config('zeus-bolt.table-prefix') . 'collections')->insertGetId([
            'name' => 'numbers range 1-5',
            'values' => json_encode([
                [
                    'itemKey' => '1',
                    'itemValue' => 'One',
                    'itemIsDefault' => false,
                ],
                [
                    'itemKey' => '2',
                    'itemValue' => 'Two',
                    'itemIsDefault' => false,
                ],
                [
                    'itemKey' => '3',
                    'itemValue' => 'Three',
                    'itemIsDefault' => false,
                ],
                [
                    'itemKey' => '4',
                    'itemValue' => 'Four',
                    'itemIsDefault' => false,
                ],
                [
                    'itemKey' => '5',
                    'itemValue' => 'Five',
                    'itemIsDefault' => false,
                ],
            ], JSON_THROW_ON_ERROR),
            'created_at' => now(),
        ]);
        DB::table(config('zeus-bolt.table-prefix') . 'collections')->insertGetId([
            'name' => 'yes no maybe list',
            'values' => json_encode([
                [
                    'itemKey' => 'yes',
                    'itemValue' => 'Yes',
                    'itemIsDefault' => false,
                ],
                [
                    'itemKey' => 'no',
                    'itemValue' => 'No',
                    'itemIsDefault' => false,
                ],
                [
                    'itemKey' => 'maybe',
                    'itemValue' => 'Maybe',
                    'itemIsDefault' => false,
                ],
            ], JSON_THROW_ON_ERROR),
            'created_at' => now(),
        ]);
    }
}
