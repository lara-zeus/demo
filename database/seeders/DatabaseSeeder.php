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

        $this->call([
            WindSeeder::class,
            SkySeeder::class,
            BoltSeeder::class,
            RainSeeder::class,
            BoltSectionsSeeder::class,
            SelectTreeSeeder::class,
            OperationsTableSeeder::class,
            AthenaSeeder::class,
        ]);
    }
}
