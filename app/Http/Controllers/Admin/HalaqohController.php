<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halaqoh;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;

class HalaqohController extends Controller
{
    public function index(Request $request)
    {
        $query = Halaqoh::with('teacher')
                ->withCount('students')  // Hitung jumlah santri per halaqoh
                ->latest();

        if ($request->filled('period')) {
        $query->where('period', $request->period);
    }

        $halaqohs = $query->paginate(10);

        return view('admin.halaqohs.index', compact('halaqohs'));
    }


    public function create()
    {
        $teachers = Teacher::doesntHave('halaqoh')->get(); // Satu guru satu halaqoh
        return view('admin.halaqohs.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id|unique:halaqohs,teacher_id',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'student_limit' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive,completed',
            'period' => 'nullable|in:Sore,Malam', // Validasi untuk period
            
        ]);

        Halaqoh::create($request->all());

        return redirect()->route('admin.halaqohs.index')->with('success', 'Halaqoh baru berhasil dibuat.');
    }

    public function edit(Halaqoh $halaqoh)
    {
        $teachers = Teacher::where(function ($query) use ($halaqoh) {
            $query->whereDoesntHave('halaqoh')
                  ->orWhere('id', $halaqoh->teacher_id);
        })->get();

        return view('admin.halaqohs.edit', compact('halaqoh', 'teachers'));
    }

    public function update(Request $request, Halaqoh $halaqoh)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id|unique:halaqohs,teacher_id,' . $halaqoh->id,
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'student_limit' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive,completed',
            'period' => 'nullable|in:Sore,Malam',
        ]);

        $halaqoh->update($request->all());

        return redirect()->route('admin.halaqohs.index')->with('success', 'Data halaqoh berhasil diperbarui.');
    }

    public function destroy(Halaqoh $halaqoh)
    {
        $halaqoh->delete();

        return redirect()->route('admin.halaqohs.index')->with('success', 'Halaqoh berhasil dihapus.');
    }

    /**
     * Manajemen Santri Per Halaqoh.
     */
    public function manageStudents(Halaqoh $halaqoh, Request $request)
{
    $query = Student::where('status', 'aktif');

    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('nis', 'like', '%' . $search . '%');
        });
    }

    if ($type = $request->input('type')) {
        $query->where('type', $type);
    }

    if ($request->input('type') == 'Pulang-Pergi' && $period = $request->input('halaqoh_period')) {
        $query->where('halaqoh_period', $period);
    }

    // Hanya santri tanpa halaqoh atau yang sudah tergabung dalam halaqoh ini
    $query->where(function ($q) use ($halaqoh) {
        $q->whereDoesntHave('halaqohs')
          ->orWhereHas('halaqohs', function ($q2) use ($halaqoh) {
              $q2->where('halaqoh_id', $halaqoh->id);
          });
    });

    $students = $query->orderBy('name')->get();
    $selectedStudents = $halaqoh->students()->get(['id', 'name', 'nis', 'type', 'halaqoh_period']);

    return view('admin.halaqohs.manage_students', compact('halaqoh', 'students'));
}


    public function updateStudents(Request $request, Halaqoh $halaqoh)
    {
    $studentIds = $request->input('student_ids', []);

    // Cek apakah ada santri tidak aktif
    $invalidStudents = Student::whereIn('id', $studentIds)
        ->where('status', '!=', 'aktif')
        ->pluck('name')
        ->toArray();

    if (!empty($invalidStudents)) {
        return redirect()->back()->withErrors('Santri berikut tidak aktif: ' . implode(', ', $invalidStudents));
    }

    // Validasi: satu santri hanya satu halaqoh
    $alreadyAssigned = Student::whereIn('id', $studentIds)
        ->whereHas('halaqohs', function ($query) use ($halaqoh) {
            $query->where('halaqoh_id', '!=', $halaqoh->id);
        })->pluck('name')->toArray();

    if (!empty($alreadyAssigned)) {
        return redirect()->back()->withErrors('Beberapa santri sudah tergabung di halaqoh lain: ' . implode(', ', $alreadyAssigned));
    }

    // Sinkronisasi data pivot
    $syncData = [];
    foreach ($studentIds as $studentId) {
        $syncData[$studentId] = [
            'join_date' => now(),
            'status' => 'active'
        ];
    }

    $halaqoh->students()->sync($syncData);

    return redirect()->route('admin.halaqohs.index')->with('success', 'Santri berhasil diperbarui di halaqoh.');
    }


    public function show(Halaqoh $halaqoh)
    {
        $halaqoh->load(['teacher', 'students']);
        return view('admin.halaqohs.show', compact('halaqoh'));
    } 
    
}
