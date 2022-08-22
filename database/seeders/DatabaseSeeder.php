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
            'email' => 'zeus@larazeus.com',
            'password' => Hash::make('zeus#larazeus'),
        ]);

        $this->call([
            WindSeeder::class,
            SkySeeder::class,
            BoltSeeder::class,
        ]);
    }
}
