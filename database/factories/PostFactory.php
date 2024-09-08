<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        $categoryIds = \App\Models\Category::pluck('id');

        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'category_id' => $categoryIds->random(),
        ];
    }
}
