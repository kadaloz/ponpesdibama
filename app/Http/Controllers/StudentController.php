<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel; // Import Facade Excel
use App\Exports\StudentsExport; // Import Kelas Export
use App\Imports\StudentsImport; // Import Kelas Import
use Illuminate\Support\Facades\Storage; // Import Storage facade
use App\Models\Program; // Import Model Program

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    // 🔍 Query Params
    $sortBy = $request->query('sort_by', 'nis');
    $sortOrder = $request->query('sort_order', 'asc');
    $perPage = $request->query('per_page', 10);
    $search = $request->query('search');
    $genderFilter = $request->query('gender_filter');
    $status = $request->query('status');
    $type = $request->query('type');
    $halaqoh_period = $request->query('halaqoh_period');
    $admissionYear = $request->query('admission_year');

    // ✅ Validasi
    $validSortColumns = ['id', 'nis', 'name', 'gender', 'admission_year', 'status', 'category', 'type', 'created_at'];
    if (!in_array($sortBy, $validSortColumns)) {
        $sortBy = 'created_at';
    }

    if (!in_array($sortOrder, ['asc', 'desc'])) {
        $sortOrder = 'desc';
    }

    $validPerPages = [10, 20, 50];
    if (!in_array((int)$perPage, $validPerPages)) {
        $perPage = 10;
    }

    // 🔎 Build Query
    $query = Student::query();

    // 🧑‍🏫 Role Mudabbir
    if (auth()->user()->hasRole('mudabbir')) {
        $teacher = auth()->user()->teacher;
        if ($teacher) {
            $query->whereHas('halaqohs', function ($q) use ($teacher) {
                $q->where('teacher_id', $teacher->id);
            });
        } else {
            $query->whereRaw('0 = 1'); // Tidak tampilkan apapun
        }
    }

    // 🔍 Pencarian Umum
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('nis', 'like', '%' . $search . '%')
              ->orWhere('address', 'like', '%' . $search . '%')
              ->orWhere('parent_name', 'like', '%' . $search . '%');
        });
    }

    // 👦🏻 Gender
    if ($genderFilter && in_array($genderFilter, ['Laki-laki', 'Perempuan'])) {
        $query->where('gender', $genderFilter);
    }

    // 🟢 Status
    if ($status && in_array($status, ['aktif', 'non-aktif', 'lulus'])) {
        $query->where('status', $status);
    }

    // 📘 Type & Period
    if ($type && in_array($type, ['Asrama', 'Pulang-Pergi'])) {
        $query->where('type', $type);

        if ($type === 'Pulang-Pergi' && $halaqoh_period && in_array($halaqoh_period, ['Sore', 'Malam'])) {
            $query->where('halaqoh_period', $halaqoh_period);
        }
    }

    // 📅 Tahun Masuk
    if ($admissionYear && is_numeric($admissionYear) && strlen($admissionYear) === 4) {
        $query->where('admission_year', $admissionYear);
    }

    // 🔃 Pagination
    $allStudents = $query->orderBy($sortBy, $sortOrder)
                         ->paginate($perPage)
                         ->appends($request->query());

    // 📦 Data Dropdown
    $halaqohPeriods = ['Sore', 'Malam'];
    $admissionYears = Student::pluck('admission_year')->filter()->unique()->sortDesc()->values();

    // 🖼️ Kirim ke View
    return view('admin.students.index', compact(
        'allStudents', 'sortBy', 'sortOrder', 'perPage',
        'search', 'genderFilter', 'status', 'type',
        'halaqoh_period', 'admissionYear',
        'halaqohPeriods', 'admissionYears'
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Student $student)
    {
    $programs = Program::where('is_active', true)->get(); // ⬅️ penting
    $halaqohPeriods = ['Sore', 'Malam'];

    return view('admin.students.create', compact('student', 'programs', 'halaqohPeriods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'nullable|string|max:255|unique:students,nis',
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string|in:Laki-laki,Perempuan',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'nisn' => 'nullable|string|max:255',
            'last_education' => 'nullable|string|max:255',
            'school_origin' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'village' => 'nullable|string|max:255',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:50',
            'parent_email' => 'nullable|string|email|max:255',
            'parent_occupation' => 'nullable|string|max:255',
            'admission_year' => 'nullable|integer|digits:4',
            'status' => 'required|string|in:aktif,non-aktif,lulus',
            'category' => 'nullable|string|max:255',
            'type' => 'required|string|in:Asrama,Pulang-Pergi',
            'halaqoh_period' => 'nullable|string|in:Sore,Malam', // NEW: Validasi halaqoh_period
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'document_akta' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'document_kk' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'document_ijazah' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'document_photo' => 'nullable|file|mimes:jpg,png|max:1024',
        ]);

        $data = $request->all();

       if (empty($data['nis'])) {
        $data['nis'] = Student::generateUniqueNis(
        $data['type'] ?? 'TP', // pakai type, bukan category
        $data['gender'] ?? 'Laki-laki',
        $data['admission_year'] ?? date('Y')
    );
}


        if ($request->type === 'Asrama') {
            $data['halaqoh_period'] = null;
        }

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('student_photos', 'public');
        } else {
            $data['photo_path'] = null;
        }

        $documentFields = [
            'document_akta' => 'document_akta_path',
            'document_kk' => 'document_kk_path',
            'document_ijazah' => 'document_ijazah_path',
            'document_photo' => 'document_photo_path',
        ];

        foreach ($documentFields as $fileInputName => $dbColumnName) {
            if ($request->hasFile($fileInputName)) {
                $path = $request->file($fileInputName)->store('student_documents', 'public');
                $data[$dbColumnName] = $path;
            } else {
                $data[$dbColumnName] = null;
            }
        }

        Student::create($data);
        record_audit(
            'create_student',
            'Buat Data Santri Baru dengan NIS: ' . $data['nis'],
            auth()->user()->id ?? null,
            auth()->user()->name ?? 'Guest',
            $request->ip(),
            $request->userAgent()
        );

        return redirect()->route('admin.students.index')->with('success', 'Data santri berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
    $halaqohPeriods = ['Sore', 'Malam'];
    $programs = Program::where('is_active', true)->get(); // ⬅️ pastikan ini ada
    $selectedCategory = $student->category;

    return view('admin.students.edit', compact(
        'student', 'halaqohPeriods', 'programs', 'selectedCategory'
    ));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Student $student)
{
    // 1️⃣ Validasi Data
    $request->validate([
        'nis' => 'nullable|string|max:255|unique:students,nis,' . $student->id,
        'name' => 'required|string|max:255',
        'gender' => 'nullable|string|in:Laki-laki,Perempuan',
        'place_of_birth' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'nisn' => 'nullable|string|max:255',
        'last_education' => 'nullable|string|max:255',
        'school_origin' => 'nullable|string|max:255',
        'address' => 'nullable|string',
        'city' => 'nullable|string|max:255',
        'province' => 'nullable|string|max:255',
        'district' => 'nullable|string|max:255', // BARU DITAMBAHKAN
        'village' => 'nullable|string|max:255',  // BARU DITAMBAHKAN
        'parent_name' => 'nullable|string|max:255',
        'parent_phone' => 'nullable|string|max:50',
        'parent_email' => 'nullable|string|email|max:255',
        'parent_occupation' => 'nullable|string|max:255',
        'admission_year' => 'nullable|integer|digits:4',
        'status' => 'required|string|in:aktif,non-aktif,lulus',
        'category' => 'nullable|string|max:255',
        'type' => 'required|string|in:Asrama,Pulang-Pergi',
        'halaqoh_period' => 'nullable|string|in:Sore,Malam',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'document_akta' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'document_kk' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'document_ijazah' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        'document_photo' => 'nullable|file|mimes:jpg,png|max:1024',
    ]);

    // 2️⃣ Persiapkan Data
    $data = $request->except(['photo', 'remove_photo', 'document_akta', 'document_kk', 'document_ijazah', 'document_photo']);

    if ($request->type === 'Asrama') {
        $data['halaqoh_period'] = null;
    }

    // 3️⃣ Proses Foto Santri
    if ($request->hasFile('photo')) {
        if ($student->photo_path) {
            Storage::disk('public')->delete($student->photo_path);
        }
        $data['photo_path'] = $request->file('photo')->store('student_photos', 'public');
    } elseif ($request->boolean('remove_photo')) {
        if ($student->photo_path) {
            Storage::disk('public')->delete($student->photo_path);
        }
        $data['photo_path'] = null;
    } else {
        $data['photo_path'] = $student->photo_path;
    }

    // 4️⃣ Proses Dokumen Upload
    $documentFields = [
        'document_akta' => 'document_akta_path',
        'document_kk' => 'document_kk_path',
        'document_ijazah' => 'document_ijazah_path',
        'document_photo' => 'document_photo_path',
    ];

    foreach ($documentFields as $fileInputName => $dbColumnName) {
        if ($request->hasFile($fileInputName)) {
            if ($student->{$dbColumnName}) {
                Storage::disk('public')->delete($student->{$dbColumnName});
            }
            $data[$dbColumnName] = $request->file($fileInputName)->store('student_documents', 'public');
        } elseif ($request->boolean('remove_' . $fileInputName)) {
            if ($student->{$dbColumnName}) {
                Storage::disk('public')->delete($student->{$dbColumnName});
            }
            $data[$dbColumnName] = null;
        } else {
            $data[$dbColumnName] = $student->{$dbColumnName};
        }
    }

    // 5️⃣ Update Database
    $student->update($data);

    // 6️⃣ Catat Audit Trail
    record_audit(
        'update_student',
        'Update Data Santri dengan NIS: ' . $student->nis,
        auth()->user()->id ?? null,
        auth()->user()->name ?? 'Guest',
        $request->ip(),
        $request->userAgent()
    );

    // 7️⃣ Redirect
    return redirect()->route('admin.students.index')->with('success', 'Data santri berhasil diperbarui!');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy(Student $student)
{
    // Catat audit sebelum menghapus
    record_audit('delete_student', 'Hapus Data Santri dengan NIS: ' . $student->nis);

    // Hapus foto profil jika ada
    if ($student->photo_path) {
        Storage::disk('public')->delete($student->photo_path);
        record_audit('delete_file', 'Deleted profile photo for NIS: ' . $student->nis . ' (' . $student->photo_path . ')');
    }

    // Hapus dokumen jika ada
    foreach (['document_akta_path', 'document_kk_path', 'document_ijazah_path', 'document_photo_path'] as $docField) {
        if ($student->{$docField}) {
            Storage::disk('public')->delete($student->{$docField});
            record_audit('delete_file', 'Deleted document [' . $docField . '] for NIS: ' . $student->nis . ' (' . $student->{$docField} . ')');
        }
    }

    // Hapus data santri dari database
    $student->delete();

    return redirect()->route('admin.students.index')->with('success', 'Data santri dan dokumen berhasil dihapus!');
}


    /**
     * Export students data to Excel.
     */
public function export(Request $request)
{
    $query = Student::query()
        ->with(['applicant', 'program', 'halaqohs', 'placements']);

    // 🔍 Pencarian Umum
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('nis', 'like', '%' . $request->search . '%')
              ->orWhere('address', 'like', '%' . $request->search . '%')
              ->orWhere('parent_name', 'like', '%' . $request->search . '%');
        });
    }

    // 👦🏻 Gender
    if ($request->filled('gender_filter') && in_array($request->gender_filter, ['Laki-laki', 'Perempuan'])) {
        $query->where('gender', $request->gender_filter);
    }

    // 🟢 Status
    if ($request->filled('status') && in_array($request->status, ['aktif', 'non-aktif', 'lulus'])) {
        $query->where('status', $request->status);
    }

    // 📘 Type & Period
    if ($request->filled('type') && in_array($request->type, ['Asrama', 'Pulang-Pergi'])) {
        $query->where('type', $request->type);

        if ($request->type === 'Pulang-Pergi' &&
            $request->filled('halaqoh_period') &&
            in_array($request->halaqoh_period, ['Sore', 'Malam'])) {
            $query->where('halaqoh_period', $request->halaqoh_period);
        }
    }

    // 📅 Tahun Masuk
    if ($request->filled('admission_year') &&
        is_numeric($request->admission_year) &&
        strlen($request->admission_year) === 4) {
        $query->where('admission_year', $request->admission_year);
    }

    // 📥 Ambil Data
    $students = $query->orderBy('nis')->get();

    // 📁 Nama File Dinamis
    $filename = 'Data-Santri-DIBAMA-' . now()->format('d-m-Y_H-i-s') . '.xlsx';

    // 🚀 Ekspor Excel
    return Excel::download(new StudentsExport($students), $filename);
}

    /**
     * Import students data from Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048',
        ]);

        try {
            Excel::import(new StudentsImport, $request->file('file'));
            return redirect()->route('admin.students.index')->with('success', 'Data santri berhasil diimpor!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = 'Row ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return redirect()->back()->with('error', 'Failed to import data: ' . implode('; ', $errors));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }

public function getAvailableStudents(Request $request)
{
    $students = Student::whereDoesntHave('currentPlacement')
                ->where('status', 'aktif')
                ->orderBy('nis')
                ->select('id', 'name', 'nis', 'gender')
                ->get();

    return response()->json($students);
}

    /**
     * Generate a unique NIS.
     */
public static function generateUniqueNis(string $type, string $gender, ?string $admissionYear = null): string
{
    if (empty($gender)) {
        throw new \InvalidArgumentException("Jenis kelamin tidak boleh kosong.");
    }

    if (empty($admissionYear)) {
        throw new \InvalidArgumentException("Tahun masuk tidak boleh kosong.");
    }

    $yearPart = $admissionYear;

    // Map type ke inisial
    $typeInitialMap = [
        'Asrama' => 'ASR',
        'Pulang-Pergi' => 'TPQ',
    ];
    $typeInitial = $typeInitialMap[$type] ?? 'TPQ'; // Default fallback
    $genderInitial = strtoupper(substr($gender, 0, 1));

    // Format NIS
    $prefix = "DBM{$yearPart}{$typeInitial}{$genderInitial}";

    $lastNis = self::where('nis', 'like', "{$prefix}%")
        ->orderBy('nis', 'desc')
        ->pluck('nis')
        ->first();

    if ($lastNis) {
        $lastNumber = (int) substr($lastNis, strlen($prefix));
        $nextNumber = $lastNumber + 1;
    } else {
        $nextNumber = 1;
    }

    $paddedSequence = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    return $prefix . $paddedSequence;
}


}