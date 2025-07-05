<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- 1. Buat Permissions (Izin) ---
        Permission::firstOrCreate(['name' => 'view dashboard']);

        // Berita & Pengumuman
        Permission::firstOrCreate(['name' => 'view news']);
        Permission::firstOrCreate(['name' => 'create news']);
        Permission::firstOrCreate(['name' => 'edit news']);
        Permission::firstOrCreate(['name' => 'delete news']);

        // Pengaturan Website
        Permission::firstOrCreate(['name' => 'manage settings']);

        // Data Santri
        Permission::firstOrCreate(['name' => 'view students']);
        Permission::firstOrCreate(['name' => 'create students']);
        Permission::firstOrCreate(['name' => 'edit students']);
        Permission::firstOrCreate(['name' => 'delete students']);
        Permission::firstOrCreate(['name' => 'export students']);
        Permission::firstOrCreate(['name' => 'import students']);

        // Manajemen Program
        Permission::firstOrCreate(['name' => 'view programs']);
        Permission::firstOrCreate(['name' => 'create programs']);
        Permission::firstOrCreate(['name' => 'edit programs']);
        Permission::firstOrCreate(['name' => 'delete programs']);

        // Manajemen Pendaftaran (PPDB)
        Permission::firstOrCreate(['name' => 'view applicants']);
        Permission::firstOrCreate(['name' => 'edit applicants']);
        Permission::firstOrCreate(['name' => 'delete applicants']);

        // Manajemen Syarat PPDB
        Permission::firstOrCreate(['name' => 'edit ppdb requirements']);


        // Manajemen Akun Pengguna (CRUD Users & Roles)
        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'assign roles']);

        // Manajemen Umum (dashboard untuk sub-modul)
        Permission::firstOrCreate(['name' => 'view general management']);
        Permission::firstOrCreate(['name' => 'manage own profile']);

        // Izin Galeri
        Permission::firstOrCreate(['name' => 'view galleries']);
        Permission::firstOrCreate(['name' => 'create galleries']);
        Permission::firstOrCreate(['name' => 'edit galleries']);
        Permission::firstOrCreate(['name' => 'delete galleries']);

        // Izin untuk Manajemen Pengajar (mudabbir/mudabbiroh)
        Permission::firstOrCreate(['name' => 'view teachers']);
        Permission::firstOrCreate(['name' => 'create teachers']);
        Permission::firstOrCreate(['name' => 'edit teachers']);
        Permission::firstOrCreate(['name' => 'delete teachers']);
        Permission::firstOrCreate(['name' => 'assign teacher user']);

        // NEW: Izin untuk Manajemen Halaqoh
        Permission::firstOrCreate(['name' => 'view halaqohs']);
        Permission::firstOrCreate(['name' => 'create halaqohs']);
        Permission::firstOrCreate(['name' => 'edit halaqohs']);
        Permission::firstOrCreate(['name' => 'delete halaqohs']);
        Permission::firstOrCreate(['name' => 'assign students to halaqoh']); // Izin untuk menambahkan/menghapus santri dari halaqoh


        // --- 2. Buat Roles (Peran) dan Beri Izin (Permissions) ---

        // Role Admin (Super Admin) - Memiliki semua izin yang ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Role Sekretaris
        $sekretRole = Role::firstOrCreate(['name' => 'sekret']);
        $sekretRole->givePermissionTo([
            'view dashboard',
            'view news', 'create news', 'edit news', 'delete news',
            'view applicants', 'edit applicants', 'delete applicants',
            'view general management',
            'manage own profile',
            'view halaqohs', 'create halaqohs', 'edit halaqohs', 'delete halaqohs', 'assign students to halaqoh', 'edit ppdb requirements' // Sekretaris bisa mengelola halaqoh
        ]);

        // Role Mudabbir (untuk semua pengajar, laki-laki atau perempuan)
        $mudabbirRole = Role::firstOrCreate(['name' => 'mudabbir']);
        $mudabbirRole->givePermissionTo([
            'view dashboard',
            'view students', 'create students', 'edit students', 'delete students', 'export students', 'import students',
            'view general management',
            'manage own profile',
            'view teachers', 'create teachers', 'edit teachers', 'delete teachers',
            'view halaqohs', 'edit halaqohs', 'assign students to halaqoh', // Mudabbir bisa melihat, mengedit halaqoh yang dia ajar, dan menetapkan santri
        ]);

        // Hapus peran 'mudabbiroh' lama jika ada
        Role::where('name', 'mudabbiroh')->delete();
        Role::where('name', 'pengajar')->delete();


        // --- 3. Tetapkan Roles ke Pengguna (User) ---

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@ponpesdibama.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
            ]
        );
        if (!$adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }

        $sekretUser = User::firstOrCreate(
            ['email' => 'sekret@ponpesdibama.com'],
            [
                'name' => 'Sekretaris PPDB',
                'password' => bcrypt('password'),
            ]
        );
        if (!$sekretUser->hasRole('sekret')) {
            $sekretUser->assignRole('sekret');
        }

        $mudabbirUser = User::firstOrCreate(
            ['email' => 'mudabbir@ponpesdibama.com'],
            [
                'name' => 'Mudabbir Umum',
                'password' => bcrypt('password'),
            ]
        );
        if (!$mudabbirUser->hasRole('mudabbir')) {
            $mudabbirUser->assignRole('mudabbir');
        }


        $this->command->info('Roles dan Permissions berhasil dibuat dan ditetapkan.');
    }
}
