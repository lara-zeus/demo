<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use LaraZeus\Hermes\Models\Branch;
use LaraZeus\Hermes\Models\MenuItemLabels;
use LaraZeus\Hermes\Models\MenuSection;

class HermesSeeder extends Seeder
{
    /**
     * @throws \JsonException
     */
    public function run()
    {
        DB::table('menu_item_labels')
            ->insertGetId([
                'name' => 'Hot',
                'description' => 'Hot one',
                'color' => '#e61f1f',
                'icon' => 'heroicon-m-fire',
            ]);

        DB::table('menu_item_labels')
            ->insertGetId([
                'name' => 'Hot',
                'description' => 'Hot one',
                'color' => '#e6a21e',
                'icon' => 'tabler-rubber-stamp',
            ]);

        $address = [
            'country' => 1,
            'state' => 1,
            'city' => 1,
            'zip_code' => '212121',
            'phone_number' => '0123456789',
            'mobile' => '0123456789',
            'map' => 'https://www.google.com/maps/@-26.5066023,-11.6096593,2.84z?authuser=0&entry=ttu',
        ];
        $houes = [
            [
                'day' => __('Sunday'),
                'from' => '07:00:00',
                'to' => '11:00:00',
                'closed' => false,
            ],
            [
                'day' => __('Monday'),
                'from' => '07:00:00',
                'to' => '11:00:00',
                'closed' => false,
            ],
            [
                'day' => __('Tuesday'),
                'from' => '07:00:00',
                'to' => '11:00:00',
                'closed' => false,
            ],
            [
                'day' => __('Wednesday'),
                'from' => '07:00:00',
                'to' => '11:00:00',
                'closed' => false,
            ],
            [
                'day' => __('Thursday'),
                'from' => '07:00:00',
                'to' => '11:00:00',
                'closed' => false,
            ],
            [
                'day' => __('Friday'),
                'from' => '07:00:00',
                'to' => '11:00:00',
                'closed' => true,
            ],
            [
                'day' => __('Saturday'),
                'from' => '07:00:00',
                'to' => '11:00:00',
                'closed' => false,
            ],
        ];
        $social = [
            'website' => 'website',
            'instagram' => 'instagram',
            'facebook' => 'facebook',
            'twitter' => 'twitter',
            'whatsapp' => 'whatsapp',
            'snapchat' => 'snapchat',
            'tiktok' => 'tiktok',
        ];
        $branch = DB::table('branches')
            ->insertGetId([
                'name' => json_encode(['en'=>'Main Branch']),
                'description' => json_encode(['en'=>'our Main Branch']),
                'image' => 'https://picsum.photos/600/600?random='.rand(1,99),
                'address' => json_encode($address),
                'hours' => json_encode($houes),
                'social' => json_encode($social),
                'created_at' => now(),
            ]);

        $breakfastMenu = DB::table('menus')
            ->insertGetId([
                'name' => json_encode(['en'=>'Breakfast Menu']),
                'description' => json_encode(['en'=>'our Breakfast Menu']),
                'branch_id' => $branch,
                'is_active' => true,
                'order' => 1,
            ]);
        $breakfastMenuSection_1 = DB::table('menu_sections')
            ->insertGetId([
                'menu_id' => $breakfastMenu,
                'cover' => 'https://picsum.photos/600/600?random='.rand(1,99),
                'name' => json_encode(['en'=>'Drinks']),
                'description' => json_encode(['en'=>'all drinks']),
            ]);
        $breakfastMenuSection_2 = DB::table('menu_sections')
            ->insertGetId([
                'menu_id' => $breakfastMenu,
                'cover' => 'https://picsum.photos/600/600?random='.rand(1,99),
                'name' => json_encode(['en'=>'sandwiches']),
                'description' => json_encode(['en'=>'all our sandwiches']),
            ]);

        $breakfastMenuSection_2_item_1 = DB::table('menu_items')
            ->insertGetId([
                'menu_section_id' => $breakfastMenuSection_1,
                'name' => 'coffee',
                'description' => 'the best coffee in the house',
                'prices' => json_encode([
                    [
                        'type' => 'small',
                        'price' => 10,
                    ],
                    [
                        'type' => 'large',
                        'price' => 20,
                    ]
                ]),
                'images' => 'https://picsum.photos/600/600?random='.rand(1,99),
                'calories' => 10,
                'labels' => json_encode([1, 2]),
                'is_pinned' => true,
            ]);

        $breakfastMenuSection_2_item_2 = DB::table('menu_items')
            ->insertGetId([
                'menu_section_id' => $breakfastMenuSection_1,
                'name' => 'tea',
                'description' => 'hot tea',
                'prices' => json_encode([
                    [
                        'type' => 'small',
                        'price' => 10,
                    ],
                    [
                        'type' => 'large',
                        'price' => 20,
                    ]
                ]),
                'images' => 'https://picsum.photos/600/600?random='.rand(1,99),
                'calories' => 20,
            ]);

        $breakfastMenuSection_2_item_1 = DB::table('menu_items')
            ->insertGetId([
                'menu_section_id' => $breakfastMenuSection_1,
                'name' => 'orange',
                'description' => 'fresh orange juice',
                'prices' => json_encode([
                    [
                        'type' => 'small',
                        'price' => 10,
                    ],
                    [
                        'type' => 'large',
                        'price' => 20,
                    ]
                ]),
                'images' => 'https://picsum.photos/600/600?random='.rand(1,99),
                'calories' => 20,
            ]);

        /*$dinnerMenu = DB::table('menus')
            ->insertGetId([
                'name' => json_encode(['en'=>'Dinner Menu']),
                'description' => json_encode(['en'=>'our Dinner Menu']),
                'branch_id' => $branch,
                'is_active' => true,
                'order' => 2,
                'start_time' => '01:38:53',
                'end_time' => '12:38:53',
            ]);
        $dinnerMenuSection = DB::table('menu_sections')
            ->insertGetId([
                'menu_id' => $breakfastMenu,
                'name' => json_encode(['en'=>'Drinks']),
                'description' => json_encode(['en'=>'all drinks']),
                'cover' => '',
                'order' => 2,
                'is_active' => 1,
            ]);*/

    }
}
