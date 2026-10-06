<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => null,
            'title' => fake()->sentence(6),
            'description' => fake()->paragraph(3),
        ];
    }
}
