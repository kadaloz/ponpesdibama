<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halaqoh;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;

class HalaqohController extends Controller
{
    public function index()
    {
        $halaqohs = Halaqoh::with('teacher')->latest()->paginate(10);
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
        ]);

        Halaqoh::create($request->all());

        return redirect()->route('halaqohs.index')->with('success', 'Halaqoh baru berhasil dibuat.');
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
        ]);

        $halaqoh->update($request->all());

        return redirect()->route('halaqohs.index')->with('success', 'Data halaqoh berhasil diperbarui.');
    }

    public function destroy(Halaqoh $halaqoh)
    {
        $halaqoh->delete();

        return redirect()->route('halaqohs.index')->with('success', 'Halaqoh berhasil dihapus.');
    }

    /**
     * Manajemen Santri Per Halaqoh.
     */
    public function manageStudents(Halaqoh $halaqoh)
    {
        // Ambil santri yang belum masuk halaqoh manapun
        $students = Student::whereDoesntHave('halaqohs')
            ->orWhereHas('halaqohs', function ($q) use ($halaqoh) {
                $q->where('halaqoh_id', $halaqoh->id);
            })->get();

        return view('admin.halaqohs.manage_students', compact('halaqoh', 'students'));
    }

    public function updateStudents(Request $request, Halaqoh $halaqoh)
    {
        $studentIds = $request->input('student_ids', []);

        // Validasi agar satu santri hanya satu halaqoh
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

        return redirect()->route('halaqohs.index')->with('success', 'Santri berhasil diperbarui di halaqoh.');
    }
}
