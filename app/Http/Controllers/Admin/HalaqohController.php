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
use Illuminate\Validation\Rule;

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

    public function index(Request $request)
    {
        $query = Halaqoh::with(['teacher', 'students']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

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

    public function create()
    {
        $teachers = Teacher::where('status', 'active')->get();
        $students = Student::where('status', 'aktif')->select('id', 'name', 'nis', 'type', 'halaqoh_period')->get();
        $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('admin.halaqohs.create', compact('teachers', 'students', 'daysOfWeek'));
    }

    public function store(Request $request)
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

        DB::transaction(function () use ($request) {
            $halaqoh = Halaqoh::create($request->only([
                'name', 'description', 'teacher_id', 'start_date', 'end_date', 'status', 'student_limit'
            ]));

            if ($request->has('selected_students')) {
                $this->validateHalaqohRules($halaqoh, $request->input('selected_students'));
                $halaqoh->students()->attach($request->input('selected_students'), ['join_date' => now()]);
            }

            if ($request->has('schedules')) {
                foreach ($request->input('schedules') as $scheduleData) {
                    $halaqoh->schedules()->create($scheduleData);
                }
            }
        });

        return redirect()->route('admin.halaqohs.index')->with('success', 'Halaqoh berhasil ditambahkan!');
    }

    public function show(Halaqoh $halaqoh, Request $request)
    {
        $logsQuery = HalaqohScheduleLog::with('user')
            ->where('halaqoh_id', $halaqoh->id)
            ->latest();

        if ($request->has('start_date') && $request->has('end_date')) {
            $logsQuery->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $halaqoh->load(['teacher', 'students', 'schedules']);

        $logs = $request->get('show') === 'all' ? $logsQuery->get() : $logsQuery->paginate(5);

        return view('admin.halaqohs.show', compact('halaqoh', 'logs'));
    }

    public function edit(Halaqoh $halaqoh)
    {
        $teachers = Teacher::where('status', 'active')->get();
        $students = Student::where('status', 'aktif')->select('id', 'name', 'nis', 'type', 'halaqoh_period')->get();
        $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $currentStudents = $halaqoh->students->pluck('id')->toArray();

        return view('admin.halaqohs.edit', compact('halaqoh', 'teachers', 'students', 'daysOfWeek', 'currentStudents'));
    }

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
            $this->validateHalaqohRules($halaqoh, $request->input('selected_students'));

            $halaqoh->update($request->only([
                'name', 'description', 'teacher_id', 'start_date', 'end_date', 'status', 'student_limit'
            ]));

            $halaqoh->students()->detach();
            if ($request->has('selected_students')) {
                foreach ($request->input('selected_students') as $studentId) {
                    $halaqoh->students()->attach($studentId, ['join_date' => now()]);
                }
            }

            $existingScheduleIds = $halaqoh->schedules->pluck('id')->toArray();
            $updatedScheduleIds = [];

            if ($request->has('schedules')) {
                foreach ($request->input('schedules') as $scheduleData) {
                    if (isset($scheduleData['id']) && in_array($scheduleData['id'], $existingScheduleIds)) {
                        $schedule = HalaqohSchedule::find($scheduleData['id']);

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

            $schedulesToDelete = array_diff($existingScheduleIds, $updatedScheduleIds);
            foreach ($schedulesToDelete as $deletedId) {
                $schedule = HalaqohSchedule::find($deletedId);

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

    public function destroy(Halaqoh $halaqoh)
    {
        $halaqoh->delete();
        return redirect()->route('admin.halaqohs.index')->with('success', 'Halaqoh berhasil dihapus!');
    }

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

    protected function validateHalaqohRules(Halaqoh $currentHalaqoh, array $selectedStudentIds)
    {
        $existingStudentIdsInThisHalaqoh = $currentHalaqoh->students->pluck('id')->toArray();
        $errors = [];
        $studentsToCheck = Student::whereIn('id', $selectedStudentIds)->get();

        foreach ($studentsToCheck as $student) {
            if (in_array($student->id, $existingStudentIdsInThisHalaqoh)) {
                continue;
            }

            if ($student->halaqohs()->where('id', '!=', $currentHalaqoh->id)->exists()) {
                $errors['selected_students'] = ($errors['selected_students'] ?? '') . "Santri '{$student->name}' (NIS: {$student->nis}) sudah terdaftar di halaqoh lain. ";
            }

            if ($student->type === 'Pulang-Pergi') {
                $halaqohPeriod = $currentHalaqoh->halaqoh_period ?? request('halaqoh_period');

                if (empty($halaqohPeriod)) {
                    $errors['selected_students'] = ($errors['selected_students'] ?? '') . "Halaqoh harus memiliki 'Periode Ngaji' jika menempatkan santri Pulang-Pergi. ";
                } elseif ($student->halaqoh_period !== $halaqohPeriod) {
                    $errors['selected_students'] = ($errors['selected_students'] ?? '') . "Santri '{$student->name}' (NIS: {$student->nis}) adalah Pulang-Pergi dengan periode '{$student->halaqoh_period}', tidak cocok dengan periode halaqoh '{$halaqohPeriod}'. ";
                }
            }
        }

        if (!empty($errors)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'selected_students' => array_values($errors)
            ]);
        }
    }
}
