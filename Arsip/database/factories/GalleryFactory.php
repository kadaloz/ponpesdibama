<?php

namespace Database\Factories;

use App\Models\Gallery; // Import Model Gallery
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Untuk membuat slug

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(3, 7)); // Judul album acak
        $description = $this->faker->paragraph(rand(2, 4)); // Deskripsi acak
        $isPublished = $this->faker->boolean(80); // 80% kemungkinan dipublikasi

        return [
            'title' => $title,
            'slug' => Str::slug($title . '-' . uniqid()), // Slug unik dari judul
            'description' => $description,
            'cover_image' => $this->faker->boolean(70) ? 'gallery_covers/' . $this->faker->image('public/storage/gallery_covers', 640, 480, null, false) : null, // 70% kemungkinan ada gambar cover dummy
            'is_published' => $isPublished,
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
