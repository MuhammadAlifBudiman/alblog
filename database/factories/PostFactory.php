<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;


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
        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                ->map(fn($p) => "<p>$p</p>")
                ->implode(''),
            'user_id' => mt_rand(1, 3),
            'category_id' => mt_rand(1, 3)
        ];
    }
}
