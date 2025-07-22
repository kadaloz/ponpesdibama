<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view teachers')->only(['index', 'show']);
        $this->middleware('permission:create teachers')->only(['create', 'store']);
        $this->middleware('permission:edit teachers')->only(['edit', 'update']);
        $this->middleware('permission:delete teachers')->only(['destroy']);
        $this->middleware('permission:assign teacher user')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allTeachers = Teacher::latest()->get();
        return view('admin.teachers.index', compact('allTeachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Dapatkan user yang belum terhubung dengan pengajar manapun DAN memiliki peran 'mudabbir'
        $unassignedUsers = User::doesntHave('teacher')
                                ->whereHas('roles', function ($query) {
                                    $query->where('name', 'mudabbir'); // Filter peran 'mudabbir'
                                })
                                ->get();
        return view('admin.teachers.create', compact('unassignedUsers')); // Pastikan $unassignedUsers diteruskan
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255|unique:teachers,nip',
            'gender' => 'nullable|string|in:Laki-laki,Perempuan',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'nullable|string|max:50',
            'specialization' => 'nullable|string|max:255',
            'join_date' => 'nullable|date',
            'status' => 'required|string|in:active,inactive',
            'user_id' => [
                'nullable',
                'exists:users,id',
                Rule::unique('teachers', 'user_id'),
            ],
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $teacher = Teacher::create($request->all());
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('teachers_photos', 'public');
            $teacher->photo_path = $photoPath;
            $teacher->save();
        }

        // Catat audit trail untuk pembuatan pengajar
        record_audit(
            'create_teacher',
            'Pengajar baru berhasil dibuat: ' . $teacher->full_name,
            auth()->user()->id ?? null, // Simpan ID user yang membuat
            auth()->user()->name ?? 'Guest',
            $request->ip(),
            $request->userAgent()
        );

        return redirect()->route('admin.teachers.index')->with('success', 'Data pengajar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        // Dapatkan user yang belum terhubung dengan pengajar lain DAN memiliki peran 'mudabbir'
        // ATAU user yang saat ini sudah terhubung dengan pengajar ini
        $unassignedUsers = User::whereDoesntHave('teacher')
                                ->whereHas('roles', function ($query) {
                                    $query->where('name', 'mudabbir');
                                })
                                ->orWhere('id', $teacher->user_id)
                                ->get();
        return view('admin.teachers.edit', compact('teacher', 'unassignedUsers')); // Pastikan $unassignedUsers diteruskan
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Teacher $teacher)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'nip' => 'nullable|string|max:255',
        'photo' => 'nullable|image|max:2048', // Maksimal 2MB
        'gender' => 'nullable|in:Laki-laki,Perempuan',
        'place_of_birth' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'phone_number' => 'nullable|string|max:255',
        'specialization' => 'nullable|string|max:255',
        'join_date' => 'nullable|date',
        'status' => 'required|in:active,inactive',
        'user_id' => 'nullable|exists:users,id',
    ]);

    // Update data dasar
    $teacher->fill($validated);

    // Proses unggah foto jika ada
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoPath = $photo->store('teachers/photos', 'public'); // Simpan di storage/app/public/teachers/photos

        // Hapus foto lama jika ada
        if ($teacher->photo_path && Storage::disk('public')->exists($teacher->photo_path)) {
            Storage::disk('public')->delete($teacher->photo_path);
        }

        // Simpan path foto baru
        $teacher->photo_path = $photoPath;
    }

    $teacher->save();

    return redirect()->route('admin.teachers.index')->with('success', 'Data pengajar berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        // Catat audit trail untuk penghapusan pengajar
        record_audit(
            'delete_teacher',
            'Data pengajar berhasil dihapus: ' . $teacher->full_name,
            auth()->user()->id ?? null, // Simpan ID user yang menghapus
            auth()->user()->name ?? 'Guest',
            request()->ip(),
            request()->userAgent()
        );
        return redirect()->route('admin.teachers.index')->with('success', 'Data pengajar berhasil dihapus!');
    }
}
