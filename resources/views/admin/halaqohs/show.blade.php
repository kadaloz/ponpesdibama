@extends('layouts.admin')

@section('title', 'Detail Halaqoh: ' . $halaqoh->name)
@section('header_admin', 'Detail Halaqoh')

@section('admin_content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        {{-- Header with Halaqoh Name and Back Button --}}
        <div class="bg-teal-600 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center">
                {{-- Heroicon: Academic Cap (main icon for the section) --}}
                <x-heroicon-o-academic-cap class="h-8 w-8 text-white mr-3" />
                <h1 class="text-2xl font-bold text-white">Detail Halaqoh: {{ $halaqoh->name }}</h1>
            </div>
            <a href="{{ route('admin.halaqohs.index') }}"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-teal-500 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                <x-heroicon-o-arrow-left class="h-5 w-5 mr-2" />
                Kembali ke Daftar
            </a>
        </div>

        {{-- Main Content: Halaqoh Details --}}
        <div class="p-6 space-y-8">
            {{-- Halaqoh General Information --}}
            <div class="pb-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <x-heroicon-o-information-circle class="h-6 w-6 text-gray-500 mr-2" />
                    Informasi Umum Halaqoh
                </h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-gray-700">
                    <div>
                        <dt class="font-medium text-gray-500">Nama Halaqoh</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $halaqoh->name }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Guru Ngaji</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $halaqoh->teacher->full_name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Periode Ngaji</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ ucfirst($halaqoh->period ?? '-') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            @if($halaqoh->status === 'active')
                                <span class="inline-flex items-center px-3 py-1 text-sm font-medium leading-5 rounded-full bg-green-100 text-green-800">
                                    <x-heroicon-s-check-circle class="h-4 w-4 mr-1" />
                                    Aktif
                                </span>
                            @elseif($halaqoh->status === 'completed')
                                <span class="inline-flex items-center px-3 py-1 text-sm font-medium leading-5 rounded-full bg-blue-100 text-blue-800">
                                    <x-heroicon-s-check class="h-4 w-4 mr-1" />
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 text-sm font-medium leading-5 rounded-full bg-gray-200 text-gray-600">
                                    <x-heroicon-s-x-circle class="h-4 w-4 mr-1" />
                                    Non-aktif
                                </span>
                            @endif
                        </dd>
                    </div>
                    @if($halaqoh->description)
                    <div class="md:col-span-2"> {{-- Make description span full width on medium screens --}}
                        <dt class="font-medium text-gray-500">Deskripsi</dt>
                        <dd class="mt-1 text-gray-900 leading-relaxed">{{ $halaqoh->description }}</dd>
                    </div>
                    @endif
                </dl>
            </div>

            {{-- List of Students --}}
            <div class="pt-6">
                <h4 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <x-heroicon-o-users class="h-6 w-6 text-gray-500 mr-2" />
                    Daftar Santri
                </h4>

                @if($halaqoh->students->isEmpty())
                    <div class="bg-blue-50 border-l-4 border-blue-400 text-blue-700 p-4 rounded-md" role="alert">
                        <div class="flex items-center">
                            <x-heroicon-o-information-circle class="h-5 w-5 text-blue-400 mr-2" />
                            <p class="font-medium">Belum ada santri yang terdaftar dalam halaqoh ini.</p>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-lg shadow border border-gray-200"> {{-- Added border for table container --}}
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Santri</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($halaqoh->students as $student)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->nis }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->gender }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Footer with Action Buttons --}}
        <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-200">
            <a href="{{ route('admin.halaqohs.edit', $halaqoh->id) }}"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <x-heroicon-o-pencil class="h-5 w-5 mr-2" />
                Edit Halaqoh
            </a>
            {{-- Delete Button (using form for DELETE request) --}}
            <form action="{{ route('admin.halaqohs.destroy', $halaqoh->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus halaqoh ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <x-heroicon-o-trash class="h-5 w-5 mr-2" />
                    Hapus Halaqoh
                </button>
            </form>
        </div>
    </div>
</div>
@endsection