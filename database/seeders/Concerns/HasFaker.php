<?php

namespace Database\Seeders\Concerns;

use Faker\Generator;
use Illuminate\Container\Container;

trait HasFaker
{
    protected mixed $faker;

    public function __construct()
    {
        $this->faker = Container::getInstance()
            ->make(Generator::class);
    }
}
