<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->paragraph(3),
            'tags' => 'amv,naruto,bleach',
            'upvotes' => $this->faker->numberBetween(0, 100),
            'downvotes' => $this->faker->numberBetween(0, 100), 
            'comments' => $this->faker->numberBetween(0, 100), 
        ];
    }
}
