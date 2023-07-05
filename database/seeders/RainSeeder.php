<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RainSeeder extends Seeder
{
    /**
     * @throws \JsonException
     */
    public function run()
    {

        //{"headerColumn":[{"type":"paragraph","data":{"title":null,"sort":1,"widget":"LaraZeus\\Rain\\Widgets\\Classes\\HeadingWidget","content":"no title top column content"}},{"type":"Menu","data":{"menu_slug":"nav-menu","menu_dir":"horizontal","title":null,"sort":1,"widget":"LaraZeus\\Rain\\Widgets\\Classes\\MenuWidget"}}],"rightColumn":[{"type":"paragraph","data":{"title":"left column","sort":1,"widget":"LaraZeus\\Rain\\Widgets\\Classes\\HeadingWidget","content":"left column"}}],"middleColumn":[{"type":"image","data":{"title":null,"sort":1,"widget":"LaraZeus\\Rain\\Widgets\\Classes\\ImageWidget","url":"widgets\/wHolBt7bwoaJytec3Snc9f10MloRVf-metac2h1YmhhbS1kaGFnZS00dTdWekRnTmdMSS11bnNwbGFzaC5qcGc=-.jpg","alt":"alt"}}],"leftColumn":[{"type":"paragraph","data":{"title":"right column","sort":1,"widget":"LaraZeus\\Rain\\Widgets\\Classes\\HeadingWidget","content":"right column"}}],"footerColumn":[{"type":"paragraph","data":{"title":null,"sort":1,"widget":"LaraZeus\\Rain\\Widgets\\Classes\\HeadingWidget","content":"no title bottom column content"}}]}
        DB::table('layouts')
            ->insertGetId([
                'user_id' => 1,
                'layout_title' => 'New page',
                'layout_slug' => 'new-page',
                'widgets' => json_encode([
                    'headerColumn' => [
                        [
                            'type' => 'paragraph',
                            'data' => [
                                'title' => null,
                                'sort' => 2,
                                'widget' => "LaraZeus\\Rain\\Widgets\\Classes\\HeadingWidget",
                                'content' => 'no title top column content',
                            ],
                        ],
                        [
                            'type' => 'Menu',
                            'data' => [
                                'menu_slug' => 'nav-menu',
                                'menu_dir' => 'horizontal',
                                'widget' => "LaraZeus\\Rain\\Widgets\\Classes\\MenuWidget",
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
                                'widget' => "LaraZeus\\Rain\\Widgets\\Classes\\HeadingWidget",
                                'content' => 'left column',
                            ],
                        ],
                        [
                            'type' => 'Menu',
                            'data' => [
                                'menu_slug' => 'nav-menu',
                                'menu_dir' => 'vertical',
                                'widget' => "LaraZeus\\Rain\\Widgets\\Classes\\MenuWidget",
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
                                'widget' => "LaraZeus\\Rain\\Widgets\\Classes\\ImageWidget",
                                'url' => 'widgets/d8snXpNRmcxggHsotkH9p8lxZQ2zeA-metaRGVtby5wbmc=-.png',
                                'alt' => 'alt',
                            ],
                        ],
                        [
                            'type' => 'Faq',
                            'data' => [
                                'faq_cat' => 'all-faq',
                                'title' => null,
                                'sort' => 2,
                                'widget' => "LaraZeus\\Rain\\Widgets\\Classes\\FaqWidget",
                            ],
                        ],
                        [
                            'type' => 'Forms',
                            'data' => [
                                'form_slug' => 'feedback',
                                'title' => 'Form Widget',
                                'sort' => 3,
                                'widget' => "LaraZeus\\Rain\\Widgets\\Classes\\FormsWidget",
                            ],
                        ],
                    ],
                    'leftColumn' => [
                        [
                            'type' => 'paragraph',
                            'data' => [
                                'title' => 'right column',
                                'sort' => 1,
                                'widget' => "LaraZeus\\Rain\\Widgets\\Classes\\HeadingWidget",
                                'content' => 'right column',
                            ],
                        ],
                        [
                            'type' => 'Library',
                            'data' => [
                                'library_slug' => 'support-docs',
                                'title' => null,
                                'sort' => 2,
                                'widget' => "LaraZeus\\Rain\\Widgets\\Classes\\LibraryWidget",
                            ],
                        ],
                    ],
                    'footerColumn' => [
                        [
                            'type' => 'paragraph',
                            'data' => [
                                'title' => null,
                                'sort' => 1,
                                'widget' => "LaraZeus\\Rain\\Widgets\\Classes\\HeadingWidget",
                                'content' => 'no title bottom column content',
                            ],
                        ],
                    ],
                ]),
                'created_at' => now(),
            ]);
    }
}
