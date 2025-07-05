<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GeneralManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\GalleryController; // NEW: Import Admin GalleryController
use App\Http\Controllers\Admin\TeacherController; // NEW: Import TeacherController
use App\Http\Controllers\Admin\HalaqohController; // NEW: Import HalaqohController
use App\Http\Controllers\Public\GalleryPublicController; // NEW: Import Public GalleryPublicController
use App\Http\Controllers\Admin\PpdbRequirementController; // NEW: Import PpdbRequirementController
use App\Models\News;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Program;
use App\Models\Applicant;
use App\Models\Gallery; // NEW: Import Gallery model
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the "web" middleware group. Make something great!
|
*/

// Rute untuk Halaman Utama Pondok Dibama (Publik)
Route::get('/', function () {
    $latestNews = News::whereNotNull('published_at')
                        ->orderByDesc('published_at')
                        ->limit(2)
                        ->get();

    $programs = Program::where('is_active', true)->limit(3)->get();

    $settings = Setting::all()->pluck('value', 'key')->toArray();

    $aboutUsContent = $settings['about_us_content'] ?? 'Pondok Pesantren Diniyah Baitul Makmur Aikmel didirikan dengan visi...';
    $missionQuote = $settings['mission_quote'] ?? '"Membina santri menjadi pribadi yang bertakwa, cerdas, mandiri, dan berakhlakul karimah..."';
    $contactAddress = $settings['contact_address'] ?? 'Jl. Contoh Alamat No. 123, Kota Contoh, Provinsi Contoh';
    $contactPhone = $settings['contact_phone'] ?? '+62 812-3456-7890';
    $contactEmail = $settings['contact_email'] ?? 'info@ponpesdibama.com';
    $pondokPhoto = $settings['pondok_photo'] ?? null;
    $locationMapUrl = $settings['location_map_url'] ?? null;
    $isPpdbOpen = filter_var($settings['is_ppdb_open'] ?? false, FILTER_VALIDATE_BOOLEAN);
    $ppdbAcademicYear = $settings['ppdb_academic_year'] ?? date('Y') . '/' . (date('Y') + 1);
    $ctaEnrollmentHeading = $settings['cta_enrollment_heading'] ?? 'Siapkan Masa Depan Gemilang Putra/Putri Anda Bersama PonpesDIBAMA!';
    // Ambil beberapa album galeri yang dipublikasi untuk ditampilkan di homepage
    $galleries = Gallery::published()->latest()->limit(3)->get(); // NEW: Ambil 3 galeri terbaru yang dipublikasi


    return view('home', compact('latestNews', 'aboutUsContent', 'missionQuote', 'contactAddress', 'contactPhone', 'contactEmail', 'pondokPhoto', 'locationMapUrl', 'programs', 'isPpdbOpen', 'ppdbAcademicYear', 'ctaEnrollmentHeading', 'galleries'));
});

// Route untuk menampilkan daftar semua berita publik (dengan filter dan pencarian)
Route::get('/berita', [NewsController::class, 'indexPublic'])->name('news.index_public');


// Rute untuk menampilkan detail berita tunggal publik
Route::get('/berita/{news:slug}', [NewsController::class, 'show'])->name('news.show');

// Rute untuk menampilkan detail program tunggal publik
Route::get('/program/{program:slug}', [ProgramController::class, 'show'])->name('programs.show');

// Rute PPDB Publik (Formulir Pendaftaran)
Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/daftar', [ApplicantController::class, 'create'])->name('create');
    Route::post('/daftar', [ApplicantController::class, 'store'])->name('store');
    Route::get('/sukses', [ApplicantController::class, 'successPage'])->name('success');
});

// --- NEW: Rute Galeri Publik ---
Route::prefix('galeri')->name('public.galleries.')->group(function () {
    Route::get('/', [GalleryPublicController::class, 'index'])->name('index');
    Route::get('/{gallery:slug}', [GalleryPublicController::class, 'show'])->name('show');
});




// Hapus Rute default Dashboard pengguna (dari Breeze)
// Route::get('/dashboard', function () { ... })

