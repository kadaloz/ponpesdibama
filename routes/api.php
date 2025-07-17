<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

// Endpoint lokasi wilayah Indonesia
Route::get('/provinces', [LocationController::class, 'getProvinces'])->name('locations.provinces');
Route::get('/cities', [LocationController::class, 'getCities'])->name('locations.cities');
Route::get('/districts', [LocationController::class, 'getDistricts'])->name('locations.districts');
Route::get('/villages', [LocationController::class, 'getVillages'])->name('locations.villages');

// Endpoint untuk mendapatkan data santri berdasarkan periode
Route::get('/admin/api/students/search', function (Request $request) {
    $search = $request->input('q');

    $students = \App\Models\Student::query()
        ->where('status', 'aktif') // Hanya santri aktif
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%');
        })
        ->limit(20) // Batasi hasil per request
        ->get(['id', 'name', 'nis', 'type', 'halaqoh_period']);

    return response()->json($students->map(function ($student) {
        return [
            'value' => $student->id,
            'text' => "{$student->name} ({$student->nis}) - {$student->type}" .
                      ($student->type === 'Pulang-Pergi' ? " | " . ($student->halaqoh_period ?? '-') : ''),
        ];
    }));
})->middleware('auth'); // Atur middleware jika perlu
