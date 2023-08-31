<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Container\Container;
use Faker\Generator;
use Intervention\Image\Facades\Image;

class HermesSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Container::getInstance()->make(Generator::class);
    }

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

        $imageID = $this->getImage();

        $branch = DB::table('branches')
            ->insertGetId([
                'name' => json_encode(['en' => 'Main Branch']),
                'description' => json_encode(['en' => 'our Main Branch']),
                'image' => $imageID,
                'address' => json_encode($address),
                'hours' => json_encode($houes),
                'social' => json_encode($social),
                'created_at' => now(),
            ]);

        $breakfastMenu = DB::table('menus')
            ->insertGetId([
                'name' => json_encode(['en' => 'Breakfast Menu']),
                'description' => json_encode(['en' => 'our Breakfast Menu']),
                'branch_id' => $branch,
                'is_active' => true,
                'order' => 1,
            ]);

        $breakfastMenuSection_1 = DB::table('menu_sections')
            ->insertGetId([
                'menu_id' => $breakfastMenu,
                'cover' => 'https://picsum.photos/600/600?random='.rand(1, 99),
                'name' => json_encode(['en' => 'Drinks']),
                'description' => json_encode(['en' => 'all drinks']),
            ]);

        $breakfastMenuSection_2 = DB::table('menu_sections')
            ->insertGetId([
                'menu_id' => $breakfastMenu,
                'cover' => 'https://picsum.photos/600/600?random='.rand(1, 99),
                'name' => json_encode(['en' => 'sandwiches']),
                'description' => json_encode(['en' => 'all our sandwiches']),
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
                    ]
                ]),
                'images' => 'https://picsum.photos/600/600?random='.rand(1, 99),
                'calories' => 10,
                'prep_time' => '04:04',
                'labels' => json_encode([1, 2]),
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
                    ]
                ]),
                'images' => 'https://picsum.photos/600/600?random='.rand(1, 99),
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
                    ]
                ]),
                'images' => 'https://picsum.photos/600/600?random='.rand(1, 99),
                'calories' => 20,
            ]);
    }

    public function getImage(): int
    {
        $randName = $this->faker->randomNumber();
        $imgUrl = 'https://picsum.photos/1300/700?random='.$randName;
        $getImageContent = file_get_contents($imgUrl);
        $fileName = 'branch'.$randName.'.jpg';
        $directory = 'branches';
        $disk = 'public';

        if (!Storage::disk($disk)->exists($directory.'/'.$fileName)) {
            Storage::disk($disk)->put($directory.'/'.$fileName, $getImageContent);
        }

        $data = Image::make(Storage::disk($disk)->path($directory.'/'.$fileName));

        return DB::table('curator_media')
            ->insertGetId([
                'name' => $data->filename,
                'path' => $directory.'/'.$fileName,
                'ext' => $data->extension,
                'type' => $data->mime(),
                'alt' => $this->faker->words(rand(3, 8), true),
                'title' => $data->filename,
                'caption' => $data->filename,
                'description' => $data->filename,
                'width' => $data->getWidth() ?? null,
                'height' => $data->getHeight() ?? null,
                'disk' => $disk,
                'directory' => $directory,
                'size' => $data->filesize() ?? null,
                'created_at' => now(),
            ]);
    }
}
