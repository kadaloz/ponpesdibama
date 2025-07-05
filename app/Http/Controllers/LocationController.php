<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvinces()
{
    $filePath = public_path('storage/data/provinsi_kabupaten_full.json');

    if (!file_exists($filePath)) {
        return response()->json(['error' => 'File not found'], 404);
    }

    $data = json_decode(file_get_contents($filePath), true);
    return response()->json(array_keys($data));
}

public function getCities(Request $request)
{
    $province = $request->query('province');
    $filePath = public_path('storage/data/provinsi_kabupaten_full.json');

    if (!file_exists($filePath)) {
        return response()->json(['error' => 'File not found'], 404);
    }

    $data = json_decode(file_get_contents($filePath), true);

    if (!isset($data[$province])) {
        return response()->json(['error' => 'Province not found'], 404);
    }

    return response()->json($data[$province]);
}

}
