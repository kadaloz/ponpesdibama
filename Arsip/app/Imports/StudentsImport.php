<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

    class StudentsImport implements ToModel, WithHeadingRow, WithValidation
    {
        /**
        * @param array $row
        *
        * @return \Illuminate\Database\Eloquent\Model|null
        */
        public function model(array $row)
        {
            // Jika Anda ingin NIS otomatis digenerate hanya jika kolomnya kosong di Excel,
            // Anda bisa menggunakan logika ini atau memindahkan generate NIS ke Model Observer
            // Jika kolom 'nis' di Excel ada dan terisi, itu akan digunakan.
            $nis = $row['nis'] ?? null;
            if (empty($nis)) {
                 $nis = Student::generateUniqueNis($row['tahun_masuk'] ?? date('Y'));
            }

            return new Student([
                // Pastikan nama kolom di Excel (heading row) sesuai dengan array $row ini
                // Contoh: 'Nama Lengkap' di Excel menjadi 'nama_lengkap' di sini (sesuaikan mapWithHeadings jika perlu)
                'nis' => $nis,
                'name' => $row['nama_lengkap'],
                'gender' => $row['jenis_kelamin'],
                'place_of_birth' => $row['tempat_lahir'],
                'date_of_birth' => $row['tanggal_lahir'], // Pastikan format tanggal sesuai (YYYY-MM-DD)
                'address' => $row['alamat'],
                'parent_name' => $row['nama_orang_tua'],
                'parent_phone' => $row['no_hp_orang_tua'],
                'admission_year' => $row['tahun_masuk'],
                'status' => $row['status'],
                'category' => $row['kategori'],
                'type' => $row['tipe'], // Data kolom baru
                // 'applicant_id' => $row['applicant_id'], // Ini mungkin tidak perlu diimpor
            ]);
        }

        /**
         * Aturan validasi untuk setiap baris data impor.
         * @return array
         */
        public function rules(): array
        {
            return [
                'nama_lengkap' => 'required|string|max:255',
                'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
                'tanggal_lahir' => 'nullable|date',
                'alamat' => 'nullable|string',
                'nama_orang_tua' => 'nullable|string|max:255',
                'no_hp_orang_tua' => 'nullable|string|max:50',
                'tahun_masuk' => 'nullable|integer|digits:4',
                'status' => 'required|string|in:aktif,non-aktif,lulus',
                'kategori' => 'nullable|string|max:255',
                'tipe' => 'nullable|string|in:Asrama,Pulang-Pergi', // Validasi tipe
                'nis' => 'nullable|string|max:255|unique:students,nis', // Validasi NIS, unik
            ];
        }
    }
    