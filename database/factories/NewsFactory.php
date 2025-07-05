<?php

namespace Database\Factories;

use App\Models\News; // Import Model News
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Untuk membuat slug

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(5, 10)); // Judul berita acak
        $content = $this->faker->paragraphs(rand(5, 10), true); // Konten berita acak
        $published = $this->faker->boolean(80); // 80% kemungkinan berita dipublikasi

        return [
            'title' => $title,
            'slug' => Str::slug($title . '-' . uniqid()), // Slug unik dari judul
            'content' => '<p>' . $content . '</p>', // Bungkus konten dengan paragraf HTML
            'image' => $this->faker->boolean(50) ? 'news_images/' . $this->faker->image('public/storage/news_images', 640, 480, null, false) : null, // 50% kemungkinan ada gambar dummy
            'published_at' => $published ? $this->faker->dateTimeBetween('-1 year', 'now') : null, // Tanggal publikasi jika dipublikasi
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
