<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halaqoh;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\HalaqohSchedule;
use App\Models\HalaqohScheduleLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule; // Import Rule for validation

class HalaqohController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view halaqohs')->only(['index', 'show']);
        $this->middleware('permission:create halaqohs')->only(['create', 'store']);
        $this->middleware('permission:edit halaqohs')->only(['edit', 'update']);
        $this->middleware('permission:delete halaqohs')->only(['destroy']);
        $this->middleware('permission:assign students to halaqoh')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = Halaqoh::with(['teacher', 'students']);

    // Filter berdasarkan status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Pencarian berdasarkan nama halaqoh atau nama pengajar
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhereHas('teacher', function ($q2) use ($search) {
                  $q2->where('full_name', 'like', "%$search%");
              });
        });
    }

    $allHalaqohs = $query->latest()->paginate(10)->withQueryString();

    return view('admin.halaqohs.index', compact('allHalaqohs'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::where('status', 'active')->get();
        // Ambil santri aktif, dan pastikan kolom 'type' serta 'halaqoh_period' juga diambil
        $students = Student::where('status', 'aktif')->select('id', 'name', 'nis', 'type', 'halaqoh_period')->get();
        $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('admin.halaqohs.create', compact('teachers', 'students', 'daysOfWeek'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id' => 'nullable|exists:teachers,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string|in:active,inactive,completed',
            'student_limit' => 'nullable|integer|min:0', // NEW: Validasi student_limit
            'selected_students' => 'nullable|array',
            'selected_students.*' => 'exists:students,id',
            'schedules' => 'nullable|array',
            'schedules.*.day_of_week' => 'required_with:schedules|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'schedules.*.start_time' => 'required_with:schedules|date_format:H:i',
            'schedules.*.end_time' => 'required_with:schedules|date_format:H:i|after:schedules.*.start_time',
            'schedules.*.location' => 'nullable|string|max:255',
        ]);

        // Validasi tambahan untuk student_limit jika ada santri yang dipilih
        if ($request->filled('student_limit') && $request->has('selected_students')) {
            if (count($request->input('selected_students')) > $request->input('student_limit')) {
                return redirect()->back()->withErrors(['selected_students' => 'Jumlah santri yang dipilih melebihi batas yang ditentukan.'])->withInput();
            }
        }

        DB::transaction(function () use ($request) {
            $halaqoh = Halaqoh::create($request->only([
                'name', 'description', 'teacher_id', 'start_date', 'end_date', 'status', 'student_limit' // NEW: Simpan student_limit
            ]));

            if ($request->has('selected_students')) {
                $halaqoh->students()->attach($request->input('selected_students'), ['join_date' => now()]);
            }
            // Validasi Aturan Halaqoh
                $this->validateHalaqohRules($halaqoh, $request->input('selected_students'));

                $halaqoh->students()->attach($studentsToAttach->toArray());

            if ($request->has('schedules')) {
                foreach ($request->input('schedules') as $scheduleData) {
                    $halaqoh->schedules()->create($scheduleData);
                }
            }
        });

        return redirect()->route('admin.halaqohs.index')->with('success', 'Halaqoh berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
public function show(Halaqoh $halaqoh, Request $request)
{
    $logsQuery = HalaqohScheduleLog::with('user')
        ->where('halaqoh_id', $halaqoh->id)
        ->latest();

    if ($request->has('start_date') && $request->has('end_date')) {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $logsQuery->whereBetween('created_at', [$startDate, $endDate]);
    }

    $halaqoh->load(['teacher', 'students', 'schedules']);

    if ($request->get('show') === 'all') {
        $logs = $logsQuery->get();
    } else {
        $logs = $logsQuery->paginate(5);
    }

    return view('admin.halaqohs.show', compact('halaqoh', 'logs'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Halaqoh $halaqoh, Request $request)
    {
        $teachers = Teacher::where('status', 'active')->get();
        // Ambil santri aktif, dan pastikan kolom 'type' serta 'halaqoh_period' juga diambil
        $students = Student::where('status', 'aktif')->select('id', 'name', 'nis', 'type', 'halaqoh_period')->get();
        $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $currentStudents = $halaqoh->students->pluck('id')->toArray();

        return view('admin.halaqohs.edit', compact('halaqoh', 'teachers', 'students', 'daysOfWeek', 'currentStudents'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Halaqoh $halaqoh)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'teacher_id' => 'nullable|exists:teachers,id',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'status' => 'required|string|in:active,inactive,completed',
        'student_limit' => 'nullable|integer|min:0',
        'selected_students' => 'nullable|array',
        'selected_students.*' => 'exists:students,id',
        'schedules' => 'nullable|array',
        'schedules.*.id' => 'nullable|exists:halaqoh_schedules,id',
        'schedules.*.day_of_week' => 'required_with:schedules|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        'schedules.*.start_time' => 'required_with:schedules|date_format:H:i',
        'schedules.*.end_time' => 'required_with:schedules|date_format:H:i|after:schedules.*.start_time',
        'schedules.*.location' => 'nullable|string|max:255',
    ]);

    if ($request->filled('student_limit') && $request->has('selected_students')) {
        if (count($request->input('selected_students')) > $request->input('student_limit')) {
            return redirect()->back()->withErrors(['selected_students' => 'Jumlah santri yang dipilih melebihi batas yang ditentukan.'])->withInput();
        }
    }

    DB::transaction(function () use ($request, $halaqoh) {
        
        // Validasi Aturan Halaqoh sebelum update dan sync
        $this->validateHalaqohRules($halaqoh, $request->input('selected_students'));

        // Update data utama halaqoh
        $halaqoh->update($request->only([
            'name', 'description', 'teacher_id', 'start_date', 'end_date', 'status', 'student_limit'
        ]));

        // Sinkronisasi santri
        $halaqoh->students()->detach();
        if ($request->has('selected_students')) {
            foreach ($request->input('selected_students') as $studentId) {
                $halaqoh->students()->attach($studentId, ['join_date' => now()]);
            }
        }

        // Proses jadwal
        $existingScheduleIds = $halaqoh->schedules->pluck('id')->toArray();
        $updatedScheduleIds = [];

        if ($request->has('schedules')) {
            foreach ($request->input('schedules') as $scheduleData) {
                if (isset($scheduleData['id']) && in_array($scheduleData['id'], $existingScheduleIds)) {
                    $schedule = HalaqohSchedule::find($scheduleData['id']);

                    // Simpan log UPDATE
                    HalaqohScheduleLog::create([
                        'halaqoh_id' => $halaqoh->id,
                        'schedule_id' => $schedule->id,
                        'action' => 'updated',
                        'data_before' => $schedule->toArray(),
                        'data_after' => $scheduleData,
                        'user_id' => auth()->id(),
                    ]);

                    $schedule->update([
                            'day_of_week' => $scheduleData['day_of_week'],
                            'start_time' => $scheduleData['start_time'],
                            'end_time' => $scheduleData['end_time'],
                            'location' => $scheduleData['location'] ?? null,
            ]);
                    $updatedScheduleIds[] = $scheduleData['id'];
                } else {
                    $newSchedule = $halaqoh->schedules()->create($scheduleData);

                    // Simpan log CREATE
                    HalaqohScheduleLog::create([
                        'halaqoh_id' => $halaqoh->id,
                        'schedule_id' => $newSchedule->id,
                        'action' => 'created',
                        'data_after' => $scheduleData,
                        'user_id' => auth()->id(),
                    ]);
                }
            }
        }

        // Hapus jadwal yang tidak dikirim
        $schedulesToDelete = array_diff($existingScheduleIds, $updatedScheduleIds);
        foreach ($schedulesToDelete as $deletedId) {
            $schedule = HalaqohSchedule::find($deletedId);

            // Simpan log DELETE
            HalaqohScheduleLog::create([
                'halaqoh_id' => $halaqoh->id,
                'schedule_id' => $schedule->id,
                'action' => 'deleted',
                'data_before' => $schedule->toArray(),
                'user_id' => auth()->id(),
            ]);

            $schedule->delete();
        }
    });

    return redirect()->route('admin.halaqohs.index')->with('success', 'Halaqoh berhasil diperbarui!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Halaqoh $halaqoh)
    {
        $halaqoh->delete();
        return redirect()->route('admin.halaqohs.index')->with('success', 'Halaqoh berhasil dihapus!');
    }

    /**
     * Delete an individual schedule from a halaqoh via AJAX.
     */
    public function deleteSchedule(Request $request, HalaqohSchedule $schedule)
    {
        if (!auth()->user()->can('edit halaqohs')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        HalaqohScheduleLog::create([
        'halaqoh_id' => $schedule->halaqoh_id,
        'schedule_id' => $schedule->id,
        'action' => 'deleted',
        'data_before' => $schedule->toArray(),
        'user_id' => auth()->id(),
    ]);

        $schedule->delete();
        return response()->json(['message' => 'Jadwal berhasil dihapus.']);
    }
        /**
     * Validasi aturan kustom untuk halaqoh (satu halaqoh per santri, periode ngaji sesuai).
     *
     * @param  \App\Models\Halaqoh $currentHalaqoh
     * @param  array $selectedStudentIds
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateHalaqohRules(Halaqoh $currentHalaqoh, array $selectedStudentIds)
    {
        // Ambil santri yang sudah ada di halaqoh ini, karena mereka tidak perlu divalidasi ulang
        // Kecuali jika ada santri yang DITAMBAHKAN ke halaqoh ini
        $existingStudentIdsInThisHalaqoh = $currentHalaqoh->students->pluck('id')->toArray();

        $errors = [];
        $studentsToCheck = Student::whereIn('id', $selectedStudentIds)->get();

        foreach ($studentsToCheck as $student) {
            // Lewati validasi jika santri sudah ada di halaqoh ini (untuk update)
            if (in_array($student->id, $existingStudentIdsInThisHalaqoh) && $currentHalaqoh->students->contains($student->id)) {
                continue; // Santri ini sudah bagian dari halaqoh ini, lewati pengecekan duplikasi
            }

            // Aturan 1: Setiap santri hanya memiliki 1 jadwal halaqoh
            if ($student->halaqohs()->where('id', '!=', $currentHalaqoh->id)->exists()) {
                $errors['selected_students'] = ($errors['selected_students'] ?? '') . "Santri '{$student->name}' (NIS: {$student->nis}) sudah terdaftar di halaqoh lain. ";
            }

            // Aturan 2: Santri Pulang-Pergi harus sesuai periode ngaji Halaqoh Sore/Malam
            if ($student->type === 'Pulang-Pergi') {
                // Asumsi halaqoh_period sudah diisi di request atau sudah ada di halaqoh object
                $halaqohPeriod = $currentHalaqoh->halaqoh_period ?? request('halaqoh_period'); // Ambil dari object atau request

                if (empty($halaqohPeriod)) { // Jika halaqoh_period belum di set untuk halaqoh
                    $errors['selected_students'] = ($errors['selected_students'] ?? '') . "Halaqoh harus memiliki 'Periode Ngaji' jika menempatkan santri Pulang-Pergi. ";
                } elseif ($student->halaqoh_period !== $halaqohPeriod) {
                    $errors['selected_students'] = ($errors['selected_students'] ?? '') . "Santri '{$student->name}' (NIS: {$student->nis}) adalah Pulang-Pergi dengan periode '{$student->halaqoh_period}', tidak cocok dengan periode halaqoh '{$halaqohPeriod}'. ";
                }
            }
        }

        if (!empty($errors)) {
            // Jika Anda ingin mengumpulkan semua error, gunakan bag error global
            // throw \Illuminate\Validation\ValidationException::withMessages($errors);
            // Atau, untuk kesederhanaan, ambil error pertama saja dan redirect
            throw \Illuminate\Validation\ValidationException::withMessages([
                'selected_students' => array_values($errors) // Mengambil pesan error pertama saja
            ]);
        }
    }
}
