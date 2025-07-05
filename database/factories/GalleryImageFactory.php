<?php

namespace Database\Factories;

use App\Models\GalleryImage; // Import Model GalleryImage
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GalleryImage>
 */
class GalleryImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GalleryImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_path' => 'gallery_images/' . $this->faker->image('public/storage/gallery_images', 800, 600, null, false), // Gambar dummy untuk galeri
            'caption' => $this->faker->sentence(rand(3, 7)), // Keterangan gambar acak
            'order' => $this->faker->numberBetween(1, 100), // Urutan acak
        ];
    }
}
