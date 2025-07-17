
<?php

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Perlu untuk mengambil nama jika hanya ID yang disediakan

if (!function_exists('record_audit')) {
    /**
     * Mencatat entri audit trail.
     *
     * @param string $action Aksi yang dilakukan (contoh: 'user_login', 'create_student').
     * @param string $description Deskripsi detail dari aksi.
     * @param int|null $userId ID dari pengguna yang melakukan aksi. Default ke ID pengguna yang login.
     * @param string|null $userName Nama pengguna yang melakukan aksi. Default ke nama pengguna yang login atau 'Guest'.
     * @param string|null $ipAddress Alamat IP asal aksi. Default ke IP request saat ini.
     * @param string|null $userAgent String user agent (informasi browser/klien). Default ke user agent request saat ini.
     * @return void
     */
    function record_audit(
        string $action,
        string $description,
        ?int $userId = null,
        ?string $userName = null, // BARU: Tambahkan parameter ini
        ?string $ipAddress = null,
        ?string $userAgent = null
    ): void
    {
        $currentUserId = $userId ?? Auth::id();
        $currentUserName = $userName;

        // Jika nama pengguna tidak disediakan, coba ambil dari Auth
        if (is_null($currentUserName)) {
            if (Auth::check() && Auth::user()) {
                $currentUserName = Auth::user()->name;
            } else {
                $currentUserName = 'Guest';
            }
        }
        
        // Final fallback for user ID
        // If Auth::id() is null and no userId was passed, then it's truly null.
        if (is_null($currentUserId) && Auth::check()) { // Try one last time to get ID if name was passed manually but not ID
            $currentUserId = Auth::id();
        }

        AuditTrail::create([
            'action'       => $action,
            'description'  => $description,
            'user_id'      => $currentUserId, // Simpan ID user
            'user_name'    => $currentUserName, // Simpan nama user
            'ip_address'   => $ipAddress ?? request()->ip(),
            'user_agent'   => $userAgent ?? request()->userAgent(),
        ]);
    }
}