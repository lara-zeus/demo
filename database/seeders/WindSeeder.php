<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\HasFaker;
use Database\Seeders\Concerns\HasImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use LaraZeus\Wind\Models\Letter;

class WindSeeder extends Seeder
{
    use HasFaker;
    use HasImage;

    public function run()
    {
        $department = DB::table('departments')
            ->insertGetId([
                'name' => 'Customer service',
                'ordering' => 1,
                'is_active' => 1,
                'desc' => 'for customer service',
                'slug' => 'customer-service',
                'logo' => $this->getImage('logos'),
                'created_at' => now(),
            ]);

        $department_2 = DB::table('departments')
            ->insertGetId([
                'name' => 'Sales',
                'ordering' => 2,
                'is_active' => 1,
                'desc' => 'any help with sales',
                'slug' => 'sales',
                'logo' => $this->getImage('logos'),
                'created_at' => now(),
            ]);

        Letter::factory()
            ->count(5)
            ->state(function () use ($department) {
                return [
                    'department_id' => $department,
                ];
            })
            ->create();

        Letter::factory()
            ->count(5)
            ->state(function () use ($department_2) {
                return [
                    'department_id' => $department_2,
                ];
            })
            ->create();
    }
}
