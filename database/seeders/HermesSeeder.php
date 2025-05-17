<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\HasFaker;
use Database\Seeders\Concerns\HasImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HermesSeeder extends Seeder
{
    use HasImage;
    use HasFaker;

    /**
     * @throws \JsonException
     */
    public function run(): void
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
                'name' => 'chef choice',
                'description' => 'chef choice',
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
                'name' => json_encode(['en' => 'Main Branch'], JSON_THROW_ON_ERROR),
                'description' => json_encode(['en' => 'our Main Branch'], JSON_THROW_ON_ERROR),
                'image' => $this->getImage('branches', true),
                'address' => json_encode($address, JSON_THROW_ON_ERROR),
                'hours' => json_encode($houes, JSON_THROW_ON_ERROR),
                'social' => json_encode($social, JSON_THROW_ON_ERROR),
                'created_at' => now(),
            ]);

        $breakfastMenu = DB::table('menus')
            ->insertGetId([
                'name' => json_encode(['en' => 'Breakfast Menu'], JSON_THROW_ON_ERROR),
                'description' => json_encode(['en' => 'our Breakfast Menu'], JSON_THROW_ON_ERROR),
                'branch_id' => $branch,
                'is_active' => true,
                'order' => 1,
            ]);

        $breakfastMenuSection_1 = DB::table('menu_sections')
            ->insertGetId([
                'menu_id' => $breakfastMenu,
                'cover' => $this->getImage('menu_sections'),
                'name' => json_encode(['en' => 'Drinks'], JSON_THROW_ON_ERROR),
                'description' => json_encode(['en' => 'all drinks'], JSON_THROW_ON_ERROR),
            ]);

        $breakfastMenuSection_2 = DB::table('menu_sections')
            ->insertGetId([
                'menu_id' => $breakfastMenu,
                'cover' => $this->getImage('menu_sections'),
                'name' => json_encode(['en' => 'sandwiches'], JSON_THROW_ON_ERROR),
                'description' => json_encode(['en' => 'all our sandwiches'], JSON_THROW_ON_ERROR),
            ]);

        DB::table('menu_items')
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
                    ],
                ], JSON_THROW_ON_ERROR),
                'images' => $this->getImage('menu_items'),
                'calories' => 10,
                'prep_time' => '04:04',
                'labels' => json_encode([1, 2], JSON_THROW_ON_ERROR),
                'is_pinned' => true,
            ]);

        DB::table('menu_items')
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
                    ],
                ], JSON_THROW_ON_ERROR),
                'images' => $this->getImage('menu_items'),
                'calories' => 20,
            ]);

        DB::table('menu_items')
            ->insertGetId([
                'menu_section_id' => $breakfastMenuSection_2,
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
                    ],
                ], JSON_THROW_ON_ERROR),
                'images' => $this->getImage('menu_items'),
                'calories' => 20,
            ]);
    }
}
