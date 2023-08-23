<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraZeus\Hermes\Models\Branch;
use LaraZeus\Hermes\Models\Menu;
use LaraZeus\Hermes\Models\MenuItemLabels;
use LaraZeus\Hermes\Models\MenuSection;

class HermesSeeder extends Seeder
{
    /**
     * @throws \JsonException
     */
    public function run()
    {

        Branch::factory()
            ->count(1)
            ->hasMenu(1, function (array $attributes, Branch $branch) {
                return [
                    'branch_id' => $branch->id,
                ];
            })
            ->create();

        MenuSection::factory()
            ->count(5)
            ->hasItems(13, function (array $attributes, MenuSection $sec) {
                return [
                    'menu_section_id' => $sec->id,
                ];
            })
            ->create([
                'menu_id' => 1,
            ]);

        MenuItemLabels::factory()
            ->count(5)
            ->create();
    }
}
