<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PaymentCategory;
use Illuminate\Database\Seeder;

class PaymentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $categories = [
            ['name' => 'Biaya Administrasi', 'description' => 'Biaya administrasi awal pendaftaran'],
            ['name' => 'SPP', 'description' => 'Iuran bulanan santri'],
            ['name' => 'Kitab', 'description' => 'Pembelian kitab dan perlengkapan'],
            ['name' => 'Ujian', 'description' => 'Biaya pelaksanaan ujian'],
        ];

        foreach ($categories as $category) {
            PaymentCategory::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}
