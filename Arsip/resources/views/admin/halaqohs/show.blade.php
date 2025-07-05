@extends('layouts.admin')

@section('title', 'Detail Halaqoh')
@section('header_admin', 'Detail Halaqoh')

@section('admin_content')
<div class="bg-white shadow-sm rounded-lg p-6">
    {{-- Informasi Halaqoh --}}
    <h2 class="text-2xl font-bold text-teal-700 mb-4">Informasi Umum</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <div>
            <span class="font-medium text-gray-700">Nama Halaqoh:</span>
            <p class="text-gray-800">{{ $halaqoh->name }}</p>
        </div>
        <div>
            <span class="font-medium text-gray-700">Pengajar:</span>
            <p class="text-gray-800">{{ $halaqoh->teacher->full_name ?? '-' }}</p>
        </div>
        <div>
            <span class="font-medium text-gray-700">Tanggal Mulai:</span>
            <p class="text-gray-800">{{ $halaqoh->start_date ?? '-' }}</p>
        </div>
        <div>
            <span class="font-medium text-gray-700">Tanggal Selesai:</span>
            <p class="text-gray-800">{{ $halaqoh->end_date ?? '-' }}</p>
        </div>
        <div>
            <span class="font-medium text-gray-700">Status:</span>
            <p class="text-gray-800 capitalize">{{ $halaqoh->status }}</p>
        </div>
        <div>
            <span class="font-medium text-gray-700">Batas Santri:</span>
            <p class="text-gray-800">{{ $halaqoh->student_limit ?? '-' }}</p>
        </div>
    </div>

    {{-- Deskripsi --}}
    @if ($halaqoh->description)
        <div class="mt-4">
            <span class="font-medium text-gray-700">Deskripsi:</span>
            <p class="text-gray-800">{{ $halaqoh->description }}</p>
        </div>
    @endif

    {{-- Santri --}}
    <h3 class="text-xl font-semibold text-teal-700 mt-8 mb-3 border-b pb-1">Daftar Santri</h3>
    @if ($halaqoh->students->isEmpty())
        <p class="text-gray-600 text-sm">Belum ada santri yang terdaftar.</p>
    @else
        <ul class="list-disc list-inside text-sm text-gray-800 space-y-1">
            @foreach ($halaqoh->students as $student)
                <li>{{ $student->name }} (NIS: {{ $student->nis }})</li>
            @endforeach
        </ul>
    @endif

    {{-- Jadwal --}}
    <h3 class="text-xl font-semibold text-teal-700 mt-8 mb-3 border-b pb-1">Jadwal Halaqoh</h3>
    @if ($halaqoh->schedules->isEmpty())
        <p class="text-gray-600 text-sm">Belum ada jadwal.</p>
    @else
        <table class="w-full mt-2 text-sm border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-teal-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Hari</th>
                    <th class="px-4 py-2 text-left">Jam</th>
                    <th class="px-4 py-2 text-left">Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($halaqoh->schedules as $schedule)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $schedule->day_of_week }}</td>
                        <td class="px-4 py-2">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td class="px-4 py-2">{{ $schedule->location ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Log Perubahan Jadwal --}}
    <h3 class="text-xl font-semibold text-teal-700 mt-10 mb-3 border-b pb-1">Riwayat Perubahan Jadwal</h3>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.halaqohs.show', $halaqoh->id) }}" class="flex flex-wrap items-center gap-2 mb-4">
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded px-2 py-1 text-sm">
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded px-2 py-1 text-sm">
        <button type="submit" class="bg-teal-600 text-white text-sm px-3 py-1 rounded hover:bg-teal-700">Filter</button>
        <a href="{{ route('admin.halaqohs.show', ['halaqoh' => $halaqoh->id, 'show' => 'all']) }}" class="bg-gray-600 text-white text-sm px-3 py-1 rounded hover:bg-gray-700">Tampilkan Semua</a>
    </form>

    @if ($logs->isEmpty())
        <p class="text-gray-600 text-sm">Belum ada riwayat perubahan jadwal.</p>
    @else
        <div class="overflow-x-auto mt-2">
            <table class="w-full text-sm border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                        <th class="px-4 py-2 text-left">Hari</th>
                        <th class="px-4 py-2 text-left">Jam</th>
                        <th class="px-4 py-2 text-left">Lokasi</th>
                        <th class="px-4 py-2 text-left">User</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        @php
                            $data = $log->data_after ?? $log->data_before ?? [];
                        @endphp
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2 capitalize">{{ $log->action }}</td>
                            <td class="px-4 py-2">{{ $data['day_of_week'] ?? '-' }}</td>
                            <td class="px-4 py-2">
                                {{ $data['start_time'] ?? '-' }} - {{ $data['end_time'] ?? '-' }}
                            </td>
                            <td class="px-4 py-2">{{ $data['location'] ?? '-' }}</td>
                            <td class="px-4 py-2">{{ optional($log->user)->name ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if(method_exists($logs, 'links'))
                <div class="mt-4">
                    {{ $logs->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    @endif

    {{-- Kembali --}}
    <div class="mt-8">
        <a href="{{ route('admin.halaqohs.index') }}"
            class="inline-block px-4 py-2 bg-gray-100 hover:bg-gray-200 text-sm text-gray-800 rounded-md border border-gray-300">
            ← Kembali ke Daftar Halaqoh
        </a>
    </div>
</div>
@endsection
