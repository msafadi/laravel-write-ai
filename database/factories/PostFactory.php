<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
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
        $title = $this->faker->sentence(6);

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),

            'category_id' => Category::inRandomOrder()->first()?->id,

            'title' => $title,
            'content' => $this->faker->paragraphs(5, true),
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->sentence(15),
            'cover_image' => $this->faker->imageUrl(800, 600, 'posts', true),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),

            'meta' => [
                'meta_title' => $title,
                'meta_description' => $this->faker->text(150),
                'keywords' => implode(',', $this->faker->words(5))
            ],

            'views' => $this->faker->numberBetween(0, 5000),
        ];
    }
}
