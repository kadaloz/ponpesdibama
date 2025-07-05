<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'Modul Lain' => [],
        ];

        foreach ($allPermissions as $permission) {
            if (Str::startsWith($permission->name, 'view dashboard') || Str::startsWith($permission->name, 'manage own profile')) {
                $categorizedPermissions['Umum'][] = $permission;
            } elseif (Str::startsWith($permission->name, ['view news', 'create news', 'edit news', 'delete news', 'manage settings', 'view galleries', 'create galleries', 'edit galleries', 'delete galleries', 'manage galleries'])) {
                $categorizedPermissions['Konten & Website'][] = $permission;
            } elseif (Str::startsWith($permission->name, ['view students', 'create students', 'edit students', 'delete students', 'export students', 'import students'])) {
                $categorizedPermissions['Santri & PPDB'][] = $permission;
            } elseif (Str::startsWith($permission->name, ['view applicants', 'edit applicants', 'delete applicants'])) {
                $categorizedPermissions['Santri & PPDB'][] = $permission;
            } elseif (Str::startsWith($permission->name, ['view programs', 'create programs', 'edit programs', 'delete programs', 'manage users', 'assign roles'])) {
                $categorizedPermissions['Administrasi Sistem'][] = $permission;
            } elseif (Str::startsWith($permission->name, ['view teachers', 'create teachers', 'edit teachers', 'delete teachers', 'assign teacher user'])) {
                $categorizedPermissions['Manajemen Pengajar'][] = $permission;
            } elseif (Str::startsWith($permission->name, 'view general management')) {
                $categorizedPermissions['Modul Lain'][] = $permission;
            } elseif (Str::startsWith($permission->name, 'manage finance')) {
                $categorizedPermissions['Modul Lain'][] = $permission;
            } elseif (Str::startsWith($permission->name, 'manage dormitories')) {
                $categorizedPermissions['Modul Lain'][] = $permission;
            } elseif (Str::startsWith($permission->name, 'manage events')) {
                $categorizedPermissions['Modul Lain'][] = $permission;
            }
        }

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
            $role->syncPermissions(Permission::all());
        } else {
            $selectedPermissions = Permission::whereIn('id', $request->input('permissions', []))->get();
            $role->syncPermissions($selectedPermissions);
        }

        return redirect()->route('admin.permissions.index')->with('success', 'Izin untuk peran ' . $role->name . ' berhasil diperbarui!');
    }
}
