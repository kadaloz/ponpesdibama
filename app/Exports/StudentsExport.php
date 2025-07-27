<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $students;

    /**
     * Terima koleksi santri dari controller.
     */
    public function __construct(Collection $students)
    {
        $this->students = $students;
    }

    /**
     * Kembalikan data untuk diekspor.
     */
    public function collection(): Collection
    {
        return $this->students;
    }

    /**
     * Header kolom.
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
            'Alamat Lengkap',
            'Nama Orang Tua/Wali',
            'No. HP Orang Tua/Wali',
            'Tahun Masuk',
            'Status',
            'Kategori',
            'Tipe',
            'Tanggal Dibuat',
            'Tanggal Diperbarui',
            'ID Pendaftar',
        ];
    }

    /**
     * Mapping data santri ke format Excel.
     */
    public function map($student): array
    {
        return [
            $student->id,
            $student->nis,
            $student->name,
            $student->gender,
            $student->place_of_birth,
            optional($student->date_of_birth)->locale('id')->translatedFormat('d F Y'),
            $student->address,
            $student->parent_name,
            $student->parent_phone,
            $student->admission_year,
            ucfirst($student->status),
            $student->category,
            $student->type,
            optional($student->created_at)->format('d-m-Y H:i:s'),
            optional($student->updated_at)->format('d-m-Y H:i:s'),
            $student->applicant_id,
        ];
    }
}
