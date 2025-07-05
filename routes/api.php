<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::middleware('api')->get('/provinces', [LocationController::class, 'getProvinces'])->name('locations.provinces');
Route::middleware('api')->get('/cities', [LocationController::class, 'getCities'])->name('locations.cities');
