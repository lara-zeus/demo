<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Zeus',
            'email' => 'info@larazeus.com',
            'password' => Hash::make('zeus#larazeus'),
        ]);

        DB::table('users')->insert([
            'name' => 'ashol Spammer',
            'email' => 'spammer@larazeus.com',
            'password' => Hash::make('assholespammer'),
        ]);

        DB::table('users')->insert([
            'name' => 'the printer magician',
            'email' => 'printer-god@larazeus.com',
            'password' => Hash::make('printerMagician'),
        ]);

        DB::table('masons')->insert([
            'content' => '{"type":"doc","content":[{"type":"masonBrick","attrs":{"identifier":"batman","values":{"name":"Joker","color":"yellow","side":"villain"},"path":"mason.batman"}},{"type":"masonBrick","attrs":{"identifier":"newsletter_signup","values":{"heading":"Want product news and updates? Sign up for our newsletter."},"path":"mason.newsletter-signup"}},{"type":"masonBrick","attrs":{"identifier":"section","values":{"background_color":"primary","image":"01JNHSK4PDENCMYVR563NDG1GJ.jpg","text":"<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur doloremque saepe architecto maiores repudiandae amet perferendis repellendus, reprehenderit voluptas sequi.<\/p><p><br><\/p>","image_position":"end","image_alignment":"middle","image_rounded":"1","image_shadow":"1"},"path":"mason::bricks.section"}},{"type":"masonBrick","attrs":{"identifier":"cards","values":{"background_color":"primary","cards":[{"heading":"Head","body":"<p>Body<\/p>","footer":"<p>Fot<\/p>"}]},"path":"mason.cards"}},{"type":"masonBrick","attrs":{"identifier":"supportCenter","values":null,"path":"mason.support-center"}},{"type":"masonBrick","attrs":{"identifier":"section","values":{"background_color":"bg-white-500","image":"01JNHPZFRKHMK6HFS9V5GDS87A.png","text":"<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur doloremque saepe architecto maiores repudiandae amet perferendis repellendus, reprehenderit voluptas sequi.<\/p><p><br><\/p>"},"path":"mason.section"}},{"type":"masonBrick","attrs":{"identifier":"code","values":{"code":"$data = [\n    &#039;id&#039; =&gt; null,\n    &#039;code&#039; =&gt; null,\n    &#039;language&#039; =&gt; null,\n];","language":"php"},"path":"mason.code"}}]}',
        ]);

        $this->call([
            WindSeeder::class,
            SkySeeder::class,
            BoltSeeder::class,
            BoltProSeeder::class,
            ThunderSeeder::class,
            RainSeeder::class,
            HermesSeeder::class,
            BoltSectionsSeeder::class,
            SelectTreeSeeder::class,
            OperationsTableSeeder::class,
            AthenaSeeder::class,
        ]);
    }
}
