<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateWilayahJson extends Command
{
    protected $signature = 'wilayah:generate';
    protected $description = 'Menggabungkan data wilayah Indonesia menjadi satu file JSON lengkap';

    public function handle()
    {
        $basePath = storage_path('data-indonesia');
        $outputPath = storage_path('app/public/provinsi_kabupaten_kecamatan_kelurahan_nama.json');

        // Cek file provinsi
        if (!file_exists("$basePath/provinsi.json")) {
            $this->error('❌ File provinsi.json tidak ditemukan di: ' . $basePath);
            return;
        }

        // Ambil dan ubah provinsi menjadi array asosiatif
        $provinsiRaw = json_decode(file_get_contents("$basePath/provinsi.json"), true);
        $provinsi = [];
        foreach ($provinsiRaw as $item) {
            $provinsi[$item['id']] = ucwords(strtolower($item['nama']));
        }
        asort($provinsi);

        $result = [];

        foreach ($provinsi as $provId => $provName) {
            $result[$provName] = [];

            $kabPath = "$basePath/kabupaten/$provId.json";
            if (!file_exists($kabPath)) continue;

            $kabupatenRaw = json_decode(file_get_contents($kabPath), true);
            $kabupaten = [];
            foreach ($kabupatenRaw as $item) {
                $kabupaten[$item['id']] = ucwords(strtolower($item['nama']));
            }
            ksort($kabupaten);

            foreach ($kabupaten as $kabId => $kabName) {
                $result[$provName][$kabName] = [];

                $kecPath = "$basePath/kecamatan/$kabId.json";
                if (!file_exists($kecPath)) continue;

                $kecamatanRaw = json_decode(file_get_contents($kecPath), true);
                $kecamatan = [];
                foreach ($kecamatanRaw as $item) {
                    $kecamatan[$item['id']] = ucwords(strtolower($item['nama']));
                }
                ksort($kecamatan);

                foreach ($kecamatan as $kecId => $kecName) {
                    $result[$provName][$kabName][$kecName] = [];

                    $kelPath = "$basePath/kelurahan/$kecId.json";
                    if (!file_exists($kelPath)) continue;

                    $kelurahanRaw = json_decode(file_get_contents($kelPath), true);
                    $kelurahan = [];
                    foreach ($kelurahanRaw as $item) {
                        $kelurahan[] = ucwords(strtolower($item['nama']));
                    }
                    sort($kelurahan);

                    $result[$provName][$kabName][$kecName] = $kelurahan;
                }
            }
        }

        file_put_contents($outputPath, json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $this->info("✅ File berhasil dibuat: $outputPath");
    }
}
