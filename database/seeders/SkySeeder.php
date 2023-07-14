<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraZeus\Sky\Models\Faq;
use LaraZeus\Sky\Models\Library;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;
use RyanChandler\FilamentNavigation\Models\Navigation;

class SkySeeder extends Seeder
{
    public function run()
    {
        Tag::create(['name' => ['en' => 'laravel', 'ar' => 'لارافل'], 'type' => 'category']);
        Tag::create(['name' => ['en' => 'talks', 'ar' => 'اخبار'], 'type' => 'category']);
        Tag::create(['name' => ['en' => 'dev', 'ar' => 'تطوير'], 'type' => 'category']);
        $faqTag = Tag::create(['name' => ['en' => 'all faq', 'ar' => 'كافة الاسئلة الشائعة'], 'type' => 'faq']);

        Post::factory()
            ->count(15)
            ->create();

        Post::create([
            'user_id' => 1,
            'title' => 'Embed a Form',
            'slug' => 'embed-form',
            'description' => "this is an example of an embed form from bolt",
            'content' => "<p>This is a form</p><p></p><p>&lt;bolt&gt;feedback&lt;/bolt&gt;</p><p></p><p></p>",
            'published_at' => now(),
            'sticky_until' => null,
            'status' => 'publish',
            'post_type' => 'post',
            'featured_image' => 'https://picsum.photos/1200/1300?random=404',
        ]);

        foreach (Post::all() as $post) { // loop through all posts
            $random_tags = Tag::all()->random(1)->first()->name;
            $post->syncTagsWithType([$random_tags], 'category');
        }

        $faq = Faq::create([
            'question' => [
                'en' => 'who is zeus',
                'ar' => 'من هو زوس',
            ],
            'answer' => [
                'en' => 'Zeus is the god of the sky in ancient Greek mythology. As the chief Greek deity, Zeus is considered the ruler, protector, and father of all gods and humans. Zeus is often depicted as an older man with a beard and is represented by symbols such as the lightning bolt and the eagle.',
                'ar' => 'زيوس هو إله السماء والصاعقة في الميثولوجيا الإغريقية. نظيره الروماني هو جوبتير، ونظيره في الميثولوجيا الهندوسية هو إندرا وفي الإيتروسكانية الإله تينيا. تكمن قوة زيوس في حكمه لقوى الطبيعة الرهيبة التي كان الإغريق يخشونها كالبرق والرعد والسماء الواسعة.',
            ],
        ]);
        $faq->syncTagsWithType([$faqTag], 'faq');

        config('zeus-sky.models.tag')::create([
            'name' => ['en' => 'support docs', 'ar' => 'الدعم الفني'], 'type' => 'library'
        ]);
        config('zeus-sky.models.tag')::create(['name' => ['en' => 'how to', 'ar' => 'كيف'], 'type' => 'library']);

        Library::factory()
            ->count(8)
            ->create();

        foreach (Library::all() as $library) { // loop through all library
            $random_tags = Tag::getWithType('library')->random(1)->first()->name;
            $library->syncTagsWithType([$random_tags], 'library');
        }

        Navigation::create([
            'name' => 'Nav Menu',
            'handle' => 'nav-menu',
            'items' => [
                'c10233ae-1b02-492f-b47d-117e4bcd4f4a' => [
                    'label' => 'home',
                    'type' => 'external-link',
                    'data' => [
                        'url' => '#',
                        'target' => null,
                    ],
                    'children' => [],
                ],
                'c10233ae-1b02-492f-hut9-117e4bcd4f4a' => [
                    'label' => 'nav 1',
                    'type' => 'external-link',
                    'data' => [
                        'url' => '#',
                        'target' => null,
                    ],
                    'children' => [],
                ],
                'c10233ae-23rf-492f-hut9-117e4bcd4f4a' => [
                    'label' => 'nav 2',
                    'type' => 'external-link',
                    'data' => [
                        'url' => '#',
                        'target' => null,
                    ],
                    'children' => [],
                ]
            ],
        ]);
    }
}
