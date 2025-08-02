<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Tampilkan formulir untuk mengedit semua pengaturan.
     */
    public function edit()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        
        $defaultSettings = [
            'about_us_content' => 'Yayasan Pondok Pesantren Diniyah Baitul Makmur Aikmel didirikan dengan visi...',
            'contact_address' => 'Jl. Pendidikan No. 79, Aikmel Timur, Kecamatan Aikmel, Kabupaten Lombok Timur, Nusa Tenggara Barat, Indonesia',
            'contact_phone' => '+62 819-1657-7540',
            'contact_email' => 'info@ponpesdibama.com',
            'mission_quote' => '"Membina santri menjadi pribadi yang bertakwa, cerdas, mandiri, dan berakhlakul karimah..."',
            'pondok_photos' => null, // Menggunakan pondok_photos, bukan pondok_photo
            'location_map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.2476302278365!2d116.53449527476408!3d-8.572171986971089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcc491348043eb3%3A0xf9582c5263d3272c!2sPonpes%20DIBAMA!5e0!3m2!1sen!2sau!4v1754122166345!5m2!1sen!2sau',
            'is_ppdb_open' => false,
            'ppdb_asrama_open' => false,
            'ppdb_pulang_pergi_open' => false,
            'ppdb_academic_year' => date('Y') . '/' . (date('Y') + 1),
            'cta_enrollment_heading' => 'Siapkan Masa Depan Putra/Putri Anda Bersama Yayasan Ponpes DIBAMA!',
        ];

        foreach ($defaultSettings as $key => $defaultValue) {
            if (array_key_exists($key, $settings)) {
                if (in_array($key, ['is_ppdb_open', 'ppdb_asrama_open', 'ppdb_pulang_pergi_open'])) {
                    $settings[$key] = filter_var($settings[$key], FILTER_VALIDATE_BOOLEAN);
                }
            } else {
                $settings[$key] = $defaultValue;
            }
        }
        
        // Mengubah string JSON kembali menjadi array untuk view
        $settings['pondok_photos'] = !empty($settings['pondok_photos']) ? json_decode($settings['pondok_photos'], true) : [];

        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Memperbarui semua pengaturan dalam storage.
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
            'pondok_photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk beberapa foto
            'location_map_url' => 'nullable|url|max:1000',
            'is_ppdb_open' => 'boolean',
            'ppdb_asrama_open' => 'boolean',
            'ppdb_pulang_pergi_open' => 'boolean',
            'ppdb_academic_year' => 'nullable|string|max:20',
            'cta_enrollment_heading' => 'required|string|max:255',
            // Tambahkan validasi untuk kunci pengaturan lainnya
        ]);

        // Tangani unggah foto secara terpisah
        if ($request->hasFile('pondok_photos')) {
            $paths = [];
            // Ambil path foto lama untuk dihapus
            $oldPhotos = Setting::where('key', 'pondok_photos')->first();
            $oldPhotosPaths = $oldPhotos ? json_decode($oldPhotos->value, true) : [];

            // Hapus file lama dari storage
            foreach ($oldPhotosPaths as $oldPath) {
                Storage::disk('public')->delete($oldPath);
            }

            // Unggah foto baru
            foreach ($request->file('pondok_photos') as $file) {
                if ($file->isValid()) {
                    $paths[] = $file->store('settings_images', 'public');
                }
            }
            
            // Simpan array path foto yang baru sebagai string JSON
            Setting::updateOrCreate(
                ['key' => 'pondok_photos'],
                ['value' => json_encode($paths)]
            );
        } elseif ($request->has('delete_photos')) {
            // Logika untuk tombol "Hapus Semua"
            $oldPhotos = Setting::where('key', 'pondok_photos')->first();
            $oldPhotosPaths = $oldPhotos ? json_decode($oldPhotos->value, true) : [];

            // Hapus file dari storage
            foreach ($oldPhotosPaths as $oldPath) {
                Storage::disk('public')->delete($oldPath);
            }
            
            // Hapus entri di database
            if ($oldPhotos) {
                $oldPhotos->delete();
            }
        }
        
        // Loop melalui input yang divalidasi dan simpan ke tabel settings
        // Kita tidak bisa menggunakan loop untuk pondok_photos karena nilainya array
        foreach ($validatedData as $key => $value) {
            // Lewati pondok_photos karena sudah ditangani di atas
            if ($key === 'pondok_photos' || $key === 'pondok_photo') {
                continue;
            }

            // Untuk checkbox, simpan sebagai string '0' atau '1'
            if (in_array($key, ['is_ppdb_open', 'ppdb_asrama_open', 'ppdb_pulang_pergi_open'])) {
                $value = $value ? '1' : '0';
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        
        // Catat audit trail untuk pembaruan pengaturan
        // (Pastikan fungsi record_audit() Anda sudah ada atau hapus baris ini)
        if (function_exists('record_audit')) {
            record_audit(
                'update_settings',
                'Pengaturan berhasil diperbarui oleh ' . (auth()->user()->name ?? 'Guest'),
                auth()->user()->id ?? null,
                auth()->user()->name ?? 'Guest',
                $request->ip(),
                $request->userAgent()
            );
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
