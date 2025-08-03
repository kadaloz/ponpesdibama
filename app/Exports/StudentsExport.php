<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class StudentsExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithTitle,
    WithStyles,
    ShouldAutoSize,
    WithEvents
{
    protected $students;
    protected $rowNumber = 1; // untuk nomor urut

    public function __construct(Collection $students)
    {
        $this->students = $students;
    }

    public function collection(): Collection
    {
        return $this->students;
    }

    public function title(): string
    {
        return 'Data Santri';
    }

    public function headings(): array
    {
        return [
            ['Data Santri Pondok Pesantren DIBAMA'],
            [
                'No', 'NIS', 'Nama Lengkap', 'Jenis Kelamin', 'Tempat Lahir',
                'Tanggal Lahir', 'Alamat Lengkap', 'Desa/Kelurahan', 'Kecamatan',
                'Kabupaten/Kota', 'Provinsi', 'Nama Orang Tua/Wali', 'Pekerjaan Orang Tua/Wali', 'No. HP Orang Tua/Wali',
                'Tahun Masuk', 'Status', 'Program', 'Tipe', 'Periode Halaqoh'
            ]
        ];
    }

    public function map($student): array
    {
        return [
            $this->rowNumber++, // No urut
            $student->nis,
            $student->name,
            $student->gender,
            $student->place_of_birth,
            optional($student->date_of_birth)->locale('id')->translatedFormat('d F Y'),
            $student->address,
            $student->village ?? '-',
            $student->district ?? '-',
            $student->city ?? '-',
            $student->province ?? '-',
            $student->parent_name,
            $student->parent_occupation ?? '-',
            $student->parent_phone,
            $student->admission_year,
            ucfirst($student->status),
            $student->program?->name ?? '-',
            $student->type,
            $student->halaqoh_period ?? '-',

        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 16]],
            2 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A1:V1'); // A1 sampai S1 (19 kolom)
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

                $lastRow = 2 + $this->students->count(); // header + data
                $event->sheet->getStyle("A2:S{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FFAAAAAA'],
                        ],
                    ],
                ]);
            }
        ];
    }
}
