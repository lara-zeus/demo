<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraZeus\Sky\Models\Faq;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;

class SkySeeder extends Seeder
{
    public function run()
    {
        Tag::create(['name' => ['en' => 'laravel', 'ar' => 'لارافل'], 'type' => 'category']);
        Tag::create(['name' => ['en' => 'talks', 'ar' => 'اخبار'], 'type' => 'category']);
        Tag::create(['name' => ['en' => 'dev', 'ar' => 'تطوير'], 'type' => 'category']);

        Post::factory()
            ->count(10)
            ->create();

        Faq::create([
            'question' => [
                'en' => 'who is zeus',
                'ar' => 'من هو زوس'
            ],
            'answer' => [
                'en' => 'Zeus is the god of the sky in ancient Greek mythology. As the chief Greek deity, Zeus is considered the ruler, protector, and father of all gods and humans. Zeus is often depicted as an older man with a beard and is represented by symbols such as the lightning bolt and the eagle.',
                'ar' => 'زيوس هو إله السماء والصاعقة في الميثولوجيا الإغريقية. نظيره الروماني هو جوبتير، ونظيره في الميثولوجيا الهندوسية هو إندرا وفي الإيتروسكانية الإله تينيا. تكمن قوة زيوس في حكمه لقوى الطبيعة الرهيبة التي كان الإغريق يخشونها كالبرق والرعد والسماء الواسعة.'
            ],
        ]);


        foreach (Post::all() as $post) { // loop through all posts
            $random_tags = Tag::all()->random(1)->first()->name;
            $post->syncTagsWithType([$random_tags], 'category');
        }
    }
}
