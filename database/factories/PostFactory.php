<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaraZeus\Sky\Models\Post;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'slug' => $this->faker->slug(2),
            'description' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'content' => $this->faker->paragraph($nbSentences = 12, $variableNbSentences = true),
            'published_at' => now(),
            'sticky_until' => $this->faker->randomElement([now()->addWeek(), null]),
            'status' => $this->faker->randomElement(['publish']), // , 'future', 'draft', 'private'
            'post_type' => $this->faker->randomElement(['page', 'post']),
            'featured_image' => asset('storage/widgets/d8snXpNRmcxggHsotkH9p8lxZQ2zeA-metaRGVtby5wbmc=-.png'),
        ];
    }
}
