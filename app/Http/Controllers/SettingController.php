<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Show the form for editing all settings.
     */
    public function edit()
    {
        // Mendapatkan semua pengaturan yang sudah ada, lalu mengumpulkannya ke dalam array asosiatif (key => value)
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        // Data default jika pengaturan belum ada di database
        $defaultSettings = [
            'about_us_content' => 'Yayasan Pondok Pesantren Diniyah Baitul Makmur Aikmel didirikan dengan visi...',
            'contact_address' => 'Jl. Pendidikan No. 79, Aikmel Timur, Kecamatan Aikmel, Kabupaten Lombok Timur, Nusa Tenggara Barat, Indonesia',
            'contact_phone' => '+62 819-1657-7540',
            'contact_email' => 'info@ponpesdibama.com',
            'mission_quote' => '"Membina santri menjadi pribadi yang bertakwa, cerdas, mandiri, dan berakhlakul karimah..."',
            'pondok_photo' => null, // Default: tidak ada foto
            'location_map_url' => null, // Default: tidak ada URL peta
            'is_ppdb_open' => false, // Default PPDB tertutup
            'ppdb_asrama_open' => false,  // Default PPDB Asrama tertutup
            'ppdb_pulang_pergi_open' => false,  // Default Pulang Pergi tertutup
            'ppdb_academic_year' => date('Y') . '/' . (date('Y') + 1), // Default tahun ajaran PPDB
            'cta_enrollment_heading' => 'Siapkan Masa Depan Gemilang Putra/Putri Anda Bersama Yayasan Ponpes DIBAMA!', // NEW: Teks CTA Pendaftaran
            // Tambahkan kunci pengaturan default lainnya di sini
        ];

        // Gabungkan pengaturan yang sudah ada dengan pengaturan default, agar form tidak kosong jika belum ada data
        foreach ($defaultSettings as $key => $defaultValue) {
            if (array_key_exists($key, $settings)) {
                // Untuk boolean, pastikan nilai string '0'/'1' diubah ke boolean
                if (in_array($key, ['is_ppdb_open', 'ppdb_asrama_open', 'ppdb_pulang_pergi_open'])) {
                $settings[$key] = filter_var($settings[$key], FILTER_VALIDATE_BOOLEAN);
            }

            } else {
                $settings[$key] = $defaultValue;
            }
        }

        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Update all settings in storage.
     */
    public function update(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'about_us_content' => 'required|string',
            'contact_address' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:50',
            'contact_email' => 'required|email|max:255',
            'mission_quote' => 'required|string',
            'pondok_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location_map_url' => 'nullable|url|max:1000',
            'is_ppdb_open' => 'boolean',
            'ppdb_asrama_open' => 'boolean',
            'ppdb_pulang_pergi_open' => 'boolean',
            'ppdb_academic_year' => 'nullable|string|max:20',
            'cta_enrollment_heading' => 'required|string|max:255', // NEW: Validasi teks CTA
            // Tambahkan validasi untuk kunci pengaturan lainnya
        ]);

        // Loop melalui input yang divalidasi dan simpan ke tabel settings
        foreach ($validatedData as $key => $value) {
            // Jika key adalah pondok_photo, tangani upload file
            if ($key === 'pondok_photo') {
                if ($request->hasFile('pondok_photo')) {
                    // Hapus foto lama jika ada
                    $oldPhotoPath = Setting::where('key', 'pondok_photo')->first();
                    if ($oldPhotoPath && $oldPhotoPath->value) {
                        Storage::disk('public')->delete($oldPhotoPath->value);
                    }
                    // Simpan foto baru
                    $imagePath = $request->file('pondok_photo')->store('settings_images', 'public');
                    $value = $imagePath; // Perbarui nilai untuk disimpan ke DB
                } else {
                    // Jika tidak ada file baru diupload, pertahankan foto yang sudah ada
                    continue;
                }
            }

            // Untuk checkbox 'is_ppdb_open', nilai yang diterima adalah boolean, simpan sebagai string '0' atau '1'
            if (in_array($key, ['is_ppdb_open', 'ppdb_asrama_open', 'ppdb_pulang_pergi_open'])) {
                $value = $value ? '1' : '0';
            }


            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
