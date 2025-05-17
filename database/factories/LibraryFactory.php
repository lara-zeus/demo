<?php

namespace Database\Factories;

use Database\Seeders\Concerns\HasImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use LaraZeus\Sky\Models\Library;
use LaraZeus\Sky\SkyPlugin;

class LibraryFactory extends Factory
{
    use HasImage;

    protected $model = Library::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->slug(2),
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'type' => $this->faker->randomElement(array_keys(SkyPlugin::get()->getLibraryTypes())),
            'file_path' => $this->getImage('library'),
        ];
    }
}
