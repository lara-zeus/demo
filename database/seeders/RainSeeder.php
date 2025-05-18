<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\HasFaker;
use Database\Seeders\Concerns\HasImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use LaraZeus\DynamicDashboard\Widgets\Classes\FaqWidget;
use LaraZeus\DynamicDashboard\Widgets\Classes\FormsWidget;
use LaraZeus\DynamicDashboard\Widgets\Classes\HeadingWidget;
use LaraZeus\DynamicDashboard\Widgets\Classes\ImageWidget;
use LaraZeus\DynamicDashboard\Widgets\Classes\LibraryWidget;
use LaraZeus\DynamicDashboard\Widgets\Classes\MenuWidget;

class RainSeeder extends Seeder
{
    use HasFaker;
    use HasImage;

    /**
     * @throws \JsonException
     */
    public function run()
    {
        DB::table('layouts')
            ->insertGetId([
                'user_id' => 1,
                'layout_title' => 'New page',
                'layout_slug' => 'new-page',
                'created_at' => now(),
                'widgets' => json_encode([
                    'headerColumn' => [
                        [
                            'type' => 'paragraph',
                            'data' => [
                                'title' => null,
                                'sort' => 2,
                                'widget' => HeadingWidget::class,
                                'content' => 'no title top column content',
                            ],
                        ],
                        [
                            'type' => 'Menu',
                            'data' => [
                                'menu_slug' => 'nav-menu',
                                'menu_dir' => 'horizontal',
                                'widget' => MenuWidget::class,
                                'title' => null,
                                'sort' => 1,
                            ],
                        ],
                    ],
                    'rightColumn' => [
                        [
                            'type' => 'paragraph',
                            'data' => [
                                'title' => 'left column',
                                'sort' => 1,
                                'widget' => HeadingWidget::class,
                                'content' => 'left column',
                            ],
                        ],
                        [
                            'type' => 'Menu',
                            'data' => [
                                'menu_slug' => 'nav-menu',
                                'menu_dir' => 'vertical',
                                'widget' => MenuWidget::class,
                                'title' => null,
                                'sort' => 1,
                            ],
                        ],
                    ],
                    'middleColumn' => [
                        [
                            'type' => 'image',
                            'data' => [
                                'title' => null,
                                'sort' => 1,
                                'widget' => ImageWidget::class,
                                'url' => $this->getImage('widgets'),
                                'alt' => 'alt',
                            ],
                        ],
                        [
                            'type' => 'Faq',
                            'data' => [
                                'faq_cat' => 'all-faq',
                                'title' => null,
                                'sort' => 2,
                                'widget' => FaqWidget::class,
                            ],
                        ],
                        [
                            'type' => 'Forms',
                            'data' => [
                                'form_slug' => 'feedback',
                                'title' => 'Form Widget',
                                'sort' => 3,
                                'widget' => FormsWidget::class,
                            ],
                        ],
                    ],
                    'leftColumn' => [
                        [
                            'type' => 'paragraph',
                            'data' => [
                                'title' => 'right column',
                                'sort' => 1,
                                'widget' => HeadingWidget::class,
                                'content' => 'right column',
                            ],
                        ],
                        [
                            'type' => 'Library',
                            'data' => [
                                'library_slug' => 'support-docs',
                                'title' => null,
                                'sort' => 2,
                                'widget' => LibraryWidget::class,
                            ],
                        ],
                    ],
                    'footerColumn' => [
                        [
                            'type' => 'paragraph',
                            'data' => [
                                'title' => null,
                                'sort' => 1,
                                'widget' => HeadingWidget::class,
                                'content' => 'no title bottom column content',
                            ],
                        ],
                    ],
                ], JSON_THROW_ON_ERROR),
            ]);
    }
}
