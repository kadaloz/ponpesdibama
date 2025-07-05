<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Ambil semua data siswa.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Student::all();
    }

    /**
     * Header kolom untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'NIS',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Nama Orang Tua',
            'No. HP Orang Tua',
            'Tahun Masuk',
            'Status',
            'Kategori',
            'Tipe',
            'Created At',
            'Updated At',
            'Applicant ID',
        ];
    }

    /**
     * Mapping data siswa ke format Excel.
     *
     * @param mixed $student
     * @return array
     */
    public function map($student): array
    {
        return [
            $student->id,
            $student->nis,
            $student->name,
            $student->gender,
            $student->place_of_birth,
            $student->date_of_birth ? $student->date_of_birth->format('Y-m-d') : null,
            $student->address,
            $student->parent_name,
            $student->parent_phone,
            $student->admission_year,
            $student->status,
            $student->category,
            $student->type,
            $student->created_at,
            $student->updated_at,
            $student->applicant_id,
        ];
    }
}
