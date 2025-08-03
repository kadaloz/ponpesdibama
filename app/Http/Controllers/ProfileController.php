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

        // 1. Tangani Unggahan Foto Profil
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo_path) {
                Storage::disk('public')->delete($user->photo_path);
            }
            // Simpan foto baru dan update path
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->photo_path = $path;
        }

        // 2. Tangani Pembaruan Nama dan Email
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