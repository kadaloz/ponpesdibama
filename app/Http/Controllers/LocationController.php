<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $filePath;

    public function __construct()
    {
        $this->filePath = storage_path('app/public/provinsi_kabupaten_kecamatan_kelurahan_nama.json');
    }

    public function getProvinces()
    {
        if (!file_exists($this->filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $data = json_decode(file_get_contents($this->filePath), true);
        return response()->json(array_keys($data));
    }

    public function getCities(Request $request)
    {
        $province = $request->query('province');

        if (!file_exists($this->filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $data = json_decode(file_get_contents($this->filePath), true);

        if (!isset($data[$province])) {
            return response()->json(['error' => 'Province not found'], 404);
        }

        return response()->json(array_keys($data[$province]));
    }

    public function getDistricts(Request $request)
    {
        $province = $request->query('province');
        $city = $request->query('city');

        if (!file_exists($this->filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $data = json_decode(file_get_contents($this->filePath), true);

        if (!isset($data[$province][$city])) {
            return response()->json(['error' => 'City not found in province'], 404);
        }

        return response()->json(array_keys($data[$province][$city]));
    }

    public function getVillages(Request $request)
    {
        $province = $request->query('province');
        $city = $request->query('city');
        $district = $request->query('district');

        if (!file_exists($this->filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $data = json_decode(file_get_contents($this->filePath), true);

        if (!isset($data[$province][$city][$district])) {
            return response()->json(['error' => 'District not found in city'], 404);
        }

        return response()->json($data[$province][$city][$district]);
    }
}
