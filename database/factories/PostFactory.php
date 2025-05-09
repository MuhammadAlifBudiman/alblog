<?php

namespace Database\Factories;

use App\Models\Post; // Needed to specify the model this factory is for
use App\Models\User; // Needed to fetch user IDs for associating posts with users
use App\Models\Category; // Needed to fetch category IDs for associating posts with categories
use Illuminate\Database\Eloquent\Factories\Factory; // Needed to extend the base Factory class

class PostFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class; // Needed to link this factory to the Post model
    protected static $userIds; // Needed to cache user IDs for efficient data generation
    protected static $categoryIds; // Needed to cache category IDs for efficient data generation


    /**
     * Define the model's default state.
     *
     * This method generates fake data for the Post model, including
     * title, slug, excerpt, body, user_id, and category_id.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Cache user IDs if not already cached
        if (!static::$userIds) {
            static::$userIds = User::pluck('id')->toArray(); // Needed to retrieve all user IDs for associating posts with users
        }

        // Cache category IDs if not already cached
        if (!static::$categoryIds) {
            static::$categoryIds = Category::pluck('id')->toArray(); // Needed to retrieve all category IDs for associating posts with categories
        }

        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)), // Needed to generate a random title for the post
            'slug' => $this->faker->slug(), // Needed to generate a unique slug for the post
            'excerpt' => $this->faker->paragraph(), // Needed to generate a short excerpt for the post
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10))) // Needed to generate the main content of the post
                ->map(fn($p) => "<p>$p</p>") // Needed to format paragraphs as HTML
                ->implode(''), // Needed to combine all paragraphs into a single string
            'user_id' => $this->faker->randomElement(static::$userIds), // Needed to associate the post with a random user
            'category_id' => $this->faker->randomElement(static::$categoryIds), // Needed to associate the post with a random category
        ];
    }
}
