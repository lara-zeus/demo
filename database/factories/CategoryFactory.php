<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaraZeus\Bolt\Models\Category;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     *
     * @throws \JsonException
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'ordering' => $this->faker->numberBetween(1, 10),
            'is_active' => 1,
            'desc' => $this->faker->words(5, true),
            'slug' => $this->faker->slug,
        ];
    }
}
