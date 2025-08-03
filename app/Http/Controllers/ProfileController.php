<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information, including photo.
     */
public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();
    
    // 1. Tangani Unggahan Foto Profil (dari data Base64)
    if ($request->filled('cropped_photo_data')) {
        // Hapus foto lama jika ada
        if ($user->photo_path) {
            Storage::disk('public')->delete($user->photo_path);
        }

        // Ambil data gambar Base64
        $base64Image = $request->input('cropped_photo_data');
        // Pisahkan header data dari data sebenarnya
        list($type, $base64Image) = explode(';', $base64Image);
        list(, $base64Image)      = explode(',', $base64Image);

        // Decode data Base64 menjadi file
        $imageData = base64_decode($base64Image);
        
        // Buat nama file unik dan path penyimpanan
        $fileName = 'profile-photos/' . uniqid() . '.png';
        
        // Simpan file ke storage
        Storage::disk('public')->put($fileName, $imageData);
        
        // Update path di database
        $user->photo_path = $fileName;
    }

    // 2. Tangani Pembaruan Nama dan Email (logika yang sama)
    $user->fill($request->validated());
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }
    $user->save();

    // 3. Catat audit trail untuk pembaruan profil
    record_audit(
        'update_profile',
        'Profil dan foto berhasil diperbarui oleh ' . ($user->name ?? 'Guest'),
        $user->id ?? null,
        $user->name ?? 'Guest',
        $request->ip(),
        $request->userAgent()
    );

    return Redirect::route('admin.profile.edit')->with('success', 'Profile updated successfully.');
}

    /**
     * Delete the user's profile photo.
     */
    public function deletePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->photo_path) {
            // Hapus file dari storage
            Storage::disk('public')->delete($user->photo_path);
            
            // Hapus path dari database
            $user->photo_path = null;
            $user->save();

            // Catat audit trail untuk penghapusan foto
            record_audit(
                'delete_profile_photo',
                'Foto profil berhasil dihapus oleh ' . ($user->name ?? 'Guest'),
                $user->id ?? null,
                $user->name ?? 'Guest',
                $request->ip(),
                $request->userAgent()
            );

            return Redirect::route('admin.profile.edit')->with('success', 'Foto profil berhasil dihapus.');
        }

        return Redirect::route('admin.profile.edit')->with('error', 'Tidak ada foto profil untuk dihapus.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Catat audit trail untuk penghapusan akun
        record_audit(
            'delete_account',
            'Akun berhasil dihapus: ' . $user->name,
            $user->id,
            $user->name,
            $request->ip(),
            $request->userAgent()
        );

        return Redirect::to('/');
    }
}