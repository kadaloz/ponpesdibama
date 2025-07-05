<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Untuk hash password
use Spatie\Permission\Models\Role; // Untuk mendapatkan daftar peran

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya admin yang bisa melihat semua pengguna
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $allUsers = User::with('roles')->latest()->get(); // Ambil semua user beserta perannya
        return view('admin.users.index', compact('allUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hanya admin yang bisa membuat user dan menetapkan peran
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::pluck('name', 'id'); // Ambil semua peran dari Spatie
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Hanya admin yang bisa membuat user dan menetapkan peran
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'nullable|array', // Harapkan array role IDs
            'roles.*' => 'exists:roles,id', // Pastikan ID role ada di tabel roles
        ]);

        // Pastikan admin tidak menetapkan peran yang tidak ada
        $selectedRoles = Role::whereIn('id', $request->input('roles', []))->pluck('name')->toArray();

        // Validasi khusus: hanya admin yang boleh membuat user mudabbir
        if (in_array('mudabbir', $selectedRoles) && !auth()->user()->hasRole('admin')) {
            abort(403, 'Only admin can create mudabbir users.');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($selectedRoles); // Tetapkan peran ke user

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Show the specified resource.
     */
    public function show(User $user)
    {
        // Untuk admin, detail biasanya di halaman edit. Redirect saja.
        return redirect()->route('admin.users.edit', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Hanya admin yang bisa mengedit user dan perannya
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::pluck('name', 'id'); // Ambil semua peran
        $userRoles = $user->roles->pluck('id')->toArray(); // Peran user yang sudah ada (dalam ID)

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Hanya admin yang bisa mengedit user dan perannya
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Perbarui peran user
        $selectedRoles = Role::whereIn('id', $request->input('roles', []))->pluck('name')->toArray();

        // Validasi khusus: admin tidak boleh mengubah peran adminnya sendiri menjadi bukan admin
        // Atau membatasi peran mudabbir jika user yang mengedit bukan admin (jika ada logika ini)
        if (in_array('mudabbir', $selectedRoles) && !auth()->user()->hasRole('admin') && $request->has('roles') && !in_array('mudabbir', $user->getRoleNames()->toArray())) {
            // Jika user bukan admin dan mencoba menambahkan peran mudabbir, tolak
            abort(403, 'Only admin can assign mudabbir role.');
        }
        
        $user->syncRoles($selectedRoles); // Sinkronkan peran

        // Jika password diisi, perbarui juga (opsional, bisa pisah form)
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Hanya admin yang bisa menghapus user
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        // Tidak boleh menghapus diri sendiri
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
