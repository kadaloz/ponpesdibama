<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News; // Import Model News

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data berita yang ada jika diperlukan (opsional)
        // News::truncate();

        // Buat 15 data berita dummy menggunakan factory
        News::factory()->count(15)->create();

        $this->command->info('15 data berita dummy berhasil dibuat!');
    }
}
