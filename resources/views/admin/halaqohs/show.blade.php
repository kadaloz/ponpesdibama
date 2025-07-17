@extends('layouts.admin')

@section('title', 'Detail Halaqoh')
@section('header_admin', 'Detail Halaqoh: ' . $halaqoh->name)

@section('admin_content')
<div class="bg-white shadow rounded-lg p-6 space-y-6">
    {{-- Navigasi --}}
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold text-teal-700">Informasi Halaqoh</h2>
        <a href="{{ route('admin.halaqohs.index') }}" class="text-sm text-gray-600 hover:text-teal-600">
            &larr; Kembali ke daftar halaqoh
        </a>
    </div>

    {{-- Informasi Halaqoh --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
        <div>
            <span class="font-semibold">Nama Halaqoh:</span>
            <p>{{ $halaqoh->name }}</p>
        </div>
        <div>
            <span class="font-semibold">Guru Ngaji:</span>
            <p>{{ $halaqoh->teacher->full_name ?? '-' }}</p>
        </div>
        <div>
            <span class="font-semibold">Periode Ngaji:</span>
            <p>{{ $halaqoh->period ?? '-' }}</p>
        </div>
        <div>
            <span class="font-semibold">Status:</span>
            <p>{{ ucfirst($halaqoh->status) }}</p>
        </div>
        <div>
            <span class="font-semibold">Tanggal Mulai:</span>
            <p>{{ $halaqoh->start_date ? $halaqoh->start_date->format('d M Y') : '-' }}</p>
        </div>
        <div>
            <span class="font-semibold">Tanggal Selesai:</span>
            <p>{{ $halaqoh->end_date ? $halaqoh->end_date->format('d M Y') : '-' }}</p>
        </div>
        <div>
            <span class="font-semibold">Kuota Santri:</span>
            <p>{{ $halaqoh->student_limit ?? 'Tidak terbatas' }}</p>
        </div>
        <div>
            <span class="font-semibold">Jumlah Santri Saat Ini:</span>
            <p>{{ $halaqoh->students->count() }}</p>
        </div>
    </div>

    {{-- Deskripsi --}}
    @if($halaqoh->description)
        <div>
            <span class="font-semibold text-sm text-gray-700">Deskripsi:</span>
            <p class="mt-2 text-gray-600 whitespace-pre-line">{{ $halaqoh->description }}</p>
        </div>
    @endif

    {{-- Daftar Santri --}}
    @if($halaqoh->students->count())
        <div class="pt-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Santri dalam Halaqoh Ini</h3>
            <ul class="divide-y divide-gray-200 border rounded-md">
                @foreach($halaqoh->students as $student)
                    <li class="px-4 py-3 text-sm text-gray-700 flex justify-between items-center">
                        <div>
                            <strong>{{ $student->name }}</strong> (NIS: {{ $student->nis }})
                            <span class="text-xs text-gray-500 ml-2">{{ $student->type }}
                                @if($student->type === 'Pulang-Pergi')
                                    | {{ $student->halaqoh_period }}
                                @endif
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p class="text-sm text-gray-500 pt-6">Belum ada santri yang tergabung dalam halaqoh ini.</p>
    @endif
</div>
@endsection
