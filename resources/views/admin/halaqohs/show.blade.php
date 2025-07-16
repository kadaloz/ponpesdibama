@extends('layouts.admin')

@section('title', 'Detail Halaqoh: ' . $halaqoh->name)
@section('header_admin', 'Detail Halaqoh')

@section('admin_content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">

        <div class="mb-6">
            <h3 class="text-2xl font-bold text-teal-700">{{ $halaqoh->name }}</h3>
            <p class="mt-1 text-gray-600">{{ $halaqoh->description ?? 'Tidak ada deskripsi.' }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 rounded-xl p-4 border border-gray-200">
            <div>
                <dt class="font-semibold text-gray-600">Pengajar:</dt>
                <dd class="text-gray-800">{{ $halaqoh->teacher->full_name ?? '-' }}</dd>
            </div>
            <div>
                <dt class="font-semibold text-gray-600">Periode Ngaji:</dt>
                <dd class="text-gray-800">{{ ucfirst($halaqoh->halaqoh_period ?? '-') }}</dd>
            </div>
            <div>
                <dt class="font-semibold text-gray-600">Tanggal Mulai:</dt>
                <dd class="text-gray-800">{{ $halaqoh->start_date ? \Carbon\Carbon::parse($halaqoh->start_date)->format('d M Y') : '-' }}</dd>
            </div>
            <div>
                <dt class="font-semibold text-gray-600">Status:</dt>
                <dd class="text-gray-800">
                    @if($halaqoh->status === 'active')
                        <span class="inline-block px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Aktif</span>
                    @elseif($halaqoh->status === 'completed')
                        <span class="inline-block px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">Selesai</span>
                    @else
                        <span class="inline-block px-3 py-1 text-xs font-semibold bg-gray-200 text-gray-600 rounded-full">Non-aktif</span>
                    @endif
                </dd>
            </div>
        </div>

        <div class="mt-10">
            <h4 class="text-xl font-bold text-teal-700 mb-3">Daftar Santri</h4>

            @if($halaqoh->students->isEmpty())
                <p class="text-gray-600 bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
                    Belum ada santri yang terdaftar dalam halaqoh ini.
                </p>
            @else
                <div class="overflow-x-auto rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Nama Santri</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">NIS</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Jenis Kelamin</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($halaqoh->students as $student)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $student->name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $student->nis }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $student->gender }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $student->type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('halaqohs.index') }}" class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300">
                Kembali ke Daftar Halaqoh
            </a>
        </div>
    </div>
</div>
@endsection
