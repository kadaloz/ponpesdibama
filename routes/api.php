<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

// Endpoint lokasi wilayah Indonesia
Route::get('/provinces', [LocationController::class, 'getProvinces'])->name('locations.provinces');
Route::get('/cities', [LocationController::class, 'getCities'])->name('locations.cities');
Route::get('/districts', [LocationController::class, 'getDistricts'])->name('locations.districts');
Route::get('/villages', [LocationController::class, 'getVillages'])->name('locations.villages');