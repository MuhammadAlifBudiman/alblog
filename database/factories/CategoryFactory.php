<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->word(mt_rand(1, 3), true); // e.g., "Tech News"

        return [
            'name' => Str::title($name), // Capitalized: "Tech News"
            'slug' => Str::slug($name),  // Slugified: "tech-news"
        ];
    }
}
