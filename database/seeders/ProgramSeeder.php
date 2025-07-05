<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'name' => 'Program Tahfidz Al-Qur\'an',
                'slug' => Str::slug('Program Tahfidz Al-Qur\'an'),
                'description' => 'Fokus pada hafalan Al-Qur\'an yang mutqin, dengan metode talaqqi dan murojaah intensif.',
                'duration' => '6 Tahun',
                'is_active' => true,
            ],
            [
                'name' => 'Madrasah Diniyah',
                'slug' => Str::slug('Madrasah Diniyah'),
                'description' => 'Penguatan dasar-dasar ilmu agama seperti fiqh, tauhid, akhlaq, dan bahasa Arab.',
                'duration' => '3 Tahun',
                'is_active' => true,
            ],
            [
                'name' => 'Kajian Kitab Kuning',
                'slug' => Str::slug('Kajian Kitab Kuning'),
                'description' => 'Pembelajaran kitab-kitab klasik ulama salaf, disampaikan oleh ustadz berpengalaman.',
                'duration' => 'Berjalan Setiap Pekan',
                'is_active' => true,
            ],
            [
                'name' => 'Program Bahasa Arab Aktif',
                'slug' => Str::slug('Program Bahasa Arab Aktif'),
                'description' => 'Membiasakan santri berbicara dan menulis dengan bahasa Arab melalui metode interaktif.',
                'duration' => 'Setiap Semester',
                'is_active' => true,
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
