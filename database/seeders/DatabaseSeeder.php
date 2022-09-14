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
            'name' => 'ass·hole Spammer',
            'email' => 'spammer@larazeus.com',
            'password' => Hash::make('assholespammer'),
        ]);

        $this->call([
            //WindSeeder::class,
            //SkySeeder::class,
            BoltSeeder::class,
        ]);
    }
}