// --- Rute Admin Panel (Dashboard Utama untuk semua peran yang relevan) ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Rute untuk Dashboard Admin
    Route::get('/dashboard', function () {
        $totalActiveStudents = Student::where('status', 'aktif')->count();
        $totalGraduatedStudents = Student::where('status', 'lulus')->count();
        $totalStudents = Student::count();
        $studentsByCategory = Student::select('category', DB::raw('count(*) as total'))
                                    ->groupBy('category')
                                    ->pluck('total', 'category')->toArray();
        $totalNews = News::count();
        $totalApplicants = Applicant::count();
        $pendingApplicants = Applicant::where('status', 'pending')->count();
        $acceptedApplicants = Applicant::where('status', 'accepted')->count();

        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $isPpdbOpen = filter_var($settings['is_ppdb_open'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $ppdbAcademicYear = $settings['ppdb_academic_year'] ?? date('Y') . '/' . (date('Y') + 1);


        return view('admin.dashboard', compact(
            'totalActiveStudents', 'totalGraduatedStudents', 'totalStudents', 'studentsByCategory',
            'totalNews',
            'totalApplicants', 'pendingApplicants', 'acceptedApplicants',
            'isPpdbOpen', 'ppdbAcademicYear'
        ));
    })->middleware('permission:view dashboard')->name('dashboard');


    // Rute resource untuk Berita
    Route::resource('news', NewsController::class)->middleware('permission:view news|create news|edit news|delete news');

    // Rute untuk Pengaturan Website
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit')->middleware('permission:manage settings');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update')->middleware('permission:manage settings');

    // Rute resource untuk Santri
     Route::get('students/export/', [StudentController::class, 'export'])->name('students.export')->middleware('permission:export students');
    Route::post('students/import/', [StudentController::class, 'import'])->name('students.import')->middleware('permission:import students');
    Route::resource('students', StudentController::class)->middleware('permission:view students|create students|edit students|delete students|export students|import students');
   
    // Rute untuk Manajemen Umum
    Route::get('/general-management', [GeneralManagementController::class, 'index'])->name('general.dashboard')->middleware('permission:view general management');

    // Rute resource untuk Pengguna (User Management)
    Route::resource('users', UserController::class)->middleware('permission:manage users');

    // Rute resource untuk Program
    Route::resource('programs', ProgramController::class)->middleware('permission:view programs|create programs|edit programs|delete programs');

    // Rute resource untuk Pendaftar (Admin Management)
    Route::resource('applicants', ApplicantController::class)->middleware('permission:view applicants|edit applicants|delete applicants');

    // --- Rute untuk Manajemen Peran & Izin ---
    // Diperbarui: Menggunakan middleware 'permission' untuk izin 'assign roles'
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::get('/{role}/edit', [PermissionController::class, 'edit'])->name('edit');
        Route::put('/{role}', [PermissionController::class, 'update'])->name('update');
    })->middleware('permission:assign roles'); // Middleware diterapkan di sini

    // --- Rute untuk Manajemen Galeri (Admin) ---
        // Diperbarui: Hapus 'except(['show'])' agar admin bisa melihat detail di panel admin
    Route::resource('galleries', GalleryController::class)->middleware('permission:view galleries|create galleries|edit galleries|delete galleries');
    // Rute untuk menghapus gambar individu (tetap di sini)
    Route::delete('galleries/images/{image}', [GalleryController::class, 'deleteImage'])->name('galleries.delete_image')->middleware('permission:delete galleries');
     
    Route::resource('teachers', TeacherController::class)->middleware('permission:view teachers|create teachers|edit teachers|delete teachers');

     // NEW: Rute resource untuk Halaqoh
    Route::resource('halaqohs', HalaqohController::class)->middleware('permission:view halaqohs|create halaqohs|edit halaqohs|delete halaqohs');
    // Rute khusus untuk menghapus jadwal halaqoh via AJAX
    Route::delete('halaqohs/schedules/{schedule}', [HalaqohController::class, 'deleteSchedule'])->name('halaqohs.delete_schedule')->middleware('permission:edit halaqohs');

    // Rute untuk mengelola syarat PPDB (PpdbRequirementController)
    Route::get('ppdb-requirements/edit', [PpdbRequirementController::class, 'edit'])->name('ppdb-requirements.edit')->middleware('permission:edit ppdb requirements');
    Route::put('ppdb-requirements/update', [PpdbRequirementController::class, 'update'])->name('ppdb-requirements.update')->middleware('permission:edit ppdb requirements');



    // Rute Profil Admin
    // Diperbarui: Menggunakan middleware 'permission:manage own profile'
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('permission:manage own profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('permission:manage own profile');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('permission:manage own profile');
});


// Mengimpor rute-rute otentikasi dari Laravel Breeze
require __DIR__.'/auth.php';
