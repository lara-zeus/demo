<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Zeus Wind',
            'email' => 'wind@larazeus.com',
            'password' => Hash::make('wind#larazeus'),
        ]);

        $this->call([
            WindSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}