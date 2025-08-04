<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentsExport implements FromCollection, WithMapping, WithHeadings
{
    public function __construct(protected $filters = [])
    {
    }

    public function collection()
    {
        return Payment::with(['student', 'category'])
        ->when($this->filters['category'], fn($q, $v) => $q->where('category_id', $v))
        ->when($this->filters['student'], fn($q, $v) => $q->where('student_id', $v))
        ->when($this->filters['month'], fn($q, $v) => $q->where('month', 'like', "%$v%"))
        ->when($this->filters['search'], function ($query, $search) {
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        })
        ->orderByDesc('paid_at')
        ->get();
    }

    public function map($payment): array
    {
        return [
            $payment->student->name,
            $payment->category->name,
            $payment->month ?? '-',
            $payment->paid_at->format('d-m-Y'),
            number_format($payment->amount, 0, ',', '.'),
            $payment->method,
            $payment->note ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Santri',
            'Kategori',
            'Bulan',
            'Tanggal Bayar',
            'Jumlah',
            'Metode',
            'Catatan',
        ];
    }
}

