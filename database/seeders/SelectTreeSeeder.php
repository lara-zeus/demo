<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SelectTreeSeeder extends Seeder
{
    /**
     * @throws \JsonException
     */
    public function run()
    {
        DB::table('select_tree_categories')->insert([
            ['name' => 'Cooking', 'parent_id' => null],
            ['name' => 'Ingredients', 'parent_id' => 1],
            ['name' => 'Fruits', 'parent_id' => 2],
            ['name' => 'Vegetables', 'parent_id' => 2],
            ['name' => 'Meat', 'parent_id' => 2],
            ['name' => 'Techniques', 'parent_id' => 1],
            ['name' => 'Baking', 'parent_id' => 6],
            ['name' => 'Grilling', 'parent_id' => 6],
            ['name' => 'Boiling', 'parent_id' => 6],
            ['name' => 'Recipes', 'parent_id' => 1],
            ['name' => 'Appetizers', 'parent_id' => 10],
            ['name' => 'Main Dishes', 'parent_id' => 10],
            ['name' => 'Desserts', 'parent_id' => 10],
        ]);
    }
}
