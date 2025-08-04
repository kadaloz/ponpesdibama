<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Pastikan ini benar (sesuai letak Controller.php)
use App\Models\User; // Perlu jika Anda menggunakannya di sini, tapi sepertinya tidak untuk PermissionController
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:assign roles');
    }

    /**
     * Menampilkan daftar semua peran (roles) yang ada.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.permissions.index', compact('roles'));
    }

    /**
     * Menampilkan form untuk mengedit izin (permissions) dari sebuah peran.
     */
    public function edit(Role $role)
    {
        $allPermissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        $categorizedPermissions = [
            'Umum' => [],
            'Konten & Website' => [],
            'Santri & PPDB' => [],
            'Administrasi Sistem' => [],
            'Manajemen Pengajar' => [],
            'Manajemen Halaqoh' => [], // <<< NEW CATEGORY
            'Manajemen Asrama & Inventaris' => [], // <<< NEW CATEGORY
            'Manajemen Payments' => [], // NEW: Kategori untuk pembayaran
            'Lain-lain / Modul Umum' => [], // Mengubah "Modul Lain" jadi lebih umum
        ];

        foreach ($allPermissions as $permission) {
            if (Str::startsWith($permission->name, 'view dashboard') || Str::startsWith($permission->name, 'manage own profile')) {
                $categorizedPermissions['Umum'][] = $permission;
            } elseif (Str::startsWith($permission->name, ['view news', 'create news', 'edit news', 'delete news', 'manage settings', 'view galleries', 'create galleries', 'edit galleries', 'delete galleries'])) {
                $categorizedPermissions['Konten & Website'][] = $permission;
            } elseif (Str::startsWith($permission->name, ['view students', 'create students', 'edit students', 'delete students', 'export students', 'import students', 'view applicants', 'edit applicants', 'delete applicants', 'edit ppdb requirements', 'view programs', 'create programs', 'edit programs', 'delete programs'])) {
                // Menggabungkan Santri, PPDB, dan Program ke dalam satu kategori besar
                $categorizedPermissions['Santri & PPDB'][] = $permission;
            } elseif (Str::startsWith($permission->name, ['view audit logs', 'purge audit logs', 'manage users', 'assign roles'])) {
                $categorizedPermissions['Administrasi Sistem'][] = $permission;
            } elseif (Str::startsWith($permission->name, ['view teachers', 'create teachers', 'edit teachers', 'delete teachers', 'assign teacher user'])) {
                $categorizedPermissions['Manajemen Pengajar'][] = $permission;
            }
            // --- START NEW CATEGORY LOGIC ---
            elseif (Str::startsWith($permission->name, ['view halaqohs', 'create halaqohs', 'edit halaqohs', 'delete halaqohs', 'assign students to halaqoh'])) {
                $categorizedPermissions['Manajemen Halaqoh'][] = $permission;
            } elseif (Str::startsWith($permission->name, ['view rooms', 'create rooms', 'edit rooms', 'delete rooms', 'view placements', 'create placements', 'edit placements', 'delete placements', 'view placements history', 'manage placements', 'view placements in room', 'view items', 'create items', 'edit items', 'delete items', 'assign items to room', 'assign items to student'])) {
                $categorizedPermissions['Manajemen Asrama & Inventaris'][] = $permission;
            }
            elseif (Str::startsWith($permission->name, ['view payments', 'create payments', 'edit payments', 'delete payments', 'export payments', 'print payment receipt'])) {
                $categorizedPermissions['Manajemen Payments'][] = $permission; // NEW: Kategori untuk pembayaran
            }
            // --- END NEW CATEGORY LOGIC ---
            else {
                // Semua izin yang tidak cocok dengan kategori di atas
                $categorizedPermissions['Lain-lain / Modul Umum'][] = $permission;
            }
        }

        // Urutkan izin dalam setiap kategori secara alfabetis
        foreach ($categorizedPermissions as $category => $permissionsInGroup) {
            usort($categorizedPermissions[$category], function($a, $b) {
                return strcmp($a->name, $b->name);
            });
        }

        return view('admin.permissions.edit', compact('role', 'categorizedPermissions', 'rolePermissions'));
    }

    /**
     * Memperbarui izin (permissions) untuk sebuah peran di database.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        if ($role->name === 'admin') {
            // Role 'admin' selalu memiliki semua izin
            $role->syncPermissions(Permission::all());
        } else {
            $selectedPermissions = Permission::whereIn('id', $request->input('permissions', []))->get();
            $role->syncPermissions($selectedPermissions);
        }

        // Catat audit trail untuk pembaruan izin peran
        // Pastikan fungsi record_audit() tersedia dan berfungsi
        if (function_exists('record_audit')) {
            record_audit(
                'update_permissions',
                'Izin untuk peran ' . $role->name . ' berhasil diperbarui oleh ' . (auth()->user()->name ?? 'Guest'),
                auth()->user()->id ?? null,
                auth()->user()->name ?? 'Guest',
                request()->ip(),
                request()->userAgent()
            );
        } else {
            // Fallback jika record_audit tidak ada, misalnya log ke storage/logs
            \Log::info('Permissions for role ' . $role->name . ' updated by ' . (auth()->user()->name ?? 'Guest'));
        }


        return redirect()->route('admin.permissions.index')->with('success', 'Izin untuk peran ' . $role->name . ' berhasil diperbarui!');
    }
}