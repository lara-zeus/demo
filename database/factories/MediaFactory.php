<?php

namespace Database\Factories;

use Database\Seeders\Concerns\HasImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    use HasImage;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'collection_name' => 'posts',
            'name' => $this->faker->name(),
            'file_name' => $this->getImage('posts'),
            'disk' => 'public',
            'size' => 343,
            'manipulations' => [],
            'custom_properties' => [],
            'generated_conversions' => [],
            'responsive_images' => [],
        ];
    }
}
