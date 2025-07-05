<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery; // Import Model Gallery
use App\Models\GalleryImage; // Import Model GalleryImage

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data galeri dan gambar terkait jika diperlukan (opsional)
        // Gallery::truncate();
        // GalleryImage::truncate();

        // Buat 5 album galeri dummy
        Gallery::factory()->count(5)->create()->each(function ($gallery) {
            // Untuk setiap album, buat antara 3 hingga 10 gambar dummy
            GalleryImage::factory()->count(rand(3, 10))->create([
                'gallery_id' => $gallery->id,
            ]);
        });

        $this->command->info('5 album galeri dummy dengan gambar berhasil dibuat!');
    }
}
