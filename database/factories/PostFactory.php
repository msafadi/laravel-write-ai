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
        $title = $this->faker->sentence(6); // يولد عنوان عشوائي من 6 كلمات

        return [
            // جلب مستخدم عشوائي، وإذا لم يوجد، سيقوم بإنشاء واحد جديد فوراً
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),

            // جلب تصنيف عشوائي (يمكن أن يكون Null حسب هيكلة جدولك)
            'category_id' => Category::inRandomOrder()->first()?->id,

            'title' => $title,
            'content' => $this->faker->paragraphs(5, true), // يولد نص مقال طويل ومترابط
            'slug' => Str::slug($title), // يحول العنوان إلى رابط slug مناسب (مثل: test-post-title)
            'excerpt' => $this->faker->sentence(15), // مقتطف صغير من المقال
            'cover_image' => $this->faker->imageUrl(800, 600, 'posts', true), // رابط صورة عشوائية
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),

            // حقل الـ JSON، نضع فيه بيانات وهمية للميتا تاغز
            'meta' => [
                'meta_title' => $title,
                'meta_description' => $this->faker->text(150),
                'keywords' => implode(',', $this->faker->words(5))
            ],

            'views' => $this->faker->numberBetween(0, 5000), // عدد مشاهدات عشوائي
        ];
    }
}
