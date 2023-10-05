<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,2),
            'category_id' => rand(1,5),
            'title' => fake()->sentence(),
            'short_content' => fake()->sentence(3),
            'content' => fake()->paragraph(5),
        ];
    }
}
