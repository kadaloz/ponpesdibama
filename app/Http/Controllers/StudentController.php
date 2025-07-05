<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel; // Import Facade Excel
use App\Exports\StudentsExport; // Import Kelas Export
use App\Imports\StudentsImport; // Import Kelas Import
use Illuminate\Support\Facades\Storage; // Import Storage facade

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->query('sort_by', 'created_at');
        $sortOrder = $request->query('sort_order', 'desc');
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');
        $genderFilter = $request->query('gender_filter');

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

        $query = Student::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%')
                  ->orWhere('parent_name', 'like', '%' . $search . '%');
            });
        }

        if ($genderFilter && in_array($genderFilter, ['Laki-laki', 'Perempuan'])) {
            $query->where('gender', $genderFilter);
        }

        $allStudents = $query->orderBy($sortBy, $sortOrder)->paginate($perPage);

        return view('admin.students.index', compact('allStudents', 'sortBy', 'sortOrder', 'perPage', 'search', 'genderFilter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $halaqohPeriods = ['Sore', 'Malam'];
        return view('admin.students.create', compact('halaqohPeriods'));
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
        return view('admin.students.edit', compact('student', 'halaqohPeriods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
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

        $data = $request->all();

        if ($request->type === 'Asrama') {
            $data['halaqoh_period'] = null;
        }

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
                $path = $request->file($fileInputName)->store('student_documents', 'public');
                $data[$dbColumnName] = $path;
            } elseif ($request->boolean('remove_' . $fileInputName)) {
                if ($student->{$dbColumnName}) {
                    Storage::disk('public')->delete($student->{$dbColumnName});
                }
                $data[$dbColumnName] = null;
            } else {
                $data[$dbColumnName] = $student->{$dbColumnName};
            }
        }

        $student->update($data);

        return redirect()->route('admin.students.index')->with('success', 'Data santri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Data santri berhasil dihapus!');
    }

    /**
     * Export students data to Excel.
     */
    public function export()
    {
        return Excel::download(new StudentsExport, 'santri_data_' . date('Ymd_His') . '.xlsx');
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