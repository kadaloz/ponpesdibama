<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Program;
use App\Models\Student;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Mail\ApplicantStatusChangedNotification;
use Illuminate\Validation\Rule;
use App\Enums\HalaqohPeriod;
use App\Enums\PpdbType;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource (Admin View).
     */
 public function index(Request $request)
    {
        $query = Applicant::query();

        // 1. Apply Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%')
                  ->orWhere('registration_number', 'like', '%' . $search . '%');
            });
        }

        // 2. Apply Entry Year filter
        if ($request->filled('entry_year')) {
            $query->where('entry_year', $request->input('entry_year'));
        }

        // 3. Apply PPDB Type filter
        if ($request->filled('ppdb_type')) {
            $query->where('ppdb_type', $request->input('ppdb_type'));
        }

        // 4. Apply Halaqoh Period filter (only if ppdb_type is 'Pulang-Pergi')
        if ($request->input('ppdb_type') === 'Pulang-Pergi' && $request->filled('halaqoh_period')) {
            $query->where('halaqoh_period', $request->input('halaqoh_period'));
        }

        // 5. Apply Status filter
        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'accepted') {
                $query->whereIn('status', ['accepted', 're-registered']);
            } else {
                $query->where('status', $status);
            }
        }

        // Order by latest applicants
        $query->latest();

        // Paginate the results
        $allApplicants = $query->paginate(10);

        // Ambil daftar tahun yang tersedia dari kolom entry_year.
        // Cukup ambil satu kali dan kirimkan ke view.
        $availableYears = Applicant::whereNotNull('entry_year')
                                ->distinct()
                                ->orderBy('entry_year', 'desc')
                                ->pluck('entry_year');

        return view('admin.applicants.index', compact('allApplicants', 'availableYears'));
    }

    /**
     * Show the public registration form.
     */
    public function create()
    {
        $programs = Program::where('is_active', true)->get();
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('public.applicants.create', compact('programs', 'settings'));
    }

    /**
     * Store a newly created resource in storage (Public Form Submission).
     */
    public function store(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => ['required'],
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(7)->format('Y-m-d'),
            ],
            'nisn' => ['nullable', 'digits:10'],
            'last_education' => 'nullable|string|max:255',
            'school_origin' => 'nullable|string|max:255',
            'parent_name' => 'required|string',
            'parent_phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'parent_email' => 'nullable|string|email|max:255',
            'parent_occupation' => 'nullable|string|max:255',
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'village' => 'required|string',
            'chosen_program' => 'nullable|string|max:255',
            'ppdb_type' => [
                'required',
                'string',
                Rule::in(enum_values(PpdbType::class)),
            ],
            'halaqoh_period' => [
                'required_if:ppdb_type,Pulang-Pergi',
                Rule::in(enum_values(HalaqohPeriod::class)),
            ],
            'document_akta' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'document_kk' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'document_ijazah' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'document_photo' => 'nullable|file|mimes:jpg,png|max:1024',
        ], [
            'halaqoh_period.required_if' => 'Periode halaqoh wajib diisi jika memilih tipe Pulang-Pergi.',
            'halaqoh_period.in' => 'Periode halaqoh harus dipilih antara Sore atau Malam.',
            'parent_phone.regex' => 'Nomor HP orang tua harus berupa angka dan panjang 10–15 digit.',
            'nisn.digits' => 'NISN harus terdiri dari 10 digit angka.',
        ]);

        // ✅ Validasi tambahan: pastikan tipe pendaftaran yang dipilih memang dibuka
        $settings = Setting::pluck('value', 'key')->toArray();

        $ppdbType = $request->input('ppdb_type');
        $asramaOpen = filter_var($settings['ppdb_asrama_open'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $pulangPergiOpen = filter_var($settings['ppdb_pulang_pergi_open'] ?? false, FILTER_VALIDATE_BOOLEAN);

        if (
            ($ppdbType === 'Asrama' && !$asramaOpen) ||
            ($ppdbType === 'Pulang-Pergi' && !$pulangPergiOpen)
        ) {
            return back()
                ->withErrors(['ppdb_type' => 'Tipe pendaftaran ini sedang tidak dibuka.'])
                ->withInput();
        }


        // ✅ Verifikasi token reCAPTCHA ke Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
            return back()->withErrors(['captcha' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.'])->withInput();
        }

        $data = $request->except(['_token']);
        $data['status'] = 'pending';

        if ($request->ppdb_type === 'Asrama') {
            $data['halaqoh_period'] = null;
        }

        $documentFields = [
            'document_akta' => 'document_akta_path',
            'document_kk' => 'document_kk_path',
            'document_ijazah' => 'document_ijazah_path',
            'document_photo' => 'document_photo_path',
        ];

        foreach ($documentFields as $fileInputName => $dbColumnName) {
            if ($request->hasFile($fileInputName)) {
                $path = $request->file($fileInputName)->store('ppdb_documents', 'public');
                $data[$dbColumnName] = $path;
            }
        }

        $data['entry_year'] = date('Y');
        $applicant = Applicant::create($data);

        return redirect()->route('ppdb.success', ['reg_num' => $applicant->registration_number])
            ->with('success', 'Pendaftaran Anda berhasil dikirim! Silakan tunggu konfirmasi dari kami.');
    }

    /**
     * Display a specific applicant (Admin View).
     */
    public function show(Applicant $applicant)
    {
        return view('admin.applicants.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource (Admin View).
     */
    public function edit(Applicant $applicant)
    {
        $programs = Program::where('is_active', true)->get();
        $statuses = [
            'pending',
            'submitted',
            'under_review',
            'verified',
            'accepted',
            'rejected',
            're-registered',
        ];
        $ppdbTypes = ['Asrama', 'Pulang-Pergi'];
        $halaqohPeriods = ['Sore', 'Malam'];
        return view('admin.applicants.edit', compact('applicant', 'programs', 'statuses', 'ppdbTypes', 'halaqohPeriods'));
    }

    /**
     * Update the specified resource in storage (Admin Action).
     */
    public function update(Request $request, Applicant $applicant)
    {
        $oldStatus = $applicant->status;

        $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(7)->format('Y-m-d'),
            ],
            'nisn' => 'nullable|string|max:255',
            'last_education' => 'nullable|string|max:255',
            'school_origin' => 'nullable|string|max:255',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:50',
            'parent_email' => 'nullable|string|email|max:255',
            'parent_occupation' => 'nullable|string|max:255',
            'address' => 'required|string',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'chosen_program' => 'nullable|string|max:255',
            'ppdb_type' => 'required|string|in:Asrama,Pulang-Pergi',
            'halaqoh_period' => 'nullable|string|in:Sore,Malam',
            'status' => 'required|string|in:pending,submitted,under_review,verified,accepted,rejected,re-registered',
            'admin_notes' => 'nullable|string',

            'document_akta' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'document_kk' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'document_ijazah' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'document_photo' => 'nullable|file|mimes:jpg,png|max:1024',
        ]);

        $data = $request->except(['_token', '_method']);

        if ($request->ppdb_type === 'Asrama') {
            $data['halaqoh_period'] = null;
        }

        $documentFields = [
            'document_akta' => 'document_akta_path',
            'document_kk' => 'document_kk_path',
            'document_ijazah' => 'document_ijazah_path',
            'document_photo' => 'document_photo_path',
        ];

        foreach ($documentFields as $fileInputName => $dbColumnName) {
            if ($request->hasFile($fileInputName)) {
                if ($applicant->{$dbColumnName}) {
                    Storage::disk('public')->delete($applicant->{$dbColumnName});
                }
                $path = $request->file($fileInputName)->store('ppdb_documents', 'public');
                $data[$dbColumnName] = $path;
            } else {
                $data[$dbColumnName] = $applicant->{$dbColumnName};
            }
        }

        $applicant->update($data);

        if ($applicant->status !== $oldStatus && $applicant->parent_email) {
            Mail::to($applicant->parent_email)->send(new ApplicantStatusChangedNotification($applicant, $oldStatus));
        }

        // LOGIKA KONVERSI PENDAFTAR MENJADI SANTRI
        if (in_array($applicant->status, ['accepted', 're-registered']) && !in_array($oldStatus, ['accepted', 're-registered'])) {
            if (!$applicant->student) {
                Student::create([
                    'applicant_id' => $applicant->id,
                    'nis' => Student::generateUniqueNis(
                        $applicant->ppdb_type ?? 'TPQ',
                        $applicant->gender ?? 'L',
                        // FIX: Menggunakan entry_year sebagai tahun masuk
                        $applicant->entry_year ?? date('Y')
                    ),
                    'name' => $applicant->full_name,
                    'gender' => $applicant->gender,
                    'date_of_birth' => $applicant->date_of_birth,
                    'place_of_birth' => $applicant->place_of_birth,
                    'nisn' => $applicant->nisn,
                    'last_education' => $applicant->last_education,
                    'school_origin' => $applicant->school_origin,
                    'address' => $applicant->address,
                    'city' => $applicant->city,
                    'province' => $applicant->province,
                    'district' => $applicant->district,
                    'village' => $applicant->village,
                    'parent_name' => $applicant->parent_name,
                    'parent_phone' => $applicant->parent_phone,
                    'parent_email' => $applicant->parent_email,
                    'parent_occupation' => $applicant->parent_occupation,
                    // FIX: Menggunakan entry_year sebagai admission_year
                    'admission_year' => $applicant->entry_year ?? date('Y'),
                    'status' => 'aktif',
                    'category' => $applicant->chosen_program,
                    'type' => $applicant->ppdb_type,
                    'halaqoh_period' => $applicant->halaqoh_period,
                    'photo_path' => $applicant->document_photo_path,
                    'document_akta_path' => $applicant->document_akta_path,
                    'document_kk_path' => $applicant->document_kk_path,
                    'document_ijazah_path' => $applicant->document_ijazah_path,
                    'document_photo_path' => $applicant->document_photo_path,
                ]);
                // Catat audit trail untuk konversi pendaftar menjadi santri
                record_audit(
                    'convert_applicant_to_student',
                    'Pendaftar berhasil dikonversi menjadi santri: ' . $applicant->full_name,
                    auth()->user()->id ?? null,
                    auth()->user()->name ?? 'Guest',
                    $request->ip(),
                    $request->userAgent()
                );

                return redirect()->route('admin.applicants.index')->with('success', 'Pendaftar berhasil diterima dan data santri dibuat!');
            }
        }
        // Catat audit trail untuk pembaruan pendaftar
        record_audit(
            'update_applicant',
            'Data pendaftar berhasil diperbarui: ' . $applicant->full_name,
            auth()->user()->id ?? null,
            auth()->user()->name ?? 'Guest',
            $request->ip(),
            $request->userAgent()
        );

        return redirect()->route('admin.applicants.index')->with('success', 'Data pendaftar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage (Admin Action).
     */
    public function destroy(Applicant $applicant)
    {
        $documentPaths = [
            $applicant->document_akta_path,
            $applicant->document_kk_path,
            $applicant->document_ijazah_path,
            $applicant->document_photo_path,
        ];

        foreach ($documentPaths as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }

        $applicant->delete();
        // Catat audit trail untuk penghapusan pendaftar
        record_audit(
            'delete_applicant',
            'Data pendaftar berhasil dihapus: ' . $applicant->full_name,
            auth()->user()->id ?? null,
            auth()->user()->name ?? 'Guest',
            request()->ip(),
            request()->userAgent()
        );

        return redirect()->route('admin.applicants.index')->with('success', 'Data pendaftar berhasil dihapus!');
    }

    /**
     * Display a success page after public registration.
     */
    public function successPage(Request $request): \Illuminate\View\View
    {
        $registrationNumber = $request->query('reg_num');
        return view('public.applicants.success', compact('registrationNumber'));
    }

    /**
     * Display the public registration status page.
     */
    public function statusPage(Request $request): \Illuminate\View\View
    {
            $registrationNumber = $request->query('reg_num');

        if (!$registrationNumber) {
            return view('public.applicants.status-form')->withErrors([
                'reg_num' => 'Nomor registrasi harus diisi.'
            ]);
        }

        $applicant = Applicant::where('registration_number', $registrationNumber)->first();

        if (!$applicant) {
            return view('public.applicants.status-form')->withErrors([
                'reg_num' => 'Nomor registrasi tidak ditemukan.'
            ]);
        }

        return view('public.applicants.status-result', compact('applicant'));
    }
    /**
     * Display the public registration terms and conditions.
     */
    public function termsAndConditions(): \Illuminate\View\View
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $terms = $settings['ppdb_terms_and_conditions'] ?? 'Tidak ada syarat dan ketentuan yang ditetapkan.';
        return view('public.applicants.terms', compact('terms'));
    } 
}
